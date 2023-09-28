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
                    <div class="list-title__child">
                        <p class="list-title__child-text">飲食店名</p>
                    </div>
                    <div class="list-title__child">
                        <p class="list-title__child-text">エリア</p>
                    </div>
                    <div class="list-title__child">
                        <p class="list-title__child-text">ジャンル</p>
                    </div>
                </div>
                <div class="list-title two">
                    <p class="list-title__text">説明</p>
                </div>
                <div class="list-title three"></div>
            </div>

            @if (count($shops) !== 0)
            @foreach ($shops as $shop)
            <div class="list-item__bottom">
                <div class="list-content one">
                    <div class="list-content__child">
                        <p class="list-content__child-text">
                            {{ $shop['name'] }}
                        </p>
                    </div>
                    <div class="list-content__child">
                        <p class="list-content__child-text">
                            {{ $shop['region'] }}
                        </p>
                    </div>
                    <div class="list-content__child">
                        <p class="list-content__child-text">
                            {{ $shop['genre'] }}
                        </p>
                    </div>
                </div>
                <div class="list-content two">
                    <p class="list-content__text">
                        {{ $shop['description'] }}
                    </p>
                </div>
                <div class="list-content three">
                    <a class="list-button edit" href="/owner/shop/edit/{{ $shop['id'] }}">修正</a>
                    <form class="list-content__delete-form" action="/owner/shop/delete/{{ $shop['id'] }}" method="POST">
                    @method('DELETE')
                    @csrf
                        <button class="list-button delete" onclick="return confirmDel()">削除</button>
                    </form>
                </div>
            </div>
            @endforeach
            @else
            <div class="list-item__empty">
                <p class="list-item__empty-text">※飲食店情報がありません</p>
            </div>
            @endif
        </form>
    </div>
</div>
@endsection