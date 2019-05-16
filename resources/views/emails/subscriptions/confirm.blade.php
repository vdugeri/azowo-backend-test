@component('mail::message')
# Hi,

please click on the button below to confirm your subscription

@component('mail::button', ['url' => $url])
Confirm Subscription
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
