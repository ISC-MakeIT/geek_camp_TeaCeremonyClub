@extends('layouts.auth')
@section('registration')
    <h1 class="registration_title">ログイン</h1>
    <form class="registration_form" action="{{ route('login') }}" method="post">
        @csrf
        <dl class="form-list">
            <div class="input_group">
                <label class="input_group_label" for="registration_email" id="l_registration_email">メールアドレス</label>
                <input class="registration_box" id="registration_email" type="email" name="email"
                    value="{{ old('email') }}" placeholder="example@email.com">
                <div class="underline"></div>
            </div>
            <div class="input_group">
                <label class="input_group_label" for="registration_password" id="l_registration_password">パスワード</label>
                <input class="registration_box" id="registration_password" type="password" name="password"
                    placeholder="password">
                <div class="underline"></div>
            </div>
            <div class="actions">
                <a href="{{ route('register') }}">会員登録する</a>
                <button class="login_btn" type="submit">ログインする</button>
            </div>
        </dl>
    </form>
@endsection()
