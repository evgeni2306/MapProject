<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use App\Http\helpfunc;


class SocialController extends Controller
{
    use helpfunc;

    public function googleredirect()
    {

        return Socialite::driver('google')->redirect();
    }

    public function loginwithgoogle()
    {


        $socialuserid = Socialite::driver('google')->stateless()->user();
        $isUser = User::where('social_id', $socialuserid->id)->first();
        if ($isUser) {
            $_SESSION['User'] = $isUser;
            Auth::login($isUser);
            $_SESSION['User'] = $this->GetUserBySocialId($socialuserid);
            return redirect('map');
        } else {
            $nameAndSurname = explode(' ', $socialuserid->name);
            $createUser = User::create([
                'name' => $nameAndSurname[0],
                'surname' => $nameAndSurname[1],
                'login' => $socialuserid->email,
                'social_id' => $socialuserid->id,
                'password' => encrypt('socialuserid'),
                'avatar' => $socialuserid->getAvatar(),
                'transport' => 'Не указан',
                'rating' => 0,
                'rank' => 1,
                'mapstyle' => 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
            ]);
            $_SESSION['User'] = $this->GetUserBySocialId($socialuserid);

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

        $socialuserid = Socialite::driver('vkontakte')->user();
        $isUser = User::where('social_id', $socialuserid->id)->first();
        if ($isUser) {
            $_SESSION['User'] = $isUser;
            Auth::login($isUser);
            $_SESSION['User'] = $this->GetUserBySocialId($socialuserid);
            return redirect('map');
        } else {
            $nameAndSurname = explode(' ', $socialuserid->name);
            $createUser = User::create([
                'name' => $nameAndSurname[0],
                'surname' => $nameAndSurname[1],
                'login' => $nameAndSurname[0] . time(),
                'social_id' => $socialuserid->id,
                'password' => encrypt('socialuserid'),
                'avatar' => $socialuserid->getAvatar(),
                'transport' => 'Не указан',
                'rating' => 0,
                'rank' => 1,
                'mapstyle' => 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
            ]);
            $_SESSION['User'] = $this->GetUserBySocialId($socialuserid);

            Auth::login($createUser);
            return redirect(route('map'));


        }


    }
}
