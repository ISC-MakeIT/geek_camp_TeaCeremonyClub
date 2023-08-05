@extends('layouts.auth')
@section('registration')
    <p class="registration_title">会員登録</p>
    <form class="registration_form" action="{{ route('register') }}" method="post">
        @csrf
        <dl class="form-list">
            <div class="input_group">
                <label for="registration_email" id="l_registration_email">ユーザーネーム</label>
                <input id="registration_email" type="text" name="name" value="{{ old('name') }}"
                    placeholder="ユーザーネーム">
                <div class="underline"></div>
            </div>
            <div class="input_group">
                <label for="registration_email" id="l_registration_email">メールアドレス</label>
                <input id="registration_email" type="email" name="email" value="{{ old('email') }}"
                    placeholder="example@email.com">
                <div class="underline"></div>
            </div>
            <div class="input_group">
                <label for="registration_password" id="l_registration_password">パスワード</label>
                <input id="registration_password" type="password" name="password" placeholder="password">
                <div class="underline"></div>
            </div>
            <div class="input_group">
                <label for="registration_password" id="l_registration_password">パスワード(確認用)</label>
                <input id="registration_password" type="password" name="password_confirmation" placeholder="もう一度入力">
                <div class="underline"></div>
            </div>
        </dl>
        <div class="registration_btn">
            <a href="{{ route('login') }}">ログインする</a>
            <button class="login_btn" type="submit">会員登録する</button>
        </div>
    </form>
@endsection()
