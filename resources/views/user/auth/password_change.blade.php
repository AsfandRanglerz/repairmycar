@extends('web.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(assets/images/gradiantbg.jpg);min-height: 100vh">
        <div class="container" >
            <div class="row">
                <div class="col-lg-5 col-md-10 mx-auto">
                    <div class="cuatomer_signup_form_wraper">
                        <div class="main_content_wraper">
                            <p class="sec_main_para text-center mb-0">{{ __('msg.Reset Your Password') }}</p>
                        </div>
                        <form name="passwordReset" method="POST" action="{{ route('user.password_change') }}" class="needs-validation pt-4" novalidate="">
                            @csrf
                            <input type="hidden" name="confirm_token" value="{{ $token }}">
                            <div class="col-12 mb-3 signup_input_wraper">
                                <div class="position-relative d-flex align-items-center pass-holder">
                                    <input type="password" class="form-control pass-input" id="inputPass" name="password" placeholder=" Enter New Password">
                                    <span toggle="#inputPass" class="fa fa-fw fa-eye preview-eye-icon toggle-password"></span>
                                </div>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <div class="position-relative d-flex align-items-center pass-holder">
                                    <input type="password" class="form-control pass-confirm-input" id="inputConPass" name="password_confirmation" placeholder=" Confirm New Password">
                                    <span toggle="#inputConPass" class="fa fa-fw fa-eye preview-eye-icon toggle-password"></span>
                                </div>
                                @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <div class="d-grid gap-2 mt-4 mb-4">
                                    <button class="btn btn-secondary block get_appointment" type="submit">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function() {
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("form[name='passwordReset']").validate({
                onkeyup: function (element) {
                    var $element = $(element);
                    $element.valid();
                },
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: '#inputPass'
                    },
                },
                messages: {
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        required: "Please enter the confirm password.",
                        minlength: "Password do no match",
                        equalTo: "Please enter the same password as above"
                    },
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                errorPlacement: function(error, element) {
                    var elem = $(element);
                    console.log(elem);
                    if (elem.hasClass('pass-input')) {
                        var element2 = elem.closest('.pass-holder');
                        error.insertAfter(element2);
                    } else if (elem.hasClass('pass-confirm-input')) {
                        var element2 = elem.closest('.pass-holder');
                        error.insertAfter(element2);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>
@endsection
