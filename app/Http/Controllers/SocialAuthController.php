<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
               $user = Socialite::driver('google')->user();
        } catch (\Exception $e)
        {
            return redirect('/login');
        }

        $existingUser = User::where('google_id',$user->id)->first();
        if ($existingUser){
            $existingUser->access_token = $user->token;
            $existingUser->save();
            Auth::login($existingUser,true);
        }
        else{
            $password = Str::random(12);

            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $password,
                'google_id' => $user->id,

            ]);
            Auth::login($newUser,true);
        }
        return redirect()->to('/dashboard');
    }

}
