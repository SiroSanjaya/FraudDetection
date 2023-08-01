<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('Google_Id', $google_user->getId())->first();

            // if (explode("@", $google_user->email)[1] !== 'widyatama.ac.id') {
            //     return redirect()->to('login')->with('failed', 'Barudak Widit Hungkul Cuyy, Pake Email Widit Geura');
            // }

            if (!$user) {
                $newUser = User::create([
                    // 'fullname' => explode("/", $google_user->getName())[2],
                    // 'npm' => explode("/", $google_user->getName())[1],
                    'username' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'Google_Id' => $google_user->getId(),
                    'avatar' => $google_user->getAvatar(),
                ]);

                Auth::login($newUser);

                return redirect()->route('SelectPosition');
            } else {
                
                Auth::login($user);
                
                if (!empty($user->role)) {
                    return redirect()->intended('/');
                }

                return redirect()->route('SelectPosition');
            }
        } catch (\Throwable $th) {
            dd('Error ' . $th);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Successfully Logout');
    }
}
