@extends('layouts.loggedInBase')

@section('title', 'チャットルーム作成')

@section('main')
    <section class="inner">
        <form action="{{ url()->current() }}" method="post">
            @csrf
            @if ($errors->any())
                <ul class="alert error">
                    @foreach ($errors->all() as $error)
                        <li class="alert-item"> ・{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @foreach ($formLabels as $formLabel)
                <div>
                    <label class="create-chatroom-input-label">{{ $formLabel }}</label>
                    <textarea class="create-chatroom-input" rows="6" name="{{ $formLabel }}" value="{{ old("$formLabel") }}" placeholder="入力してください" required></textarea>
                </div>
            @endforeach

            <input type="text" name="characterId" value="{{ $character->getId() }}" hidden>

            <button class="primary-btn create-chatroom-submit" type="submit">次へ進む</button>
        </form>
    </section>
@endsection
