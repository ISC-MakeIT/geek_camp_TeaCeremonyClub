@extends('layouts.base')

@section('title', 'チャットルーム作成')

@section('main')
    <section>
        <a onClick="history.back();"><button>トップに戻る</button></a>
    </section>

    <section>
        <form action="{{ url("/chatroom/create/{$character->getId()}") }}" method="post">
            @csrf
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

            @foreach ($formLabels as $formLabel)
                <div>
                    <label>{{ $formLabel }}</label>
                    <input type="text" name="{{ $formLabel }}" value="{{ old("$formLabel") }}">
                </div>
            @endforeach
            <input type="submit" value="送信">
        </form>
    </section>
@endsection