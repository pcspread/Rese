@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('js')
<script src="{{ asset('js/detail.js') }}" defer></script>
@endsection

@section('content')
<div class="detail-section" id="header">
    <div class="detail-shop">
        <div class="shop-title">
            <a class="shop-button__back" href="/back"><</a>
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

    @if (Auth::check())
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
                    <div class="reserve-card__content-description">
                        <p class="reserve-card__content-description__text">
                            下記の内容で、予約が入っています。<br>
                            予約内容は、マイページで変更いただけます。
                        </p>
                    </div>

                    <table class="reserve-table">
                        <tr class="reserve-item">
                            <th class="reserve-item__title">Shop</th>
                            <td class="reserve-item__content">{{ $shop['name'] }}</td>
                        </tr>
                        <tr class="reserve-item">
                            <th class="reserve-item__title">Date</th>
                            <td class="reserve-item__content">{{ $shop->reserve(Auth::id(), $shop['id'])['date'] ?? '予約無' }}</td>
                        </tr>
                        <tr class="reserve-item">
                            <th class="reserve-item__title">Time</th>
                            <td class="reserve-item__content">{{ $shop->reserve(Auth::id(), $shop['id'])['time'] ?? '予約無' }}</td>
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
    @endif

    <div class="detail-rate">
        @if (Auth::check() && !empty($delete))
        <div class="rate-title">
            <h3 class="rate-title__text">コメント</h3>
        </div>
        @endif

        <div class="rate-comment">
            @if (Auth::check() && !empty($delete))
            <div class="rate-comment__top-group">
                <div class="rate-comment__top-title">
                    <h4 class="rate-comment__top-title__text">コメント入力</h4>
                </div>

                <div class="rate-comment__input-group">
                    <form class="rate-comment__input-form" action="/rate/{{ $shop['id'] }}" method="POST">
                    @csrf
                        <!-- 評価数選択 -->
                        <div class="rate-comment__input-item">
                            <label class="rate-comment__input-title" for="comment_name">〔評価数選択：5段階〕</label>
                            <input class="rate-comment__input-range" type="range" min="1" max="5" name="number" list="rate-list">
                            <datalist class="range-list" id="rate-list">
                                <option class="range-list__option">1</option> 
                                <option class="range-list__option">2</option>
                                <option class="range-list__option">3</option>
                                <option class="range-list__option">4</option>
                                <option class="range-list__option">5</option>
                            </datalist>
                        </div>
                        <!-- 投稿者 -->
                        <div class="rate-comment__input-item">
                            <label class="rate-comment__input-title" for="comment_name">〔投稿者〕</label>
                            <input class="rate-comment__input" type="text" name="name" value="{{ old('name') }}" placeholder="投稿者入力欄">
                            @error('name')
                            <div class="rate-comment__input-error">
                                ※{{ $errors->first('name') }}
                            </div>
                            @enderror
                        </div>
                        <!-- 投稿内容 -->
                        <div class="rate-comment__input-item">
                            <label class="rate-comment__input-title" for="comment_content">〔投稿内容〕</label>
                            <textarea class="rate-comment__input-text" id="comment_content" cols="30" rows="10" name="comment" maxlength="255" placeholder="投稿内容入力欄">{{ old('comment') }}</textarea>
                        </div>
                        <!-- 投稿ボタン -->
                        <div class="rate-comment__input-item">
                            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                            <button class="rate-comment__input-button">投稿する</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <div class="rate-comment__content-group">
                <div class="rate-comment__content-title">
                    <h4 class="rate-comment__content-title__text">コメント一覧</h4>
                </div>

                @foreach ($rates as $rate)
                <div class="rate-comment__content-item">
                    <h4 class="rate-comment__content-title">{{ $rate['name'] }}</h4>
                    <p class="rate-comment__content-rates">{{ $rate['number'] }}</p>
                    <p class="rate-comment__display-content">{{ $rate['comment'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection