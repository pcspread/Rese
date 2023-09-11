@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}" />
@endsection

@section('content')
<div class="register-section">
    <div class="register-wrapper">
        <div class="register-title">
            <h1 class="register-title__content">
                register
            </h1>
        </div>

        <div class="register-content">
            <form class="register-form" action="/register" method="POST">
            @csrf
                <!-- Username -->
                <div class="register-item">
                    <div class="register-item__main">
                        <label class="register-icon" for="name">
                            <svg class="register-icon__instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                        </label>
                        <input class="register-input" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="name" autofocus>
                    </div>
                    <div class="register-item__sub">
                        <div class="register-error">
                            @error('name')
                                ※{{ session('errors')->first('name') }}
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Email -->
                <div class="register-item">
                    <div class="register-item__main">
                        <label class="register-icon" for="email">
                            <svg class="register-icon__instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                        </label>
                        <input class="register-input" type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                    </div>
                    <div class="register-item__sub">
                        <div class="register-error">
                            @error('email')
                                ※{{ session('errors')->first('email') }}
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Password -->
                <div class="register-item">
                    <div class="register-item__main">
                        <label class="register-icon" for="password">
                            <svg class="register-icon__instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                        </label>
                        <input class="register-input" type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                    </div>
                    <div class="register-item__sub">
                        <div class="register-error">
                            @error('password')
                                ※{{ session('errors')->first('password') }}
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="register-button">
                    <input class="register-button__submit" type="submit" value="登録">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection