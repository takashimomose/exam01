<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Contact Form')</title> <!-- 各ページで異なるタイトルを指定可能 -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">

    <!-- 各ページで追加のCSSを読み込む -->
    @stack('css')
</head>

<body>
    <div class="header">
        <h1>FashionablyLate</h1>
        @if (Request::is('/'))
            {{-- トップページの場合はボタンなし --}}
        @elseif (Auth::check() && Request::is('admin'))
            {{-- Auth::check() かつ 管理者ページではログアウトボタンを表示 --}}
            <div class="authentication">
                <form class="form" action="/logout" method="post">
                    @csrf
                    <button type="submit">logout</button>
                </form>
            </div>
        @elseif (Request::is('login'))
            {{-- ログインページの場合、新規登録ボタンを表示 --}}
            <div class="authentication">
                <button type="button" onclick="location.href='{{ route('register') }}'">register</button>
            </div>
        @elseif (Request::is('register'))
            {{-- 登録ページの場合、ログインボタンを表示 --}}
            <div class="authentication">
                <button type="button" onclick="location.href='{{ route('login') }}'">login</button>
            </div>
        @endif
    </div>

    <main>
        @yield('content') <!-- ここに各ページのコンテンツが挿入されます -->
    </main>
</body>

</html>
