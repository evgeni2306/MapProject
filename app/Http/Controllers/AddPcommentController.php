<?php

namespace App\Http\Controllers;

use App\Models\Pcomment;
use Illuminate\Http\Request;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use App\Http\helpfunc;
use Illuminate\Support\Facades\Auth;

class AddPcommentController extends Controller
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
        $rate = $this->RatingCalculate();
        $this->UpdateUserRating(3);
        return redirect(route('getpointpage',$_SESSION['CurrentPoint']->id));


    }

    public function RatingCalculate()
    {
        $getrating = DB::table('pcomments')
            ->select('rating')
            ->where('pointid', $_SESSION['CurrentPoint']->id)
            ->get();
        $currentrating = 0;
        foreach ($getrating as $rating) {
            $currentrating += $rating->rating;
        }
        $currentrating = $currentrating / Count($getrating);
        $rating = Point::where('id', $_SESSION['CurrentPoint']->id)->update(['rating' => $currentrating]);


    }
}
