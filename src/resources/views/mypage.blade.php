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

            <div class="reserve-cards">
                @foreach ($reserves as $reserve)
                <div class="reserve-card">
                    <div class="reserve-card__title">
                        <h3 class="reserve-card__title-text">予約</h3>

                        <form class="reserve-form__delete" action="/mypage/reserve/{{ $reserve->shop['id'] }}" method="POST">
                        @method('DELETE')
                        @csrf
                            <button class="reserve-card__delete-button" onclick="return confirmDel()">×</button>
                        </form>
                    </div>

                    <div class="reserve-card__content">
                        <form class="reserve-form__" action="/mypage/reserve/{{ $reserve->shop['id'] }}" method="POST">
                        @method('PATCH')
                        @csrf
                            <!-- shop -->
                            <div class="reserve-card__item">
                                <div class="reserce-card__item-group">
                                    <label class="reserve-card__item-title">Shop</label>
                                    <p class="reserve-card__item-content">{{ $reserve->shop['name'] }}</p>
                                </div>
                            </div>
                            <!-- date -->
                            <div class="reserve-card__item">
                                <div class="reserce-card__item-group">
                                    <label class="reserve-card__item-title">Date</label>
                                    <input class="reserve-card__item-content" type="date" name="date" value="{{ $reserve['date'] }}" placeholder="入力欄">
                                </div>
                                @error('date')
                                <div class="reserve-card__input-error">
                                    ※{{ $errors->first('date'); }}
                                </div>
                                @enderror
                            </div>
                            <!-- time -->
                            <div class="reserve-card__item">
                                <div class="reserce-card__item-group">
                                    <label class="reserve-card__item-title">Time</label>
                                    <select class="reserve-card__item-content" name="time">
                                        @for ($i = 17; $i <= 22; $i++)
                                        <option class="reserve-card__item-content__option" value="{{ $i }}" @if ($reserve['time'] === "{$i}:00:00") selected @endif>{{ $i }}:00</option>
                                        @endfor
                                    </select>
                                </div>
                                @error('time')
                                <div class="reserve-card__input-error">
                                    ※{{ $errors->first('time'); }}
                                </div>
                                @enderror
                            </div>
                            <!-- number -->
                            <div class="reserve-card__item">
                                <div class="reserce-card__item-group">
                                    <label class="reserve-card__item-title">Number</label>
                                    <select class="reserve-card__item-content" name="number">
                                        @for ($s = 1; $s <= 5; $s++)
                                        <option class="reserve_card__item-content__option" value="{{ $s }}" @if ((int)$reserve['number'] === $s) selected @endif>
                                            {{ $s }}
                                        </option>    
                                        @endfor
                                    </select>
                                </div>
                                @error('number')
                                <div class="reserve-card__input-error">
                                    ※{{ $errors->first('number'); }}
                                </div>
                                @enderror
                            </div>
                            <!-- button -->
                            <button class="reserve-card__update-button" onclick="return confirmUpdate()">更新</button>
                        </form>
                    </div>
                </div>
                @endforeach
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