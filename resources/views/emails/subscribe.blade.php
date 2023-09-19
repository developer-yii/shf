@component('mail::message')
# Subscription Confirmation

<p>Thank you for subscribing with the email: <b>{{ $email }}</b></p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent