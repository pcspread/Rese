@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}" />
@endsection

@section('js')
<script src="{{ asset('js/mypage.js') }}" defer></script>
@endsection

@section('content')
<div class="mypage-section" id="header">
    <div class="mypage-header">
        <h1 class="mypage-header__name">
            {{ session('name') ?? 'ゲスト' }}さん
        </h1>
    </div>

    <div class="mypage-content">
        <div class="mypage-reserve">
            <div class="reserve-title">
                <h2 class="reserve-title__text">予約状況</h2>
            </div>

            <div class="reserve-card">
                <form class="reserve-form">
                    <div class="reserve-card__title">
                        <h3 class="reserve-card__title-text">予約</h3>
                        <button class="reserve-card__delete-button">×</button>
                    </div>

                    <div class="reserve-card__content">
                        <div class="reserve-card__item">
                            <label class="reserve-card__item-title">Shop</label>
                            <input class="reserve-card__item-content" type="text" name="shop" placeholder="入力欄">
                        </div>
                        <div class="reserve-card__item">
                            <label class="reserve-card__item-title">Date</label>
                            <input class="reserve-card__item-content" type="text" name="date" placeholder="入力欄">
                        </div>
                        <div class="reserve-card__item">
                            <label class="reserve-card__item-title">Time</label>
                            <input class="reserve-card__item-content" type="text" name="time" placeholder="入力欄">
                        </div>
                        <div class="reserve-card__item">
                            <label class="reserve-card__item-title">Number</label>
                            <input class="reserve-card__item-content" type="text" name="number" placeholder="入力欄">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mypage-shops">
            <div class="shops-title">
                <h2 class="shops-title__text">お気に入り店舗</h2>
            </div>
        
            <div class="shops-cards">
                @foreach ($interests as $interest)
                <div class="shop-card">
                    <div class="shop-card__firstView">
                        <img class="shop-card__image" src="{{ $interest->shop['photo'] }}" alt="">
                    </div>
                    <div class="shop-card__content">
                        <h1 class="shop-title">
                            {{ $interest->shop['name'] }}
                        </h1>
                        <div class="shop-card__tags">
                            <span class="shop-card__tag">#{{ $interest->shop->region }}</span>
                            <span class="shop-card__tag">#{{ $interest->shop['genre'] }}</span>
                        </div>
                        <div class="shop-card__clicks">
                            <a class="shop-card__detail-click" href="/detail/{{ $interest->shop['id'] }}">詳しく見る</a>

                            <form class="shop-card__form" action="/mypage/like/{{ $interest->shop['id'] }}" method="POST">
                            @csrf
                                <form class="shop-card__false-form" action="/mypage/like/{{ $interest->shop['id'] }}" method="POST">
                                @method('PATCH')
                                @csrf
                                    <input class="shop-card__interest-click true" type="submit" value="♥">
                                </form>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection