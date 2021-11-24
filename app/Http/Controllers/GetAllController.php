<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetAllController extends Controller
{
    public function GetPoints(Request $request)
    {
        $getpoints = DB::table('points')->select('lat', 'lng','type','icon','address' ,'name','rating')->get();
        foreach ($getpoints as $point ){
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

if (Auth::check()){
            return view('map');
}else
    return view('unmap');



    }
}
