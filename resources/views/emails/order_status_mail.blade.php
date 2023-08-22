@component('mail::message')
# Order Status Update

<h3>Hello {{ $user->first_name }} {{$user->last_name }},</h3>

<b>Order ID :</b> {{ $order->id }}<br>

Your order has been <b>{{ $order->status }}</b>


Thanks,<br>
{{ config('app.name') }}
@endcomponent