<?php

namespace App\Http\Controllers;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdatePointController extends Controller
{
    public function GetPointInfo($id){
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0)){
            $pointData=DB::table('points')->select('id','creatorid','name','address','description')
                ->where('id',$id)->first();
            if (Auth::id()==$pointData->creatorid){
                $_SESSION['ChangingPoint']=$pointData;
                return view('changepointinfo');
            }
            else
                return redirect('map');

        }
    }
}
