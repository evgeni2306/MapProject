<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\View\Component;
use PHPUnit\Framework\Constraint\Count;
use SimpleXMLElement;

class UpdatePointController extends Controller
{
    public function UpdatePoint(Request $request)
    {
        if (Auth::check()) {
            $validateFields = $request->validate([
                'name' => ['max:255'],
                'address' => ['max:255'],
                'type' => ['max:255'],
                'status' => ['max:255'],
                'description' => ['max:255'],
                'shortdescription' => ['max:255'],
                'photo'  //УБРАТЬ ОГРАНИЧЕНИЕ

            ]);

            $path = Storage::putFile('public/pointphoto', $request->file('photo'));
            $oldpath = 'public/pointphoto/' . explode('/', $_SESSION['CurrentEditPoint']->photo)[2];

            $delete = Storage::delete($oldpath);

            $path = 'storage/pointphoto/' . explode('/', $path)[2];
            $typeAndIcon = explode(',', $validateFields['type']);
            $validateFields['type'] = $typeAndIcon[1];
            $validateFields['icon'] = $typeAndIcon[0];
            DB::table('points')
                ->where('id', $_SESSION['CurrentEditPoint']->id)
                ->update([
                    'name' => $validateFields['name'],
                    'photo' => $path, 'status' => $validateFields['status'],
                    'address' => $validateFields['address'],
                    'type' => $validateFields['type'],
                    'icon' => $validateFields['icon'],
                    'description' => $validateFields['description'],
                    'shortdescription'=>$validateFields['shortdescription'],
                ]);
            return redirect(route('GetUpdatePoint', $_SESSION['CurrentEditPoint']->id));
        }
        return redirect(route('login'));
    }

    public function GetUpdatePoint($id)
    {
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0)) {
            $_SESSION['CurrentEditPoint'] = DB::table('points')->select('id', 'name', 'type', 'icon', 'address', 'description', 'shortdescription', 'status', 'photo')
                ->where('id', $id)->first();
            $_SESSION['CurrentEditPoint']->type = $_SESSION['CurrentEditPoint']->icon . ',' . $_SESSION['CurrentEditPoint']->type;
            return view('editpoints');
        }


    }

}
