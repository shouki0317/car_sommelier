<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function top()
    {
        // 現在の全国平均価格入手
        $tables = Price::orderBy('id', 'desc')->first();

        return view('fuel.login', compact('tables'));
    }


    public function authenticate(Request $request)
    {   
        // ログインチェック
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // $credentials = ['email' => $request->name, 'password' => $request->password];

        if (Auth::attempt($credentials)) { // $model = Account::where('email', $request->name)->where('password', $request->password)->first();
            $request->session()->regenerate();

            return redirect('/fuel');
        }

        return back()->withErrors([
            'email' => '※ログインIDまたはパスワードが間違っています。再度入力してください。',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {   
        // ログアウト
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect('/fuel/login');
    }
}
