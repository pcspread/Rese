@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="payment-section">
    <p class="payment-description">決済ページへ移動します</p>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const publicKey = '{{ env('STRIPE_PUBLIC_KEY') }}';
    const stripe = Stripe(publicKey);
    window.onload = function () {
        stripe.redirectToCheckout({
            sessionId: '{{ $session->id }}'
        }).then(function (result) {
            window.location.href = 'http://localhost/cart';
        });
    }
</script>
@endsection