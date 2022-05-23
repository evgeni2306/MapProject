<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
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
            ->select('points.id', 'lat', 'lng', 'type', 'icon', 'address', 'name', 'rating', 'photo', 'shortdescription',
                'status')->get();
        //определение иконок для рейтинга точки
        foreach ($getpoints as $point) {
            $point = $this->GetObjectRatingIcon($point);
        }
        $getroutes = DB::table('routes')
            ->select('id', 'name', 'icon', 'type', 'shortdescription', 'difficult', 'distance', 'time', 'rating', 'status')->get();
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
            $Route = $this->GetObjectRatingIcon($Route);
        }


        if (Auth::check()) {
            if (!isset($_SESSION['User'])) {
                $this->GetUser();
            }
            return view('map', ['points' => $getpoints, 'routes' => $Routes]);
        } else
            return view('unmap', ['points' => $getpoints, 'routes' => $Routes]);


    }
}

