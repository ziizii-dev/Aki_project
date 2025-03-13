<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
    

    public function create()
    {
        return view('user.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:20', 
            'email' => 'required|email|max:255|unique:users',  
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',  
                'regex:/[a-z]/',  
                'regex:/[0-9]/', 
            ],
        ], [
            
            'name.required' => '氏名を入力してください',
            'name.max' => '氏名は20文字以内で入力してください。',
            
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'email.unique' => 'このメールアドレスはすでに使用されています。',
        
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.regex' => 'パスワードは大文字、小文字、数字を必ず入れてください。',
        ]);
        
        
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        
        return redirect()->route('user.index');
    }
    

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }
}
