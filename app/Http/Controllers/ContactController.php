<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactController extends Controller
{
    public function top(Request $request) 
    {
    return view('contact.index');
    }

    public function create(Request $request) 
    {
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;
    
        return view('contact.create', compact('name', 'email', 'subject', 'message'));
    }

    public function add(Request $request) 
    {
    $post = new ContactForm();
    $post->name = $request->name;
    $post->email = $request->email;
    $post->subject = $request->subject;
    $post->message = $request->message;

    // サーバー登録
    $post->save();
    
    // 二重送信防止
    $request->session()->regenerateToken();

    return view('contact.add');
    }
}
