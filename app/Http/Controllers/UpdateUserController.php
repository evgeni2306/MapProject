<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateUserController extends Controller
{
    public function UpdateUser(Request $request)
    {
        if (Auth::check()) {
            $validateFields = $request->validate([
                'name' => ['required', 'max:255', 'string'],
                'surname' => ['required', 'max:255', 'string'],
                'nickname' => ['nullable', 'string', 'max:255',],
                'transport' => ['nullable', 'max:255', 'string'],
                'mapstyle' => ['string', 'ends_with:ISLbB6B5aw,{x}/{y}.png'],
                'photo' => ['mimes:jpeg,jpg,png']
            ]);
            if ($validateFields['transport'] == null) {
                $validateFields['transport'] = "Не указан";
            }

            if (isset($validateFields['photo'])) {
                $path = Storage::putFile('public/avatars', $request->file('photo'));

                $path = 'storage/avatars/' . explode('/', $path)[2];
                $oldpath = 'public/avatars/' . explode('/', $_SESSION['User']->avatar)[2];
                $delete = Storage::delete($oldpath);
            } else {
                $path = $_SESSION['User']->avatar;

            }


            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update([
                    'name' => $validateFields['name'],
                    'surname' => $validateFields['surname'],
                    'nickname' => $validateFields['nickname'],
                    'transport' => $validateFields['transport'],
                    'mapstyle' => $validateFields['mapstyle'],
                    'avatar'=>$path
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
                ->select('users.id', 'users.name', 'surname', 'nickname', 'avatar', 'transport', 'mapstyle', 'nickname', 'rating', 'ranks.name as rname', 'maxrating')
                ->first();
            if ($_SESSION['User']->nickname == null) {
                $_SESSION['User']->nickname = $_SESSION['User']->name . ' ' . $_SESSION['User']->surname;
            }
        }
        return redirect(route('login'));
    }
}
