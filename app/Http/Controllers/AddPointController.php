<?php

namespace App\Http\Controllers;

use App\Models\Pointphoto;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\helpfunc;

class AddPointController extends Controller
{
    use helpfunc;

    public function AddPoint(Request $request)
    {
        $validateFields = $request->validate([
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'address' => ['nullable', 'string',],
            'name' => ['required', 'string'],
            'type' => ['required', 'string', 'ends_with:zpoints,dpoints'],

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
        $this->UpdateUserRating(10);
        return redirect(route('GetUpdatePoint', $point->id));
    }
}
