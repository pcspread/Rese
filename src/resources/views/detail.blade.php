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
                        <img class="shop-card__image" src="{{ $shop['photo'] }}" alt="">
                    </div>

                    <div class="shop-card__content">
                        <div class="shop-card__top-group">
                            <div class="shop-card__tags">
                                <span class="shop-card__tag">#{{ $shop['region'] }}</span>
                                <span class="shop-card__tag">#{{ $shop['genre'] }}</span>
                            </div>

                            @if (Auth::check())
                            <div class="shop-card__clicks">
                                <form class="shop-card__form" action="/detail/like/{{ $shop['id'] }}" method="POST">
                                @csrf
                                    @if (empty($shop->interest(Auth::id(), $shop['id'])))
                                    <input class="shop-card__interest-click" type="submit" value="♥">

                                    @else
                                    <form class="shop-card__interest-click" action="/detail/like/{{ $shop['id'] }}" method="POST">
                                    @method('PATCH')
                                        @csrf
                                            <input class="shop-card__interest-click true" type="submit" value="♥">
                                        </form>
                                    @endif
                                </form>
                            </div>
                            @endif
                        </div>

                        <div class="shop-card__description">
                            <p class="shop-card__description-content">
                                {{ $shop['description'] }}
                            </p>
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
                <form class="reserve-form" action="/detail/{{ $shop['id'] }}" method="POST">
                @csrf 
                    <div class="reserve-card__input-group">
                        <input class="reserve-card__input" type="date" name="date">
                        @error('date')
                        <div class="reserve-card__input-error">
                            ※{{ $errors->first('date') }}
                        </div>
                        @enderror
                        <select class="reserve-card__select" name="time">
                            @for ($i = 17; $i <= 22; $i++)
                            <option class="reserve-card__select-item" value="{{ $i }}" @if ((int)old('time') === $i) selected @endif>{{ $i }}:00</option>
                            @endfor
                        </select>
                        @error('time')
                        <div class="reserve-card__input-error">
                            ※{{ $errors->first('time') }}
                        </div>
                        @enderror
                        <select class="reserve-card__select" name="number">
                            @for ($s = 1; $s <= 5; $s++)
                            <option class="reserve-card__select-item" value="{{ $s }}" @if ((int)old('number') === $s) selected @endif>{{ $s }}人</option>
                            @endfor
                        </select>
                        @error('number')
                        <div class="reserve-card__input-error">
                            ※{{ $errors->first('number') }}
                        </div>
                        @enderror
                    </div>

                    <div class="reserve-card__content">
                        <table class="reserve-table">
                            <tr class="reserve-item">
                                <th class="reserve-item__title">Shop</th>
                                <td class="reserve-item__content">{{ $shop['name'] }}</td>
                            </tr>
                            <tr class="reserve-item">
                                <th class="reserve-item__title">Date</th>
                                <td class="reserve-item__content">
                                    {{ $shop->reserve(Auth::id(), $shop['id'])['date'] ?? '予約無' }}
                                </td>
                            </tr>
                            <tr class="reserve-item">
                                <th class="reserve-item__title">Time</th>
                                <td class="reserve-item__content">
                                    {{ $shop->reserve(Auth::id(), $shop['id'])['time'] ?? '予約無' }}
                                </td>
                            </tr>
                            <tr class="reserve-item">
                                <th class="reserve-item__title">Number</th>
                                <td class="reserve-item__content">
                                    @if (empty($shop->reserve(Auth::id(), $shop['id'])['number']))
                                        予約無
                                    @else
                                        {{ "{$shop->reserve(Auth::id(), $shop['id'])['number']}人" }}
                                    @endif
                                </td>
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
            <div class="rate-title">
                <h3 class="rate-title__text">コメント</h3>
            </div>

            <div class="rate-display">
                <div class="rate-display__title">
                    <h4 class="rate-display__title-text">評価数選択</h4>
                </div>
                <div class="rate-display__content">
                    <a class="rate-display__item" href="">★</a>
                    <a class="rate-display__item" href="">★</a>
                    <a class="rate-display__item" href="">★</a>
                    <a class="rate-display__item" href="">★</a>
                    <a class="rate-display__item" href="">★</a>
                </div>
            </div>

            <div class="rate-comment">
                <div class="rate-comment__top-group">
                    <div class="rate-comment__top-title">
                        <h4 class="rate-comment__top-title__text">コメント入力</h4>
                    </div>
    
                    <div class="rate-comment__input-group">
                        <form class="rate-comment__input-form" action="">
                            <!-- 投稿者 -->
                            <div class="rate-comment__input-item">
                                <label class="rate-comment__input-title" for="comment_name">〔投稿者〕</label>
                                <input class="rate-comment__input" id="comment_name" type="text" placeholder="投稿者入力欄">
                            </div>
                            <!-- 投稿内容 -->
                            <div class="rate-comment__input-item">
                                <label class="rate-comment__input-title" for="comment_content">〔投稿内容〕</label>
                                <textarea class="rate-comment__input-text" id="comment_content"  name="" cols="30" rows="10"  placeholder="投稿内容入力欄"></textarea>
                            </div>
                            <!-- 投稿ボタン -->
                            <div class="rate-comment__input-item">
                                <button class="rate-comment__input-button">投稿する</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="rate-comment__content-group">
                    <div class="rate-comment__content-title">
                        <h4 class="rate-comment__content-title__text">コメント一覧</h4>
                    </div>

                    @for ($i = 0; $i < 5; $i++)
                    <div class="rate-comment__content-item">
                        <h4 class="rate-comment__content-title" for="">投稿者A</h4>
                        <div class="rate-comment__content-rates">
                            <a class="rate-comment__content-rate" href="">★</a>
                            <a class="rate-comment__content-rate" href="">★</a>
                            <a class="rate-comment__content-rate" href="">★</a>
                            <a class="rate-comment__content-rate" href="">★</a>
                            <a class="rate-comment__content-rate" href="">★</a>
                        </div>
                        <p class="rate-comment__display-content">
                            example...................................................................................................................................................................................
                        </p>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection