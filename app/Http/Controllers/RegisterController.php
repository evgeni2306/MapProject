<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    public function save(Request $request){
        if(Auth::check()){
            return redirect(route('map'));
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

        $validateFields['avatar'] = '/PageMap/img/user/user.png';
        $validateFields['transport'] = 'Не указан';
        $user=User::create($validateFields);
        if ($user){
            Auth::login($user);
            $_SESSION['User'] =DB::table('users')
                ->where('id', $user->id)
                ->select('id','name','surname','avatar','transport')
                ->first();
            return redirect(route('map'));
        }

        return redirect(route('login'));
    }
}
