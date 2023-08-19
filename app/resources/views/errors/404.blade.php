@extends('errors.layouts.base')

@section('title', 'ページが存在しません')

@section('main')
    <section class="error-page">
        <h1 class="error-page-title">This page is not found.<br> The cat is realy coooooooool DA nya~.</h1>

        <img class="error-page-img" src="/cat.png" alt="CAT">

        <a class="error-page-link" href="/">トップ画面へ戻る</a>
    </section>
@endsection
