@extends('layouts.loggedInBase')

@section('title', 'チャット')

@section('main')

    <section>
        @foreach ($chats as $chat)
            @if ($chat->getRole() == "system")
                @continue
            @endif

            <p>{{ $chat->getContent() }}</p>
        @endforeach
    </section>

    <section>
        <form action="{{ url()->current() }}" method="post">
            @if ($errors->any())
                <ul class="alert error">
                    @foreach ($errors->all() as $error)
                        <li class="alert-item"> ・{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <input type="text" name="content" value="{{ old('content') }}" placeholder="text" required>
            <input type="submit" value="送信">
        </form>
    </section>

    <section>
        <a href="{{ url('/') }}"><button>終わる</button></a>
    </section>
@endsection
