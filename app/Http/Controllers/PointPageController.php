<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointPageController extends Controller
{
    public function GetCurrentPoint($id)
    {
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0)) {
            $point = DB::table('points')->select('id','type', 'description')
                ->where('id', $id)->first();
$_SESSION['CurrentPoint'] = $point;
return view('test');


        } else {

//            if (!Auth::check()) {
//                return redirect(route('auth.login'));
//            } else {
                return redirect(route('login'));
//            }
        }


    }


}
