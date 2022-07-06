<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateUserController extends Controller
{
    public function UpdateUser(Request $request)
    {
        if (Auth::check()) {
            $validateFields = $request->validate([
                'name' => ['required', 'max:255', 'string'],
                'surname' => ['required', 'max:255', 'string'],
                'nickname' => ['nullable', 'string', 'max:255'],
                'transport' => ['nullable', 'max:255', 'string'],
                'mapstyle' => ['string', 'ends_with:ISLbB6B5aw,{x}/{y}.png'],
                'photo' => ['mimes:jpeg,jpg,png']
            ]);

            //---Проверка на размер загружаемого файла и уникальность никнейма соответственно---
            if (isset($validateFields['photo'])) {
                if (filesize($validateFields['photo']) > 4928307) {
                    $user = $this->GetUserFields();
                    $user->name = $validateFields['name'];
                    $user->surname = $validateFields['surname'];
                    $user->nickname = $validateFields['nickname'];
                    $user->transport = $validateFields['transport'];
                    $user->mapstyle = $validateFields['mapstyle'];
                    $fileSizeError = "Выбранный вами файл слишком большой для загрузки";
                    return view('settings', ['user' => $user, 'fileSizeError' => $fileSizeError]);
                }
            }
            if ($validateFields['nickname'] != $_SESSION['User']->nickname) {
                $check = $this->CheckNickname($validateFields['nickname']);
                if ($check == false) {
                    $user = $this->GetUserFields();
                    $nicknameError = "Этот никнейм занят";
                    $user->name = $validateFields['name'];
                    $user->surname = $validateFields['surname'];
                    $user->nickname = $validateFields['nickname'];
                    $user->transport = $validateFields['transport'];
                    $user->mapstyle = $validateFields['mapstyle'];
                    return view('settings', ['user' => $user, 'nicknameError' => $nicknameError]);
                }
                //----------------------------------------------------------------------------------

                if ($validateFields['transport'] == null) {
                    $validateFields['transport'] = "Не указан";
                }
            }

            if (isset($validateFields['photo'])) {
                $path = Storage::putFile('public/avatars', $request->file('photo'));

                $path = 'storage/avatars/' . explode('/', $path)[2];
                $oldpath = 'public/avatars/' . explode('/', $_SESSION['User']->avatar)[2];
                $delete = Storage::delete($oldpath);
            } else {
                $path = $_SESSION['User']->avatar;

            }


            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update([
                    'name' => $validateFields['name'],
                    'surname' => $validateFields['surname'],
                    'nickname' => $validateFields['nickname'],
                    'transport' => $validateFields['transport'],
                    'mapstyle' => $validateFields['mapstyle'],
                    'avatar' => $path
                ]);
            $user = $this->GetUserFields();
            $_SESSION['User'] = $user;
            if ($_SESSION['User']->nickname == null) {
                $_SESSION['User']->nickname = $_SESSION['User']->name . ' ' . $_SESSION['User']->surname;
            }
            return redirect(route('edit', ['user' => $user, 'nicknameErrorVisible' => 'hide', 'fileSizeErrorVisible' => 'hide']));
        }
        return redirect(route('login'));

    }

    //Метод получения данных для страницыы настроек
    public function GetSettingsPage()
    {
        $user = $this->GetUserFields();
        return view('settings', ['user' => $user, 'nicknameErrorVisible' => 'hide', 'fileSizeErrorVisible' => 'hide']);
    }

    public function GetUserFields()
    {
        if (Auth::check()) {
            $user = DB::table('users')
                ->where('users.id', Auth::id())
                ->join('ranks', 'ranks.id', '=', 'users.rank')
                ->select('users.id', 'users.name', 'surname', 'nickname', 'avatar', 'ranks.id as rankid', 'transport', 'mapstyle', 'rating', 'ranks.name as rname',
                    'maxrating')
                ->first();
            return $user;
        }
        return redirect(route('login'));
    }

    //Метод для проверки никнейма на уникальность
    public function CheckNickname($nickname)
    {
        $nicknames = DB::table('users')
            ->where('nickname', '=', $nickname)
            ->select('id')->get();

        if (Count($nicknames) > 0 and $nickname != null) {
            return false;
        } else {
            return true;
        }

    }


}
