@extends('web.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);min-height: 100vh">
        <div class="container" >
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-10 mx-auto">
                    <div class="cuatomer_signup_form_wraper">
                        <div class="main_content_wraper">
                            <h5 class="sec_main_heading text-center mb-0">{{__('msg.Fill This To Login')}}</h5>
                        </div>
                        <form class="pt-5" name="loginForm" action="{{route('vendor.login')}}" method="post" >
                            @csrf
                            <div class="col-12 mb-3 signup_input_wraper">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="inputEmail" placeholder="{{__('msg.Email')}} ({{__('msg.Required')}})" required>
                                @error('email')
                                <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <div class="position-relative d-flex align-items-center pass-holder">
                                    <input id="inputPassword" name="password" type="password" class="form-control pass" placeholder="{{__('msg.password')}} ({{__('msg.Required')}})" required>
                                    <span toggle="#inputPassword" class="fa fa-fw fa-eye preview-eye-icon toggle-password"></span>
                                </div>
                                @error('password')
                                <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3 signup_input_wraper forgetpaww text-right">
                                <a href="{{route('vendor.forget_password')}}">{{__("msg.Forgot Password?")}}</a>
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <div class="d-grid gap-2 mt-3 mb-4">
                                    <button class="btn btn-secondary block get_appointment" type="submit">{{__('msg.Login')}}</button>
                                </div>
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <h5 class="my-4 text-center login_link_heading">{{__('msg.New User?')}} <a href="{{route('vendor.register')}}"> {{__('msg.Sign Up')}}</a>
                                </h5>
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

        var validator = $("form[name='loginForm']").validate({
                onfocusout: function (element) {
                    var $element = $(element);
                    if ($element.prop('required')) {
                        this.element(element)
                    } else if ($element.val() != '') {
                        this.element($element)
                    } else {
                        $element.removeClass('is-valid');
                    }
                },
                rules: {
                    'email': {
                        required: true,
                    },
                    'password':{
                        required: true,
                    },
                    onkeyup: function (element) {
                        var $element = $(element);
                        $element.valid();
                    },
                },
                messages: {
                    'email': {
                        required: "Email is required"
                    },
                    'password': {
                        required: "Password is required"
                    },
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                highlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    elem.addClass(errorClass);
                    elem.removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    elem.removeClass(errorClass);
                    elem.addClass(validClass);
                    if (elem.siblings('small.text-danger')) {
                        elem.siblings('small.text-danger').html('');
                    } else if (elem.closest('.form-group').find('small.text-danger')) {
                        elem.closest('.form-group').find('small.text-danger').html('');
                    } else if (elem.closest('.form-group').closest('.form-group').find('small.text-danger')) {
                        elem.closest('.form-group').closest('.form-group').find('small.text-danger').html('');
                    }
                },
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    console.log(elem);
                    if (elem.hasClass('pass')) {
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
