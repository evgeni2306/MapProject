<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle(){
        $user=Socialite::driver('google')->user();
        $isUser=User::where('social_id',$user->id)->first();

        if ($isUser){
            Auth::login($isUser);
            return redirect('/map');
        }
        else{
            $createUser=User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'social_id'=>$user->id,
                'password'=>encrypt('user')
            ]);
            return redirect('/map');
        }
    }

    public function vkRedirect(){
        return Socialite::driver('vkontakte')->redirect();
    }

    public function loginWithVk(){
        $user=Socialite::driver('vkontakte')->user();
        $isUser=User::where('social_id',$user->id)->first();

        if ($isUser){
            Auth::login($isUser);
            return redirect('/map');
        }

        else{
            $createUser=User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'social_id'=>$user->id,
                'password'=>encrypt('user')
            ]);
            return redirect('/map');
        }
    }

}
