<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateUserController extends Controller
{
    public function UpdateUser(Request $request){
        //провалидировать
        if (Auth::check()){
        $validateFields = $request->validate([
            'name'=>['max:255'],
            'surname'=>['max:255'],
        ]);
        //change user data
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['name' => $validateFields['name'],
                'surname'=>$validateFields['surname']]);
        return redirect(route('userinfo'));
        }
        return redirect(route('login'));
        //return the page
    }

    public function GetUserFields(Request $request){
        if(Auth::check()){
            $userid=Auth::user()->id;
            $userprofile = User::find($userid);
            $_SESSION['userinfo']=$userprofile;
            return view('changeuserinfo');
        }
        return redirect(route('login'));
    }
}
