<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
   
    public function redirect()
    {
        //return "hello";
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

           
            $user = Admin::where('google_id', $googleUser->getId())->orWhere('email', $googleUser->getEmail())->first();
             //dd($user);
            if (!$user) {
               
                $user = Admin::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('default_password'),
                ]);
            }

            // Log in the user
            Auth::login($user);

            return redirect()->route('dashboard.index');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
        }
    }
    
}
