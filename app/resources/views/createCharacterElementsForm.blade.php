@extends('layouts.base')

@section('title', 'チャットルーム作成')

@section('main')
    <section>
        <a onClick="history.back();"><button>トップに戻る</button></a>
    </section>

    <section>
        <article style="border: 1px solid black;">
            <form style="margin-top: 20px" action="{{ url("/chatroom/{$character->getId()}") }}" method="post">
                @csrf
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

                <label>指定したキャラクター</label>
                <input type="text" value="{{ $character->getName() }}" disabled>
                <label>チャットの目的</label>
                <input style="width: 30%" type="text" name="purpose" value="{{ old('purpose') }}" placeholder="目的を入力"
                    required>
                <button type="submit">次へ</button>
            </form>
        </article>
    </section>
@endsection
