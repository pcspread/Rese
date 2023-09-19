@php
    use App\Models\Shop;
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
                    <div class="search-icon__content">
                        <svg class="search-icon__content-instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                    </div>
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
        @if (count($shops) !== 0)
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
                            @if (Auth::check())
                                @if (empty($shop->interest(Auth::id(), $shop['id'])))
                                <input class="shop-card__interest-click" type="submit" value="♥">
                                @else
                                    <form class="shop-card__false-form" action="/like/{{ $shop['id'] }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                        <input class="shop-card__interest-click true" type="submit" value="♥">
                                    </form>
                                @endif
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="shop-card__empty">
                <p class="shop-card__empty-text">※飲食店情報がありません</p>
            </div>
        @endif

    </div>
</div>
@endsection