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
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'address' => ['required', 'string'],
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],

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
            "status" => "Под вопросом",
            "shortdescription" => "",
            "description" => 'Отсутствует',
        );
        if ($validateFields['type'] == 'zpoints') {
            $validateFields['photo'] = "/PageMap/img/icons/socket-picture.svg";
        } else {
            $validateFields['photo'] = "/PageMap/img/icons/landmark-picture.svg";
        }
        $point = Point::create($validateFields);
        return redirect(route('map'));
    }
//    public function SavePoint(Request $request)
//    {
//        $validateFields = $request->validate([
//            'lat' => ['required','numeric'],
//            'lng' => ['required','numeric'],
//            'address' => ['required','string'],
//            'name' => ['required','string'],
//            'type' => ['required','string'],
//
//        ]);
//        $typeAndIcon = explode(',', $validateFields['type']);
//
//        $validateFields = array(
//            "lat" => (double)$validateFields['lat'],
//            "lng" => (double)$validateFields['lng'],
//            "address" => $validateFields['address'],
//            "name" => $validateFields['name'],
//            "type" => $typeAndIcon[1],
//            "icon" => $typeAndIcon[0],
//            "creatorid" => Auth::id(),
//            "rating" => 0,
//            "status"=> "Под вопросом",
//            "shortdescription"=> "",
//            "description" => 'Отсутствует',
//        );
//        if($validateFields['type']=='zpoints' ){
//            $validateFields['photo'] = "/PageMap/img/icons/socket-picture.svg";
//        }else{
//            $validateFields['photo'] = "/PageMap/img/icons/landmark-picture.svg";
//        }
//        $point = Point::create($validateFields);
//
//
//        return redirect(route('map'));
//
//
//    }
}
