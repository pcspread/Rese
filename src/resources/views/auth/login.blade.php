@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />
@endsection

@section('content')
<div class="login-section">
    <div class="login-wrapper">
        <div class="login-title">
            <h1 class="login-title__content">
                Login
            </h1>
        </div>

        <div class="login-content">
            <form class="login-form" action="/login" method="POST">
            @csrf
                <!-- Email -->
                <div class="login-item">
                    <div class="login-item__main">
                        <label class="login-icon" for="email">
                            <img src="https://dummyimage.com/20x20/000/000" alt="">
                        </label>
                        <input class="login-input" type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email" autofocus>
                    </div>
                    <div class="login-item__sub">
                        <div class="login-error">
                            @error('email')
                                ※{{ session('errors')->first('email') }}
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Password -->
                <div class="login-item">
                    <div class="login-item__main">
                        <label class="login-icon" for="password">
                            <img src="https://dummyimage.com/20x20/000/000" alt="">
                        </label>
                        <input class="login-input" type="text" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                    </div>
                    <div class="login-item__sub">
                        <div class="login-error">
                            @error('password')
                                ※{{ session('errors')->first('password') }}
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="login-button">
                    <input class="login-button__submit" type="submit" value="ログイン">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection