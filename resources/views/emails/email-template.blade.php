@component('mail::message')
# Welcome, {{$data->name}}

{{$data->subject}}

@component('mail::panel')
To access your CMS panel, click on the button below
{{$data->email}}
{{$data->message}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent