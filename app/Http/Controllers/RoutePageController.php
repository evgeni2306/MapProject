<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
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

            $getroute = DB::table('routes')
                ->join('users', 'users.id', '=', 'routes.creatorId')
                ->select('routes.id','users.name as uname', 'users.avatar', 'users.surname as usurname','creatorid','routes.name','description','difficult','distance','time','rating')
                ->where('routes.id',$id)
                ->first();

            $getrpoints = DB::table('rpoints')
                ->where('rpoints.routeid', '=', $getroute->id)
                ->select('lat', 'lng')->get();

                $route = new Route;
                $route->id = $getroute->id;
                $route->name = $getroute->name;
                $route->creatorid = $getroute->creatorid;
                $route->description=$getroute->description;
                $route->difficult=$getroute->difficult;
                $route->distace = $getroute->distance;
                $route->time = $getroute->time;
                $route->rating = $getroute->rating;
                $route->rpoints = $getrpoints;
                $route->uname = $getroute->uname;
                $route->usurname = $getroute->usurname;
                $route->avatar=$getroute->avatar;

            $_SESSION['CurrentRoute'] = $route;

            //Определение нужной иконки звездочек в зависимости от значения rating
            switch ($_SESSION['CurrentRoute']->rating) {
                case 0:
                    $_SESSION['CurrentRoute']->rating = "/PageMap/img/icons/stars-0-5.svg";
                    break;
                case 1:
                    $_SESSION['CurrentRoute']->rating = "/PageMap/img/icons/stars-1-5.svg";
                    break;
                case 2:
                    $_SESSION['CurrentRoute']->rating = "/PageMap/img/icons/stars-2-5.svg";
                    break;
                case 3:
                    $_SESSION['CurrentRoute']->rating = "/PageMap/img/icons/stars-3-5.svg";
                    break;
                case 4:
                    $_SESSION['CurrentRoute']->rating = "/PageMap/img/icons/stars-4-5.svg";
                    break;
                case 5:
                    $_SESSION['CurrentRoute']->rating = "/PageMap/img/icons/stars-5-5.svg";
                    break;
            }
//Рейтинг, 0 - иконка, 1 -  кол-во комментов, пока что просто объявление, нужно будет потом в этом же контроллере
            $_SESSION['CurrentRoute']->rating = array(0 => $_SESSION['CurrentRoute']->rating, 1 => 0);

//Получение комментов из бд
            $_SESSION['Rcomments'] = DB::table('rcomments')
                ->join('users', 'rcomments.creatorId', '=', 'users.id')
                ->select('users.name', 'users.surname', 'rating', 'text', 'rcomments.created_at', 'avatar', 'login')
                ->where('routeid', $id)
                ->latest()
                ->get();

//ОПределение иконок рейтинга у комментариев
            foreach ($_SESSION['Rcomments'] as $rcomment) {
                switch ($rcomment->rating) {
                    case 0:
                        $rcomment->rating = "/PageMap/img/icons/stars-0-5.svg";
                        break;
                    case 1:
                        $rcomment->rating = "/PageMap/img/icons/stars-1-5.svg";
                        break;
                    case 2:
                        $rcomment->rating = "/PageMap/img/icons/stars-2-5.svg";
                        break;
                    case 3:
                        $rcomment->rating = "/PageMap/img/icons/stars-3-5.svg";
                        break;
                    case 4:
                        $rcomment->rating = "/PageMap/img/icons/stars-4-5.svg";
                        break;
                    case 5:
                        $rcomment->rating = "/PageMap/img/icons/stars-5-5.svg";
                        break;
                }
            }
            $_SESSION['CurrentRoute']->rating[1] = Count($_SESSION['Rcomments']);

            return view('routepersonal');
        } else {


            return redirect(route('map'));
        }
    }
}
class Route
{
    public $id;
    public $creatorid;
    public $name;
    public $description;
    public $difficult;
    public $distance;
    public $time;
    public $rating;
    public $rpoints = array();
    //Данные владельца
    public $avatar;
    public $uname;
    public $usurname;
}
