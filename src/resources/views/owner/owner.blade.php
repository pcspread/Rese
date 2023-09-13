@extends('owner.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/owner.css') }}">
@endsection

@section('content')
<div class="home-section">
    <table class="home-table__top">
        <div class="table-wrapper">
            <tr class="table-top__item">
                <th class="table-top__title" rowspan="2"></th>
                <th class="table-top__title">飲食店名</th>
                <th class="table-top__title">エリア</th>
                <th class="table-top__title">ジャンル</th>
                <th class="table-top__title" colspan="2" rowspan="2"></th>
            </tr>
            <tr class="table-top__item">
                <th class="home-item__title" colspan="3"></th>
            </tr>
        </div>
    </table>

    <table class="home-table__bottom">
        @for ($i = 0; $i < 20; $i++)
        <div class="table-wrapper">
            <form class="table-form">
                <tr class="table-bottom__item">
                    <td class="table-bottom__content" rowspan="2"></td>
                    <td class="table-bottom__content">仙人</td>
                    <td class="table-bottom__content">東京</td>
                    <td class="table-bottom__content">寿司</td>
                    <td class="table-bottom__content" colspan="2" rowspan="2">
                        <button class="table-bottom__button--edit">修正</button>
                        <button class="table-buttom__button--delete" type="button">削除</button>
                    </td>
                </tr>
                <tr class="table-bottom__item">
                    <td class="table-bottom__content" colspan="3">説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・説明・・・</td>
                </tr>
            </form>
        </div>
        @endfor
    </table>
</div>
@endsection