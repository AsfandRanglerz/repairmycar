@component('mail::message')

<h3 style="margin: auto;width:100px">Ad Published</h3>

<p>Dear User,</p>

{{ $data['content'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
