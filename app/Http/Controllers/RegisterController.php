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
$av = $this->randomAvatar();

        $validateFields['avatar'] = '/PageMap/img/user/'.$av;
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
    public function randomAvatar(){
        $arr = array(
            0=>'avatar1.png',
            1=>'avatar2.png',
            2=>'avatar3.png',
            3=>'avatar4.png',
            4=>'avatar5.png',
            5=>'avatar6.png',
            6=>'avatar7.png',
            7=>'avatar8.png');
        $r = $arr[rand(0,7)];
        return $r;
    }

}
