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
            'lat' => ['required','numeric'],
            'lng' => ['required','numeric'],
            'address' => ['required','string'],
            'name' => ['required','string'],
            'type' => ['required','string'],

        ]);
        $typeAndIcon = explode(',', $validateFields['type']);

        $validateFields = array(
            "lat" => (double)$validateFields['lat'],
            "lng" => (double)$validateFields['lng'],
            "address" => $validateFields['address'],
            "name" => $validateFields['name'],
            "type" => $typeAndIcon[1],
            "icon" => $typeAndIcon[0],
            "creatorid" => Auth::id(),
            "rating" => 0,
            "description" => 'Отсутствует',
        );
//        dd($validateFields);
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
