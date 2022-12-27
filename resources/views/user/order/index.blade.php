@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/vendor/assets/images/gradiantbg.jpg);">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.ALL ORDERS') }}</h4>
                        <p class="sec_main_para text-center">{{ __('msg.See Your Previously Completed Orders and Details') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                @if (count($orders) > 0)
                    @foreach ($orders as $order)
                        <?php
                            $garage = \App\Models\Garage::find($order->garage_id);
                            $userbidid = \App\Models\UserBid::where('id', $order->user_bid_id)->first();
                            $img = \App\Models\UserBidImage::where('user_bid_id', $userbidid->id)->where('type','image')->oldest()->first();
                            $img1 = Explode(',', $img->car_image);
                            $company = \App\Models\Company::where('id', $userbidid->company_id)->first();
                        ?>
                        <div class="col-lg-10 col-md-11 col-sm-12 col-10  mx-auto">
                            <div class="all_quote_card ">
                                <div class="car_inner_imagg ">
                                    <img src="{{ asset($img1[0]) }}">
                                </div>
                                <div class=" w-100  quote_detail_wraper">
                                    <div class="quote_info">
                                        <h5 class="d-flex align-items-center active_quote">{{ $company->company }}
                                            ({{ $userbidid->model }})
                                        </h5>
                                        <p class="mb-0">{{ $userbidid->description1 }}</p>
                                        <p>{{ $userbidid->phone }}</p>
                                    </div>
                                    <div class="quote_detail_btn_wraper">
                                        <div class="quote_detail_btn_wraper">
                                            <h5 class=" text-sm-center vendor_replies_dtl allOrder">{{ $order->status }}
                                            </h5>
                                        </div>
                                        <h5 class=" text-sm-center">{{ __('msg.AED') }} {{ $order->total }}</h5>
                                        <div class="d-flex align-items-center chat_view__detail">
                                            <a href="{{ url('user/chat/' . $garage->vendor_id) }}" class="chat_icon">
                                                <i class="fa-solid fa-message"></i>
                                            </a>
                                            <a href="{{ route('user.order.summary', $order->id) }}"
                                                class="btn-secondary">{{ __('msg.view_details') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-10 col-md-11 col-sm-12 col-10  mx-auto">
                        <div class="all_quote_card ">

                            <div class=" w-100  quote_detail_wraper">
                                <div class="quote_info">
                                    <p class="mb-0">{{ __('msg.No Orders have been added!') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <span>{!! $orders->links() !!}</span>
            </div>
        </div>
    </section>
@endsection
