<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/layouts/default.css') }}" />
    @yield('css')
    <script src="{{ asset('js/default.js') }}" defer></script>
    @yield('js')
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <div class="header-icon">
                <div class="icon-line1"></div>
                <div class="icon-line2"></div>
                <div class="icon-line3"></div>
            </div>

            <span class="header-title">Rese</span>
        </div>

        <div class="header-mene">
            <nav class="header-menu__nav">
                <ul class="nav-list">
                    <li class="nav-list__item">
                        <a href="/" class="nav-list__link">Home</a>
                    </li>
                    @if (!Auth::check())
                    <li class="nav-list__item">
                        <a href="/register" class="nav-list__link">Registration</a>
                    </li>
                    <li class="nav-list__item">
                        <a href="/login" class="nav-list__link">Login</a>
                    </li>
                    @else
                    <li class="nav-list__item">
                        <form class="nav-list__form" action="/logout" method="POST">
                        @csrf
                            <input class="nav-list__link" type="submit" value="Logout" />
                        </form>
                    </li>
                    <li class="nav-list__item">
                        <a href="/mypage" class="nav-list__link">Mypage</a>
                    </li>
                        @if (Auth::user()->email === config('owner.top_mail') || Auth::user()->email === config('owner.owner_mail'))
                        <li class="nav-list__item">
                            <a href="/owner" class="nav-list__link">ReseA</a>
                        </li>
                        @endif
                    @endif  
                </ul>
            </nav>
        </div>

        @if (session()->has('success'))
        <div class="header-comment">
            <div class="header-comment__icon">
                <svg class="header-comment__icon-instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
            </div>

            <div class="header-comment__success">
                {{ session('success') }}
            </div>
        </div>
        @endif
    </header>

    <main class="main">
        @yield('content')
    </main>

    <aside class="aside">
        <div class="upper"><</div>
    </aside>
</body>
</html>