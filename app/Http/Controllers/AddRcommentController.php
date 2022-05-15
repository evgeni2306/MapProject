<?php

namespace App\Http\Controllers;

use App\Models\Rcomment;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\helpfunc;
use App\Models\Route;

class AddRcommentController extends Controller
{
    use helpfunc;

    public function AddRcomment(Request $request)
    {
        $validateFields = $request->validate([
            'rating' => ['required',],
            'text' => ['required', 'string'],
        ]);
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
        $currentrating = $currentrating / Count($getrating);
        $rating = Route::where('id', $_SESSION['CurrentRoute']->id)->update(['rating' => $currentrating]);


    }
}
