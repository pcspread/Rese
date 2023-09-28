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
        <form class="email-input__form" action="/owner/mail" method="POST">
        @csrf
            <div class="email-item">
                <label class="search-title" for="title">タイトル</label>
                <input class="search-content" id="title" type="text" name="title" value="{{ old('title') }}" placeholder="入力欄" autofocus>
            </div>
            <div class="email-error">
                @error('title')
                    ※{{ $errors->first('title') }}
                @enderror
            </div>

            <div class="email-item">
                <label class="search-title" for="content">内容</label>
                <textarea class="search-content" name="content" id="content" maxlength="255" placeholder="入力欄">{{ old('content') }}</textarea>
            </div>
            <div class="email-error">
                @error('content')
                    ※{{ $errors->first('content') }}
                @enderror
            </div>

            <div class="email-item">
                <button class="email-button send">送信</button>
            </div>
        </form>
    </div>
</div>
@endsection