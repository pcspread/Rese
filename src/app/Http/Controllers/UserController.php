<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model読込
use App\Models\User;
// AuthFacades読込
use Illuminate\Support\Facades\Auth;
// FormRequest読込
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
// Hash読込
use Illuminate\Support\Facades\Hash;
// Mail読込
// use Illuminate\Support\Facades\Mail;
// use App\Mail\confirmMail;
// Carbon読込
use Carbon\Carbon;
// Event読込
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserController extends Controller
{
    /**
     * view表示
     * auth.login.blade.php
     * @param void
     * @return view
     */
    public function indexLogin()
    {
        return view('auth.login');
    }

    /**
     * login処理
     * @param array $request
     * @return view
     */
    public function login(LoginRequest $request)
    {
        // フォーム情報を取得
        $form = $request->only(['email', 'password']);

        // ユーザー情報有の場合
        if (Auth::attempt($form)) {
            // セッションID生成
            $request->session()->regenerate();
            // ユーザー名取得
            $name = User::where('email', $form['email'])->first()->name;
            // セッションに格納
            session()->put('name', $name);
            return redirect('/mypage');
        }

        return back()->withErrors([
            'email' => '登録情報が見つかりませんでした'
        ]);
    }

    /**
     * view表示
     * auth.login.blade.php
     * @param void
     * @return view
     */
    public function indexRegister()
    {
        return view('auth.register');
    }

    /**
     * create処理
     * @param array $request
     * @return redirect
     */
    public function storeUser(RegisterRequest $request)
    {
        // フォーム情報を取得
        $form = $request->only('name', 'email', 'password');

        // パスワードをハッシュ化
        $hash = Hash::make($form['password']);

        // ユーザー情報を格納
        $user = [
            'name' => $form['name'],
            'email' => $form['email'],
            'password' => $hash
        ];

        // create処理
        User::create($user);


        event(new Registered($user));

        // Mail::send(new confirmMail($user));
        // Mail::send(new confirmMail($user['name'], $user['email'], $user['password']));
        
        //メール二重送信防止
        // $request->session()->regenerateToken();

        // return redirect('/thanks');
        return redirect('/email/verify');
    }

    /**
     * view表示
     * auth.login.blade.php
     * @param void
     * @return view
     */
    public function indexComplete(Request $request)
    {
        // $user = $request->only(['name', 'email', 'password']);
        // if (!empty($user['name']) && !empty($user['email']) && !empty($user['password'])) {
        //     $user->email_verified_at = Carbon::now();
        //     $user->save();
        //     return view('auth.thanks');
        // } else {
        //     return redirect('/register');
        // }

        return view('auth.thanks');
    }

    /**
     * view表示
     * mypage.blade.php
     * @param void
     * @return view
     */
    public function personal()
    {
        return view('mypage');
    }

    /**
     * ログアウト処理
     * @param void
     * @return view
     */
    public function logout(Request $request)
    {
        // ログアウト処理
        Auth::logout();
        // セッション情報を無効にする
        $request->session()->invalidate();
        // csrfトークン再生成
        $request->session()->regenerateToken();
        // return redirect('/logout');
        return view('auth.logout');
    }

    /**
     * view表示
     * @param void
     * @return view
     */
    public function indexMail()
    {
        return view('auth.verify-email');
    }

    /**
     * メール確認ハンドラ
     * @param array $request
     * @return redirect
     */
    public function confirmEmail(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/');
    }

    /**
     * メール確認の再送信
     * @param array $request
     * @return back
     */
    public function resendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
