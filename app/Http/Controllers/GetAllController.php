<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
//use http\Env\Request;
use App\Models\Route as Route;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Classes\RouteMapClass;
use Illuminate\Http\Request;
class GetAllController extends Controller
{
    use helpfunc;

    public function GetAll()
    {
        if (!isset($_SESSION['User'])) {
            $getpoints = $this->GetWorkingObjects("points");
            $getroutes = $this->GetWorkingObjects("routes");
        }else{
            //Получение точек и маршрутов, основываясь на разграничениях юзера по ролям
            if ($_SESSION['User']->rankid < 2) {
                $getpoints = $this->GetWorkingObjects("points");
                $getroutes = $this->GetWorkingObjects("routes");
            } else {
                //получение всех точек из бд
                $getpoints = DB::table('points')
                    ->select('points.id', 'lat', 'lng', 'type', 'icon', 'address', 'name', 'rating', 'photo', 'shortdescription',
                        'status')->get();
                //получение всех маршрутов из бд
                $getroutes = DB::table('routes')
                    ->select('id', 'name', 'icon', 'type', 'shortdescription', 'difficult', 'distance', 'time', 'rating', 'status')->get();
            }
        }


        //определение иконок для рейтинга точки
        foreach ($getpoints as $point) {
            $point = $this->GetObjectRatingIcon($point);
        }
        //Превращение загруженных маршрутов в объект RouteMapClass для последующей выгрузки на карту
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

        //определение иконок для рейтинга маршрута
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


    //Получение объектов, где статус != "Не работает"
    public function GetWorkingObjects($type){

        if ($type =="points"){
            $getpoints = DB::table('points')
                ->select('points.id', 'lat', 'lng', 'type', 'icon', 'address', 'name', 'rating', 'photo', 'shortdescription',
                    'status')
                ->where('status', '!=', 'Не работает')
                ->get();
            return $getpoints;
        }else if($type=="routes"){
            $getroutes = DB::table('routes')
                ->select('id', 'name', 'icon', 'type', 'shortdescription', 'difficult', 'distance', 'time', 'rating', 'status')
                ->where('status', '!=', 'Не работает')
                ->get();
            return $getroutes;
        }
    }
    public function GetRouteToDraw($id){
        if ((is_numeric($id)) and ($id > 0) and Route::where('id', $id)->exists()) {
            $getrpoints = DB::table('rpoints')
                ->where('rpoints.routeid', '=', $id)
                ->select('lat', 'lng')->get();
            return $getrpoints;
        }



//        $getpoints = DB::table('points')
//            ->select('points.id', 'lat', 'lng', 'type', 'icon', 'address', 'name', 'rating', 'photo', 'shortdescription',
//                'status')
//            ->where('id','<','10')
//            ->get();
//       return
//         return dd($_POST);
//        redirect(route('logout'));
////        dd($request);
//        return 'Darova'.$id;
    }
}

