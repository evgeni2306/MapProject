<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;


class SocialController extends Controller
{
    public function googleredirect()
    {

        return Socialite::driver('google')->redirect();
    }

    public function loginwithgoogle()
    {


        $user = Socialite::driver('google')->stateless()->user();
        $isUser = User::where('social_id', $user->id)->first();
        if ($isUser) {
            $_SESSION['User'] = $isUser;
            Auth::login($isUser);
            return redirect('map');
        } else {
            $nameAndSurname = explode(' ', $user->name);
            $createUser = User::create([
                'name' => $nameAndSurname[0],
                'surname' => $nameAndSurname[1],
                'login' => $user->email,
                'social_id' => $user->id,
                'password' => encrypt('user'),
                'avatar' => $user->getAvatar(),
                'transport' => 'Не указан'
            ]);
            $_SESSION['User'] = DB::table('users')
                ->where('social_id', $user->id)
                ->select('id', 'name', 'surname', 'avatar', 'transport')
                ->first();

            Auth::login($createUser);
            return redirect(route('map'));


        }


    }

    public function vkontakteredirect()
    {

        return Socialite::driver('vkontakte')->redirect();
    }

    public function loginwithvkontakte()
    {


        $user = Socialite::driver('vkontakte')->user();
        $isUser = User::where('social_id', $user->id)->first();
        if ($isUser) {
            $_SESSION['User'] = $isUser;
            Auth::login($isUser);
            return redirect('map');
        } else {
            $nameAndSurname = explode(' ', $user->name);
            $createUser = User::create([
                'name' => $nameAndSurname[0],
                'surname' => $nameAndSurname[1],
                'login' => $nameAndSurname[0] . time(),
                'social_id' => $user->id,
                'password' => encrypt('user'),
                'avatar' => $user->getAvatar(),
                'transport' => 'Не указан'
            ]);
            $_SESSION['User'] = DB::table('users')
                ->where('social_id', $user->id)
                ->select('id', 'name', 'surname', 'avatar', 'transport')
                ->first();

            Auth::login($createUser);
            return redirect(route('map'));


        }


    }
}
