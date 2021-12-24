<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateUserController extends Controller
{
    public function UpdateUser(Request $request)
    {
        //провалидировать
        if (Auth::check()){
        $validateFields = $request->validate([
            'name'=>['max:255'],
            'surname'=>['max:255'],
            'transport'=>['max:255'],
        ]);
        //change user data
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['name' => $validateFields['name'],
                'surname'=>$validateFields['surname'],
            'transport'=>$validateFields['transport']]);
        $this->GetUserFields();
        return redirect(route('edit'));
        }
        return redirect(route('login'));
        //return the page
    }

    public function GetUserFields(){
        if(Auth::check()){
            $_SESSION['User'] = DB::table('users')
                ->where('id', Auth::id())
                ->select('id','name', 'surname', 'avatar', 'transport')
                ->first();;
        }
        return redirect(route('login'));
    }
}
