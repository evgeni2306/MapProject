<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Models\Route;
use App\Models\Rpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddRouteController extends Controller
{
    public function AddRoute(Request $request)
    {
        $validateFields = $request->validate([
            'cord' => 'required',
        ]);
        $rroute = array(
            'creatorid'=>Auth::id(),
            'status'=>'Под вопросом',
            'name'=>'TEXT',
            'shortdescription'=>'TEXT',
            'description'=>'TEXT',
            'difficult'=>'TEXT',
            'distance'=>'TEXT',
            'time'=>'TEXT',
            'rating'=>0);
        $Route = Route::create($rroute);
        $arr =  explode(',',$validateFields['cord']);

        for ($i = 0; $i <= count($arr)-1; $i+=2) {
            $point = array("routeid"=>$Route->id, "lat"=>$arr[$i], "lng"=>$arr[$i+1]);
            Rpoint::create($point);
        }

        return redirect(route('map'));





    }
}
