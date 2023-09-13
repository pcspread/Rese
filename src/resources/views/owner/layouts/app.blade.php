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
        <div class="header-title">
            <a class="header-title__text" href="/owner">ReseA</a>
        </div>

        <div class="burger">
            <div class="burger-line1"></div>
            <div class="burger-line2"></div>
            <div class="burger-line3"></div>
        </div>

        <div class="header-nav">
            <ul class="header-list">
                <li class="header-item">
                    <a class="header-link" href="/owner/store">飲食店追加</a>
                </li>
                <li class="header-item">
                    <a class="header-link" href="/owner/mail">メール送信</a>
                </li>
                <li class="header-item">
                    <a class="header-link" href="/owner/setting">管理者設定</a>
                </li>
                <li class="header-item">
                    <a class="header-link" href="/logout">ログアウト</a>
                </li>
                <li class="header-item">
                    <div class="search-group">
                        <div class="search-wrapper">
                            <!-- area -->
                            <div class="search-item">
                                <p class="search-title">All area</p>
                                <div class="search-menu">
                                    <div class="search-menu__icon">〉</div>
                                    <ul class="search-menu__list">
                                        <li class="search-menu__record area">全て</li>
                                        <li class="search-menu__record area"></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- genre -->
                            <div class="search-item">
                                <p class="search-title">All genre</p>
                                <div class="search-menu">
                                    <div class="search-menu__icon">〉</div>
                                    <ul class="search-menu__list">
                                        <li class="search-menu__record genre">全て</li>
                                        <li class="search-menu__record genre"></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- search -->
                            <div class="search-item">
                                <div class="search-icon">
                                    <div class="search-icon__content">
                                        <svg class="search-icon__content-instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                                    </div>
                                </div>
                                <div class="search-input">
                                    <input class="search-input__box" type="text" value="" placeholder="Search ...">
                                </div>
                                <div class="search-not">
                                    <button class="search-not__button" type="button">×</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>
</body>
</html>