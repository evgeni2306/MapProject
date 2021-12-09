<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class PointPageController extends Controller
{
    public function GetCurrentPoint($id)
    {
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0)) {
            $_SESSION['CurrentPoint']= DB::table('points')
                ->join('users', 'users.id', '=', 'points.creatorId')
                ->select('points.id','users.name as uname','users.avatar','users.surname as usurname','points.name', 'type','rating','address','lat','lng','icon', 'description')
                ->where('points.id', $id)->first();
            if($_SESSION['CurrentPoint']->type == 'zpoints'){
                $_SESSION['CurrentPoint']->type =array(0 =>"socket.svg", 1=>'Розетка');
            }else if($_SESSION['CurrentPoint']->type == 'dpoints'){
                $_SESSION['CurrentPoint']->type =array(0 =>"building.svg", 1=>'Достопримечательность');
            }
            switch ($_SESSION['CurrentPoint']->rating) {
                case 0:
                    $_SESSION['CurrentPoint']->rating = "/PageMap/img/icons/stars-0-5.svg";
                    break;
                case 1:
                    $_SESSION['CurrentPoint']->rating = "/PageMap/img/icons/stars-1-5.svg";
                    break;
                case 2:
                    $_SESSION['CurrentPoint']->rating = "/PageMap/img/icons/stars-2-5.svg";
                    break;
                case 3:
                    $_SESSION['CurrentPoint']->rating = "/PageMap/img/icons/stars-3-5.svg";
                    break;
                case 4:
                    $_SESSION['CurrentPoint']->rating = "/PageMap/img/icons/stars-4-5.svg";
                    break;
                case 5:
                    $_SESSION['CurrentPoint']->rating = "/PageMap/img/icons/stars-5-5.svg";
                    break;
            }
//echo $_SESSION['CurrentPoint']->rating;

            $_SESSION['Pcomments'] = DB::table('pcomments')
                ->join('users', 'pcomments.creatorId', '=', 'users.id')
                ->select('rating', 'text', 'pcomments.created_at', 'avatar', 'login')
                ->where('pointid', $id)->get();
//            var_dump($_SESSION['Pcomments'][0]->avatar);


            return view('pointpersonal');
        } else {


            return redirect(route('login'));
//            }
        }


    }


}
