@extends('layouts.base')

@section('title', 'ログイン')

@section('main')
    <h1>エラーが発生しました</h1>

    <p>{{ $error }}</p>

    <a href="/">トップ画面へ戻る</a>
@endsection
