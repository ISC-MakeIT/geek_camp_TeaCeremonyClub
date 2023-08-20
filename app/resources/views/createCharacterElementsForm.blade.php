@extends('layouts.loggedInBase')

@section('title', 'チャットルーム作成')

@section('main')
    <section>
        <a onClick="history.back();"><button>トップに戻る</button></a>
    </section>

    <section>
        <article style="border: 1px solid black;">
            <form style="margin-top: 20px" action="{{ url("/chatroom/create") }}" method="get">
                @csrf
                @if ($errors->any())
                    <ul class="alert error">
                        @foreach ($errors->all() as $error)
                            <li class="alert-item"> ・{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @foreach ($characters as $character)
                @endforeach

                <label>チャットの目的</label>
                <input style="width: 30%" type="text" name="purpose" value="{{ old('purpose') }}" placeholder="目的を入力"
                    required>
                <button type="submit">次へ</button>
            </form>
        </article>
    </section>
@endsection
