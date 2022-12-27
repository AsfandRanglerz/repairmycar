@extends('vendor.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(assets/images/gradiantbg.jpg);">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-0"> MY OFFERED QUOTE</h4>
                        <p class="sec_main_para text-center">See How You Responded To This Request</p>
                    </div>
                </div>
            </div>
            <?php
            $car_images = \App\Models\UserBidImage::where('user_bid_id', $data->user_bid_id)
                ->where('type', 'image')
                ->first();
            $car_images = Explode(',', $car_images->car_image);
            $registerImag = \App\Models\UserBidImage::where('user_bid_id', $data->user_bid_id)
                ->where('type', 'file')
                ->first();
            $registerImag = Explode(',', $registerImag->car_image);
            ?>
            <div class="row g-2">
                <div class="col-lg-12 col-md-12 col-12  mx-auto">
                    <div class="all_quote_card replies_allquot ">
                        <div class=" w-100  quote_detail_wraper replies ">
                            <div class="active_bid_dtl_card_left">
                                <div class="quote_info">
                                    <h5 class="d-flex align-items-center active_quote nowrape ">
                                        {{ $data->userBid->company->company }}</h5>
                                    <p class="mb-0">{{ $data->userBid->user->name }}</p>
                                    <p class="mb-0">{{ $data->userBid->user->phone }}</p>
                                    <p class="milage">Mileage <span>{{ $data->userBid->mileage }}km</span></p>
                                </div>
                                <div class="d-flex chat_view__detail qoute_replies vendor_order days ">
                                    <h5 class="active_bidDay">Days {{$data->time }}</h5>
                                    <a href="{{ url('vendor/chat/' . $data->userBid->user->id) }}" class="chat_icon">
                                        <i class="fa-solid fa-message"></i>
                                        <!-- <img src="assets/images/meassageiconblk.svg"> -->
                                    </a>
                                </div>

                            </div>
                            <div class=" active_bid_dtl_card_right">
                                <h5 class="offer_quote_heading">{{ $data->userBid->model }}</h5>
                                <h5 class="offer_quote_heading second_heading">My Quote <span>AED {{ $data->price }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  mt-5">
                <div class="col-lg-12">
                    <div class="all_quote_card  vendor_rply_dtlL _text mb-5">
                        <h5 class="active_order_req">Service Required</h5>

                        <div class="vendor__rply__dttl">
                            <p>{{ $data->userBid->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <div class="owl-carousel carousel_se_03_carousel owl-theme mt-5">
                            @if (count($car_images) == 0)
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-preview.png') }}">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-preview.png') }}">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-preview.png') }}">
                                    </div>
                                </div>
                            @elseif(count($car_images) == 1)
                                @foreach ($car_images as $image)
                                    <div class="item">
                                        <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                            <img src="{{ url($image) }}">
                                        </div>
                                    </div>
                                @endforeach
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-preview.png') }}">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-preview.png') }}">
                                    </div>
                                </div>
                            @elseif(count($car_images) == 2)
                                @foreach ($car_images as $image)
                                    <div class="item">
                                        <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                            <img src="{{ url($image) }}">
                                        </div>
                                    </div>
                                @endforeach
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-preview.png') }}">
                                    </div>
                                </div>
                            @else
                                @foreach ($car_images as $image)
                                    <div class="item">
                                        <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                            <img src="{{ url($image) }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <div class="owl-carousel carousel_se_03_carousel owl-theme mt-5">
                            @if (count($registerImag) == 0)
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-file.png') }}">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-file.png') }}">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-file.png') }}">
                                    </div>
                                </div>
                            @elseif(count($registerImag) == 1)
                                @foreach ($registerImag as $image)
                                    <div class="item">
                                        <a class="text-decoration-none text-reset" href="{{ url($image) }}">
                                            <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                                <img src="{{ asset('public/assets/images/pdficon.png') }}">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-file.png') }}">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-file.png') }}">
                                    </div>
                                </div>
                            @elseif(count($registerImag) == 2)
                                @foreach ($registerImag as $image)
                                    <div class="item">
                                        <a class="text-decoration-none text-reset" href="{{ url($image) }}">
                                            <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                                <img src="{{ asset('public/assets/images/pdficon.png') }}">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                <div class="item">
                                    <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset('public/assets/images/no-file.png') }}">
                                    </div>
                                </div>
                            @else
                                @foreach ($registerImag as $image)
                                    <div class="item">
                                        <a class="text-decoration-none text-reset" href="{{ url($image) }}">
                                            <div class="carAd_img_wraper carAd_img_wraper doc_img customer_dashboard">
                                                <img src="{{ asset('public/assets/images/pdficon.png') }}">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>


                        <h5 class="active_order_req">Police /Accident /Inspection Report</h5>

                        <div class="vendor__rply__dttl">
                            <p>{{ $data->userBid->description2 }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
