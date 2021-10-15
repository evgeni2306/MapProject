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
//            'type'=> 'required',
            'description' => 'required',
        ]);
        $validateFields['creatorid'] = 1;
        $validateFields['type'] = '123';
        $validateFields['lat'] = (double)$validateFields['lat'];
        $validateFields['lng'] = (double)$validateFields['lng'];
        $point = Point::create($validateFields);
//        $_SESSION['MainX']= (double)$validateFields['x'];
//        $_SESSION['MainY'] =(double)$validateFields['y'];

//        $_SESSION['MainX'] = $validateFields['x'];
//        $_SESSION['MainY'] = $validateFields['y'];
        return redirect(route('map'));



    }
}
