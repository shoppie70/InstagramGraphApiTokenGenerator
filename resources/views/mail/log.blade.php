@component('mail::message')
# {{ $title }}

## Input

### Access Token1
{{ $result['access_token1'] }}

### App ID
{{ $result['app_id'] }}

### App Secret
{{ $result['app_secret'] }}

### Facebook Page Name
{{ $result['facebook_page_name'] }}

## Result

### Access Token3
{{ $result['access_token3'] }}

### Instagram Business Account ID
{{ $result['business_account_id'] }}

@foreach ($result['posts'] as $post)
<img src="{{ $post['img'] }}" style="max-width: 100px; margin: 0.5rem" alt="">
@endforeach

@endcomponent
