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
            $_SESSION['User'] = DB::table('users')
                ->where('id', user()->id)
                ->select('name', 'surname', 'avatar', 'transport')
                ->first();
            return view('changeuserinfo');
        }
        return redirect(route('login'));
    }
}
