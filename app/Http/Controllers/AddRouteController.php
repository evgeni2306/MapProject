<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Rpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\helpfunc;

class AddRouteController extends Controller
{
    use helpfunc;

    public function AddRoute(Request $request)
    {
        $validateFields = $request->validate([
            'name' => ['required', 'string'],
            'shortdescription' => [ 'string'],
            'description' => ['nullable', 'string'],
            'difficult' => ['required', 'string', 'ends_with:greenroute,yellowroute,redroute'],
            'distance' => ['nullable', 'string'],
            'time' => ['nullable', 'string'],
            'cord' => ['required'],
        ]);
        $difficulttype = explode(',', $validateFields['difficult']);
        $rroute = array(
            'creatorid' => Auth::id(),
            'status' => 'Под вопросом',
            'name' => $validateFields['name'],
            'type' => $difficulttype[1],
            'icon' => $difficulttype[2],
            'shortdescription' => $validateFields['shortdescription'],
            'description' => $validateFields['description'],
            'difficult' => $difficulttype[0],
            'distance' => $validateFields['distance'],
            'time' => $validateFields['time'],
            'rating' => 0);
        $Route = Route::create($rroute);
        $arr = explode(',', $validateFields['cord']);

        for ($i = 0; $i <= count($arr) - 1; $i += 2) {
            $point = array("routeid" => $Route->id, "lat" => $arr[$i], "lng" => $arr[$i + 1]);
            Rpoint::create($point);
        }
        $this->UpdateUserRating(25);

        return redirect(route('map'));


    }

    public function Redirect()
    {
        return view('addroutes');
    }
}
