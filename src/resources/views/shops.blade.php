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
                        @for ($i = 0; $i < 10; $i++)
                        <li class="search-menu__record">
                            <a class="search-menu__link" href="">#東京都</a>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>
            <!-- genre -->
            <div class="search-item">
                <p class="search-title">All genre</p>
                <div class="search-menu">
                    <div class="search-menu__icon">〉</div>
                    <ul class="search-menu__list">
                        @for ($i = 0; $i < 10; $i++)
                        <li class="search-menu__record">
                            <a class="search-menu__link" href="">#ラーメン</a>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>
            <!-- search -->
            <div class="search-item">
                <div class="search-icon">
                    <div class="search-icon__content">🔍</div>
                </div>
                <div class="search-input">
                    <input class="search-input__box" type="text" placeholder="Search ...">
                </div>
            </div>
        </div>
    </div>

    <div class="shops-group">
        @for ($i = 0; $i < 15; $i++)
        <div class="shop-card">
            <div class="shop-card__firstView">
                <img class="shop-card__image" src="https://dummyimage.com/400x200/000/000" alt="">
            </div>
            <div class="shop-card__content">
                <h1 class="shop-title">
                    仙人
                </h1>
                <div class="shop-card__tags">
                    <span class="shop-card__tag">#東京都</span>
                    <span class="shop-card__tag">#ラーメン</span>
                </div>
                <div class="shop-card__clicks">
                    <a class="shop-card__detail-click" href="#">詳しく見る</a>
                    <form class="shop-card__form" action="#">
                        <input type="hidden">
                        <input class="shop-card__interest-click" type="submit" value="♥">
                    </form>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection