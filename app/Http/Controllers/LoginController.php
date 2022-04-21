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
                ->select('id', 'name', 'surname', 'avatar', 'transport','mapstyle')
                ->first();
            return redirect('map');
        }

        return redirect(route('login'))->withErrors([
            'login' => 'Не удалось авторизоваться, проверьте логин и пароль'
        ]);
    }
}
