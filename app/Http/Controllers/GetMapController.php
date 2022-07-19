<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
use App\Models\Route as Route;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Classes\RouteMapClass;

class GetMapController extends Controller
{
    use helpfunc;

    public function GetAll()
    {
        if (!isset($_SESSION['User'])) {
            $getpoints = $this->GetWorkingObjects("points");
            $getroutes = $this->GetWorkingObjects("routes");
        } else {
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
            $count = $this->GetObjectCommentsCount("point", $point->id);
            $point->rating = [$point->rating, $count];
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
            $count = $this->GetObjectCommentsCount("route", $Route->id);
            $Route->rating = [$Route->rating, $count];
        }

        // Определение иконки сложности и цвета статуса у маршрутов и подстановка часов для вывода на карту
        foreach ($Routes as $route) {
            $route->icon = [$route->icon, 2];
            $route->status = [$route->status,2];
            if ($route->status[0] == "Не работает") {
                $route->status[1] = "status-broken";
            }
            if ($route->status[0] == "Под вопросом") {
                $route->status[1] = "status-unknown";
            }
            if ($route->status[0] == "Работает") {
                $route->status[1] = "status-working";
            }

            if ($route->difficult == "Сложно") {
                $route->icon[1] = "redroute";
            }
            if ($route->difficult == "Средне") {
                $route->icon[1] = "yellowroute";
            }
            if ($route->difficult == "Легко") {
                $route->icon[1] = "greenroute";
            }
            if (is_numeric((float)$route->time) and (float)$route->time != 0) {
                $route->time = $route->time." Ч";
            }
        }
        //Определение цвета статуса у точек
        foreach ($getpoints as $point){
            $point->status = [$point->status,2];
            if ($point->status[0] == "Не работает") {
                $point->status[1] = "status-broken";
            }
            if ($point->status[0] == "Под вопросом") {
                $point->status[1] = "status-unknown";
            }
            if ($point->status[0] == "Работает") {
                $point->status[1] = "status-working";
            }
        }


        if (Auth::check()) {
            if (!isset($_SESSION['User'])) {
                $this->GetUser();
            }
            return view('map', ['points' => $getpoints, 'routes' => $Routes]);
        } else
            return view('unmap', ['points' => $getpoints, 'routes' => $Routes]);
    }


    //Получение объектов, где статус "работает" и "под вопросом"
    public function GetWorkingObjects($type)
    {
        if ($type == "points") {
            $getpoints = DB::table('points')
                ->select('points.id', 'lat', 'lng', 'type', 'icon', 'address', 'name', 'rating', 'photo', 'shortdescription',
                    'status')
                ->where('status', '!=', 'Не работает')
                ->get();
            return $getpoints;
        } else if ($type == "routes") {
            $getroutes = DB::table('routes')
                ->select('id', 'name', 'icon', 'type', 'shortdescription', 'difficult', 'distance', 'time', 'rating', 'status')
                ->where('status', '!=', 'Не работает')
                ->get();
            return $getroutes;
        }
    }


    //Метод получения маршрута для прорисовки на карту, при нажатии соответствующей кнопки
    public function GetRouteToDraw($id)
    {
        if ((is_numeric($id)) and ($id > 0) and Route::where('id', $id)->exists()) {
            $getrpoints = DB::table('rpoints')
                ->where('rpoints.routeid', '=', $id)
                ->select('lat', 'lng')->get();
            return $getrpoints;
        }

    }
}

