@component('mail::message')
# Contact Inquiry

<h3>Contact Inquiry Form Submission Details</h3>
<b>Name: </b>{{ $validatedData['first_name'] }} {{ $validatedData['last_name'] }}<br>
<b>Email: </b>{{ $validatedData['email'] }}<br>
<b>Country: </b>{{ $validatedData['country'] }}<br>
<b>Message: </b>{{ $validatedData['message'] }}<br><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent