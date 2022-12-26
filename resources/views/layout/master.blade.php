<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="{{ App::isLocale('en') ? 'This is a tool to automatically get Instagram Graph API access token 3 and Instagram Business Account ID just by entering App ID, App Secret, access token 1, and Facebook Page name. You can use it to embed Instagram posts into your website.' : 'Instagram Graph APIを用いてインスタグラムの投稿をWebページに埋め込む際に必要となるアクセストークン3とビジネスアカウントIDを自動取得するツールです。App ID、App secret、アクセストークン1、Facebookページ名を入力するだけで自動取得が可能です。' }}">
    <title>{{ $title }}</title>
    @yield('styles')
    @include('partials.styles')

</head>
<body class="antialiased">

@yield('main')

</body>
@include('partials.scripts')
@yield('scripts')
</html>
