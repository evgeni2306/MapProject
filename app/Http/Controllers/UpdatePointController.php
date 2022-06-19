<?php

namespace App\Http\Controllers;

use App\Classes\PointEditableFieldsClass;
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
                'photo' => ['mimes:jpeg,jpg,png', 'nullable']
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
            $this->UpdatePointDb($validateFields['name'], $validateFields['type'],
                $validateFields['icon'], $validateFields['address'], $validateFields['status'],
                $validateFields['description'], $validateFields['shortdescription'], $path);

            //-----------------------//
            return redirect(route('getpointpage', $_SESSION['CurrentEditPoint']->id));
        }
        return redirect(route('map'));
    }

    public function GetUpdatePoint($id)
    {
        if (Auth::check()) {
            $id = (int)$id;
            if ((is_numeric($id)) and ($id > 0) and Point::where('id', $id)->exists()) {
                $_SESSION['CurrentEditPoint'] = DB::table('points')
                    ->select(
                        'id',
                        'creatorid',
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

                if ($_SESSION['CurrentEditPoint']->icon == "house"){
                    $_SESSION['CurrentEditPoint']->type = "house,dpoints";
                }
                if ($_SESSION['CurrentEditPoint']->icon == "socket"){
                    $_SESSION['CurrentEditPoint']->type = "socket,zpoints";
                }

                if ($_SESSION['CurrentEditPoint']->icon == "inhouse"){
                    $_SESSION['CurrentEditPoint']->type = "house,dpoints";
                }
                if ($_SESSION['CurrentEditPoint']->icon == "insocket"){
                    $_SESSION['CurrentEditPoint']->type = "socket,zpoints";
                }
                $fieldAccess = $this->EditableFields();
                return view('editpoints', ['fieldAccess' => $fieldAccess]);
            }
        }
        return redirect(route('login'));

    }

    //Определение доступных для редактирования полей
    public function EditableFields()
    {
        $fieldsAcces = "";
        //Если текущий юзер - с рангом "Новичок"
        if ($_SESSION['User']->rankid == 1) {
            //Текущий юзер - владелец объекта
            if ($_SESSION['CurrentEditPoint']->creatorid == $_SESSION['User']->id) {
                $fieldsAcces = new PointEditableFieldsClass(" ", " ", " ", "hidden", " ", " ", " ", " ");
            } //Чужой объект
            else {
                $fieldsAcces = new PointEditableFieldsClass("readonly", "hidden", "readonly", "hidden", "readonly", "readonly", "disabled", "disabled");
            }

        }
        //Если текущий юзер  - с рангом "Любитель"
        if ($_SESSION['User']->rankid == 2) {
            if ($_SESSION['CurrentEditPoint']->creatorid == $_SESSION['User']->id) {
                //Текущий юзер - владелец объекта
                $fieldsAcces = new PointEditableFieldsClass(" ", " ", " ", " ", " ", " ", " ", " ");
            } //Чужой объект
            else {
                $fieldsAcces = new PointEditableFieldsClass("readonly", "hidden", "readonly", "hidden", "readonly", "readonly", "disabled", "disabled");
            }

        }
        //Если текущий юзер с рангом "профи"
        if ($_SESSION['User']->rankid == 3) {
            //Текущий юзер - владелец объекта
            if ($_SESSION['CurrentEditPoint']->creatorid == $_SESSION['User']->id) {
                $fieldsAcces = new PointEditableFieldsClass(" ", " ", " ", " ", " ", " ", " ", " ");
            } //Чужой объект
            else {
                $fieldsAcces = new PointEditableFieldsClass("readonly", "hidden", "readonly", " ", "readonly", "readonly", "disabled", " ");
            }
        }
        //Если текущий юзер с рангом "мастер"
        if ($_SESSION['User']->rankid == 4) {
            $fieldsAcces = new PointEditableFieldsClass(" ", " ", " ", " ", " ", " ", " ", " ");
        }
        return $fieldsAcces;
    }


    public function UpdatePointDb($name, $type, $icon, $address, $status, $description, $shortdescription, $photo)
    {


        if ($_SESSION['User']->rankid == 1) {
            //Текущий юзер - владелец объекта
            if ($_SESSION['CurrentEditPoint']->creatorid == $_SESSION['User']->id) {
                DB::table('points')
                    ->where('id', $_SESSION['CurrentEditPoint']->id)
                    ->update([
                        'name' => $name,
                        'type' => $type,
                        'icon' => $icon,
                        'address' => $address,
                        'description' => $description,
                        'shortdescription' => $shortdescription,
                        'photo' => $photo,
                    ]);
            } //Чужой объект
            else {
                return null;
            }

        }
        //Если текущий юзер  - с рангом "Любитель"
        if ($_SESSION['User']->rankid == 2) {
            if ($_SESSION['CurrentEditPoint']->creatorid == $_SESSION['User']->id) {
                //Текущий юзер - владелец объекта
                DB::table('points')
                    ->where('id', $_SESSION['CurrentEditPoint']->id)
                    ->update([
                        'name' => $name,
                        'type' => $type,
                        'icon' => $icon,
                        'address' => $address,
                        'status' => $status,
                        'description' => $description,
                        'shortdescription' => $shortdescription,
                        'photo' => $photo,
                    ]);
                $this->ChangePointByStatus($_SESSION['CurrentEditPoint']->id);

            } //Чужой объект
            else {
                return null;
            }

        }
        //Если текущий юзер с рангом "профи"
        if ($_SESSION['User']->rankid == 3) {
            //Текущий юзер - владелец объекта
            if ($_SESSION['CurrentEditPoint']->creatorid == $_SESSION['User']->id) {
                DB::table('points')
                    ->where('id', $_SESSION['CurrentEditPoint']->id)
                    ->update([
                        'name' => $name,
                        'type' => $type,
                        'icon' => $icon,
                        'address' => $address,
                        'status' => $status,
                        'description' => $description,
                        'shortdescription' => $shortdescription,
                        'photo' => $photo,
                    ]);
                $this->ChangePointByStatus($_SESSION['CurrentEditPoint']->id);
            } //Чужой объект
            else {
                DB::table('points')
                    ->where('id', $_SESSION['CurrentEditPoint']->id)
                    ->update([
                        'status' => $status,
                    ]);
                $this->ChangePointByStatus($_SESSION['CurrentEditPoint']->id);
            }
        }
        //Если текущий юзер с рангом "мастер"
        if ($_SESSION['User']->rankid == 4) {

            DB::table('points')
                ->where('id', $_SESSION['CurrentEditPoint']->id)
                ->update([
                    'name' => $name,
                    'type' => $type,
                    'icon' => $icon,
                    'address' => $address,
                    'status' => $status,
                    'description' => $description,
                    'shortdescription' => $shortdescription,
                    'photo' => $photo,
                ]);
            $this->ChangePointByStatus($_SESSION['CurrentEditPoint']->id);
        }
    }

    //Метод по смене иконки и типа точки, при установке/смене статуса "Не работает"
    public function ChangePointByStatus($id)
    {

        $getpoint = DB::table('points')
            ->select('id', 'status', 'type', 'icon')
            ->where('id', $id)->first();

        if ($getpoint->status == "Не работает") {
            if ($getpoint->type == "dpoints") {
                $getpoint->icon = "inhouse";
                $getpoint->type = "inobject";
            }
            if ($getpoint->type == "zpoints") {
                $getpoint->icon = "insocket";
                $getpoint->type = "inobject";
            }
        } else {
            if ($getpoint->icon == "inhouse") {
                $getpoint->icon = "house";
                $getpoint->type = "dpoints";
            }
            if ($getpoint->icon == "insocket") {
                $getpoint->icon = "socket";
                $getpoint->type = "zpoints";
            }
        }
        DB::table('points')
            ->where('id', $id)
            ->update([
                'type' => $getpoint->type,
                'icon' => $getpoint->icon,
            ]);
    }
}
