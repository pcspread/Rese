@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('js')
<script src="{{ asset('js/detail.js') }}" defer></script>
@endsection

@section('content')
<div class="detail-section" id="header">
    <div class="detail-main">
        <div class="detail-shop">
            <div class="shop-title">
                <a class="shop-button__back" href="/"><</a>
                <h1 class="shop-title__text">{{ $shop['name']}}</h1>
            </div>
        
            <div class="shops-cards">
                <div class="shop-card">
                    <div class="shop-card__firstView">
                        <img class="shop-card__image" src="https://dummyimage.com/400x250/000/fff" alt="">
                    </div>
                    <div class="shop-card__content">
                        <div class="shop-card__tags">
                            <span class="shop-card__tag">#{{ $shop['region'] }}</span>
                            <span class="shop-card__tag">#{{ $shop['genre'] }}</span>
                        </div>
                        <div class="shop-card__description">
                            <p class="shop-card__description-content">
                                {{ $shop['description'] }}
                            </p>
                        </div>
                        <div class="shop-card__clicks">
                            <form class="shop-card__form" action="/detail/like/" method="POST">
                            @csrf
                                <form class="shop-card__interest-click" action="/detail/like/" method="POST">
                                @method('PATCH')
                                @csrf
                                    <input class="shop-card__interest-click true" type="submit" value="♥">
                                </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="detail-reserve">
            <div class="reserve-title">
                <h2 class="reserve-title__text">予約</h2>
            </div>
    
            <div class="reserve-card">
                <form class="reserve-form">
                    <div class="reserve-card__title">
                        <h3 class="reserve-card__title-text">予約</h3>
                    </div>

                    <div class="reserve-card__input-group">
                        <input class="reserve-card__input" type="date">
                        <select class="reserve-card__select" name="" id="" >
                            <option value="" class="reserve-card__select-item">17:00</option>
                            <option value="" class="reserve-card__select-item">18:00</option>
                            <option value="" class="reserve-card__select-item">19:00</option>
                            <option value="" class="reserve-card__select-item">20:00</option>
                            <option value="" class="reserve-card__select-item">21:00</option>
                            <option value="" class="reserve-card__select-item">22:00</option>
                        </select>
                        <select class="reserve-card__select" name="" id="" >
                            <option value="" class="reserve-card__select-item">1人</option>
                            <option value="" class="reserve-card__select-item">2人</option>
                            <option value="" class="reserve-card__select-item">3人</option>
                            <option value="" class="reserve-card__select-item">4人</option>
                            <option value="" class="reserve-card__select-item">5人</option>
                            <option value="" class="reserve-card__select-item">6人</option>
                            <option value="" class="reserve-card__select-item">7人</option>
                            <option value="" class="reserve-card__select-item">8人</option>
                        </select>
                        <input class="reserve-card__input" type="number">
                    </div>

                    <div class="reserve-card__content">
                        <table class="reserve-table">
                            <tr class="reserve-item">
                                <th class="reserve-title">Shop</th>
                                <td class="reserve-content">{{ $shop['name'] }}</td>
                            </tr>
                            <tr class="reserve-item">
                                <th class="reserve-title">Date</th>
                                <td class="reserve-content">2021-04-01</td>
                            </tr>
                            <tr class="reserve-item">
                                <th class="reserve-title">Time</th>
                                <td class="reserve-content">17:00</td>
                            </tr>
                            <tr class="reserve-item">
                                <th class="reserve-title">Number</th>
                                <td class="reserve-content">1人</td>
                            </tr>
                        </table>
                    </div>

                    <div class="reserve-card__button">
                        <button class="reserve-card__button-reserve">予約する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="detail-sub">
        <div class="detail-rate">
            <a class="detail-rate__item" href="">★</a>
            <a class="detail-rate__item" href="">★</a>
            <a class="detail-rate__item" href="">★</a>
            <a class="detail-rate__item" href="">★</a>
            <a class="detail-rate__item" href="">★</a>
        </div>

        <div class="detail-comment__wrapper">
            <div class="detail-comment__title-wrapper">
                <h3 class="detail-comment__title">コメント</h3>
            </div>

            <div class="detail-comment__input-group">
                <form class="detail-comment__input-form" action="">
                    <!-- 投稿者 -->
                    <div class="detail-comment__input-item">
                        <label class="detail-comment__input-title" for="">投稿者</label>
                        <input class="detail-comment__input" type="text" placeholder="投稿者入力欄">
                    </div>
                    <!-- 投稿内容 -->
                    <div class="detail-comment__input-item">
                        <label class="detail-comment__input-title" for="">投稿内容</label>
                        <textarea class="detail-comment__input-text" name="" id="" cols="30" rows="10"  placeholder="投稿内容入力欄"></textarea>
                    </div>
                    <!-- 投稿ボタン -->
                    <div class="detail-comment__input-item">
                        <button class="detail-comment__input-button">投稿する</button>
                    </div>
                </form>
            </div>

            <div class="detail-comment__display-group">
                @for ($i = 0; $i < 5; $i++)
                <div class="detail-comment__display-item">
                    <h4 class="detail-comment__display-title" for="">投稿者A</h4>
                    <div class="detail-comment__display-rates">
                        <a class="detail-comment__display-rate" href="">★</a>
                        <a class="detail-comment__display-rate" href="">★</a>
                        <a class="detail-comment__display-rate" href="">★</a>
                        <a class="detail-comment__display-rate" href="">★</a>
                        <a class="detail-comment__display-rate" href="">★</a>
                    </div>
                    <p class="detail-comment__display-content">
                        example...................................................................................................................................................................................
                    </p>
                </div>
                @endfor
            </div>
        </div>
        
    </div>
</div>
@endsection