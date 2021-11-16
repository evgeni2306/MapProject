<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{
    public function googleredirect(){

        return Socialite::driver('google')->redirect();
    }
    public function loginwithgoogle(){


        $user = Socialite::driver('google')->user();
        $isUser = User::where('social_id', $user->id)->first();
        if($isUser){
            Auth::login($isUser);
            return redirect(route('map'));
        }else{
            $nameAndSurname = explode(' ',$user->name);
            $createUser = User::create([
                'name'=>$nameAndSurname[0],
                'surname'=>$nameAndSurname[1],
                'login' =>'456',
                'social_id'=>$user->id,
                'password' => encrypt('user'),
                'avatar'=> $user->getAvatar()
            ]);


            Auth::login($createUser);
            return redirect(route('map'));


        }


    }
    public function vkontakteredirect(){

        return Socialite::driver('vkontakte')->redirect();
    }

    public function loginwithvkontakte(){


        $user = Socialite::driver('vkontakte')->user();
        $isUser = User::where('social_id', $user->id)->first();
        if($isUser){
            Auth::login($isUser);
            return redirect(route('map'));
        }else{
            $nameAndSurname = explode(' ',$user->name);
            $createUser = User::create([
                'name'=>$nameAndSurname[0],
                'surname'=>$nameAndSurname[1],
                'login' =>'4567',
                'social_id'=>$user->id,
                'password' => encrypt('user'),
                'avatar'=> $user->getAvatar()
            ]);


            Auth::login($createUser);
            return redirect(route('map'));


        }


    }
}
