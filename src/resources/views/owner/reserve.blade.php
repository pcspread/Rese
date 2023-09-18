@extends('owner.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/reserve.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/owner/reserve.js') }}" defer></script>
@endsection

@section('content')
<div class="reserve-section">
    <div class="reserve-section__title">
        <h2 class="reserve-section__title-text">予約一覧</h2>

        <div class="reserve-search">
            <div class="reserve-search__icon">
                <svg class="reserve-search__icon-instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
            </div>
            <input class="reserve-search__input" type="text" name="name" value="{{ old('name') }}" placeholder="飲食店名入力欄">
            <p class="reserve-search__clear">×</p>
        </div>
    </div>

    @if (count($reserves) !== 0)
    <table class="reserve-content">
        <tr class="reserve-content__title">
            <td class="reserve-content__title-record">飲食店</td>
            <td class="reserve-content__title-record">ユーザー名</td>
            <td class="reserve-content__title-record">予約日</td>
            <td class="reserve-content__title-record">予約時間</td>
            <td class="reserve-content__title-record">予約人数</td>
        </tr>

        @foreach ($reserves as $reserve)
        <tr class="reserve-content__instance">
            <td class="reserve-content__instance-record name">{{ $reserve->shop['name'] ?? ''}}</td>
            <td class="reserve-content__instance-record">{{ $reserve->user['name'] ?? ''}}</td>
            <td class="reserve-content__instance-record">{{ $reserve['date'] ?? ''}}</td>
            <td class="reserve-content__instance-record">{{ $reserve['time'] ?? ''}}</td>
            <td class="reserve-content__instance-record">{{ $reserve['number'] ?? ''}}人</td>
        </tr>
        @endforeach
    </table>
    @else
        <p class="reserve-empty">
            ※予約情報がありません
        </p>
    @endif
</div>
@endsection