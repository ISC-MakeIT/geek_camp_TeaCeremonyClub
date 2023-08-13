@extends('layouts.base')

@section('title', 'キャラクター詳細')

@section('character')
    <section>
        <a onClick="history.back();"><button>戻る</button></a>
    </section>

    <section>
        <article style="border: 1px solid black;">
            <img src="{{ $character->getIcon() }}" alt="{{ $character->getName() }}さんのアイコン">
            <h1>{{ $character->getName() }}{{ $character->getAge() }}歳 ({{ $character->getSexInJa() }})</h1>
            <a href="{{ route('createChatroom', $character) }}"><button>このキャラクターと会話する</button></a>
        </article>
    </section>
@endsection
