<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class GetProfileController extends Controller
{
    use helpfunc;

    public function GetMyProfile()
    {
        if (Auth::check()) {
            if (!isset($_SESSION['User'])) {
                $this->GetUser();
            }
            $_SESSION['UserInfo'] = $this->GetInformation($_SESSION['User']->id);
            return view('profile');
        } else {
            redirect(route('map'));
        }
    }
//метод для получения данных юзера(кол-во маршуртов комментов и точек)
    public function GetInformation($id)
    {
        $Pointscount = Count(DB::table('points')
            ->select('id')
            ->where('creatorid', $id)->get());
        $Commentscount = Count(DB::table('pcomments')
            ->select('id')
            ->where('creatorid', $id)->get());//Тут нужно будет еще посчитать количество комментов у маршрутов и суммировать
        $arr = array(
            "points" => $Pointscount,
            "comments" => $Commentscount,
            "routes" => 0
        );
        return $arr;
    }
}
