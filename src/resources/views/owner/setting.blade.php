@extends('owner.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owner/setting.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/owner/setting.js') }}" defer></script>
@endsection

@section('content')
<div class="setting-section">
    <h2 class="setting-title">管理者設定</h2>
    <div class="setting-input">
        <div class="setting-item">
            <label class="search-title" for="title">ユーザー名</label>
            <input class="search-content" id="title" type="text" name="title" value="{{ old('title') }}" placeholder="入力欄" autofocus>
        </div>
        <div class="setting-error"></div>

        <div class="setting-item">
            <label class="search-title" for="photo">パスワード</label>
            <input class="search-content" id="photo" type="text" name="photo">
        </div>
        <div class="setting-error"></div>

        <div class="setting-item">
            <label class="search-title" for="photo">店舗代表者</label>
            <input class="search-content" id="photo" type="text" name="photo">
        </div>
        <div class="setting-error"></div>

        <div class="setting-item">
            <button class="setting-button home" type="button">飲食店一覧</button>
            <button class="setting-button update">更新</button>
        </div>
    </div>
</div>
@endsection