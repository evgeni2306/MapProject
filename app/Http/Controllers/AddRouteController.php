<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Rpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\helpfunc;

class AddRouteController extends Controller
{
    use helpfunc;

    public function AddRoute(Request $request)
    {
        $validateFields = $request->validate([
            'name' => ['required', 'string'],
            'shortdescription' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'difficult' => ['required', 'string', 'ends_with:greenroute,yellowroute,redroute'],
            'distance' => ['nullable', 'string'],
            'time' => ['nullable', 'string'],
            'cord' => ['required'],
        ]);

        if (strlen($validateFields['cord']) > 19) {
            $arr = explode(',', $validateFields['cord']);

            if ($validateFields['time'] == null) {
                $validateFields['time'] = "Не указано";
            }
            if ($validateFields['distance'] == null) {

                for ($i = 0; $i <= count($arr)-3; $i += 2) {
                    $validateFields['distance']+= $this->GetRouteDistanceBetweenPoints($arr[$i],$arr[$i+1],$arr[$i+2],$arr[$i+3]);
                }
                $distance = explode('.',$validateFields['distance']);
                $validateFields['distance'] = $distance[0].'.'.substr($distance[1],0,2).'Км';
            }




            $difficulttype = explode(',', $validateFields['difficult']);
            $rroute = array($arr[$i],
                'creatorid' => Auth::id(),
                'status' => 'Под вопросом',
                'name' => $validateFields['name'],
                'type' => $difficulttype[1],
                'icon' => $difficulttype[2],
                'city' => $this->GetCityByCords($arr[0], $arr[1]),
                'shortdescription' => $validateFields['shortdescription'],
                'description' => $validateFields['description'],
                'difficult' => $difficulttype[0],
                'distance' => $validateFields['distance'],
                'time' => $validateFields['time'],
                'rating' => 0);

            $Route = Route::create($rroute);
            for ($i = 0; $i <= count($arr) - 1; $i += 2) {
                $point = array("routeid" => $Route->id, "lat" => $arr[$i], "lng" => $arr[$i + 1]);
                Rpoint::create($point);
            }
            $this->UpdateUserRating(25);

            return redirect(route('map'));

        } else
            return redirect(\route('map'));
    }

    public function Redirect()
    {
        //Проверка на нахождение в маршруте более, чем 1 точки
        //$_Post['cord'] - строка с координатами через запятую, 19 это 2 цифры и запятая(одна точка)
        if (strlen($_POST['cord']) > 19) {
            return view('addroutes');
        } else
            return redirect(\route('map'));

    }
}
