@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/logout.css') }}" />
@endsection

@section('content')
<div class="logout-section">
    <div class="logout-wrapper">
        <div class="logout-title">
            <h1 class="logout-title__content">
                ログアウトしました。
            </h1>
        </div>

        <!-- button -->
        <div class="logout-button">
            <a class="logout-button__login" href="/">飲食店一覧ページ</a>
        </div>
    </div>
</div>
@endsection