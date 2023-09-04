@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}" />
@endsection

@section('content')
<div class="email-section">
    <div class="email-wrapper">
        <h1 class="email-title">
            この度は、Reseをご利用いただき、誠にありがとうございます。<br />
            ご入力いただいた情報の仮登録が完了しました。
            ご本人様確認のため、ご登録されたメールアドレスに、本登録用の認証メールを送信しました。<br />
            メールに記載のリンクへアクセスいただくと、本登録が完了します。
        </h1>
    </div>
</div>
@endsection