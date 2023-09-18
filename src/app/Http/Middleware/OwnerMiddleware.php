<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// AuthFacades読込
use Illuminate\Support\Facades\Auth;
// Model読込
use App\Models\User;

class OwnerMiddleware
{
    // csrf対策除外
    // protected $expect = [
    //     'route',
    // ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // フォーム情報の取得
        $form = $request->only(['email', 'password']);

        // ユーザー情報有の場合
        if (!empty(Auth::attempt($form))) {
            // パスワードがオーナー用パスワードだった場合
            if ($form['password'] === config('owner.top_pass') || $form['password'] === config('owner.owner_pass')) {
                // セッションID生成
                $request->session()->regenerate();

                // ユーザー名取得
                $name = User::where('email', $form['email'])->first()->name;

                // ユーザー名をセッションに格納
                session()->put('name', $name);

                return redirect('/owner');
            }
        }

        return $next($request);
    }
}
