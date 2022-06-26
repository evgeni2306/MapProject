<?php

namespace App\Http\Controllers;

use App\Models\Pcomment;
use Illuminate\Http\Request;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use App\Http\helpfunc;
use Illuminate\Support\Facades\Auth;

class PcommentActionController extends Controller
{
    use helpfunc;

    public function AddPcomment(Request $request)
    {
        $validateFields = $request->validate([
            'rating' => ['required',],
            'text' => ['required', 'string'],
        ]);
        $checkComment  = DB::table('pcomments')
            ->where('creatorid',"=", Auth::id())
            ->where('pointid',"=",$_SESSION['CurrentPoint']->id)
            ->get();
        if (Count($checkComment) ==1){
            return redirect(route('getpointpage',$_SESSION['CurrentPoint']->id));
        }
        $validateFields['creatorid'] = $_SESSION['User']->id;
        $validateFields['pointid'] = $_SESSION['CurrentPoint']->id;
        $pcomment = Pcomment::create($validateFields);
        $rate = $this->RatingCalculate($_SESSION['CurrentPoint']->id);
        $this->UpdateUserRating(3);
        return redirect(route('getpointpage',$_SESSION['CurrentPoint']->id));


    }

    public function RatingCalculate($id)
    {
        $getrating = DB::table('pcomments')
            ->select('rating')
            ->where('pointid', $id)
            ->get();
        $currentrating = 0;
        foreach ($getrating as $rating) {
            $currentrating += $rating->rating;
        }
        if($currentrating >0 and Count($getrating)>0){
            $currentrating = $currentrating / Count($getrating);
        }

        $rating = Point::where('id', $id)->update(['rating' => $currentrating]);


    }
    public function DeletePcomment($id){
        $getrating = DB::table('pcomments')
            ->where('id', $id)
            ->delete();
        $this->RatingCalculate($_SESSION['CurrentPoint']->id);
        return redirect(route('getpointpage',$_SESSION['CurrentPoint']->id));

    }
}
