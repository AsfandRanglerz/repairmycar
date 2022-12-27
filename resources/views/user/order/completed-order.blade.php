@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/vendor/assets/images/gradiantbg.jpg);">
        <div class="container-lg container-fluid">
            <div class="row g-2 pt-5">
                <div class="col-lg-11 col-md-12 col-md-12 col-11  mx-auto">
                    <div class="all_quote_card  vendor_rply_dtlL completed_orders">
                        <?php
                        $userbid = \App\Models\UserBid::where('id', $order->user_bid_id)->first();
                        $company = \App\Models\Company::where('id', $userbid->company_id)->first();
                        $garage = \App\Models\Garage::where('id', $order->garage_id)->first();
                        $vendor = \App\Models\Vendor::where('id', $garage->vendor_id)->first();
                        $insurancestatus = \App\Models\InsuranceRequest::where('vendor_bid_id', $order->vendor_bid_id)->first();

                        ?>
                        <div class="car_inner_imagg vendor_rply_dtl ">
                            <img
                                @if ($garage->image && $garage->image != null) src="{{ asset($garage->image) }}" @else
                        src="{{ asset('public/assets/images/repair2.jpg') }}" @endif>
                        </div>
                        <div class=" w-100  quote_detail_wraper">
                            <div class="quote_info">
                                <h5 class="active_quote"><span class="h5 mb-0 heading-color">{{ __('msg.Garage') }}:</span>
                                    {{ $garage->garage_name }}</h5>
                                <span class="small h6 d-block mb-0"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Garage Owner') }}:</span>
                                    {{ $vendor->name }}</span>
                                <span class="small h6 d-block"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Garage Number') }}:</span>
                                    {{ $vendor->phone }}</span>
                                <div class="card_icons d-flex justify-content-center align-items-center">

                                    <?php
                                        $category = \App\Models\GarageCategory::where('garage_id', $garage->id)->pluck('category_id');
                                        $category_name = \App\Models\Category::whereIn('id', $category)->get();
                                        $count = $category_name->count();
                                        if ($count > 5) {
                                            $count = 5;
                                        }
                                    ?>
                                    @for ($i = 0; $i < $count; $i++)
                                        <div class="icon_wrpaer">
                                            <img src="{{ asset($category_name[$i]->icon) }}">
                                        </div>
                                    @endfor
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
                                <h5 class="text-sm-center"><span class="h5 heading-color">{{ __('msg.Total') }}:</span>
                                    {{ $order->total }} {{ __('msg.AED') }}</h5>
                                @if ($order->status != 'complete' && $order->paid_by != 'insurance')
                                    <h5 class="text-sm-center"><span
                                            class="h5 heading-color">{{ __('msg.Advance') }}:</span> {{ $order->advance }}
                                        {{ __('msg.AED') }}</h5>
                                @endif
                                @if ($order->status != 'complete' && $order->paid_by == 'insurance' && $insurancestatus->status == 1)
                                    <h5 class="text-sm-center"><span
                                            class="h5 heading-color">{{ __('msg.Advance') }}:</span> {{ $order->total }}
                                        {{ __('msg.AED') }}</h5>
                                @endif
                                <div class="completed_order_id">
                                    <h5><span class="h5 heading-color">{{ __('msg.Order Id:') }}</span>
                                        #{{ $order->order_code }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 mt-3">
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
            <div class="row mx-0 mt-3">
                <div class="col-lg-12">

                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <div class="over_view_part carad_data vendor_detail">
                            <h5 class="heading-color text-center mb-5">{{ __('msg.CAR DETAILS') }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="row mt-1 g-3">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="d-grid gap-2 ">
                                            <button class="btn text-center btn-secondary get_quot block get_appointment"
                                                type="button">{{ __('msg.Model') }} :
                                                {{ getModelByUserBid($order->user_bid_id) }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="d-grid gap-2 ">
                                            <button class="btn text-center btn-secondary get_quot block get_appointment"
                                                type="button">{{ __('msg.Car Make') }} : {{ $company->company }}
                                            </button>
                                        </div>
                                    </div>
                                    <?php $userbidcateg = \App\Models\UserBidCategory::where('user_bid_id', $order->user_bid_id)->pluck('category_id');
                                    $userbidcategories = \App\Models\Category::whereIn('id', $userbidcateg)->get(); ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="d-grid gap-2 ">
                                            <button class="btn text-center btn-secondary get_quot block get_appointment"
                                                type="button">{{ __('msg.Type of Service') }} : @foreach ($userbidcategories as $userbidcategory)
                                                    {{ $userbidcategory->name }},
                                                @endforeach
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="d-grid gap-2 ">
                                            <button class="btn text-center btn-secondary get_quot block get_appointment"
                                                type="button">{{ __('msg.Customer Name') }}: {{ auth()->user()->name }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $review_prev = \App\Models\UserReview::where('order_id', $order->id)->first(); ?>

            @if ($order->status == 'pending')
                <div class="row">
                    <div class="col-xl-5 col-lg-6  col-md-10 col-sm-12 mx-auto">
                        <div class="row mt-3 mb-4 g-3">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="d-grid gap-2 mt-lg-3 ">
                                    <a href="{{ route('user.order.cancel.view', $order->id) }}"
                                        class="btn text-center btn-primary get_quot block get_appointment d-flex align-items-center justify-content-center"
                                        type="button">{{ __('msg.CANCEL ORDER') }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="d-grid gap-2 mt-lg-3 ">
                                    <a href="{{ route('user.order.show', $order->id) }}"
                                        class="btn btn-secondary text-uppercase block get_appointment"
                                        type="button">{{ __('msg.Proceed') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($review_prev)
                    <div class="row mx-0 mt-3">
                        <div class="col-lg-12">

                            <div class="all_quote_card  vendor_rply_dtlL _text">
                                <div class="over_view_part carad_data vendor_detail">
                                    <h5 class="heading-color text-center mb-4">{{ __('msg.YOUR REVIEW') }}</h5>
                                </div>
                                <div class="d-flex align-items-center rating-stars">
                                    <div class="rating-group">
                                        @if ($review_prev->rating == '0')
                                            <label aria-label="0 stars" class="rating__label" for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="1 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '0.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '1')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '1.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '2')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '2.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '3')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '3.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                                for="rating2-35"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="4.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '4')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                                for="rating2-35"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="4.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '4.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                                for="rating2-35"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="4.5 stars" class="rating__label rating__label--half"
                                                for="rating2-45"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                                for="rating2-35"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="4.5 stars" class="rating__label rating__label--half"
                                                for="rating2-45"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="5 stars" class="rating__label" for="rating2-50"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        @endif

                                    </div>
                                </div>
                                <div class="review_text d-flex justify-content-center align-items-center">
                                    <p class="my-0">{{ $review_prev->review }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="over_view_part carad_data vendor_detail Leave_review">
                                <h5 class="heading-color text-center mb-2 mt-3">{{ __('msg.REVIEW WORKSHOP') }}</h5>
                            </div>

                        </div>
                    </div>
                    <div class="row mx-0 mt-3">
                        <div class="col-lg-12">
                            <div class="all_quote_card  vendor_rply_dtlL _text">
                                <div class="row">
                                    <div class="col-lg-8 mx-auto">
                                        <form method="post" action="{{ route('user.user_review.store') }}">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="garage_id" value="{{ $order->garage_id }}">
                                            <div class="row g-3">
                                                <div class="col-lg-12 col-md-8 mx-auto">
                                                    <div class="d-flex align-items-center rating-stars">
                                                        <div class="rating-group">
                                                            <input class="rating__input rating__input--none"
                                                                name="rating" id="rating2-0" value="0"
                                                                type="radio" checked>
                                                            <label aria-label="0 stars" class="rating__label"
                                                                for="rating2-0">&nbsp;</label>
                                                            <label aria-label="0.5 stars"
                                                                class="rating__label rating__label--half"
                                                                for="rating2-05"><i
                                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-05"
                                                                value="0.5" type="radio">
                                                            <label aria-label="1 star" class="rating__label"
                                                                for="rating2-10"><i
                                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-10"
                                                                value="1.0" type="radio">
                                                            <label aria-label="1.5 stars"
                                                                class="rating__label rating__label--half"
                                                                for="rating2-15"><i
                                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-15"
                                                                value="1.5" type="radio">
                                                            <label aria-label="2 stars" class="rating__label"
                                                                for="rating2-20"><i
                                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-20"
                                                                value="2.0" type="radio">
                                                            <label aria-label="2.5 stars"
                                                                class="rating__label rating__label--half"
                                                                for="rating2-25"><i
                                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-25"
                                                                value="2.5" type="radio">
                                                            <label aria-label="3 stars" class="rating__label"
                                                                for="rating2-30"><i
                                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-30"
                                                                value="3.0" type="radio">
                                                            <label aria-label="3.5 stars"
                                                                class="rating__label rating__label--half"
                                                                for="rating2-35"><i
                                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-35"
                                                                value="3.5" type="radio">
                                                            <label aria-label="4 stars" class="rating__label"
                                                                for="rating2-40"><i
                                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-40"
                                                                value="4.0" type="radio">
                                                            <label aria-label="4.5 stars"
                                                                class="rating__label rating__label--half"
                                                                for="rating2-45"><i
                                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-45"
                                                                value="4.5" type="radio">
                                                            <label aria-label="5 stars" class="rating__label"
                                                                for="rating2-50"><i
                                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                            <input class="rating__input" name="rating" id="rating2-50"
                                                                value="5.0" type="radio">
                                                        </div>
                                                    </div>

                                                    <div class="form-floating">
                                                        <textarea class="form-control" name="review" placeholder="Add Repairing Details" id="floatingTextarea2"
                                                            style="height: 177px">                      </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-8 mx-auto">
                                                    <div class="d-grid gap-2 ">
                                                        <button
                                                            class="btn text-center btn-secondary get_quot block get_appointment"
                                                            type="submit">LEAVE REVIEW
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @elseif($order->status == 'complete')
                @if ($review_prev)
                    <div class="row mx-0 mt-3">
                        <div class="col-lg-12">
                            <div class="all_quote_card  vendor_rply_dtlL _text">
                                <div class="over_view_part carad_data vendor_detail">
                                    <h5 class="heading-color text-center mb-4">{{ __('msg.YOUR REVIEW') }}</h5>
                                </div>
                                <div class="d-flex align-items-center rating-stars">
                                    <div class="rating-group">
                                        @if ($review_prev->rating == '0')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="1 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '0.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '1')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '1.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '2')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '2.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '3')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '3.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                                for="rating2-35"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                            <label aria-label="4.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '4')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                                for="rating2-35"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="4.5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '4.5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                                for="rating2-35"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="4.5 stars" class="rating__label rating__label--half"
                                                for="rating2-45"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="5 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"
                                                    style="color: gray;"></i></label>
                                        @elseif($review_prev->rating == '5')
                                            <label aria-label="0 stars" class="rating__label"
                                                for="rating2-0">&nbsp;</label>
                                            <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                                for="rating2-05"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                                for="rating2-15"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                                for="rating2-25"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                                for="rating2-35"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            <label aria-label="4.5 stars" class="rating__label rating__label--half"
                                                for="rating2-45"><i
                                                    class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                            <label aria-label="5 stars" class="rating__label" for="rating2-50"><i
                                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                                        @endif
                                    </div>
                                </div>
                                <div class="review_text d-flex justify-content-center align-items-center">
                                    <p class="my-0">{{ $review_prev->review ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="row mx-0 mt-3">
                    <div class="col-lg-12">

                        <div class="all_quote_card  vendor_rply_dtlL _text">
                            <div class="over_view_part carad_data vendor_detail">
                                <h5 class="heading-color text-center mb-5">ORDER CANCEL REASON</h5>
                            </div>
                            <div class="vendor__rply__dttl">
                                <p>{{ $order->reason }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>
    </section>
@endsection
@section('script')
    <script>
        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        $(document).ready(function() {
            <?php if(session('alert-order-success'))
                {
            ?>
            toastr.success('{{ Session::get('alert-order-success') }}');
            <?php
                }
            ?>
        });
    </script>
@endsection
