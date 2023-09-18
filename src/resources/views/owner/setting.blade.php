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
        <form class="setting-input__form" action="/owner/setting" method="POST">
        @csrf
            <div class="setting-item">
                <label class="search-title" for="name">店舗代表者</label>
                <input class="search-content" id="name" type="text" name="name" value="{{ $name }}" placeholder="入力欄">
            </div>
            <div class="setting-error">
                @error('name')
                    ※{{ $errors->first('name') }}
                @enderror
            </div>

            <div class="setting-item">
                <button class="setting-button update">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection