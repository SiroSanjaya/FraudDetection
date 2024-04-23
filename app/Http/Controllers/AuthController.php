<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        // Redirects to Google's OAuth page
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        $user = User::firstOrCreate([
            'Google_Id' => $googleUser->getId(),
        ], [
            'username' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar' => $googleUser->getAvatar(),
            'role_Id' => 4,  // Assuming '4' is a default role ID
        ]);

        Auth::login($user, true);  // 'true' to remember the user

        ///////////////////////// Debugging Logs
        \Log::info('Is user authenticated after login? ' . Auth::check());  // Log authentication check
        \Log::info('User authenticated: ', ['id' => Auth::id()]);  // Log user ID
        \Log::info('User details', ['user' => $user->toArray()]);
        if (Auth::check()) {
            \Log::info('Authentication check passed');
        } else {
            \Log::info('Authentication check failed');
        }
        ////////////////////////////////////////
        return redirect()->route('dashboard');

    } catch (\Exception $e) {
        \Log::error('Failed to authenticate with Google: ' . $e->getMessage());
        return redirect()->route('login')->withErrors('Failed to authenticate with Google. Please try again.');
    }
}
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been successfully logged out.');
    }
}
