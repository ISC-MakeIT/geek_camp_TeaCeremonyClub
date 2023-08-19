@extends('layouts.loggedInBase')

@section('title', 'エラー')

@section('main')
    <h1>エラーが発生しました</h1>

    <p>{{ $error }}</p>

    <a href="/">トップ画面へ戻る</a>
@endsection
