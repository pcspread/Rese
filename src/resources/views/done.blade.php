@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}" />
@endsection

@section('js')
<script src="{{ asset('js/done.js') }}" defer></script>
@endsection

@section('content')
<div class="done-section">
    <div class="done-wrapper">
        <div class="done-title">
            <h1 class="done-title__content">
                ご予約ありがとうございます
            </h1>
        </div>

        <!-- button -->
        <div class="done-button">
            <a class="done-button__back" href="/detail/{{ session('shop_id') }}">戻る</a>
        </div>
    </div>
</div>
@endsection