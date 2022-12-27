@extends('user.layout.app')
@section('content')
    <style>
        .inv-comp-btn {
            min-width: max-content;
            width: 175px !important;
        }
    </style>
    <section class="pb-5 login_content_wraper" style="background-image:url(assets/images/gradiantbg.jpg);">
        <div class="container-lg container-fluid">
            <div class="row g-2 pt-4">
                <div class="col-lg-11 col-md-12 col-md-12 col-11  mx-auto">
                    <div class="all_quote_card  vendor_rply_dtlL completed_orders">
                        <?php
                        $userbid = \App\Models\UserBid::where('id', $order->user_bid_id)->first();
                        $company = \App\Models\Company::where('id', $userbid->company_id)->first();
                        $garage = \App\Models\Garage::where('id', $order->garage_id)->first();
                        $vendor = \App\Models\Vendor::where('id', $garage->vendor_id)->first();
                        $insurancestatus = \App\Models\InsuranceRequest::where('vendor_bid_id', $order->vendor_bid_id)->first();
                        $part = \App\Models\Part::where([['vendor_bid_id', $order->vendor_bid_id], ['type', 'services'], ['status', 1]])->get();
                        $total_labour = 0;
                        foreach ($part as $value) {
                            $total = $value->service_quantity * $value->service_rate;
                            $total_labour += $total;
                        }
                        
                        ?>
                        <div class="car_inner_imagg vendor_rply_dtl ">
                            <img
                                @if ($garage->image && $garage->image != null) src="{{ asset($garage->image) }}" @else
                        src="{{ asset('public/assets/images/repair2.jpg') }}" @endif>
                        </div>
                        <div class=" w-100  quote_detail_wraper">
                            <div class="my-sm-0 my-3 quote_info">
                                <h5 class="active_quote"><span class="h5 mb-0 heading-color">{{ __('msg.Garage') }}:</span>
                                    {{ $garage->garage_name }}</h5>
                                <span class="small h6 d-block mb-0"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Garage Owner') }}:</span>
                                    {{ $vendor->name }}</span>
                                <span class="small h6 d-block"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Garage Number') }}:</span>
                                    {{ $vendor->phone }}</span>
                                <div class="card_icons d-flex justify-content-center align-items-center">
                                    <?php $category = \App\Models\GarageCategory::where('garage_id', $garage->id)->pluck('category_id');
                                    $category_name = \App\Models\Category::whereIn('id', $category)->get();
                                    ?>
                                    @foreach ($category_name as $catname)
                                        <div class="icon_wrpaer">
                                            <img src="{{ asset($catname->icon) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if ($order->paid_by == 'insurance')
                                <div class="d-flex align-items-center chat_view__detail allreplies mb-4">
                                    <div class="pay_via_insurance_header_garages">
                                        @if ($order->paid_by == 'insurance')
                                            @if ($insurancestatus->status == 0)
                                                <p>{{ __('msg.Payment Is Pending') }}</p>
                                            @endif
                                            @if ($insurancestatus->status == 1)
                                                <p>{{ __('msg.Paid via Insurance') }}</p>
                                            @endif
                                        @endif
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            @endif
                            <div class="quote_detail_btn_wraper">
                                <div class="quote_detail_btn_wraper">
                                    <h5 class=" text-sm-center vendor_replies_dtl allOrder">{{ $order->status }}</h5>
                                </div>
                                <h5 class=" text-sm-center"><span class="h5 heading-color">{{ __('msg.Total') }}:</span>
                                    {{ $order->total }} {{ __('msg.AED') }}
                                </h5>
                                @if ($order->status != 'complete' && $order->paid_by != 'insurance')
                                    <h5 class=" text-sm-center"><span
                                            class="h5 heading-color">{{ __('msg.Advance') }}:</span> {{ $order->advance }}
                                        {{ __('msg.AED') }}</h5>
                                @endif
                                @if ($order->status != 'complete' && ($order->paid_by == 'insurance' && $insurancestatus->status == 1))
                                    <h5 class=" text-sm-center"><span
                                            class="h5 heading-color">{{ __('msg.Advance') }}:</span> {{ $order->total }}
                                        {{ __('msg.AED') }}</h5>
                                @endif
                                <div class="completed_order_id">
                                    <p><span class="h5 heading-color">{{ __('msg.Order Id:') }}</span>
                                        <span>#{{ $order->order_code }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $images = explode(',', $bidfile->car_image);
            ?>
            <div class="container">
                <div class="owl-carousel carousel_se_03_carousel  mt-3">
                    @foreach ($images as $image)
                        <div class="item">
                            <div class="carAd_img_wraper doc_img customer_dashboard">
                                <img src="{{ asset($image) }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row mt-5">
                <div class=" col-xl-7 col-lg-9 col-md-9 col-sm-11 mx-auto">
                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <div class="over_view_part carad_data vendor_detail">
                            <h5 class="heading-color text-center mb-5">{{ __('msg.REPAIR DETAILS') }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="invoice_details mb-5">
                                    <h5 class="heading-color">{{ __('msg.Work Days') }}</h5>
                                    <h5 class="__gray">{{ $order->vendorbid->time }}</h5>
                                </div>
                                <div class="invoice_details">
                                    <h5 class="heading-color">{{ __('msg.Labor Pay') }}</h5>
                                    <h5 class="__gray">{{ __('msg.AED') }} {{ $total_labour }}</h5>
                                </div>


                            </div>
                            <div class="col-sm-2">
                                <div class="divider_invoice"></div>
                            </div>
                            <div class="col-sm-5">
                                <div class="invoice_details">
                                    <h5 class="heading-color">{{ __('msg.Total Invoice') }}</h5>
                                    <h5 class="__gray">{{ __('msg.AED') }} {{ $order->vendorbid->net_total }}</h5>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row mx-0 mt-5">
                <div class="col-lg-12">

                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <div class="over_view_part carad_data vendor_detail">
                            <h5 class="heading-color text-center mb-5">{{ __('msg.REPAIR DETAILS') }}</h5>
                        </div>
                        <?php $vendor_bid = \App\Models\VendorBid::where('garage_id', $order->garage_id)
                            ->where('user_bid_id', $order->user_bid_id)
                            ->first(); ?>
                        <div class="vendor__rply__dttl">
                            <p>{{ $vendor_bid->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-5 col-lg-6  col-md-8 mx-auto">
                    <div class="row mt-5 mb-4 g-3">
                        <div class="mt-0 d-flex flex-wrap justify-content-center" style="gap: 16px">
                            @if ($newinvoce->part != '[]')
                                <a href="{{ route('user.order.invoce', $newinvoce->id) }}"
                                    class="m-0 btn btn-secondary block get_appointment inv-comp-btn">{{ __('msg.NEW INVOICE') }}</a>
                            @endif
                            <a href="{{ url('user/print-order-details', $vendorBid->id) }}"
                                class="m-0 btn btn-secondary block get_appointment inv-comp-btn">{{ __('msg.INVOICE') }}</a>
                            @if ($order->paid_by == 'insurance')
                                <form enctype="multipart/form-data" method="post"
                                    action="{{ route('user.order.complete') }}" class="needs-validation" novalidate>
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                    @if ($order->paid_by == 'insurance')
                                        @if ($insurancestatus->status == 0)
                                            <button class="btn btn-secondary block get_appointment disabled inv-comp-btn"
                                                type="submt">{{ __('msg.CONFIRM TO COMPLETE') }}</button>
                                        @endif
                                        @if ($insurancestatus->status == 1)
                                            <button class="btn btn-secondary block get_appointment inv-comp-btn"
                                                type="submt">{{ __('msg.CONFIRM TO COMPLETE') }}</button>
                                        @endif
                                    @endif
                                </form>
                            @else
                                <form enctype="multipart/form-data" method="post"
                                    action="{{ route('user.payment_page') }}" class="needs-validation" novalidate>
                                    @csrf
                                    <input type="hidden" name="bid_id" value="{{ $vendor_bid->id }}">
                                    <input type="hidden" name="type" value="order">
                                    <button class="m-0 btn btn-secondary block get_appointment inv-comp-btn"
                                        type="submt">{{ __('msg.MARK AS COMPLETE') }}</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
