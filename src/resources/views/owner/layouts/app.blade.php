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
    <link rel="stylesheet" href="{{ asset('css/owner/app.css') }}" />
    @yield('css')
    <script src="{{ asset('js/owner/app.js') }}" defer></script>
    @yield('js')
</head>
<body>
    <header class="header">
        <div class="header-title">
            <h1 class="header-title__text" href="/owner">ReseA</h1>
        </div>

        <div class="header-nav">
            <div class="header-item">
                <div class="header-data home">
                    <p class="header-data__text">ホーム</p>
                </div>
                <div class="header-data search">
                    <p class="header-data__text">飲食店抽出</p>
                </div>
                <div class="header-data shop">
                    <p class="header-data__text">飲食店追加</p>
                </div>
                <div class="header-data reserve">
                    <p class="header-data__text">予約一覧</p>
                </div>
                <div class="header-data mail">
                    <p class="header-data__text">メール送信</p>
                </div>
                <div class="header-data hp">
                    <p class="header-data__text">サイト</p>
                </div>
                <div class="header-data logout">
                    <form class="header-data__form" action="/logout" method="POST">
                    @csrf
                        <button class="header-data__buton">
                            <p class="header-data__text">ログアウト</p>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        @if (Auth::user()->email === config('owner.owner_mail'))
        <div class="header-nav__add">
            <p class="header-time__add-setting">管理者設定</p>
        </div>
        @endif

        <div class="header-search">
            <div class="search-group">
                <div class="search-wrapper">
                    <!-- area -->
                    <div class="search-item">
                        <p class="search-title">area</p>
                        <div class="search-menu">
                            <div class="search-menu__icon">〉</div>
                            <ul class="search-menu__list">
                                <li class="search-menu__record area">全て</li>
                                @if (!empty($regions))
                                @foreach ($regions as $region)
                                <li class="search-menu__record area">{{ $region }}</li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- genre -->
                    <div class="search-item">
                        <p class="search-title">genre</p>
                        <div class="search-menu">
                            <div class="search-menu__icon">〉</div>
                            <ul class="search-menu__list">
                                <li class="search-menu__record genre">全て</li>
                                @if (!empty($genres ))
                                @foreach ($genres as $genre)
                                <li class="search-menu__record genre">{{ $genre }}</li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- search -->
                    <div class="search-item">
                        <div class="search__input-group">
                            <div class="search-icon__content">
                                <svg class="search-icon__content-instance" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                            </div>
                            <div class="search-input">
                                <input class="search-input__box" type="text" value="" placeholder="Search ...">
                            </div>
                        </div>
                        <div class="search__button-group">
                            <div class="search-not">
                                <button class="search-not__button" type="button">クリア</button>
                            </div>
                            <div class="search-close">
                                <button class="search-close__link">閉じる</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mask"></div>
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
</body>
</html>