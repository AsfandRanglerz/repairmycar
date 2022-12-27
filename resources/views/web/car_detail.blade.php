@extends('web.layout.app')
@section('content')
    <?php $images = explode(',', $ad->images);
    $docs = explode(',', $ad->document_file);
    ?>
    <section class="caradDetailBabnner py-5">
        <div class="container">
            <h4 class="text-center text-uppercase mb-4 heading-color">{{ __('msg.CAR IMAGES') }}</h4>
            <div class="owl-carousel carousel_se_02_carousel owl-theme" id="carImages">
                @foreach ($images as $image)
                    <a href="{{ asset($image) }}">
                        <div class="item">
                            <div class="carAd_img_wraper">
                                <img src="{{ asset($image) }}">
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class=" store_brances d-flex justify-content-center align-items-center">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-3">
                    <h6 class="store_addres">{{ __('msg.Company') }}: {{ getCompany($ad->company_id) }}</h6>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-3">
                    <h6 class="store_addres">{{ __('msg.Country') }}: @if ($ad->vendor_id != null)
                            {{ getCountryByVendor($ad->vendor_id) }}@else{{ getCountryByVendor($ad->user_id) }}
                        @endif
                    </h6>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-3">
                    <h6 class="store_addres">{{ __('msg.City') }}: {{ $ad->city }}</h6>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-3">
                    <h6 class="store_addres">{{ __('msg.Price') }}: {{ $ad->price }}</h6>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="over_view_part carad_data">
                        <h4 class="text-center mt-3 mb-0 heading-color">{{ __('msg.LEGAL DOCS') }}</h4>
                    </div>
                </div>
            </div>
            <div class="owl-carousel carousel_se_02_carousel owl-theme" id="carDocs">
                @foreach ($docs as $doc)
                    <a href="{{ asset($doc) }}">
                        <div class="item">
                            <div class="carAd_img_wraper doc_img">
                                <img src="{{ asset($doc) }}">
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>
    <section class="">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="over_view_part carad_data">
                        <h4 class="text-center mt-3 mb-0 heading-color">{{ __('msg.CAR INFORMATION') }}</h4>
                    </div>
                </div>
            </div>
            <div class="row g-4 mb-4">
                <div class="col-lg-8 col-md-6 col-sm-6">
                    <div class="over_view_part">
                        <h5 class=" text-center mb-5 heading-color">{{ __('msg.OVERVIEW') }}</h5>
                        <p>{{ $ad->description }}</p>
                        <br>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="over_view_part timing_hours">
                        <h5 class=" text-center mb-5 heading-color">{{ __('msg.DETAILS') }}</h5>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">{{ __('msg.Model') }}</p>
                            <p class="time_for_opning mb-1">{{ $ad->model }}</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-0">{{ __('msg.Engine') }}</p>
                            <p class="time_for_opning mb-1">{{ $ad->engine }} cc</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">{{ __('msg.Color') }}</p>
                            <p class="time_for_opning mb-1">{{ $ad->color }}</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">{{ __('msg.Registered On') }}</p>
                            <p class="time_for_opning mb-1">{{ $ad->modelYear->model_year }}</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">{{ __('msg.Total Mileage') }}</p>
                            <p class="time_for_opning mb-1">{{ $ad->mileage }} {{ __('msg.Km') }}</p>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        @if (Auth::guard('web')->check())
                            <a @if (isset($ad->vendor_id)) href="{{ url('user/chat/' . $ad->vendor_id) }}" @else @if ($ad->user_id == Auth::guard('web')->id())
                                onclick="customer()"
                            @else
                            href="{{ url('user/customerChat/' . $ad->user_id) }}" @endif
                                @endif
                                class="btn btn-primary get_appointment">{{ __('msg.CONTACT VIA MESSAGE') }}
                                <img src="{{ asset('public/assets/images/messageicon.svg') }}">
                            </a>
                        @elseif(Auth::guard('vendor')->check())
                            <a @if (isset($ad->user_id)) href="{{ url('vendor/chat/' . $ad->user_id) }}" @else onclick="vendor()" href="#" @endif
                                class="btn btn-primary get_appointment">{{ __('msg.CONTACT VIA MESSAGE') }}
                                <img src="{{ asset('public/assets/images/messageicon.svg') }}">
                            </a>
                        @else
                            <a onclick="myFunction()"
                                class="btn btn-primary get_appointment">{{ __('msg.CONTACT VIA MESSAGE') }}
                                <img src="{{ asset('public/assets/images/messageicon.svg') }}">
                            </a>
                        @endif
                    </div>
                    @if (isset($ad->vendor_id))
                        <div class="d-grid gap-2 mt-3">
                            <button class="d-block btn btn-primary get_appointment byCall heart" type="button">
                                <span class="d-block h-100"><a href="tel: {{ $ad->vendor->phone }}"
                                        class="text-white h-100 d-flex align-items-center justify-content-center">{{ __('msg.CONTACT VIA PHONE') }}</a></span>
                                <span class="d-none h-100"><a href="tel: {{ $ad->vendor->phone }}"
                                        class="text-white h-100 d-flex align-items-center justify-content-center">{{ $ad->vendor->phone }}</a></span>
                                <a href="tel: {{ $ad->vendor->phone }}"><img
                                        src="{{ asset('public/assets/images/appoinmenticon.svg') }}"></a>
                            </button>
                        </div>
                    @if (isset($ad->vendor->landline_no))
                        <div class="d-grid gap-2 mt-3">
                            <button class="d-block btn btn-primary get_appointment byCall heart" type="button">
                                <span class="d-block h-100"><a href="tel: {{ $ad->vendor->landline_no }}"
                                        class="text-white h-100 d-flex align-items-center justify-content-center">{{ __('msg.CONTACT VIA LANDLINE') }}</a></span>
                                <span class="d-none h-100"><a href="tel: {{ $ad->vendor->landline_no }}"
                                        class="text-white h-100 d-flex align-items-center justify-content-center">{{ $ad->vendor->landline_no }}</a></span>
                                <a href="tel: {{ $ad->vendor->landline_no }}"><img
                                        src="{{ asset('public/assets/images/appoinmenticon.svg') }}"></a>
                            </button>
                        </div>
                    @endif
                    @endif
                    @if (isset($ad->user_id))
                        <div class="d-grid gap-2 mt-3">
                            <button class="d-block btn btn-primary get_appointment byCall heart" type="button">
                                <span class="d-block h-100"><a href="tel: {{ $ad->user->phone }}"
                                        class="text-white h-100 d-flex align-items-center justify-content-center">{{ __('msg.CONTACT VIA PHONE') }}</a></span>
                                <span class="d-none h-100"><a href="tel: {{ $ad->user->phone }}"
                                        class="text-white h-100 d-flex align-items-center justify-content-center">{{ $ad->user->phone }}</a></span>
                                <a href="tel: {{ $ad->user->phone }}"><img
                                        src="{{ asset('public/assets/images/appoinmenticon.svg') }}"></a>
                            </button>
                        </div>
                        @if (isset($ad->user->landline_no))
                        <div class="d-grid gap-2 mt-3">
                            <button class="d-block btn btn-primary get_appointment byCall heart" type="button">
                                <span class="d-block h-100"><a href="tel: {{ $ad->user->landline_no }}"
                                        class="text-white h-100 d-flex align-items-center justify-content-center">{{ __('msg.CONTACT VIA LANDLINE') }}</a></span>
                                <span class="d-none h-100"><a href="tel: {{ $ad->user->landline_no }}"
                                        class="text-white h-100 d-flex align-items-center justify-content-center">{{ $ad->user->landline_no }}</a></span>
                                <a href="tel: {{ $ad->user->landline_no }}"><img
                                        src="{{ asset('public/assets/images/appoinmenticon.svg') }}"></a>
                            </button>
                        </div>
                    @endif
                    @endif
                </div>

            </div>

        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function() {
            $('#carImages, #carDocs').lightGallery({
                clone: false,
                share: false
            });
        });

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

        function myFunction() {
            toastr.warning('Please login first');
        }

        function customer() {
            toastr.warning("You can't communicate to Your self");
        }

        function vendor() {
            toastr.warning('You can not communicate to other Vendor');
        }
    </script>
@endsection
