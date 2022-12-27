@component('mail::message')

<h3>Advertisement Placement Completed </h3>
<p style="margin: 35px 0 15px;">Dear Customer,
<p>We are pleased to inform you that your  <a href="{{$message['link1']}}">car advertisement </a> has been successfully placed. You will receive notification from interested customers so stay tuned or sign in to you accounts to get updates.You are welcome to contact our support <a href="edev@ranglerz.pw">here</a> team if you have any questions.</p>
<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->
Thanks,<br>
{{ config('app.name') }}
@endcomponent
