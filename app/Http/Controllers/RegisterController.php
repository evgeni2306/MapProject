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
            return redirect(route('user.private'));
        }

        $validateFields=$request->validate([
            'email'=>'required|email',
            'password'=>'required',
            'name'=>'required',
            'surname'=>'required'
        ]);

        if (User::where('email',$validateFields['email'])->exists()){
            return redirect(route('user.registration'))->withErrors([
                'email'=>'Пользователь с такой почтой уже зарегистрирован'
            ]);
        }

        $user=User::create($validateFields);
        if ($user){
            Auth::login($user);
            return redirect(route('user.private'));
        }

        return redirect(route('user.login'));
    }
}
