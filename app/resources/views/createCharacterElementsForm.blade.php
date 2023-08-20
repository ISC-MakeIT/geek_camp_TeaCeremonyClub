@extends('layouts.loggedInBase')

@section('title', 'チャットルーム作成')

@section('main')
    <form class="inner" action="{{ url("/chatroom/create") }}" method="get">
        @csrf
        @if ($errors->any())
            <ul class="alert error">
                @foreach ($errors->all() as $error)
                    <li class="alert-item"> ・{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <label class="create-chatroom-input-label">キャラクター選択</label>
        <section class="create-chatroom-character-wrapper">
            @foreach ($characters as $character)
                <article class="create-chatroom-character" data-id="{{ $character->getId() }}">
                    <div class="create-chatroom-character-icon" style="background-image: url({{ $character->getIcon() }})"></div>
                    <div class="create-chatroom-character-contents">
                        <p class="create-chatroom-character-name">{{ $character->getName() }} ({{ $character->getAge() }})</p>
                        <p class="create-chatroom-character-sex">{{ $character->getSexInJa() }}</p>
                    </div>
                </article>
            @endforeach
        </section>

        <input type="text" name="characterId" id="input-character-id" hidden>

        <label class="create-chatroom-input-label">チャットの目的</label>
        <textarea class="create-chatroom-input" rows="6" type="text" name="purpose" value="{{ old('purpose') }}" placeholder="目的を入力" required></textarea>

        <button class="primary-btn create-chatroom-submit" type="submit">次へ進む</button>
    </form>
@endsection

@section('script')
    <script>
        const createChatroomCharacters = document.querySelectorAll('.create-chatroom-character');
        let isSelected = false;

        createChatroomCharacters.forEach((createChatroomCharacter) => {
            createChatroomCharacter.addEventListener('click', () => {
                if (isSelected) {
                    return;
                }

                isSelected = true;
                createChatroomCharacter.classList.add('selecting');
                document.querySelector('#input-character-id').setAttribute('value', createChatroomCharacter.dataset.id);
            });
        })
    </script>
@endsection

