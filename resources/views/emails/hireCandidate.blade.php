@component('mail::message')
# {{$mailData['title']}}

Hello {{$mailData['name']}}

{{$mailData['message']}}

@component('mail::button', ['url' => $mailData['url']])
Start Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
