@extends('vendor.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        @if ($order->status == 'cancelled')
                            <h4 class="sec_main_heading text-center mb-0"> {{ __('msg.ORDER CANCELED') }}</h4>
                        @else
                            <h4 class="sec_main_heading text-center mb-0">{{ __('msg.Active Orders') }}</h4>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mx-0">
                <div class="col-sm-6 mb-sm-0 mb-3">
                    <div class="all_quote_card replies_allquot h-100">
                        <?php
                        $modelYear = \App\Models\ModelYear::find($order->userbid->model_year_id);
                        $userbidid = \App\Models\UserBid::where('id', $order->user_bid_id)->first();
                        $insurancestatus = \App\Models\InsuranceRequest::where('vendor_bid_id', $order->vendor_bid_id)->first();
                        $company = \App\Models\Company::where('id', $userbidid->company_id)->first();
                        $user = \App\Models\User::find($userbidid->user_id);
                        $userbidimage = \App\Models\UserBidImage::where([['user_bid_id', $order->userbid->id], ['type', 'image']])->first();
                        $userbidimage = explode(',', $userbidimage->car_image);
                        $user = \App\Models\User::find($order->userbid->user_id);
                        $userbidcateg = \App\Models\UserBidCategory::where('user_bid_id', $order->user_bid_id)->pluck('category_id');
                        $userbidcategories = \App\Models\Category::whereIn('id', $userbidcateg)->get();
                        $documents = \App\Models\UserBidImage::where('user_bid_id', $order->userbid->id)
                            ->where('type', 'file')
                            ->first();
                        ?>
                        <div class="w-100 quote_detail_wraper replies" style="padding-left: 0">
                            <div class="quote_info">
                                @if ($user->type == 'company')
                                    <span class="small h6 d-block mb-0"><span
                                            class="small h6 mb-0 heading-color">{{ __('msg.Company Name') }}:</span>
                                        {{ $userbidid->car_owner_name }}</span>
                                    <span class="small h6 d-block mb-0"><span
                                            class="small h6 mb-0 heading-color">{{ __('msg.Company Number') }}:</span>
                                        {{ $user->phone }}</span>
                                @else
                                    <span class="small h6 d-block mb-0"><span
                                            class="small h6 mb-0 heading-color">{{ __('msg.Customer Name') }}:</span>
                                        {{ $userbidid->car_owner_name }}</span>
                                    <span class="small h6 d-block mb-0"><span
                                            class="small h6 mb-0 heading-color">{{ __('msg.Customer Number') }}:</span>
                                        {{ $user->phone }}</span>
                                @endif
                                <span class="small h6 d-block mb-0"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Car Make') }}:</span>
                                    {{ $company->company }}</span>
                                <span class="small h6 d-block mb-0"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Model Year') }}:</span>
                                    {{ $modelYear->model_year }}</span>
                                <span class="small h6 d-block mb-0"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Model') }} :</span>
                                    {{ getModelByUserBid($order->user_bid_id) }}</span>
                                <span class="small h6 d-block mb-0"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Total Mileage') }}:</span>
                                    {{ $order->userbid->mileage }}km</span>

                            </div>
                            <div class="quote_detail_btn_wraper replies">
                                <span class="h5 d-block mb-0"><span
                                        class="h5 mb-0 heading-color">{{ __('msg.Time Frame') }}:</span>
                                    {{ $order->vendorbid->time }} {{ __('msg.Days') }}</span>
                                <div class="d-flex chat_view__detail qoute_replies vendor_order ">
                                    <form action="{{ route('vendor.queryChat') }}" method="POST"
                                        class="chat_view__detail">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $userbidid->user_id }}">
                                        <input type="hidden" name="order_no" value="{{ $order->order_code }}">
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="chat_icon"><i
                                                class="fa-solid fa-message"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="all_quote_card  replies_allquot h-100">
                        <div class="w-100  quote_detail_wraper replies payviainsu" style="padding-left: 0">
                            <div class="quote_detail_btn_wraper">
                                <div class="d-flex align-items-center chat_view__detail allreplies mb-4">
                                    <div class="pay_via_insurance_header_garages">
                                        @if ($order->paid_by == 'insurance')
                                            @if ($insurancestatus->status == 0)
                                                <p>{{ __('msg.Payment Is Pending') }}</p>
                                            @endif
                                            @if ($insurancestatus->status == 1)
                                                <p>{{ __('msg.Paid via Insurance') }}</p>
                                            @endif
                                        @elseif ($order->paid_by == 'company')
                                            <p>{{ __('msg.Order By Company') }}</p>
                                        @else
                                            <p>{{ __('msg.Paid By Customer') }}</p>
                                        @endif
                                        <i class="bi bi-star-fill"></i>
                                    </div>

                                </div>
                                <a href="{{ url('vendor/print-order-details', $order->vendor_bid_id) }}"
                                    class="view-invoice">{{ __('msg.view invoice') }}</a>
                            </div>
                            <div class="quote_info">
                                <div class="quote_detail_btn_wraper">
                                    <h5 class="quotereplies"><span
                                            class="h5 mb-0 heading-color">{{ __('msg.Total') }}:</span>
                                        {{ $order->total }}
                                        {{ __('msg.AED') }}</h5>
                                    @if ($order->status != 'complete' && $order->paid_by != 'insurance')
                                        <h5 class="quotereplies"><span
                                                class="h5 mb-0 heading-color">{{ __('msg.Advance') }}:</span>
                                            {{ $order->advance }}
                                            {{ __('msg.AED') }}</h5>
                                    @endif
                                    @if ($order->status != 'complete' && $order->paid_by == 'insurance' && $insurancestatus->status == 1)
                                        <h5 class=" text-sm-center"><span
                                                class="h5 mb-0 heading-color">{{ __('msg.Advance') }}:</span>
                                            {{ $order->total }}
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
            </div>
            <div class="row mx-0 mt-3">
                <div class="col-lg-12">
                    <div class="all_quote_card  vendor_rply_dtlL _text mb-3">
                        <h5 class="active_order_req text-center">{{ __('msg.Requirements') }}</h5>
                        <div class="over_view_part carad_data vendor_detail">
                            @if (isset($documents))
                                <h6 class="heading-color float-left mb-0">{{ __('msg.Type of Service') }}</h6>
                                <p>
                                    @foreach ($userbidcategories as $userbidcategory)
                                        {{ $userbidcategory->name }},
                                    @endforeach
                                </p>
                            @endif
                            <h6 class="heading-color float-left mb-0">{{ __('msg.DETAILS') }}</h6>
                        </div>
                        <div class="vendor__rply__dttl">
                            <p>{{ $userbidid->description1 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 mb-3">
                <div class="col-lg-12">
                    <div class="all_quote_card vendor_rply_dtlL _text mt-4">
                        <h5 class="heading-color text-center mb-3">{{ __('msg.CAR IMAGES') }}</h5>
                        <div class="owl-carousel carousel_se_03_carousel owl-theme mt-3">
                            @foreach ($userbidimage as $image)
                                <div class="item">
                                    <div class="carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset($image) }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $register_images = \App\Models\UserBidImage::where('user_bid_id', $order->userbid->id)
                ->where('type', 'registerImage')
                ->first();
            $register_images = Explode(',', $register_images->car_image);
            ?>
            <div class="row  mx-0">
                <div class="col-lg-12">
                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <h5 class="text-center mb-3 heading-color">{{ __('msg.Registration Copy Images') }} </h5>
                        <div class="owl-carousel carousel_se_03_carousel owl-theme mt-3">
                            @foreach ($register_images as $image)
                                <div class="item">
                                    <div class="carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset($image) }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            @if (isset($documents))
                <div class="row mx-0 my-3">
                    <div class="col-lg-12">
                        <div class="all_quote_card  vendor_rply_dtlL _text">
                            <h5 class="active_order_req text-center">{{ __('msg.Police /Accident /Inspection Report') }}
                            </h5>
                            <div class="owl-theme mt-4">


                                @if (isset($documents->car_image))
                                    <?php $pathinfo = pathinfo($documents->car_image);
                                    $supported_ext = ['docx', 'xlsx', 'pdf'];
                                    $src_file_name = $documents->car_image;
                                    $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>
                                    <div class="item">
                                        <div class="carAd_img_wraper doc_img customer_dashboard">
                                            @if ($ext == 'docx')
                                                <a class="text-decoration-none text-reset"
                                                    href="{{ url($documents->car_image) }}">
                                                    <img src="{{ asset('public/assets/images/wordicon.png') }}"
                                                        style="height: 100%;">
                                                </a>
                                            @elseif($ext == 'doc')
                                                <a class="text-decoration-none text-reset"
                                                    href="{{ url($documents->car_image) }}">
                                                    <img src="{{ asset('public/assets/images/wordicon.png') }}"
                                                        style="height: 100%;">
                                                </a>
                                            @elseif($ext == 'xlsx')
                                                <a class="text-decoration-none text-reset"
                                                    href="{{ url($documents->car_image) }}">
                                                    <img src="{{ asset('public/assets/images/excelicon.png') }}"
                                                        style="height: 100%;">
                                                </a>
                                            @elseif($ext == 'pdf')
                                                <a class="text-decoration-none text-reset"
                                                    href="{{ url($documents->car_image) }}">
                                                    <img src="{{ asset('public/assets/images/pdficon.png') }}"
                                                        style="height: 100%;">
                                                </a>
                                            @else
                                                <img src="{{ asset($documents->car_image) }}">
                                            @endif


                                        </div>
                                    </div>
                                @else
                                    <div class="item">
                                        <div class="carAd_img_wraper doc_img customer_dashboard">
                                            <img src="{{ asset('public/assets/images/no-file.png') }}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mx-0 mt-4">
                <div class="col-lg-12">

                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <div class="over_view_part carad_data vendor_detail">
                            <h5 class="heading-color text-center mb-3">{{ __('msg.REPAIR DETAILS') }}</h5>
                        </div>
                        <div class="vendor__rply__dttl">
                            <p>{{ $order->vendorbid->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if ($order->status == 'pending')
                <div class="row mt-sm-5 mt-3 mx-auto col-xl-9 col-md-10" style="row-gap: 12px">
                    <div class="col-sm-6">
                        <a href="{{ route('vendor.addfund', $order->user_bid_id) }}"
                            class="btn btn-secondary block get_appointment" type="button" style="height: 100%">
                            {{ __('msg.ADD FUNDS') }}
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <form action="{{ route('vendor.completeInovoice') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="order_no" value="{{ $order->order_code }}">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            @if ($order->paid_by == 'insurance' && $insurancestatus->status == 0)
                                <button
                                    class="w-100 btn text-center px-5 btn-primary get_quot block get_appointment d-flex align-items-center justify-content-center disabled"
                                    type="submit" style="font-size: 14px;border-radius: 6px">
                                    {{ __('msg.MARK AS COMPLETE') }} </button>
                            @else
                                <button
                                    class="w-100 btn text-center px-5 btn-primary get_quot block get_appointment d-flex align-items-center justify-content-center"
                                    type="submit" style="font-size: 14px;border-radius: 6px">
                                    {{ __('msg.MARK AS COMPLETE') }} </button>
                            @endif
                        </form>
                    </div>
                </div>
            @else
                <div class="row mx-0 mt-4">
                    <div class="col-lg-12">

                        <div class="all_quote_card  vendor_rply_dtlL _text">
                            <div class="over_view_part carad_data vendor_detail">
                                <h5 class=" text-center mb-3">ORDER CANCEL REASON</h5>
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
