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
       // return "hello world";
        $googleUser = Socialite::driver('google')->stateless()->user(); 
    
        $user = Admin::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt(uniqid()), 
        ]);

        Admin::login($user);

    
        return redirect()->intended(route('dashboard.index'));
    }
    
}
