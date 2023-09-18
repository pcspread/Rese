
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
    <link rel="stylesheet" href="{{ asset('css/auth/send-email.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header-wrapper">
            <h1 class="header-title">Rese</h1>
        </div>
    </header>

    <main class="main">
        <div class="email-section">
            <div class="email-wrapper">
                <div class="email-content">
                    <h2 class="email-content__title">
                        お知らせメール
                    </h2>
                    <div class="email-content__main">
                        <p class="email-content__thanks">
                            {{ $user_name }}様、日頃より、Reseをご愛顧いただき誠にありがとうございます。
                            ご予約の当日となりましたので、メールにてお知らせいたします。
                        </p>
                    </div>

                    <div class="email-content__sub">
                        <h3 class="email-content__sub-title">予約内容</h3>
                        <p class="email-content__description">飲食店名：{{ $shop_name }}</p>
                        <p class="email-content__description">予約日時：{{ $date . ' ' . $time }}</p>
                        <p class="email-content__description">予約人数：{{ $number }}人</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>