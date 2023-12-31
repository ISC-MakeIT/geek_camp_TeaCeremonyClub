<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/images/favicon.png" />
    <title>@yield('title') | コネクト！</title>
    @vite('resources/js/app.js')
</head>

<body>
    <header class="header">
        @yield('header')
    </header>

    <main class="main">
        @yield('main')
    </main>

    @yield('script')
</body>

</html>
