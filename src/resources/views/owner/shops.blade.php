@extends('owner.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/shops.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/owner/shops.js') }}"></script>
@endsection

@section('content')
<div class="home-section">
    <div class="list-wrapper">
        <form class="list-form">
            <div class="list-item__top">
                <div class="list-title one">
                    <div class="list-title__child">飲食店名</div>
                    <div class="list-title__child">エリア</div>
                    <div class="list-title__child">ジャンル</div>
                </div>
                <div class="list-title two">
                    <p class="list-title__text">説明</p>
                </div>
                <div class="list-title three"></div>
            </div>

            @foreach ($shops as $shop)
            <div class="list-item__bottom">
                <div class="list-content one">
                    <div class="list-content__child">{{ $shop['name'] }}</div>
                    <div class="list-content__child">{{ $shop['region'] }}</div>
                    <div class="list-content__child">{{ $shop['genre'] }}</div>
                </div>
                <div class="list-content two">
                    <p class="list-content__text">{{ $shop['description'] }}</p>
                </div>
                <div class="list-content three">
                    <a class="list-button edit" href="/owner/shop/edit">修正</a>
                    <button class="list-button delete" type="button">削除</button>
                </div>
            </div>
            @endforeach
        </form>
    </div>
</div>
@endsection