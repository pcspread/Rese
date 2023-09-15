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
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMail;
// Carbon読込
use Carbon\Carbon;
// Event読込
use Illuminate\Auth\Events\Registered;
// EmailVerificationRequest読込
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

        // メール認証がされていない場合
        $record = User::where('email', $form['email'])->first();
        if (empty($record['email_verified_at'])) {
            return back()->withErrors([
                'password' => 'メール認証が未完了です'
            ]);
        }

        // ユーザー情報有の場合
        if (Auth::attempt($form)) {
            // セッションID生成
            $request->session()->regenerate();

            // ユーザー名取得
            $user = User::where('email', $form['email'])->first();
            // パスワードがオーナー用パスワードだった場合
            if ($form['password'] === config('owner.owner_pass')) {
                return redirect('/owner');
            } else {
                // セッションに格納
                session()->put('name', $user['name']);
                return redirect('/mypage');
            }
        }

        return back()->withErrors([
            'password' => '登録情報が見つかりませんでした'
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

        // ランダム文字列を生成
        $token = bin2hex(random_bytes(32));

        // ユーザー情報を格納
        $user = [
            'name' => $form['name'],
            'email' => $form['email'],
            'password' => Hash::make($form['password']),
            'remember_token' => Hash::make($token)
        ];

        // create処理
        User::create($user);

        // メール送信
        // event(new Registered($user));
        Mail::send(new sendMail($user['name'], $user['email'], $token));
        
        //メール二重送信防止
        $request->session()->regenerateToken();

        // return redirect('/thanks');
        return redirect('/email/verify')->with([
            'name' => $user['name'], 
            'email' => $user['email'], 
            'token' => $token
        ]);
    }

    /**
     * view表示
     * auth.login.blade.php
     * @param void
     * @return view
     */
    public function indexComplete(Request $request)
    {   
        // ユーザー情報を全件取得
        $records = User::all();

        // ユーザー情報からトークンに合致する情報の取得
        foreach ($records as $record) {
            if (Hash::check($request['token'], $record['remember_token'])) {
                $user = $record;
            }
        }

        // レコードが無い場合
        if (!$user) {
            return redirect('/register')->withErrors([
                'password' => '登録情報がございません'
            ]);
        }

        // メール認証時刻を挿入
        $user->email_verified_at = Carbon::now();
        $user->save();
        return view('auth.thanks');
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
     * 認証メールの再送信
     * @param array $request
     * @param void
     */
    public function resendMail(Request $request)
    {
        // ユーザー情報を取得
        $user = $request->only('name', 'email', 'token');

        
        // メール送信
        // event(new Registered($user));
        Mail::send(new sendMail($user['name'], $user['email'], $user['token']));
        
        //メール二重送信防止
        $request->session()->regenerateToken();

        // return redirect('/thanks');
        return redirect('/email/verify')->with([
            'name' => $user['name'], 
            'email' => $user['email'], 
            'token' => $user['token']
        ]);
    }

    // /**
    //  * メール確認ハンドラ
    //  * @param array $request
    //  * @return redirect
    //  */
    // public function confirmEmail(EmailVerificationRequest $request) {
    //     $request->fulfill();

    //     return redirect('/');
    // }

    // /**
    //  * メール確認の再送信
    //  * @param array $request
    //  * @return back
    //  */
    // public function resendEmail(Request $request)
    // {
    //     $request->user()->sendEmailVerificationNotification();
    //     return back()->with('message', 'Verification link sent!');
    // }
}
