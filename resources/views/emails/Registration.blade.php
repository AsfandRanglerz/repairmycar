@component('mail::message')
    <div class="card-body">
        <div style="text-align: center">
            <h3>Account Created</h3>
        </div>
        <p style="margin: 35px 0 15px;">Dear {{ $data['name'] }},</p>
        <p>Congratulation Your Account has been Created Successfully, Please Create Your password and go to Login page</p>
        <form action="{{ route('password_create') }}" method="GET">
            <input type="hidden" name="type" value="{{ $data['type'] }}">
            <input type="hidden" name="email" value="{{ $data['email'] }}">
            <div style="text-align: center">
                <button type="submit" style="padding: 10px;color:white;background-color: black">Click Here</button>
            </div>
        </form>
    </div>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
