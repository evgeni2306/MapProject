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
            $point = DB::table('points')
                ->join('users', 'users.id', '=', 'points.creatorId')
                ->select('points.id','users.name','users.surname','points.name', 'type','address','lat','lng','icon', 'description')
                ->where('points.id', $id)->first();
            $_SESSION['CurrentPoint'] = $point;
            print_r($_SESSION['CurrentPoint']);
//            $pcomments = DB::table('pcomments')
//                ->join('users', 'pcomments.creatorId', '=', 'users.id')
//                ->select('rating', 'text', 'pcomments.created_at', 'avatar', 'login')
//                ->where('pointid', $id)->get();
//            $_SESSION['Pcomments'] = $pcomments;
//
//
//            return view('pointpersonal');
        } else {


            return redirect(route('login'));
//            }
        }


    }


}
