<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryMail;

class InquiryController extends Controller
{
    
    public function index()
    {
        return view('inquiry.index');
    }

  
 

    
    public function submit(Request $request)
    {
      
        $validated = $request->validate([
            'name' => 'required|string|max:20',     
            'email' => 'required|email|max:255',     
            'body' => 'required|string|max:200',    
            'name.required' => '氏名を入力してください',
            'name.max' => '氏名は20文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは正しい形式で入力してください',
            'email.max' => 'メールアドレスは200文字以内で入力してください',
            'body.required' => '本文を入力してください',
            'body.max' => '本文は200文字以内で入力してください',
        ]);

        $data = $validated;
    
  
        Mail::to($data['email'])->send(new InquiryMail($data, 'お問い合わせ自動返信メール'));
        
       
        Mail::to('inquiry@mail.test')->send(new InquiryMail($data, 'お問い合わせ管理者メール'));
    
        
        return redirect()->route('inquiry.index')  
            ->with('success', 'お問い合わせが送信されました。')
            ->with('data', $data);  
    }
}
