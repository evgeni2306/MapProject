<?php

namespace App\Http\Controllers;

use App\Classes\RouteEditableFieldsClass;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class UpdateRouteController extends Controller
{
    //Валидация входящих данных и последующе обновление маршрута
    public function UpdateRoute(Request $request)
    {
        Artisan::call('storage:link');
        if (Auth::check()) {
            $validateFields = $request->validate([
                'name' => ['required', 'string'],
                'shortdescription' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'difficult' => ['string', 'required', 'ends_with:Легко,Средне,Сложно'],
                'status' => ['string', 'required', 'ends_with:Под вопросом,Работает,Не работает'],
                'distance' => ['nullable', 'string'],
                'time' => ['nullable', 'string'],
            ]);

            //----Обновление маршрута----
            $this->UpdateRouteDb($validateFields['name'], $validateFields['description'],
                $validateFields['shortdescription'], $validateFields['difficult'], $validateFields['status'],
                $validateFields['distance'], $validateFields['time']);

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
                        'creatorid',
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

                $fieldAccess = $this->EditableFields();
                return view('editroutes', ['fieldAccess' => $fieldAccess]);
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
            if ($_SESSION['CurrentEditRoute']->creatorid == $_SESSION['User']->id) {
                $fieldsAcces = new RouteEditableFieldsClass(" ", " ", "hidden", "", " ", " ", " ", " ");
            } //Чужой объект
            else {
                $fieldsAcces = new RouteEditableFieldsClass("readonly", "hidden", "hidden", "readonly", "readonly", "readonly", "readonly", "disabled");
            }

        }
        //Если текущий юзер  - с рангом "Любитель"
        if ($_SESSION['User']->rankid == 2) {
            if ($_SESSION['CurrentEditRoute']->creatorid == $_SESSION['User']->id) {
                //Текущий юзер - владелец объекта
                $fieldsAcces = new RouteEditableFieldsClass(" ", " ", " ", " ", " ", " ", " ", " ");
            } //Чужой объект
            else {
                $fieldsAcces = new RouteEditableFieldsClass("readonly", "hidden", "hidden", "readonly", "readonly", "readonly", "readonly", "disabled");
            }

        }
        //Если текущий юзер с рангом "профи"
        if ($_SESSION['User']->rankid == 3) {
            //Текущий юзер - владелец объекта
            if ($_SESSION['CurrentEditRoute']->creatorid == $_SESSION['User']->id) {
                $fieldsAcces = new RouteEditableFieldsClass(" ", " ", " ", " ", " ", " ", " ", " ");
            } //Чужой объект
            else {
                $fieldsAcces = new RouteEditableFieldsClass("readonly", "hidden", " ", "readonly", "readonly", "readonly", "readonly", " ");
            }
        }
        //Если текущий юзер с рангом "мастер"
        if ($_SESSION['User']->rankid == 4) {
            $fieldsAcces = new RouteEditableFieldsClass(" ", " ", " ", " ", " ", " ", " ", " ");
        }
        if($_SESSION['User']->rankid != 1 and $_SESSION['User']->rankid!= 2 and $_SESSION['User']->rankid !=3 and $_SESSION['User']->rankid !=4){
            $fieldsAcces = new RouteEditableFieldsClass("readonly", "hidden", "hidden", "readonly", "readonly", "readonly", "readonly", "disabled");
        }
        return $fieldsAcces;
    }

    public function UpdateRouteDb($name, $description, $shortdescription, $difficult, $status, $distance, $time)
    {


        if ($_SESSION['User']->rankid == 1) {
            //Текущий юзер - владелец объекта
            if ($_SESSION['CurrentEditRoute']->creatorid == $_SESSION['User']->id) {
                DB::table('routes')
                    ->where('id', $_SESSION['CurrentEditRoute']->id)
                    ->update([
                        'name' => $name,
                        'description' => $description,
                        'shortdescription' => $shortdescription,
                        'difficult' => $difficult,
                        'distance' => $distance,
                        'time' => $time
                    ]);
            } //Чужой объект
            else {
                return null;
            }

        }
        //Если текущий юзер  - с рангом "Любитель"
        if ($_SESSION['User']->rankid == 2) {
            if ($_SESSION['CurrentEditRoute']->creatorid == $_SESSION['User']->id) {
                //Текущий юзер - владелец объекта
                DB::table('routes')
                    ->where('id', $_SESSION['CurrentEditRoute']->id)
                    ->update([
                        'name' => $name,
                        'status' => $status,
                        'description' => $description,
                        'shortdescription' => $shortdescription,
                        'difficult' => $difficult,
                        'distance' => $distance,
                        'time' => $time
                    ]);
                $this->ChangeRouteByStatus($_SESSION['CurrentEditRoute']->id);

            } //Чужой объект
            else {
                return null;
            }

        }
        //Если текущий юзер с рангом "профи"
        if ($_SESSION['User']->rankid == 3) {
            //Текущий юзер - владелец объекта
            if ($_SESSION['CurrentEditRoute']->creatorid == $_SESSION['User']->id) {
                DB::table('routes')
                    ->where('id', $_SESSION['CurrentEditRoute']->id)
                    ->update([
                        'name' => $name,
                        'status' => $status,
                        'description' => $description,
                        'shortdescription' => $shortdescription,
                        'difficult' => $difficult,
                        'distance' => $distance,
                        'time' => $time
                    ]);
                $this->ChangeRouteByStatus($_SESSION['CurrentEditRoute']->id);
            } //Чужой объект
            else {
                DB::table('routes')
                    ->where('id', $_SESSION['CurrentEditRoute']->id)
                    ->update([
                        'status' => $status,
                    ]);
                $this->ChangeRouteByStatus($_SESSION['CurrentEditRoute']->id);
            }
        }
        //Если текущий юзер с рангом "мастер"
        if ($_SESSION['User']->rankid == 4) {

            DB::table('routes')
                ->where('id', $_SESSION['CurrentEditRoute']->id)
                ->update([
                    'name' => $name,
                    'status' => $status,
                    'description' => $description,
                    'shortdescription' => $shortdescription,
                    'difficult' => $difficult,
                    'distance' => $distance,
                    'time' => $time
                ]);
            $this->ChangeRouteByStatus($_SESSION['CurrentEditRoute']->id);
        }
    }

    //Метод по смене иконки и типа маршрута, при установке/смене статуса "Не работает"
    public function ChangeRouteByStatus($id)
    {

        $getroute = DB::table('routes')
            ->select('id', 'status', 'icon', 'type', 'difficult')
            ->where('id', $id)->first();

        if ($getroute->status == "Не работает") {

            $getroute->icon = "grayroute";
            $getroute->type = "inobject";
        } else {
            if ($getroute->difficult == "Легко") {
                $getroute->icon = "greenroute";
                $getroute->type = "groutes";
            }
            if ($getroute->difficult == "Средне") {
                $getroute->icon = "yellowroute";
                $getroute->type = "yroutes";
            }
            if ($getroute->difficult == "Сложно") {
                $getroute->icon = "redroute";
                $getroute->type = "rroutes";
            }
        }
        DB::table('routes')
            ->where('id', $id)
            ->update([
                'type' => $getroute->type,
                'icon' => $getroute->icon,
            ]);
    }
}
