@extends('web.layout.app')
@section('content')
<section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg); min-height: 100vh;">
    <div class="container" >
        <div class="row">
            <div class="col-lg-5 col-md-10 mx-auto">
                <div class="cuatomer_signup_form_wraper">
                    <div class="main_content_wraper">
                        <p class="sec_main_para text-center mb-0">{{ __('msg.Reset Your Password') }}</p>
                    </div>

                    <form class="pt-5">

                        <div class="col-12 mb-3 signup_input_wraper">
                            <input type="email" class="form-control" id="inputEmail" placeholder=" Enter Your Email">
                        </div>



                        <div class="col-12 mb-3 signup_input_wraper">
                            <div class="d-grid gap-2 mt-4 mb-4">
                                <a href ="Newpass.php" class="btn btn-secondary block get_appointment" type="button">SUBMIT
                                </a>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
