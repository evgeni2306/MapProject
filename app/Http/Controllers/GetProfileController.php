<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class GetProfileController extends Controller
{
    public function GetMyProfile()
    {
        if (Auth::check()) {
            $_SESSION['UserInfo'] = $this->GetInformation($_SESSION['User']->id);
            return view('profile');
        } else {
            redirect(route('map'));
        }
    }

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
            "routes"=>0
        );
        return $arr;
    }
}
