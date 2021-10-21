<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::check()) {
            return redirect('map');
        }


        $formFields=$request->only(['login','password']);
        if (Auth::attempt($formFields)){
            $_SESSION['User'] =DB::table('users')
                ->where('login', $formFields['login'])
                ->select('name','surname','avatar','transport')
                ->first();
            return redirect('map');
        }

        return redirect(route('login'))->withErrors([
            'login'=>'Не удалось авторизоваться, проверьте логин и пароль'
        ]);
    }
}
