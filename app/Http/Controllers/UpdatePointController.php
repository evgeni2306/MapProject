<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdatePointController extends Controller
{
    public function UpdatePoint(Request $request)
    {
        if (Auth::check()) {
            $validateFields = $request->validate([
                'name' => ['max:255'],
                'address' => ['max:255'],
                'type' => ['max:255'],
                'description' => ['max:255']
            ]);
            $typeAndIcon = explode(',', $validateFields['type']);
            $validateFields['type'] = $typeAndIcon[1];
            $validateFields['icon'] = $typeAndIcon[0];
            DB::table('points')
                ->where('id', $_SESSION['CurrentEditPoint']->id)
                ->update(['name' => $validateFields['name'], 'address' => $validateFields['address'],
                    'type' => $validateFields['type'], 'icon' => $validateFields['icon'], 'description' => $validateFields['description']]);
            return redirect(route('GetUpdatePoint', $_SESSION['CurrentEditPoint']->id));
        }
        return redirect(route('login'));
    }

    public function GetUpdatePoint($id)
    {
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0)) {
            $_SESSION['CurrentEditPoint'] = DB::table('points')->select('id', 'name', 'type', 'icon', 'address', 'description')
                ->where('id', $id)->first();
            $_SESSION['CurrentEditPoint']->type = $_SESSION['CurrentEditPoint']->icon . ',' . $_SESSION['CurrentEditPoint']->type;
            return view('test');
        }


    }
}
