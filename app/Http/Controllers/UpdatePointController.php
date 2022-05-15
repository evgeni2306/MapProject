<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class UpdatePointController extends Controller
{
    public function UpdatePoint(Request $request)
    {
        Artisan::call('storage:link');
        if (Auth::check()) {
            $validateFields = $request->validate([
                'name' => ['string', 'required'],
                'address' => ['string', 'nullable'],
                'type' => ['string', 'required', 'ends_with:zpoints,dpoints'],
                'status' => ['string', 'required', 'ends_with:Под вопросом,Работает,Не работает'],
                'description' => ['nullable', 'max:500', 'string'],
                'shortdescription' => ['max:255', 'string', 'nullable'],
                'photo' => ['mimes:jpeg,jpg,png']
            ]);

            if (isset($validateFields['photo'])) {
                $path = Storage::putFile('public/pointphoto', $request->file('photo'));
                $path = 'storage/pointphoto/' . explode('/', $path)[2];
                $oldpath = 'public/pointphoto/' . explode('/', $_SESSION['CurrentEditPoint']->photo)[2];
                $delete = Storage::delete($oldpath);
            } else {
                $path = $_SESSION['CurrentEditPoint']->photo;

            }


            $typeAndIcon = explode(',', $validateFields['type']);
            $validateFields['type'] = $typeAndIcon[1];
            $validateFields['icon'] = $typeAndIcon[0];

            //----Обновление точки----
            DB::table('points')
                ->where('id', $_SESSION['CurrentEditPoint']->id)
                ->update([
                    'name' => $validateFields['name'],
                    'type' => $validateFields['type'],
                    'icon' => $validateFields['icon'],
                    'address' => $validateFields['address'],
                    'status' => $validateFields['status'],
                    'description' => $validateFields['description'],
                    'shortdescription' => $validateFields['shortdescription'],
                    'photo' => $path,
                ]);
            //-----------------------//
            return redirect(route('getpointpage', $_SESSION['CurrentEditPoint']->id));
        }
        return redirect(route('map'));
    }

    public function GetUpdatePoint($id)
    {
        if (Auth::check()) {
            $id = (int)$id;
            if ((is_numeric($id)) and ($id > 0)) {
                $_SESSION['CurrentEditPoint'] = DB::table('points')
                    ->select(
                        'id',
                        'name',
                        'type',
                        'icon',
                        'address',
                        'status',
                        'description',
                        'shortdescription',
                        'photo'
                    )
                    ->where('id', $id)->first();
                $_SESSION['CurrentEditPoint']->type = $_SESSION['CurrentEditPoint']->icon . ',' . $_SESSION['CurrentEditPoint']->type;
                return view('editpoints');
            }
        }
        return redirect(route('login'));

    }

}
