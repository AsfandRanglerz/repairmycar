@extends('web.layout.app')
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>OTP Confirm</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('vendor.otp_confirm') }}" class="needs-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">OTP</label>
                                    <input id="email" type="hidden" class="form-control" name="email" value="{{$email}}">
                                    <input id="email" type="number" class="form-control" name="otp" tabindex="1" required autofocus>
                                    @error('otp')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Send Email
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection