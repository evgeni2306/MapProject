<?php

namespace App\Http\Controllers;


use App\Models\Route;
use App\Models\Rpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\helpfunc;
use SimpleXMLElement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class UploadRouteController extends Controller
{
    use helpfunc;

    public function UploadRoute(Request $request)
    {
        Artisan::call('storage:link');
        $validateFields = $request->validate([
            'name' => ['required', 'string'],
            'shortdescription' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'difficult' => ['required', 'string', 'ends_with:greenroute,yellowroute,redroute'],
            'distance' => ['nullable', 'string'],
            'time' => ['nullable', 'string'],
            'file' => ['required', 'file'],
            'type' => ['required', 'string', 'ends_with:CSV,GPX']

        ]);

        if ($validateFields['time'] == null) {
            $validateFields['time'] = "Не указано";
        }
        if ($validateFields['distance'] == null) {
            $validateFields['distance'] = "Не указано";
        }

        $difficulttype = explode(',', $validateFields['difficult']);
        $rroute = array(
            'creatorid' => Auth::id(),
            'status' => 'Под вопросом',
            'type' => $difficulttype[1],
            'icon' => $difficulttype[2],
            'name' => $validateFields['name'],
            'shortdescription' => $validateFields['shortdescription'],
            'description' => $validateFields['description'],
            'difficult' => $difficulttype[0],
            'distance' => $validateFields['distance'],
            'time' => $validateFields['time'],
            'rating' => 0,
        );

        $path = Storage::putFile('routes', $request->file('file'));
        $type = explode('.', $path);
        if ($validateFields['type'] == "CSV" and $type[1] == "txt") {
            $this->CSVparse($path, $rroute);
        } else
            if ($validateFields['type'] == "GPX" and $type[1] == "xml") {
                $this->XMLparse($path, $rroute);
            } else {
                $fileTypeError = "Выбранный вами тип файла не совпадает с типом загруженного";
                return redirect()->back()->withErrors(['error' => $fileTypeError])->withInput();
            }

        $this->UpdateUserRating(25);
        return redirect(route('map'));
    }

    //Разбор GPX файла
    public function XMLparse($path, $rroute)
    {
        $xml = new SimpleXMLElement(file_get_contents(storage_path('app\\' . $path)));
        $count = Count($xml->trk->trkseg->trkpt);
        $Route = Route::create($rroute);
        $arr = [];
        $row = $xml->trk->trkseg->trkpt;
        for ($i = 0; $i <= $count - 10; $i += 10) {
            $point = array("routeid" => $Route->id, "lat" => $row[$i]['lat'], "lng" => $row[$i]['lon']);
            array_push($arr, $point);
            set_time_limit(20);
        }
        Rpoint::insert($arr);


        if ($rroute['distance'] == null or $rroute['distance'] == "Не указано") {
            $distance = 0;
            for ($i = 0; $i <= $count - 3; $i += 2) {
                $distance += $this->GetRouteDistanceBetweenPoints($xml->trk->trkseg->trkpt[$i]['lat'], $xml->trk->trkseg->trkpt[$i + 1]['lon'], $xml->trk->trkseg->trkpt[$i + 2]['lat'], $xml->trk->trkseg->trkpt[$i + 3]['lon']);
                set_time_limit(20);
            }
            $distance = explode('.', $distance);
            $dist = $distance[0] . '.' . substr($distance[1], 0, 2);
            Route::where('id', $Route->id)->update(['distance' => $dist]);
        }
        $this->SetCity($xml->trk->trkseg->trkpt[0]['lat'], $xml->trk->trkseg->trkpt[0]['lon'], $Route);
        $this->DeleteFile($path);
    }

    //Разбор CSV файла
    public function CSVparse($path, $rroute)
    {
        $file = explode("\n", (string)file_get_contents(storage_path('app\\' . $path)));
        $count = Count($file);
        $Route = Route::create($rroute);

        $abc = explode(',', $file[0]);
        for ($i = 0; $i < count($abc); $i++) {
            $abc[$i] = mb_strtolower(trim($abc[$i]));
        }
        $indexlat = array_search('latitude', $abc);
        $indexlng = array_search('longitude', $abc);
//        //$i=1 т.к там первая строчка - шапка таблицы
        $arr = [];
        for ($i = 1; $i <= $count - 10; $i += 10) {
            $row = explode(',', $file[$i]);
            $point = array("routeid" => $Route->id, "lat" => $row[$indexlat], "lng" => $row[$indexlng]);
            array_push($arr, $point);
            set_time_limit(20);
        }
        Rpoint::insert($arr);

        if ($rroute['distance'] == null or $rroute['distance'] == "Не указано") {
            $distance = 0;
            for ($i = 1; $i <= $count - 3; $i += 2) {
                $row = explode(',', $file[$i]);
                $row1 = explode(',', $file[$i + 1]);
                $distance += $this->GetRouteDistanceBetweenPoints($row[$indexlat], $row[$indexlng], $row1[$indexlat], $row1[$indexlng]);
                set_time_limit(20);
            }
            $distance = explode('.', $distance);
            $dist = $distance[0] . '.' . substr($distance[1], 0, 2);
            Route::where('id', $Route->id)->update(['distance' => $dist]);
        }


        $row = explode(',', $file[1]);
        $this->SetCity($row[$indexlat], $row[$indexlng], $Route);
        $this->DeleteFile($path);
    }

    //Автоопределение города маршрута, по первой его точке
    public function SetCity($lat, $lng, $route)
    {
        $city = $this->GetCityByCords($lat, $lng);

        DB::table('routes')
            ->where('id', $route->id)
            ->update([
                'city' => $city
            ]);
    }

    //Удаление разобранного файла с маршрутом
    public function DeleteFile($path)
    {
        $delete = Storage::delete($path);
    }


}
