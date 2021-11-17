<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddPointController extends Controller
{
    public function AddPoint(Request $request)
    {
        $validateFields = $request->validate([
            'lat' => 'required',
            'lng' => 'required',
            'address'=>'required',
            'name'=>'required',
            'type'=> 'required',

        ]);
        $typeAndIcon = $validateFields['type'];
        $typeAndIcon = explode(',',$typeAndIcon);
        $validateFields['icon'] = $typeAndIcon[0];
        $validateFields['type'] = $typeAndIcon[1];

        $validateFields['creatorid'] = Auth::id();
        $validateFields['rating'] = 0;
        $validateFields['lat'] = (double)$validateFields['lat'];
        $validateFields['lng'] = (double)$validateFields['lng'];
        $point = Point::create($validateFields);
        return redirect(route('map'));



    }
}
