<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Classes\RouteMapClass;

class GetAllController extends Controller
{
    use helpfunc;

    public function GetAll(Request $request)
    {
        //получение всех точек из бд
        $getpoints = DB::table('points')
            ->select('points.id', 'lat', 'lng', 'type', 'icon', 'address', 'name', 'rating', 'photo','shortdescription',
            'status')->get();
        //определение иконок для рейтинга точки
        foreach ($getpoints as $point) {
            switch ($point->rating) {
                case 0:
                    $point->rating = "/PageMap/img/icons/stars-0-5.svg";
                    break;
                case 1:
                    $point->rating = "/PageMap/img/icons/stars-1-5.svg";
                    break;
                case 2:
                    $point->rating = "/PageMap/img/icons/stars-2-5.svg";
                    break;
                case 3:
                    $point->rating = "/PageMap/img/icons/stars-3-5.svg";
                    break;
                case 4:
                    $point->rating = "/PageMap/img/icons/stars-4-5.svg";
                    break;
                case 5:
                    $point->rating = "/PageMap/img/icons/stars-5-5.svg";
                    break;
            }
        }
        $_SESSION['Points'] = $getpoints;

        $getroutes = DB::table('routes')
            ->select('id','name','icon','type','shortdescription','difficult','distance','time','rating','status')->get();
        $Routes = array();
        foreach ($getroutes as $getroute) {
            $route = new RouteMapClass(
                $getroute->id,
                $getroute->name,
                $getroute->status,
                $getroute->type,
                $getroute->icon,
                $getroute->shortdescription,
                $getroute->difficult,
                $getroute->distance,
                $getroute->time,
                $getroute->rating


            );
            array_push($Routes, $route);
        }
        foreach ($Routes as $rpoint) {
            $getrpoints = DB::table('rpoints')
                ->where('rpoints.routeid', '=', $rpoint->id)
                ->select('lat', 'lng')->first();
            $rpoint->lat = $getrpoints->lat;
            $rpoint->lng = $getrpoints->lng;
        }
        foreach ($Routes as $Route) {
            switch ($Route->rating) {
                case 0:
                    $Route->rating = "/PageMap/img/icons/stars-0-5.svg";
                    break;
                case 1:
                    $Route->rating = "/PageMap/img/icons/stars-1-5.svg";
                    break;
                case 2:
                    $Route->rating = "/PageMap/img/icons/stars-2-5.svg";
                    break;
                case 3:
                    $Route->rating = "/PageMap/img/icons/stars-3-5.svg";
                    break;
                case 4:
                    $Route->rating = "/PageMap/img/icons/stars-4-5.svg";
                    break;
                case 5:
                    $Route->rating = "/PageMap/img/icons/stars-5-5.svg";
                    break;
            }
        }
        $_SESSION['Routes'] = $Routes;


        if (Auth::check()) {
            if (!isset($_SESSION['User'])) {
                $this->GetUser();
            }
            return view('map');
        } else
            return view('unmap');


    }
}

