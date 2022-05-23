<?php

namespace App\Http\Controllers;

use App\Classes\RoutePageClass;
use App\Http\helpfunc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Route as Rout;

class RoutePageController extends Controller
{
    use helpfunc;

    public function GetCurrentRoute($id)
    {

        if (!isset($_SESSION['User']) and Auth::check()) {
            $this->GetUser();
        }
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0) and Rout::where('id', $id)->exists()) {
            //Получение точки из бд

// var_dump(abs($z));
            $getroute = DB::table('routes')
                ->join('users', 'users.id', '=', 'routes.creatorId')
                ->select('routes.id', 'users.name as uname', 'users.avatar', 'users.surname as usurname', 'creatorid', 'routes.name', 'description', 'status', 'difficult', 'distance', 'time', 'icon', 'routes.rating')
                ->where('routes.id', $id)
                ->first();

            $getrpoints = DB::table('rpoints')
                ->where('rpoints.routeid', '=', $getroute->id)
                ->select('lat', 'lng')->get();


            $rpointsarr = array();
            $pointarr = array();
            for ($i = 0; $i < count($getrpoints) - 1; $i += 1) {
                array_push($rpointsarr, $getrpoints[$i]);
            }
            $getpoints = DB::table('points')
                ->select('points.id', 'lat', 'lng', 'type', 'icon', 'address', 'name', 'rating', 'photo', 'shortdescription',
                    'status')
                ->get();
            for ($i = 0; $i < count($rpointsarr); $i += 1) {
                foreach ($getpoints as $point) {
                    if (abs($rpointsarr[$i]->lat - $point->lat) < 0.00875 and abs($rpointsarr[$i]->lng - $point->lng) < 0.00875) {
                        if (!in_array($point, $pointarr)) {
                            array_push($pointarr, $point);
                        }

                    }
                }
            }

            $route = new RoutePageClass(
                $getroute->id,
                $getroute->creatorid,
                $getroute->name,
                $getroute->status,
                $getroute->description,
                $getroute->difficult,
                $getroute->distance,
                $getroute->time,
                $getroute->rating,
                $getrpoints,
                $getroute->avatar,
                $getroute->uname,
                $getroute->usurname,
                $getroute->icon,
                $pointarr
            );

            $_SESSION['CurrentRoute'] = $route;

            //Определение нужной иконки звездочек в зависимости от значения rating
            $_SESSION['CurrentRoute'] = $this->GetObjectRatingIcon($_SESSION['CurrentRoute']);

//Рейтинг, 0 - иконка, 1 -  кол-во комментов, пока что просто объявление, нужно будет потом в этом же контроллере
            $_SESSION['CurrentRoute']->rating = array(0 => $_SESSION['CurrentRoute']->rating, 1 => 0);

//Получение комментов из бд
            $_SESSION['Rcomments'] = DB::table('rcomments')
                ->join('users', 'rcomments.creatorId', '=', 'users.id')
                ->select('users.name', 'users.surname', 'rcomments.rating', 'text', 'rcomments.created_at', 'avatar', 'login')
                ->where('routeid', $id)
                ->latest()
                ->get();

            //ОПределение иконок рейтинга у комментариев
            $_SESSION['Rcomments'] = $this->GetCommentRatingIcon($_SESSION['Rcomments']);


            $_SESSION['CurrentRoute']->rating[1] = Count($_SESSION['Rcomments']);

            return view('routepersonal');
        } else {
            return redirect(route('map'));
        }
    }
}
