@extends('layouts.auth')
@section('registration')
    <h1 class="registration_title">会員登録</h1>
    <form class="registration_form" action="{{ route('register') }}" method="post">
        @csrf
        <dl class="form-list">
            <div class="input_group">
                <label class="input_group_label" for="registration_name" id="l_registration_name">ユーザー名</label>
                <input class="registration_box" id="registration_name" type="text" name="name"
                    value="{{ old('name') }}" placeholder="username">
                <div class="underline"></div>
            </div>
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
            <div class="input_group">
                <label class="input_group_label" for="registration_password_confirmation" id="l_registration_password_confirmation">パスワード(確認用)</label>
                <input class="registration_box" id="registration_password_confirmation" type="password"
                    name="password_confirmation" placeholder="もう一度入力">
                <div class="underline"></div>
            </div>
            <div class="actions">
                <a href="{{ route('login') }}">ログインする</a>
                <button class="registration_btn" type="submit">会員登録する</button>
            </div>
        </dl>
    </form>
@endsection()
