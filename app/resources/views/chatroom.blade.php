@extends('layouts.base')

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
            @csrf
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

            <input type="text" name="content" value="{{ old('content') }}" placeholder="text" required>
            <input type="submit" value="送信">
        </form>
    </section>

    <section>
        <a href="{{ url('/') }}"><button>終わる</button></a>
    </section>
@endsection
