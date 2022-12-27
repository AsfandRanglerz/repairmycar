@extends('admin.auth.layout.app')
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Password Change</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.password_change') }}" class="needs-validation" novalidate="">
                                @csrf
                                <input id="password" type="hidden" class="form-control" name="email" value="{{ $email }}">
                                <div class="form-group">
                                    <label for="password" class="control-label">New Password</label>
                                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Confirm Password</label>
                                    <input id="password" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Change Password
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
