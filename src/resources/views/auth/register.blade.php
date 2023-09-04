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
                            <img src="https://dummyimage.com/20x20/000/000" alt="">
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
                            <img src="https://dummyimage.com/20x20/000/000" alt="">
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
                            <img src="https://dummyimage.com/20x20/000/000" alt="">
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