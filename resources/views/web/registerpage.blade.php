<?php //include 'headersignup.php';?>
@extends('web.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="main_content_wraper pt-5">
                        <h4 class="sec_main_heading text-center">{{__('msg.Sign Up')}}</h4>
                        <p class="sec_main_para text-center">{{__('msg.Choose your role to signup')}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="sing_up_img_wraper card-img-top">
                                <img src="{{asset('public/assets/images/vendorsingupimg.jpg')}}"  alt="image">
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text text-center sing_up_card_txt">{{__('msg.vendor_detail')}}</p>
                                <a href="{{route('vendor.register')}}" class="btn btn-secondary Signup_btn">{{__('msg.Vendor')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="sing_up_img_wraper card-img-top">
                                <img src="{{asset('public/assets/images/usersignupimg.jpg')}}" alt="image">
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text text-center sing_up_card_txt">{{__('msg.customer_detail')}}</p>
                                <a href="{{route('user.register')}}" class="btn btn-secondary Signup_btn">{{__('msg.Customer')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="sing_up_img_wraper card-img-top">
                                <img src="{{asset('public/assets/images/company-logo.jpg')}}" alt="image">
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text text-center sing_up_card_txt">{{__('msg.company_detail')}}</p>
                                <a href="{{route('user.companyRegister')}}" class="btn btn-secondary Signup_btn">{{__('msg.Insurance Company')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php //include 'footersignup.php';?><!--   -->
@endsection
