<?php

namespace App\Http\Controllers;

use App\Models\Pointphoto;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;

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
        $validateFields['description'] = 'Отсутствует';
        $validateFields['lat'] = (double)$validateFields['lat'];
        $validateFields['lng'] = (double)$validateFields['lng'];
        $point = Point::create($validateFields);
        if($validateFields['type']=='zpoints' ){
            $mainphoto = "/PageMap/img/icons/socket-picture.svg";
        }else{
            $mainphoto = "/PageMap/img/icons/landmark-picture.svg";
        }

        $photofields  = array("pointid"=>$point->id,"photo1" =>$mainphoto,"photo2"=>'',"photo3"=>'');

        $pointphoto = Pointphoto::create($photofields);

        return redirect(route('map'));



    }
}
