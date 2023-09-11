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
                            <svg class="login-icon__instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
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
                            <svg class="login-icon__instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                        </label>
                        <input class="login-input" type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
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