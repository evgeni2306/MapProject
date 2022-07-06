<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    public function save(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('map'));
        }
        $validateFields = $request->validate([
            'login' => ['required', 'string', 'email', 'unique:users,login'],
            'password' => ['required', 'string'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
        ]);


        $av = $this->randomAvatar();
        $validateFields['mapstyle'] = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
        $validateFields['avatar'] = '/PageMap/img/user/' . $av;
        $validateFields['transport'] = 'Не указан';
        $validateFields['rank'] = 1;
        $validateFields['rating'] = 0;
        $user = User::create($validateFields);

        if ($user) {
            Auth::login($user);
            $_SESSION['User'] = DB::table('users')
                ->where('users.id', $user->id)
                ->join('ranks', 'ranks.id', '=', 'users.rank')
                ->select('users.id', 'users.name', 'surname','nickname', 'avatar','ranks.id as rankid', 'transport', 'mapstyle', 'rating', 'ranks.name as rname', 'maxrating')
                ->first();

            if($_SESSION['User']->nickname == null){
                $_SESSION['User']->nickname = $_SESSION['User']->name.' '.$_SESSION['User']->surname;
            }
            return redirect(route('map'));
        }
        return redirect(route('login'));
    }


    //Рандомно возвращает одну из 8 дефолтных аватарок
    public function randomAvatar()
    {
        $random = rand(1,8);
        return 'avatar'.$random.'.png';
    }

}
