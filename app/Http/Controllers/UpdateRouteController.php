<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class UpdateRouteController extends Controller
{
    public function UpdateRoute(Request $request)
    {
        Artisan::call('storage:link');
        if (Auth::check()) {
            $validateFields = $request->validate([
                'name' => ['required', 'string'],
                'shortdescription' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'difficult' => ['string','required',  'ends_with:greenroute,yellowroute,redroute'],
////                'status' => ['string', 'required', 'ends_with:Под вопросом,Работает,Не работает'],
                'distance' => ['nullable', 'string'],
                'time' => ['nullable', 'string'],
            ]);

            $difAndTypeAndIcon = explode(',', $validateFields['difficult']);
            $validateFields['type'] = $difAndTypeAndIcon[1];
            $validateFields['icon'] = $difAndTypeAndIcon[2];
            $validateFields['difficult'] = $difAndTypeAndIcon[0];

            //----Обновление точки----
            DB::table('routes')
                ->where('id', $_SESSION['CurrentEditRoute']->id)
                ->update([
                    'name' => $validateFields['name'],
                    'type' => $validateFields['type'],
                    'icon' => $validateFields['icon'],
                    'difficult' => $validateFields['difficult'],
//                    'status' => $validateFields['status'],
                    'description' => $validateFields['description'],
                    'shortdescription' => $validateFields['shortdescription'],
                    'time'=>$validateFields['time'],
                    'distance'=>$validateFields['distance']
                ]);
            //-----------------------//
            return redirect(route('getroutepage', $_SESSION['CurrentEditRoute']->id));
        }
        return redirect(route('map'));
    }

    public function GetUpdateRoute($id)
    {
        if (Auth::check()) {
            $id = (int)$id;
            if ((is_numeric($id)) and ($id > 0) and Route::where('id', $id)->exists()) {
                $_SESSION['CurrentEditRoute'] = DB::table('routes')
                    ->select(
                        'id',
                        'name',
                        'description',
                        'shortdescription',
                        'difficult',
                        'distance',
                        'status',
                        'distance',
                        'type',
                        'icon',
                        'time',
                    )
                    ->where('id', $id)->first();
                $_SESSION['CurrentEditRoute']->difficult = $_SESSION['CurrentEditRoute']->difficult . "," . $_SESSION['CurrentEditRoute']->type . "," . $_SESSION['CurrentEditRoute']->icon;
                return view('editroutes');
            }
        }
        return redirect(route('login'));

    }
}
