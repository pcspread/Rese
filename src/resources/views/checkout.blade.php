@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">    
@endsection

@section('content')
<div class="pay-section">
    <div class="pay-title">
        <h1 class="pay-title__text">決済内容</h1>
        <a class="pay-button__back" href="/mypage/">×</a>
    </div>

    <div class="pay-content">
        <table class="pay-table">
            <!-- shop -->
            <tr class="pay-item">
                <th class="pay-head">
                    Shop
                </th>
                <td class="pay-data">
                    牛助
                </td>
            </tr>
            <!-- date -->
            <tr class="pay-item">
                <th class="pay-head">
                    Date
                </th>
                <td class="pay-data">
                    2023/09/15
                </td>
            </tr>
            <!-- time -->
            <tr class="pay-item">
                <th class="pay-head">
                    Time
                </th>
                <td class="pay-data">
                    18:00
                </td>
            </tr>
            <!-- Number -->
            <tr class="pay-item">
                <th class="pay-head">
                    Number
                </th>
                <td class="pay-data">
                    5人
                </td>
            </tr>
            <!-- price -->
            <tr class="pay-item">
                <th class="pay-head">
                    price
                </th>
                <td class="pay-data">
                    2,000円
                </td>
            </tr>
        </table>
    </div>

    <div class="pay-button__wrapper">
        <a class="pay-button__checkout" href="/mypage/payment/checkout">支払う</a>
    </div>
</div>
<div class="mask"></div>
@endsection