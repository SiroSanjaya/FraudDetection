<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile', 'https://mail.google.com/'])
            ->with(['access_type' => 'offline', 'prompt' => 'consent select_account'])
            ->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
                    // Manually creating an array of user data to log
        \Log::info('Google User:', [
            'id' => $googleUser->getId(),
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar' => $googleUser->getAvatar(),
            'token' => $googleUser->token,
            'refreshToken' => $googleUser->refreshToken,
            'expiresIn' => $googleUser->expiresIn
        ]);

            $user = User::updateOrCreate([
                'google_id' => $googleUser->getId(),
            ], [
                'username' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                'token' => $googleUser->token,
                'refresh_token' => $googleUser->refreshToken, // Ensure you request offline access
                'token_expires_at' => now()->addSeconds($googleUser->expiresIn)
            ]);
    
            Auth::login($user, true);
    
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
