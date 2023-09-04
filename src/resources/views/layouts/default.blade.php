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
                    @if (!Auth::check())
                    <li class="nav-list__item">
                        <a href="/" class="nav-list__link">Home</a>
                    </li>
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
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <aside class="aside">
        <div class="upper"><</div>
    </aside>
</body>
</html>