<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function save(Request $request){
        if(Auth::check()){
            return redirect(route('private'));
        }

        $validateFields=$request->validate([
            'login'=>'required',
            'password'=>'required',
            'name'=>'required',
            'surname'=>'required'
        ]);

        if (User::where('login',$validateFields['login'])->exists()){
            return redirect(route('registration'))->withErrors([
                'login'=>'Пользователь с таким логином уже зарегистрирован'
            ]);
        }

        $user=User::create($validateFields);
        if ($user){
            Auth::login($user);
            return redirect(route('private'));
        }

        return redirect(route('login'));
    }
}
