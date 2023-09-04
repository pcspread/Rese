@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}" />
@endsection

@section('content')
<div class="email-section">
    <div class="email-wrapper">
        <h1 class="email-title">
            入力いただいたメールアドレスにメールを送信しました。<br>
            ご確認の上、登録の確定をお願いします。
        </h1>
    </div>
</div>
@endsection