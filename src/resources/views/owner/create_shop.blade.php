@extends('owner.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owner/create_shop.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/owner/create_shop.js') }}" defer></script>
@endsection

@section('content')
<div class="shop-section">
    <h2 class="shop-title">飲食店追加</h2>

    <div class="shop-input">
        <form class="shop-input__form" action="/owner/shop/create" method="POST">
        @csrf
            <div class="shop-item">
                <label class="search-title" for="name">飲食店名</label>
                <input class="search-content" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="入力欄" autofocus>
            </div>
            <div class="shop-error">
                @error('name')
                    ※{{ $errors->first('name') }}
                @enderror
            </div>

            <div class="shop-item">
                <label class="search-title" for="region">エリア</label>
                <input class="search-content" id="region" type="text" name="region" value="{{ old('region') }}" placeholder="入力欄">
            </div>
            <div class="shop-error">
                @error('region')
                    ※{{ $errors->first('region') }}
                @enderror
            </div>

            <div class="shop-item">
                <label class="search-title" for="genre">ジャンル</label>
                <input class="search-content" id="genre" type="text" name="genre" value="{{ old('genre') }}" placeholder="入力欄">
            </div>
            <div class="shop-error">
                @error('genre')
                    ※{{ $errors->first('genre') }}
                @enderror
            </div>

            <div class="shop-item">
                <label class="search-title" for="photo">画像</label>
                <input class="search-content" id="photo" type="url" name="photo" placeholder="入力欄">
            </div>
            <div class="shop-error">
                @error('photo')
                    ※{{ $errors->first('photo') }}
                @enderror
            </div>

            <div class="shop-item">
                <label class="search-title" for="description">説明</label>
                <textarea class="search-content" name="description" id="description" maxlength="255" placeholder="入力欄">{{ old('description') }}</textarea>
            </div>
            <div class="shop-error">
                @error('description')
                    ※{{ $errors->first('description') }}
                @enderror
            </div>

            <div class="shop-item">
                <button class="shop-button home" type="button">飲食店一覧</button>
                <button class="shop-button store">追加</button>
            </div>
        </form>
    </div>
</div>
@endsection