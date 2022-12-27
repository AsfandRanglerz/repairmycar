
@component('mail::message')

<h3>Quote Received From Customer</h3>
<p style="margin: 35px 0 15px;">Dear Vendor, </p>
<p>{{$message['body1']}} request a <a href="{{ $message['link1']}}">Quote </a> to you and all the @if ($message['type'] == "preferred_garage")  preferred @endif vendors. Hurry up and put your quote. Be one to get this request to repair the car. You are welcome to contact our support <a href="edev@ranglerz.pw">here</a> team if you have any questions.</p>
<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->
Thanks,<br>
{{ config('app.name') }}
@endcomponent

