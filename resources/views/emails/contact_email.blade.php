

@component('mail::message')

# Subject Of Message
 {{$contact->subject}}
# Body Of Message
@component('mail::panel')
 {{$contact->message}}
@endcomponent
 # from
 {{$contact->name}}
 {{$contact->email}}

# Mobile: 
{{$contact->mobile }}<br>

@endcomponent