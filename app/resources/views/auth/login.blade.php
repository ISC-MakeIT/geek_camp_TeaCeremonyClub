@extends('layouts.auth')
@section('registration')
    <p class="registration_title">ログイン</p>
    <form class="registration_form" action="{{ route('login') }}" method="post">
        @csrf
        <dl class="form-list">
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
        </dl>
        <div class="registration_btn">
            <a href="{{ route('register') }}">会員登録する</a>
            <button class="login_btn" type="submit">ログインする</button>
        </div>
    </form>
@endsection()
