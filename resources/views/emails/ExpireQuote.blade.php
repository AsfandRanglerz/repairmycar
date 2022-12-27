@component('mail::message')
<h3 style="margin: auto;width:100px">Alert</h3>

<p>Dear {{ $data['name'] }},</p>

<p> {{ $data['body1']}} @if (isset($data['reference'])) <a href="{{ $data['link']}}">{{ $data['reference']}} </a> {{$data['body2']}} @endif  You are welcome to contact our support <a href="edev@ranglerz.pw">here</a> team if you have any questions.</p> 


Thanks,<br>
{{ config('app.name') }}
@endcomponent
