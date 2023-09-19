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
                        メール認証
                    </h2>
                    <div class="email-content__main">
                        <p class="email-content__thanks">
                            この度は、Reseをご利用いただきありがとうございます。<br>
                        </p>
                    </div>

                    <div class="email-content__sub">
                        <p class="email-content__description">
                            こちらは、{{ $name }}様専用のメール認証用の確認メールです。<br>
                            下記「認証を完了する」をクリックいただくと、本登録が完了します。  
                        </p>
                        
                        <div class="email-button">
                            <a class="email-button__thanks" href="{{ url('http://localhost/thanks?token='.$token) }}">認証を完了する</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>