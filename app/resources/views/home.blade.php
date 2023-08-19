@extends('layouts.loggedInBase')

@section('title', 'トップ')

@section('main')
    <section>
        @foreach ($chatrooms as $chatroom)
            <article style="border: 1px solid black;">
                <h1>{{ $chatroom->getId() }}</h1>
                <p>{{ $chatroom->getPurpose() }}</p>
                <p>({{ json_encode($chatroom->getCharacterElements(), JSON_UNESCAPED_UNICODE) }})</p>
                <a href="{{ url("/chatroom/{$chatroom->getId()}/chat") }}">ルームに移動する</a>
            </article>
        @endforeach
    </section>

@endsection
