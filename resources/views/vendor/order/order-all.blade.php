@extends('vendor.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.Active Orders') }}</h4>
                        <p class="sec_main_para text-center">{{ __('msg.See what are the active orders you have') }}</p>
                    </div>
                </div>
            </div>

            <div class="row g-2">
                @foreach ($orders as $order)
                    <?php
                    $userbidid = \App\Models\UserBid::where('id', $order->user_bid_id)->first();
                    $img = \App\Models\UserBidImage::where('user_bid_id', $userbidid->id)
                        ->where('type', 'image')
                        ->oldest()
                        ->first();
                    $img1 = Explode(',', $img->car_image);
                    $company = \App\Models\Company::where('id', $userbidid->company_id)->first();
                    $user = \App\Models\User::find($order->userbid->user_id);
                    ?>
                    <div class="col-lg-10 col-md-12 col-sm-12 col-10  mx-auto">
                        <div class="all_quote_card ">
                            <div class="car_inner_imagg ">
                                <img src="{{ asset($img1[0]) }}">
                            </div>
                            <div class=" w-100  quote_detail_wraper">
                                <div class="quote_info">
                                    <h5 class="d-flex align-items-center active_quote heading-color">{{ $company->company }}
                                        ({{ $userbidid->model }})
                                    </h5>
                                    <p class="mb-0"><b>{{$user->type == "user" ? "Customer Name":"Insurance Company"}}: </b>{{ $userbidid->car_owner_name }}</p>
                                    <p class="mb-0"><b>Phone: </b>{{ $user->phone }}</p>
                                </div>
                                <div class="quote_detail_btn_wraper">
                                    <h5 class=" text-sm-center">{{ __('msg.AED') }} {{ $order->total }}</h5>
                                    <div class="d-flex align-items-center chat_view__detail">
                                        <form action="{{ route('vendor.queryChat') }}" method="POST"
                                            class="chat_view__detail">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $userbidid->user_id }}">
                                            <input type="hidden" name="order_no" value="{{ $order->order_code }}">
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <button type="submit" class="chat_icon"><i
                                                    class="fa-solid fa-message"></i></button>
                                        </form>
                                        <a href="{{ route('vendor.fullfillment', $order->id) }}"
                                            class="btn-secondary">{{ __('msg.view_details') }}</a>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
