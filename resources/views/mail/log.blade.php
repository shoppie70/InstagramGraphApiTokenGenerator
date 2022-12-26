@component('mail::message')
# {{ $title }}

@component('mail::table')
| Input |    |
| ---- | ---- |
|  Access Token1  |  {{ $result['access_token1'] }}  |
|  app_id  |  {{ $result['app_id'] }}  |
|  app_secret  |  {{ $result['app_secret'] }}  |
|  facebook_page_name  |  {{ $result['facebook_page_name'] }}  |
@endcomponent

@component('mail::table')
| Result |    |
| ---- | ---- |
|  Access Token3  |  {{ $result['access_token3'] }}  |
|  Instagram Business Account ID  |  {{ $result['business_account_id'] }}  |
@endcomponent

@foreach ($result['posts'] as $post)
<img src="{{ $post['img'] }}" style="max-width: 100px; margin: 0.5rem" alt="">
@endforeach

@endcomponent
