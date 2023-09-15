@extends('owner.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owner/mail.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/owner/mail.js') }}" defer></script>
@endsection

@section('content')
<div class="email-section">
    <h2 class="email-title">メール送信</h2>
    <div class="email-input">
        <div class="email-item">
            <label class="search-title" for="title">タイトル</label>
            <input class="search-content" id="title" type="text" name="title" value="{{ old('title') }}" placeholder="入力欄" autofocus>
        </div>
        <div class="email-error"></div>
        <div class="email-item">
            <label class="search-title" for="photo">画像</label>
            <input class="search-content" id="photo" type="url" name="photo">
        </div>
        <div class="email-error"></div>
        <div class="email-item">
            <label class="search-title" for="send_at">送信日</label>
            <input class="search-content" id="send_at" type="datetime-local" name="send_at" value="{{ old('send_at') }}" placeholder="入力欄">
        </div>
        <div class="email-error"></div>
        <div class="email-item">
            <label class="search-title" for="content">内容</label>
            <textarea class="search-content" name="content" id="content" maxlength="255" placeholder="入力欄">{{ old('content') }}</textarea>
        </div>
        <div class="email-error"></div>
        <div class="email-item">
            <button class="email-button home" type="button">飲食店一覧</button>
            <button class="email-button send">送信</button>
        </div>
    </div>
</div>
@endsection