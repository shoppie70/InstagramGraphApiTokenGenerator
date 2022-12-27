@component('mail::message')
# {{ $title }}

## Error Details

### Access Token1
{{ $request['access_token1'] }}

### App ID
{{ $request['app_id'] }}

### App Secret
{{ $request['app_secret'] }}

### Facebook Page Name
{{ $request['facebook_page_name'] }}

### Error Message
{{ $message }}

@endcomponent
