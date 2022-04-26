@component('mail::message')
# {{$mailData['title']}}

Hello {{$mailData['name']}}

{{$mailData['message']}}

@component('mail::button', ['url' => $mailData['url']])
Get Started
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
