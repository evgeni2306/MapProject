<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Route;
use App\Models\Rpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use PHPUnit\Framework\Constraint\Count;
use SimpleXMLElement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class UploadRouteController extends Controller
{
    public function UploadRoute(Request $request)
    {
        Artisan::call('storage:link');
        $validateFields = $request->validate([
            'name' => ['required', 'string'],
            'shortdescription' => ['required', 'string'],
            'description' => ['required', 'string'],
            'difficult' => ['required', 'string','ends_with:greenroute,yellowroute,redroute'],
            'distance' => ['required', 'string'],
            'time' => ['required', 'string'],
            'file' => ['required','file','mimes:csv,txt,xml'],
            'type' => ['required', 'string','ends_with:CSV,GPX']

        ]);
        $difficulttype = explode(',',$validateFields['difficult']);
        $rroute = array(
            'creatorid' => Auth::id(),
            'status' => 'Под вопросом',
            'type'=>$difficulttype[1],
            'icon'=>$difficulttype[2],
            'name' => $validateFields['name'],
            'shortdescription' => $validateFields['shortdescription'],
            'description' => $validateFields['description'],
            'difficult' => $difficulttype[0],
            'distance' => $validateFields['distance'],
            'time' => $validateFields['time'],
            'rating' => 0,
        );

        $path = Storage::putFile('routes', $request->file('file'));
        switch ($validateFields['type']) {
            case "CSV":
                $this->CSVparse($path, $rroute);
                break;
            case "GPX":
                $this->XMLparse($path, $rroute);
                break;

        }
        return redirect(route('map'));
    }

    public function XMLparse($path, $rroute)
    {
        $xml = new SimpleXMLElement(file_get_contents(storage_path('app\\' . $path)));
        $count = Count($xml->trk->trkseg->trkpt);
        $Route = Route::create($rroute);
        for ($i = 0; $i <= $count - 10; $i += 10) {
            $point = array("routeid" => $Route->id, "lat" => $xml->trk->trkseg->trkpt[$i]['lat'], "lng" => $xml->trk->trkseg->trkpt[$i]['lon']);
            set_time_limit(20);
            Rpoint::create($point);
        }
        $this->DeleteFile($path);
    }

    public function CSVparse($path, $rroute)
    {
        $file = explode("\r\n", (string)file_get_contents(storage_path('app\\' . $path)));
        $count = Count($file);
        $Route = Route::create($rroute);
//        //$i=1 т.к там первая строчка - шапка таблицы
        for ($i = 1; $i <= $count - 10; $i += 10) {
            $row = explode(',', $file[$i]);
            $point = array("routeid" => $Route->id, "lat" => $row[2], "lng" => $row[3]);
            set_time_limit(20);
            Rpoint::create($point);
        }
        $this->DeleteFile($path);
    }

    public function DeleteFile($path)
    {
        $delete = Storage::delete($path);
    }


}
