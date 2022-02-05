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
        if (Auth::check()) {
            $validateFields = $request->validate([
                'name' => ['max:255','string'],
                'surname' => ['max:255','string'],
                'transport' => ['max:255','string'],
            ]);
            if ($validateFields['transport'] == null) {
                $validateFields['transport'] = "Не указан";
            }
            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(['name' => $validateFields['name'],
                    'surname' => $validateFields['surname'],
                    'transport' => $validateFields['transport']]);
            $this->GetUserFields();
            return redirect(route('edit'));
        }
        return redirect(route('login'));

    }

    public function GetUserFields()
    {
        if (Auth::check()) {
            $_SESSION['User'] = DB::table('users')
                ->where('id', Auth::id())
                ->select('id', 'name', 'surname', 'avatar', 'transport')
                ->first();;
        }
        return redirect(route('login'));
    }
}
