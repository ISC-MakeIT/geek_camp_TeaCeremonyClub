@extends('layouts.base')

@section('title', 'ログイン')

@section('main')
    <section>
        <p>ようこそ、{{ Auth::user()->name }}さん</p>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
    </section>

    <section>
        @foreach ($characters as $character)
            <article style="border: 1px solid black;">
                <img src="{{ $character->getIcon() }}" alt="{{ $character->getName() }}さんのアイコン">
                <h1>{{ $character->getName() }}{{ $character->getAge() }}歳 ({{ $character->getSexInJa() }})</h1>
            </article>
        @endforeach
    </section>

    <section>
        <h1>キャラクター作成</h1>

        <form action="{{ url('/character') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach

            <div>
                <label for="name">名前</label><br>
                <input name="name" id="name" type="text" required>
            </div>

            <div>
                <label for="age">歳</label><br>
                <input name="age" id="age" min="0" max="120" type="number" required>
            </div>

            <div>
                <label for="sex">性別</label><br>
                <select name="sex" id="sex" required>
                    <option value=""></option>
                    <option value="man">男性</option>
                    <option value="woman">女性</option>
                    <option value="others">その他</option>
                </select>
            </div>

            <div>
                <label for="icon">アイコンをアップロード</label><br>
                <input name="icon" id="icon" type="file" accept="image/png,image/jpg,image/jpeg" required>
            </div>

            <div>
                <label for="extraversion">外向性</label><br>
                <input name="extraversion" id="extraversion" type="range" min="0" max="100" value="50" required>
            </div>

            <div>
                <label for="agreeableness">協調性</label><br>
                <input name="agreeableness" id="agreeableness" type="range" min="0" max="100" value="50" required>
            </div>

            <div>
                <label for="conscientiousness">誠実性</label><br>
                <input name="conscientiousness" id="conscientiousness" type="range" min="0" max="100" value="50" required>
            </div>

            <div>
                <label for="neuroticism">情緒安定性</label><br>
                <input name="neuroticism" id="neuroticism" type="range" min="0" max="100" value="50" required>
            </div>

            <div>
                <label for="openness">開放性</label><br>
                <input name="openness" id="openness" type="range" min="0" max="100" value="50" required>
            </div>

            <input type="submit" value="登録">
        </form>
    </section>
@endsection
