<?php

namespace App\Http\Controllers;

use App\Models\Rcomment;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\helpfunc;
use App\Models\Route;
use Illuminate\Support\Facades\Auth;

class RcommentActionController extends Controller
{
    use helpfunc;

    public function AddRcomment(Request $request)
    {
        $validateFields = $request->validate([
            'rating' => ['required',],
            'text' => ['required', 'string'],
        ]);
        $checkComment  = DB::table('rcomments')
            ->where('creatorid',"=", Auth::id())
            ->where('routeid',"=",$_SESSION['CurrentRoute']->id)
            ->get();
        if (Count($checkComment) ==1){
            return redirect(route('getroutepage',$_SESSION['CurrentRoute']->id));
        }

        $validateFields['creatorid'] = $_SESSION['User']->id;
        $validateFields['routeid'] = $_SESSION['CurrentRoute']->id;
        $rcomment = Rcomment::create($validateFields);
        $rate = $this->RatingCalculate();
        $this->UpdateUserRating(3);
        return redirect(route('getroutepage',$_SESSION['CurrentRoute']->id));


    }

    public function RatingCalculate()
    {
        $getrating = DB::table('rcomments')
            ->select('rating')
            ->where('routeid', $_SESSION['CurrentRoute']->id)
            ->get();
        $currentrating = 0;
        foreach ($getrating as $rating) {
            $currentrating += $rating->rating;
        }
        if ($currentrating > 0 and Count($getrating) > 0) {
            $currentrating = $currentrating / Count($getrating);
        }
        $rating = Route::where('id', $_SESSION['CurrentRoute']->id)->update(['rating' => $currentrating]);


    }


    public function DeleteRcomment($id)
    {
        $deleteroute = DB::table('rcomments')
            ->where('id', $id)
            ->delete();
        $this->RatingCalculate($_SESSION['CurrentRoute']->id);
        return redirect(route('getroutepage', $_SESSION['CurrentRoute']->id));
    }

    public function UpdateRcomment(Request $request )
    {
        $validateFields = $request->validate([
            'rating' => ['required',],
            'text' => ['required', 'string'],
            'id'=>['required']
        ]);
        $creatorid =  $geletepoint = DB::table('rcomments')
            ->where('id', $validateFields['id'])
            ->select('creatorid')
            ->first();

        if (Auth::check() and $_SESSION['User']->id == $creatorid->creatorid and Rcomment::where('id', $validateFields['id'])->exists()) {
            $rcomment = Rcomment::where('id',$validateFields['id'])->update(['rating'=>$validateFields['rating'],'text'=>$validateFields['text']]);
            $this->RatingCalculate($_SESSION['CurrentRoute']->id);
            return redirect(route('getroutepage', $_SESSION['CurrentRoute']->id));
        }
    }
}
