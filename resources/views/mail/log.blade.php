@component('mail::message')
    # {{ $title }}

    @component('mail::table')
        | Input |    |
        | ---- | ---- |
        |  Access Token1  |  {{ $request['access_token1'] }}  |
        |  app_id  |  {{ $request['app_id'] }}  |
        |  app_secret  |  {{ $request['app_secret'] }}  |
        |  facebook_page_name  |  {{ $request['facebook_page_name'] }}  |
    @endcomponent

    @component('mail::table')
        | Result |    |
        | ---- | ---- |
        |  Access Token3  |  {{ $request['access_token3'] }}  |
        |  Instagram Business Account ID  |  {{ $request['business_account_id'] }}  |
    @endcomponent

    @foreach ($response['posts'] as $post)
        <img src="{{ $post['img'] }}" style="max-width: 100px; margin: 0.5rem" alt="">
    @endforeach

@endcomponent
