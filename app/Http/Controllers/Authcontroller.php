<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class Authcontroller extends Controller
{
    public function login_by_google()
    {
            $googleUser = Socialite::driver('google')->user();
            dd($googleUser);
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
    }
}
