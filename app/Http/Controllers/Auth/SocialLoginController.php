<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Events\Register;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallBack()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', trans('Something went wrong, Try again'));
        }
    
        $user = User::where('google_id', $googleUser->id)->first();
    
        if (!$user) {
            $user = User::where('email', $googleUser->email)->first();
    
            if (!$user) {
                $user = tap(User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(\Str::random(16)),
                    'google_id' => $googleUser->id,
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'google_avatar' => $googleUser->avatar
                ]), function (User $user) {
                    $user->markEmailAsVerified();
                });
    
                // Dispatch register event
                event(new Register($user));
    
                // Log the user in
                Auth::login($user);
    
                // Return a regular response, like a redirect
                return redirect()->route('dashboard')->with('success', 'You have registered successfully!');
            }
    
            // Update user with Google credentials
            $user->update([
                'google_id' => $googleUser->id,
                'google_avatar' => $googleUser->avatar
            ]);
        }
    
        // Update Google credentials
        $user->update([
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);
    
        // Log the user in
        Auth::login($user, true);
    
        // Return the login response
        return redirect()->route('dashboard')->with('success', 'You are logged in!');
    }
}    