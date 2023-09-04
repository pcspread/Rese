@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}" />
@endsection

@section('content')
<div class="thanks-section">
    <div class="thanks-wrapper">
        <div class="thanks-title">
            <h1 class="thanks-title__content">
                会員登録ありがとうございます。
            </h1>
        </div>

        <!-- button -->
        <div class="thanks-button">
            <a class="thanks-button__login" href="/login">ログインする</a>
        </div>
    </div>
</div>
@endsection