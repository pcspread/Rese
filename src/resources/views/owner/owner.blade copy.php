@extends('owner.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/owner.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/owner.js') }}"></script>
@endsection

@section('content')
<div class="home-section">
    <div class="list-wrapper">
        <form class="list-form">
            <div class="list-item__top">
                <div class="list-title1">店舗画像</div>
                <div class="list-title2">飲食店名</div>
                <div class="list-title3">エリア</div>
                <div class="list-title4">ジャンル</div>
                <div class="list-title5">説明</div>
                <div class="list-title6"></div>
            </div>

            <div class="list-item__bottom__wrapper">
                @foreach ($shops as $shop)
                <div class="list-item__bottom">
                    <div class="list-content1">
                        <img class="list-content1__image" src="{{ $shop['photo'] }}" alt="shop-image">
                    </div>
                    <div class="list-content2">{{ $shop['name'] }}</div>
                    <div class="list-content3">{{ $shop['region'] }}</div>
                    <div class="list-content4">{{ $shop['genre'] }}</div>
                    <div class="list-content5">{{ $shop['description'] }}</div>
                    <div class="list-content6">
                        <button class="list-button edit">修正</button>
                        <button class="list-button delete" type="button">削除</button>
                    </div>
                </div>
                @endforeach
            </div>
        </form>
    </div>
</div>
@endsection