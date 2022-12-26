@component('mail::message')
    # {{ $title }}

    @component('mail::table')
        |   Error Details |    |
        | ---- | ---- |
        |  Access Token1  |  {{ $request['access_token1'] }}  |
        |  app_id  |  {{ $request['app_id'] }}  |
        |  app_secret  |  {{ $request['app_secret'] }}  |
        |  facebook_page_name  |  {{ $request['facebook_page_name'] }}  |
        |  Error Message  |  {{ $message }}  |
    @endcomponent

@endcomponent
