<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.login");
    }

    public function login(Request $request)
    {

        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->intended(route('dashboard.index'));
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ]); 
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
