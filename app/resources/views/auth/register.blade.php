@extends('layouts.base')

@section('title', 'アカウント作成')

@section('header')
    <a class="success-btn" href="{{ route('login') }}">
        <svg class="success-btn-icon" width="21" height="24" viewBox="0 0 21 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 3.75C12 2.92031 11.3297 2.25 10.5 2.25C9.67031 2.25 9 2.92031 9 3.75V10.5H2.25C1.42031 10.5 0.75 11.1703 0.75 12C0.75 12.8297 1.42031 13.5 2.25 13.5H9V20.25C9 21.0797 9.67031 21.75 10.5 21.75C11.3297 21.75 12 21.0797 12 20.25V13.5H18.75C19.5797 13.5 20.25 12.8297 20.25 12C20.25 11.1703 19.5797 10.5 18.75 10.5H12V3.75Z"
                fill="white"></path>
        </svg>
        <span>ログインする</span>
    </a>

    <a class="success-btn" href="{{ route('register') }}">
        <svg class="success-btn-icon" width="21" height="24" viewBox="0 0 21 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 3.75C12 2.92031 11.3297 2.25 10.5 2.25C9.67031 2.25 9 2.92031 9 3.75V10.5H2.25C1.42031 10.5 0.75 11.1703 0.75 12C0.75 12.8297 1.42031 13.5 2.25 13.5H9V20.25C9 21.0797 9.67031 21.75 10.5 21.75C11.3297 21.75 12 21.0797 12 20.25V13.5H18.75C19.5797 13.5 20.25 12.8297 20.25 12C20.25 11.1703 19.5797 10.5 18.75 10.5H12V3.75Z"
                fill="white"></path>
        </svg>
        <span>アカウント作成</span>
    </a>
@endsection

@section('main')
    <section class="inner">
        <form action="{{ route('register') }}" method="post" autocomplete="off">
            @csrf
            @if ($errors->any())
                <ul class="alert error">
                    @foreach ($errors->all() as $error)
                        <li class="alert-item"> ・{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="auth-form">
                <h1 class="auth-title">
                    <svg class="auth-title-icon" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 3.75C12 2.92031 11.3297 2.25 10.5 2.25C9.67031 2.25 9 2.92031 9 3.75V10.5H2.25C1.42031 10.5 0.75 11.1703 0.75 12C0.75 12.8297 1.42031 13.5 2.25 13.5H9V20.25C9 21.0797 9.67031 21.75 10.5 21.75C11.3297 21.75 12 21.0797 12 20.25V13.5H18.75C19.5797 13.5 20.25 12.8297 20.25 12C20.25 11.1703 19.5797 10.5 18.75 10.5H12V3.75Z"
                            fill="black"></path>
                    </svg>
                    <span>アカウント作成</span>
                </h1>

                <div class="auth-input-group">
                    <label class="auth-input-label">名前</label>
                    <input class="auth-input" id="name" type="text" name="name" value="{{ old('name') }}"
                        placeholder="名前">
                </div>
                <div class="auth-input-group">
                    <label class="auth-input-label">メールアドレス</label>
                    <input class="auth-input" id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="メールアドレス">
                </div>
                <div class="auth-input-group">
                    <label class="auth-input-label" for="password">パスワード</label>
                    <input class="auth-input" id="password" type="password" name="password" placeholder="パスワード">
                </div>

                <div class="auth-input-group">
                    <label class="auth-input-label" for="password-confirmation">パスワード確認用</label>
                    <input class="auth-input" id="password-confirmation" type="password" name="password_confirmation"
                        placeholder="もう一度入力">
                </div>

                <button class="primary-btn auth-submit-btn" type="submit">アカウント作成</button>
            </div>
        </form>
    </section>
@endsection
