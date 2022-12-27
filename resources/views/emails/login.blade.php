@component('mail::message')

<h3 style="margin: auto;width:100px">Regitered</h3>

<p>Dear {{ $data['name'] }},</p>

{{ $data['data'] }}

{{-- @component('mail::button', ['url' =>  $data['link']])
    Login To Dashboard
    @endcomponent --}}
<br>
In case you need to talk, please call us at our support +971 56 784 5425<br>
Or send us a mail at <a href="support@repairmycar.com">support@repairmycar.com</a><br>
Best Regards,<br>
RepairMyCar Services<br>
@endcomponent
