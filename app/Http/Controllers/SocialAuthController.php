<?php

namespace App\Http\Controllers;

use App\SocialAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider){
        if ($provider=='facebook'){
            return Socialite::driver('facebook')->redirect();
        }
    }

    public function callback($provider)
    {
        if ($provider=='facebook'){
            $providerUser = Socialite::driver('facebook')->user();
            $existSocialAcc=SocialAccount::whereProvider('facebook')->whereProviderUserId($providerUser->id)->first();
            if ($existSocialAcc){
                auth()->login($existSocialAcc->user);
                return redirect()->route('home');
            }else{
                $sc=new SocialAccount([
                    'provider'=>'facebook',
                    'provider_user_id'=>$providerUser->id
                ]);

                $user=User::whereEmail($providerUser->email)->first();
                if ($user){
                    $user->social_accounts()->save($sc);
                    auth()->login($user);
                    return redirect()->route('home');
                }else{
                    $user=User::create([
                        'email'=>$providerUser->email,
                        'name'=>$providerUser->name,
                        'avatar'=>$providerUser->avatar
                    ]);
                    $user->social_accounts()->save($sc);
                    auth()->login($user);
                    return redirect()->route('home');
                }
            }
        }
    }
}
