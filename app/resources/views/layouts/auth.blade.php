<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン | 人格形成会話アプリ</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css?ver01"') }}">
</head>

<body>
    @if ($errors->any())
        <ul class="alert">
            @foreach ($errors->all() as $error)
                <div class="alert" role="alert">
                    <li> {{ $error }}</li>
                </div>
            @endforeach
        </ul>
    @endif
    <div class="registration">
        @yield('registration')
    </div>
</body>

</html>
