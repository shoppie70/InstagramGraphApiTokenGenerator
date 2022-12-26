<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="This is a tool to automatically get Instagram Graph API access token 3 and Instagram Business Account ID just by entering App ID, App Secret, access token 1, and Facebook Page name. You can use it to embed Instagram posts into your website. / インスタグラムをWebページに埋め込む際に必要となるアクセストークン3とビジネスアカウントIDを自動取得するツールです。">
    <title>{{ $title ?? 'Instagram Graph API Automatic Token Acquisition Tool' }}</title>
    @yield('styles')
    @include('partials.styles')

</head>
<body class="antialiased">

@yield('main')

</body>
@include('partials.scripts')
@yield('scripts')
</html>
