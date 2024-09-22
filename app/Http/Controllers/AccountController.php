<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function top(Request $request) 
    {
    return view('fuel.account');
    }

    public function create(Request $request) 
    {
        $email = $request->email;
        $pass1 = $request->pass1;
        $pass2 = $request->pass2;

         // Eメールの重複チェック
        $ex_email = Account::where('email', '=', $email)->get();
        if (isset($ex_email[0]["id"])) {
            $account_duplication = 0;
        } else {
            $account_duplication = 1;
        }

        // パスワードの一致チェック
        if ($pass1 === $pass2) {
            $account_error = 1;
        } else {
            $account_error = 0;
        }  

        // パスワードチェック
        if (preg_match("/^[a-z0-9]{3,12}$/i", $pass1)) {
            $pass_length = 1;
        } else {
            $pass_length = 0;
        }

        if ($account_duplication === 1 && $account_error === 1 && $pass_length === 1) {
            return view('fuel.create', compact('email', 'pass1', 'account_duplication', 'account_error','pass_length'));
        } else {
            return view('fuel.account', compact('account_duplication', 'account_error','pass_length'));
        }
    }

    public function add(Request $request) 
    {
    $post = new Account();
    $post->email = $request->email;
    $post->password = Hash::make($request->password);

    // サーバー登録
    $post->save();
    
    // 二重送信防止
    $request->session()->regenerateToken();

    return view('fuel.add');
    }
}
