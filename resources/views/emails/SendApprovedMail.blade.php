@component('mail::message')
<h3 style="margin: auto;width:100px">Ad Approvel</h3>
<p style="margin: 35px 0 15px;"> Dear {{ isset($data->user_id) ? $data->user['name'] : $data->vendor['name']}},</p>


Congratulation ! Your ad has been approved and Published Successfully.

<p>Model: {{$data->company->company}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
