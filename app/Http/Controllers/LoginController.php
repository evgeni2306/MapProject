<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('map');
        }
        $formFields = $request->validate([
            'login' => ['required', 'string', 'exists:users,login', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($formFields)) {
            $_SESSION['User'] = DB::table('users')
                ->where('login', $formFields['login'])
                ->join('ranks', 'ranks.id', '=', 'users.rank')
                ->select('users.id', 'users.name', 'surname','nickname', 'avatar', 'transport','mapstyle','rating','ranks.name as rname',
                'maxrating')
                ->first();
            if($_SESSION['User']->nickname == null){
                $_SESSION['User']->nickname = $_SESSION['User']->name.' '.$_SESSION['User']->surname;
            }
            return redirect('map');
        }

        return redirect(route('login'))->withErrors([
            'login' => 'Не удалось авторизоваться, проверьте логин и пароль'
        ]);
    }
}
