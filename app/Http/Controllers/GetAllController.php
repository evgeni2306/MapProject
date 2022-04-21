<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetAllController extends Controller
{
    use helpfunc;

    public function GetPoints(Request $request)
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
            ->select('id','name')->get();
        $Routes = array();
        foreach ($getroutes as $getroute) {
            $route = new Route;
            $route->id = $getroute->id;
            $route->name = $getroute->name;
            array_push($Routes, $route);
        }
        foreach ($Routes as $rpoint) {
            $getrpoints = DB::table('rpoints')
                ->where('rpoints.routeid', '=', $rpoint->id)
                ->select('lat', 'lng')->get();
            array_push($rpoint->rpoints, $getrpoints);
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

class Route
{
    public $id = 0;
    public $name = 'd';
    public $rpoints = array();
}
