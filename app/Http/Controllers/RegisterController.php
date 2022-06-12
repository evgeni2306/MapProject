<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;


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

    public function randomAvatar()
    {
        $arr = array(
            0 => 'avatar1.png',
            1 => 'avatar2.png',
            2 => 'avatar3.png',
            3 => 'avatar4.png',
            4 => 'avatar5.png',
            5 => 'avatar6.png',
            6 => 'avatar7.png',
            7 => 'avatar8.png');
        $r = $arr[rand(0, 7)];
        return $r;
    }

}
