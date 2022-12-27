@component('mail::message')
    <div class="card-body">
        <h3 style="margin: auto;width:250px;text-align:center">{{ $message['title'] }}</h3>
        <p style="margin: 35px 0 15px;">Dear Customer,</p>
        <p>{{ $message['body1'] }} <a href="{{ $message['link1'] }}">Order No {{ $message['order_no'] }}</a>
            {{ $message['body2'] }} @if (isset($message['link2']))
                <a href="{{ $message['link2'] }}">Chat Now</a> {{ $message['body3'] }}
            @endif </br>You are welcome to contact our support <a href="edev@ranglerz.pw">here</a> team
            if
            you have any questions.</p>
        @if (isset($message['invoice']))
            <h4>Invoice</h4>
            <table class="table table-striped table-bordered table-responsive" id="table_id" style='width:100%'>
                <thead>
                    <tr>
                        <th>Order no #</th>
                        <th>Total</th>
                        <th>Paid</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style='text-align: center;padding: 10px 16px'>
                            {{ $message['order_no'] }}
                        </td>
                        <td style='text-align: center;padding: 10px 16px'>
                            {{ $message['total'] }} AED
                        </td>
                        <td style='text-align: center'>
                            {{ $message['paid'] }} AED
                        </td>
                    </tr>
                </tbody>
            </table>
            <h3 style="margin-top: 16px">Note, </h3>
            @if ($message['paid_type'] == 'quote')
                <p>"Right now you've paid 30% of the total amount {{ $message['total'] }} AED, the remaining dues will be
                    asked
                    to pay when the
                    order get completed, thank you"</p>
            @endif
            @if ($message['paid_type'] == 'order' && $message['user'] != 'company')
                <p>You've paid the 30% of the total amount 525 in the first half to make the order in process, right now
                    you've paid the remaining dues to make the order as completed"</p>
            @endif
            @if ($message['user'] == 'company')
                <p>"Right now you've paid 100% of the total amount {{ $message['total'] }} AED to make the order as
                    completed, thank you"</p>
            @endif
        @endif
    </div>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
