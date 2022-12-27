@extends('vendor.layout.app')
@section('content')
<section class="pb-5 login_content_wraper">
    <div class="container-lg container-fluid" >
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                    <h4 class="sec_main_heading text-center mb-0">PREFERRED GARAGES</h4>
                    <p class="sec_main_para text-center">See your favorite stores and what they have new to offer to you</p>
                </div>
            </div>
        </div>
        <div class="row g-2">
            <div class="col-lg-11 col-md-12  mx-auto">
                <div class="all_quote_card ">
                    <div class="car_inner_imagg ">
                        <img src="assets/images/repair3.jpg">
                    </div>
                    <div class=" w-100  quote_detail_wraper align-items-sm-center">
                        <div class="quote_info Leavereview mb-sm-3">
                            <h5 class="d-flex align-items-center active_quote">Car Repair
                            </h5>
                            <p class="mb-0">Red Suzuki For Repair</p>
                            <p >0987654321778</p>
                            <div class="card_icons d-flex justify-content-center align-items-center">
                                <div class="icon_wrpaer">
                                    <img src="assets/images/iconrp.svg">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="assets/images/iconrp2.svg">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="assets/images/iconrp3.svg">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="assets/images/iconrp4.svg">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="assets/images/iconrp5.svg">
                                </div>
                            </div>
                        </div>
                        <div class="quote_detail_btn_wraper">
                            <div class="d-flex align-items-center chat_view__detail">
                                <a href="#" class="chat_icon">
                                    <i class="fa-solid fa-message"></i>
                                    <!-- <img src="assets/images/meassageiconblk.svg"> -->
                                </a>
                                <a href="#" class="btn-secondary">VIEW DETAILS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-11 col-md-12  mx-auto">
                <div class="all_quote_card ">
                    <div class="car_inner_imagg ">
                        <img src="assets/images/repair3.jpg">
                    </div>
                    <div class=" w-100  quote_detail_wraper align-items-sm-center">
                        <div class="quote_info Leavereview mb-sm-3">
                            <h5 class="d-flex align-items-center active_quote">Car Repair
                            </h5>
                            <p class="mb-0">Red Suzuki For Repair</p>
                            <p >0987654321778</p>
                            <div class="card_icons d-flex justify-content-center align-items-center">
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp.svg')}}">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp2.svg')}}">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp3.svg')}}">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp4.svg')}}">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp5.svg')}}">
                                </div>
                            </div>
                        </div>
                        <div class="quote_detail_btn_wraper">
                            <div class="d-flex align-items-center chat_view__detail">
                                <a href="#" class="chat_icon">
                                    <i class="fa-solid fa-message"></i>
                                    <!-- <img src="assets/images/meassageiconblk.svg"> -->
                                </a>
                                <a href="#" class="btn-secondary">VIEW DETAILS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-11 col-md-12  mx-auto">
                <div class="all_quote_card ">
                    <div class="car_inner_imagg ">
                        <img src="{{ asset('public/vendor/assets/images/repair3.jpg')}}">
                    </div>
                    <div class=" w-100  quote_detail_wraper align-items-sm-center">
                        <div class="quote_info Leavereview mb-sm-3">
                            <h5 class="d-flex align-items-center active_quote">Car Repair
                            </h5>
                            <p class="mb-0">Red Suzuki For Repair</p>
                            <p >0987654321778</p>
                            <div class="card_icons d-flex justify-content-center align-items-center">
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp.svg')}}">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp2.svg')}}">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp3.svg')}}">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp4.svg')}}">
                                </div>
                                <div class="icon_wrpaer">
                                    <img src="{{ asset('public/vendor/assets/images/iconrp5.svg')}}">
                                </div>
                            </div>
                        </div>
                        <div class="quote_detail_btn_wraper">
                            <div class="d-flex align-items-center chat_view__detail">
                                <a href="#" class="chat_icon">
                                    <i class="fa-solid fa-message"></i>
                                </a>
                                <a href="#" class="btn-secondary">VIEW DETAILS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div>
    </div>
</section>
@endsection
