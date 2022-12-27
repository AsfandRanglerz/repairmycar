@component('mail::message')
    <div style="margin:auto;width:100px">
        <h3>Account Status</h3>
    </div>
    <p style="margin: 35px 0 15px;">Dear {{ $data['name'] }},</p>

    {{ $data['data'] }}
    @if (isset($data['reason']))
{{ $data['reason'] }}
    @endif


    Thanks,
    {{ config('app.name') }}
@endcomponent
