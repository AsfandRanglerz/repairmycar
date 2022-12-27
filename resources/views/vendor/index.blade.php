@extends('vendor.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper"
        style="background-image:url({{ asset('public/assets/images/gradiantbg.jpg') }});">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        {{-- <h4 class="sec_main_heading text-center mb-0">{{ __('msg.DASHBOARD') }}</h4>
                        <p class="sec_main_para text-center">{{ __("msg.See what's happening on your profile") }}</p> --}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-11 col-md-11  mx-auto">
                    <div class="quote_card_heading _top_dash  mb-lg-4 mb-2 mt-lg-5 mt-3">
                        <h5>{{ __('msg.Previous Stats') }}</h5>
                        <!-- <a href="#">View All</a> -->
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class="all_quote_card dashboard_card top_dashboard flex-column shadow h-100 ">
                                <h5>{{ $completedOrders }}</h5>
                                <h5 class="heading-color text-center">{{ __('msg.Completed Orders') }}</h5>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class="all_quote_card dashboard_card top_dashboard flex-column shadow h-100">
                                <h5>{{ $totalReviews }}</h5>
                                <h5 class="heading-color text-center">{{ __('msg.Total Reviews') }}</h5>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class="all_quote_card dashboard_card top_dashboard flex-column shadow h-100">
                                <h5>{{ round($overAllRatings, 2) }}</h5>
                                <h5 class="heading-color text-center">{{ __('msg.Overall Rating') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-11 col-md-12  mx-auto">
                    <div class="quote_card_heading  mb-lg-4 mb-2 mt-lg-5 mt-3">
                        <h5>{{ __('msg.Active Orders') }}</h5>
                        <a href="{{ route('vendor.orders') }}">{{ __('msg.VIEW ALL') }}</a>
                    </div>
                    {{-- <div class="all_quote_card "> --}}

                    @if (isset($order))
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
                        <div class="col-12">
                            <div class="all_quote_card ">
                                <div class="car_inner_imagg ">
                                    <img src="{{ asset($img1[0]) }}">
                                </div>
                                <div class=" w-100  quote_detail_wraper">
                                    <div class="quote_info">
                                        <h5 class="d-flex align-items-center active_quote">{{ $company->company }}
                                            ({{ $userbidid->model }}) <span class="order_id">{{ $order->status }}</span>
                                        </h5>
                                        <p class="mb-0">{{ $userbidid->car_owner_name }}</p>
                                        <p class="mb-0">{{ $user->phone }}</p>
                                        <p>{{ $userbidid->phone }}</p>
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
                    @else
                        <div class=" w-100  quote_detail_wraper all_quote_card">
                            <div class="quote_info">
                                <p class="mb-0">{{ __('msg.No Data found!') }}</p>
                            </div>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="privTermsPolicyModal" aria-labelledby="privTermsPolicy" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="privTermsPolicy">{{ __('msg.Privacy Policy and Terms & Conditions') }}</h6>
                </div>
                <div class="modal-body">
                    <h6 class="sec_main_heading text-center">{{ __('msg.Privicy Policy') }}</h6>
                    <p class="text-justify">{!! $data['policy']->description !!}</p>
                    <h6 class="sec_main_heading text-center">{{ __('msg.Terms & Conditions') }}</h6>
                    <p class="text-justify">{!! $data['terms']->description !!}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="agreePrivTerms" data-bs-dismiss="modal"
                        style="padding: 8px 16px!important;height: unset">{{ __('msg.I Agree') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <?php
    
    $vendor = \App\Models\Vendor::find(Auth::id());
    $term = $vendor->term_condition;
    ?>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script>
        var term = '<?php echo $term; ?>';
        var authid = '<?php echo $vendor->id; ?>';

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
        if (term == 0) {

            $(function() {
                $('#privTermsPolicyModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $("#privTermsPolicyModal").modal('show');
                $(document).on('click', '#agreePrivTerms', function() {
                    toastr.success(
                        "{{ __('msg.You agreed to our Privacy Policy and Terms & Conditions') }}");
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        url: "{{ route('vendor.terms_condition') }}",
                        data: {
                            'id': 1,
                            'authid': authid
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    });
                });
            });
        }
    </script>
@endsection
