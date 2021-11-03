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
        $_SESSION['MainX'] = 56.838285;
        $_SESSION['MainY'] = 60.603442;
        $getpoints = DB::table('points')->select('lat', 'lng','type','address' ,'name')->get();
        $_SESSION['Points'] = $getpoints;

if (Auth::check()){
            return view('Map');
}else
    return view('unmap');



    }
}
