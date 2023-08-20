@extends('layouts.loggedInBase')

@section('title', 'キャラクター作成')

@section('main')
    <section class="inner">
        @csrf

        @if ($errors->any())
            <ul class="alert error">
                @foreach ($errors->all() as $error)
                    <li class="alert-item"> ・{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form class="create-character-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf

            <div class="inner-create-character-form">
                <div class="create-character-form-contents">
                    <div class="create-character-icon">
                        <svg color="#333" height="5rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/></svg>
                    </div>

                    <input id="icon" type="file" name="icon" accept="image/png,image/jpeg,image/jpg" hidden>

                    <div class="create-character-input-group">
                        <label for="name" class="create-character-input-label">名前</label>
                        <input name="name" id="name" type="text" class="create-character-input">
                    </div>

                    <div class="create-character-input-group">
                        <label for="age" class="create-character-input-label">歳</label>
                        <input name="age" id="age" type="number" class="create-character-input">
                    </div>

                    <div class="create-character-input-group">
                        <label for="sex" class="create-character-input-label">性別</label>
                        <select name="sex" id="sex" class="create-character-input">
                            <option value="">性別を選択してください</option>
                            <option value="man">男</option>
                            <option value="woman">女</option>
                            <option value="others">その他</option>
                        </select>
                    </div>
                </div>

                <div class="create-character-form-contents create-character-form-big-five">
                    <div class="create-character-input-group">
                        <label for="extraversion" class="create-character-input-label">外向性</label>
                        <input name="extraversion" id="name" min="0" max="100" value="50" type="range" class="create-character-range">
                    </div>

                    <div class="create-character-input-group">
                        <label for="agreeableness" class="create-character-input-label">協調性</label>
                        <input name="agreeableness" id="name" min="0" max="100" value="50" type="range" class="create-character-range">
                    </div>

                    <div class="create-character-input-group">
                        <label for="conscientiousness" class="create-character-input-label">誠実性</label>
                        <input name="conscientiousness" id="name" min="0" max="100" value="50" type="range" class="create-character-range">
                    </div>

                    <div class="create-character-input-group">
                        <label for="neuroticism" class="create-character-input-label">情緒安定性</label>
                        <input name="neuroticism" id="name" min="0" max="100" value="50" type="range" class="create-character-range">
                    </div>

                    <div class="create-character-input-group">
                        <label for="openness" class="create-character-input-label">開放性</label>
                        <input name="openness" id="name" min="0" max="100" value="50" type="range" class="create-character-range">
                    </div>
                </div>
            </div>

            <button type="submit" class="primary-btn create-character-submit">キャラクター作成</button>
        </form>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        const main = () => {
            init();
        }

        const getCreateCharacterIconElement = () => document.querySelector('.create-character-icon');
        const getIconElement                = () => document.querySelector('#icon');

        const init = () => {
            getCreateCharacterIconElement().addEventListener('click', () => getIconElement().click());
            getIconElement().addEventListener('change', (e) => {
                if (!e.target.files.length) {
                    return;
                }

                const previewURL = URL.createObjectURL(e.target.files[0]);

                getCreateCharacterIconElement().innerHTML = '';
                getCreateCharacterIconElement().style.backgroundImage = `url("${previewURL}")`
            });
        }

        main();
    </script>
@endsection
