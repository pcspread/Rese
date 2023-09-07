@php
    use App\Models\Shop;
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shops.css') }}" />
@endsection

@section('js')
<script src="{{ asset('js/shops.js') }}" defer></script>
@endsection

@section('content')
<div class="shops-section" id="header">
    <div class="search-group">
        <div class="search-wrapper">
            <!-- area -->
            <div class="search-item">
                <p class="search-title">All area</p>
                <div class="search-menu">
                    <div class="search-menu__icon">〉</div>
                    <ul class="search-menu__list">
                        <li class="search-menu__record area">全て</li>
                        @foreach ($regions as $region)
                        <li class="search-menu__record area">{{ $region }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- genre -->
            <div class="search-item">
                <p class="search-title">All genre</p>
                <div class="search-menu">
                    <div class="search-menu__icon">〉</div>
                    <ul class="search-menu__list">
                        <li class="search-menu__record genre">全て</li>
                        @foreach ($genres as $genre)
                        <li class="search-menu__record genre">{{ $genre }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- search -->
            <div class="search-item">
                <div class="search-icon">
                    <div class="search-icon__content">🔍</div>
                </div>
                <div class="search-input">
                    <input class="search-input__box" type="text" value="" placeholder="Search ...">
                </div>
                <div class="search-not">
                    <button class="search-not__button" type="button">×</button>
                </div>
            </div>
        </div>
    </div>

    <div class="shops-group">
        @foreach ($shops as $shop)
        <div class="shop-card">
            <div class="shop-card__firstView">
                <img class="shop-card__image" src="{{ $shop['photo'] }}" alt="shop-photo">
            </div>
            <div class="shop-card__content">
                <h1 class="shop-title">{{ $shop['name'] }}</h1>
                <div class="shop-card__tags">
                    <span class="shop-card__tag">#{{ $shop['region'] }}</span>
                    <span class="shop-card__tag">#{{ $shop['genre'] }}</span>
                </div>
                <div class="shop-card__clicks">
                    <a class="shop-card__detail-click" href="/detail/{{ $shop['id'] }}">詳しく見る</a>
                    <form class="shop-card__form" action="/like/{{ $shop['id'] }}" method="POST">
                    @csrf
                        @if (empty($shop->Interest))
                        <input class="shop-card__interest-click" type="submit" value="♥">
                        @else
                            <form class="shop-card__false-form" action="/like/{{ $shop['id'] }}" method="POST">
                            @method('PATCH')
                            @csrf
                                <input class="shop-card__interest-click true" type="submit" value="♥">
                            </form>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection