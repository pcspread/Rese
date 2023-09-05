@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}" />
@endsection

@section('content')
<div class="email-section">
    <div class="email-wrapper">
        <div class="email__group">
            <h1 class="email__title">
                この度は、Reseをご利用いただき、誠にありがとうございます。<br />
            </h1>
            <p class="email__content">
                {{ session('name') }}様の仮登録が完了しました。
                ご本人様確認のため、メールアドレスに、メール認証用のメールを送信しました。<br />
                メールに記載のリンクへアクセスいただくと、本登録が完了します。<br />
            </p>
        </div>
        
        <div class="resend-email__group">
            <div class="resend_email__description">
                メールが届かない場合は、下記「再送する」より認証メールを再送信いただけます。<br />
                ※認証メールが届かない場合は、メールアドレスが間違っている可能性がございますので、お手数をおかけしますが、登録画面から再度ご登録をお願いします。
            </div>
            
            <form class="resend-email__form" action="/email/verify" method="POST">
            @csrf
                <input type="hidden" name="name" value="{{ session('name') }}">
                <input type="hidden" name="email" value="{{ session('email') }}">
                <input type="hidden" name="token" value="{{ session('token') }}">
                <button class="resend-email__button">再送する</button>
            </form>
        </div>
    </div>
</div>
@endsection