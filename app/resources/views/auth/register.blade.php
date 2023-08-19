@extends('layouts.base')

@section('title', 'アカウント作成')

@section('main')

    <form action="{{ route('register') }}" method="post" autocomplete="off">
        @csrf
        <div class="actions">
            <a class="registration-btn" href="{{ route('login') }}">
                <svg class="registration-btn-icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.2141 4.96406L15.9703 10.7203C16.3078 11.0578 16.5 11.5219 16.5 12C16.5 12.4781 16.3078 12.9422 15.9703 13.2797L10.2141 19.0359C9.91406 19.3359 9.51094 19.5 9.08906 19.5C8.2125 19.5 7.5 18.7875 7.5 17.9109V15H1.5C0.670312 15 0 14.3297 0 13.5V10.5C0 9.67031 0.670312 9 1.5 9H7.5V6.08906C7.5 5.2125 8.2125 4.5 9.08906 4.5C9.51094 4.5 9.91406 4.66875 10.2141 4.96406ZM16.5 19.5H19.5C20.3297 19.5 21 18.8297 21 18V6C21 5.17031 20.3297 4.5 19.5 4.5H16.5C15.6703 4.5 15 3.82969 15 3C15 2.17031 15.6703 1.5 16.5 1.5H19.5C21.9844 1.5 24 3.51562 24 6V18C24 20.4844 21.9844 22.5 19.5 22.5H16.5C15.6703 22.5 15 21.8297 15 21C15 20.1703 15.6703 19.5 16.5 19.5Z"
                        fill="white" />
                </svg>ログインする</a>

            <a href="{{ route('register') }}"><button class="registration-btn" type="submit">
                    <svg class="registration-btn-icon" width="21" height="24" viewBox="0 0 21 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 3.75C12 2.92031 11.3297 2.25 10.5 2.25C9.67031 2.25 9 2.92031 9 3.75V10.5H2.25C1.42031 10.5 0.75 11.1703 0.75 12C0.75 12.8297 1.42031 13.5 2.25 13.5H9V20.25C9 21.0797 9.67031 21.75 10.5 21.75C11.3297 21.75 12 21.0797 12 20.25V13.5H18.75C19.5797 13.5 20.25 12.8297 20.25 12C20.25 11.1703 19.5797 10.5 18.75 10.5H12V3.75Z"
                            fill="white" />
                    </svg>アカウント作成</button></a>
        </div>
        @if ($errors->any())
            <ul class="alert">
                @foreach ($errors->all() as $error)
                    <div class="alert" role="alert">
                        <li> {{ $error }}</li>
                    </div>
                @endforeach
            </ul>
        @endif
        <div class="registration-form">
            <h1 class="registration-title"> <svg class="registration-btn-icon" width="21" height="24"
                    viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 3.75C12 2.92031 11.3297 2.25 10.5 2.25C9.67031 2.25 9 2.92031 9 3.75V10.5H2.25C1.42031 10.5 0.75 11.1703 0.75 12C0.75 12.8297 1.42031 13.5 2.25 13.5H9V20.25C9 21.0797 9.67031 21.75 10.5 21.75C11.3297 21.75 12 21.0797 12 20.25V13.5H18.75C19.5797 13.5 20.25 12.8297 20.25 12C20.25 11.1703 19.5797 10.5 18.75 10.5H12V3.75Z"
                        fill="black" />
                </svg>アカウント作成</h1>
            <dl class="form-list">
                <div>
                    <p class="input-label">名前</p>
                    <input class="registration-box" id="registration-name" type="text" name="name"
                        value="{{ old('name') }}" placeholder="名前">
                </div>
                <div>
                    <p class="input-label">メールアドレス</p>
                    <input class="registration-box" id="registration-email" type="email" name="email"
                        value="{{ old('email') }}" placeholder="メールアドレス">
                </div>
                <div>
                    <p class="input-label">パスワード</p>
                    <input class="registration-box" id="registration-password" type="password" name="password"
                        placeholder="パスワード">
                </div>
                <div>
                    <p class="input-label">パスワード確認</p>
                    <input class="registration-box" id="registration-password-confirmation" type="password"
                        name="password_confirmation" placeholder="もう一度入力">
                </div>
            </dl>
            <button class="login-btn" type="submit">アカウント作成</button>
        </div>
    </form>
@endsection()
