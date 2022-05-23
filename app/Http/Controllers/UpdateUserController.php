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
        if (Auth::check()) {
            $validateFields = $request->validate([
                'name' => ['required','max:255','string'],
                'surname' => ['required','max:255','string'],
                'nickname'=>['nullable','string','max:255',],
                'transport' => ['nullable','max:255','string'],
                'mapstyle'=>['string','ends_with:ISLbB6B5aw,{x}/{y}.png'],
            ]);
            if ($validateFields['transport'] == null) {
                $validateFields['transport'] = "Не указан";
            }
            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update([
                    'name' => $validateFields['name'],
                    'surname' => $validateFields['surname'],
                    'nickname'=>$validateFields['nickname'],
                    'transport' => $validateFields['transport'],
                    'mapstyle'=>$validateFields['mapstyle']
                ]);
            $this->GetUserFields();
            return redirect(route('edit'));
        }
        return redirect(route('login'));

    }

    public function GetUserFields()
    {
        if (Auth::check()) {
            $_SESSION['User'] = DB::table('users')
                ->where('users.id', Auth::id())
                ->join('ranks', 'ranks.id', '=', 'users.rank')
                ->select('users.id', 'users.name', 'surname','nickname', 'avatar', 'transport','mapstyle','nickname','rating','ranks.name as rname','maxrating')
                ->first();
            if($_SESSION['User']->nickname == null){
                $_SESSION['User']->nickname = $_SESSION['User']->name.' '.$_SESSION['User']->surname;
            }
        }
        return redirect(route('login'));
    }
}
