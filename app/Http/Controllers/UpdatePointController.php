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
                $_SESSION['CurrentEditPoint']->type = $_SESSION['CurrentEditPoint']->icon . ',' . $_SESSION['CurrentEditPoint']->type;
                $fieldAccess = $this->EditableFields();
                return view('editpoints',['fieldAccess' => $fieldAccess]);
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
                $fieldsAcces = new PointEditableFieldsClass(" ", " ", " ", "disabled", " ", " ", " ");
            } //Чужой объект
            else {
                $fieldsAcces = new PointEditableFieldsClass("readonly", "readonly", "readonly", "readonly", "readonly", "readonly", "readonly");
            }

        }
        //Если текущий юзер  - с рангом "Любитель"
        if ($_SESSION['User']->rankid == 2 and $_SESSION['CurrentEditPoint']->creatorid == $_SESSION['User']->id) {
            if ($_SESSION['CurrentEditPoint']->creatorid == $_SESSION['User']->id) {
                $fieldsAcces = new PointEditableFieldsClass(" ", " ", " ", " ", " ", " ", " ");
            } //Чужой объект
            else {
                $fieldsAcces = new PointEditableFieldsClass("readonly", "readonly", "readonly", "readonly", "readonly", "readonly", "readonly");
            }

        }
        //Если текущий юзер с рангом "профи"
        if ($_SESSION['User']->rankid == 3) {
            //Текущий юзер - владелец объекта
            if ($_SESSION['CurrentEditPoint']->creatorid == $_SESSION['User']->id) {
                $fieldsAcces = new PointEditableFieldsClass(" ", " ", " ", " ", " ", " ", " ");
            } //Чужой объект
            else {
                $fieldsAcces = new PointEditableFieldsClass("readonly", "hidden", "readonly", " ", "readonly", "readonly", "readonly");
            }
        }
        //Если текущий юзер с рангом "мастер"
        if ($_SESSION['User']->rankid == 4) {
            $fieldsAcces = new PointEditableFieldsClass(" ", " ", " ", " ", " ", " ", " ");
        }
        return $fieldsAcces;
    }

}
