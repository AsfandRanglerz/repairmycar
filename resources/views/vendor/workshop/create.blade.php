@extends('web.layout.app')

@section('content')
    <section class="pb-5 login_content_wraper"
        style="background-image:url({{ asset('public/assets/images/gradiantbg.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-3">{{ __('msg.CREATE_WORKSHOP') }}</h4>
                        <p class="sec_main_para text-center">{{ __('msg.Set Up How Your Workshop Looks Like') }}</p>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-8 col-md-11  mx-auto">
                    <div class="bid_form_wraper">
                        <div class="row">
                            <div class="col-lg-8 mx-auto px-5 px-lg-1">
                                <ul class="nav nav-tabs " id="myTab" role="tablist">
                                    <li class="nav-item nav_item_li vendor_creatworkoshop " role="presentation">
                                        <button class="nav-link active tab_btns" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true"></button>
                                    </li>
                                    <li class="nav-item nav_item_li vendor_creatworkoshop" role="presentation">
                                        <button class="nav-link tab_btns" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                            aria-selected="false"></button>
                                    </li>
                                    <li class="nav-item nav_item_li vendor_creatworkoshop" role="presentation">
                                        <button class="nav-link tab_btns" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                            aria-selected="false"></button>
                                    </li>
                                </ul>
                                <div class="col-lg-9 mx-auto">
                                    <p class=" request_quote_heading">{{ __('msg.Garage INFORMATION') }}</p>
                                </div>
                            </div>
                            <form enctype="multipart/form-data" method="post"
                                action="{{ route('vendor.garage.store') }}">
                                @csrf
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active form-step form-step-active" id="home"
                                        role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row g-lg-3 g-2">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" name="garage_name"
                                                    value="{{ $authvendor->garage_name }}" class="form-control"
                                                    placeholder="{{ __('msg.Workshop Name') }} ({{__('msg.Required')}})">
                                                @error('garage_name')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" name="address"
                                                    value="{{ $authvendor->billing_address }}" class="form-control"
                                                    placeholder="{{ __('msg.Address') }} ({{__('msg.Required')}})">
                                                @error('address')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="email" name="email" class="form-control" readonly
                                                    value="{{ $authvendor->email }}">
                                                <input type="hidden" name="vendor_id" class="form-control" 
                                                    value="{{ $authvendor->id }}">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" name="phone" value="{{ $authvendor->phone }}"
                                                    class="form-control"  placeholder="971421108000 ({{__('msg.Required')}})" onkeypress="if(this.value.length==12) return false">
                                                @error('phone')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" class="form-control" value="United Arab Emirates"
                                                    name="country" aria-label="Country" readonly>
                                                @error('country')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <select class="form-select form-control" name="city" aria-label="City">
                                                    <option value="Dubai"
                                                        @if ($authvendor->city == 'Dubai') selected @endif>
                                                        {{ __('msg.Dubai') }}</option>
                                                    <option value="Abu Dhabi"
                                                        @if ($authvendor->city == 'Abu Dhabi') selected @endif>
                                                        {{ __('msg.Abu Dhabi') }}</option>
                                                    <option value="Sharjah"
                                                        @if ($authvendor->city == 'Sharjah') selected @endif>
                                                        {{ __('msg.Sharjah') }}</option>
                                                    <option value="Ras Al Khaimah"
                                                        @if ($authvendor->city == 'Ras Al Khaimah') selected @endif>
                                                        {{ __('msg.Ras Al Khaimah') }}</option>
                                                    <option value="Ajman"
                                                        @if ($authvendor->city == 'Ajman') selected @endif>
                                                        {{ __('msg.Ajman') }}</option>
                                                </select>
                                                @error('city')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="number" name="post_box"
                                                    value="{{ $authvendor->post_box }}" class="form-control"
                                                    placeholder="{{ __('msg.P/O Box') }} ({{__('msg.Required')}})">
                                                @error('post_box')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <!-- multiple name="animals" id="animals" class="filter-multi-select" -->

                                                <select class="form-select form-control garage-services-offer"
                                                    name="category[]" multiple aria-label="Type of Service" placeholder="">
                                                    @foreach ($categories as $data1)
                                                        {{-- <option value="{{$data1->id}}"  @if (in_array($data1->name, explode(',', $authvendor->garages_catagory))) selected @endif>{{$data1->name }}</option> --}}
                                                        <option value="{{$data1->id}}"  {{ (collect(explode(',', $authvendor->garages_catagory))->contains($data1->name)) ? 'selected':'' }}>{{$data1->name }}</option>
                                                    {{ $data1->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" name="trading_no"
                                                    value="{{ $authvendor->trading_license }}" class="form-control"
                                                    placeholder="{{ __('msg.Trading License No.') }} ({{__('msg.Required')}})">
                                                @error('trading_no')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" name="vat" value="{{ $authvendor->vat }}% VAT"
                                                    class="form-control" placeholder="{{ __('msg.VAT Details') }} ({{__('msg.Required')}})" readonly>
                                                @error('vat')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="d-grid gap-2 mt-3 mb-4">
                                                    <button class="btn btn-secondary block get_appointment next-tab-btn"
                                                        type="button">{{ __('msg.NEXT') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="over_view_part timing_hours mape_wraper mt-4">
                                                    <h5 class=" text-center mb-5">{{ __('msg.Google Maps') }}</h5>
                                                    <div
                                                        class="input-group mb-3 mx-lg-5 mx-md-3 mx-1 search_garages_wraper vendor_crt_wrkshop">
                                                        <input type="text"
                                                            class="form-control search_garages creat_wrk"
                                                            placeholder="Search For Your Next Car"
                                                            aria-label="Recipient's username"
                                                            aria-describedby="button-addon2">
                                                        <button class="btn search crt_wrik" type="button"
                                                            id="button-addon2">{{ __('msg.SEARCH') }}</button>
                                                        <div class="srearch_icon_wraper crt_wrk_shp">
                                                            <span class="fa fa-location" aria-hidden="true"></span>
                                                            <!-- <img src="{{ asset('public/assets/images/location-icon.svg') }}"> -->
                                                        </div>
                                                    </div>

                                                    <div class="responsive-map">
                                                        <iframe
                                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2822.7806761080233!2d-93.29138368446431!3d44.96844997909819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x52b32b6ee2c87c91%3A0xc20dff2748d2bd92!2sWalker+Art+Center!5e0!3m2!1sen!2sus!4v1514524647889"
                                                            height="550" frameborder="0" style="border:0"
                                                            allowfullscreen>
                                                        </iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade form-step" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="row g-lg-3 g-2">
                                            <div class="col-lg-12 mb-3">
                                                <div class="input-images-4">
                                                </div>

                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="description" maxlength="880" placeholder="Add information in details ({{__('msg.Optional')}})" id="floatingTextarea2"
                                                        style="height: 106px"></textarea>
                                                    <label
                                                        for="floatingTextarea2">{{ __('msg.Add overview in detail') }}  ({{__('msg.Optional')}})</label>
                                                    @error('description')
                                                        <div class="text-danger p-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="d-grid gap-2 mt-3 mb-4">
                                                    <button class="btn btn-secondary block get_appointment next-tab-btn"
                                                        type="button">{{ __('msg.NEXT') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade form-step" id="contact" role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        <h5 class="heading-color text-center mb-4">{{ __('msg.Timings') }} ({{__('msg.Optional')}})</h5>
                                        <div class="row mb-3 align-items-center justify-content-center">
                                            <label for="inputEmail3"
                                                class="col-lg-2 mb-3 col-md-2 col-sm-3 col-form-label activeDaylabel">{{ __('msg.Monday') }}</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="hidden" name="day[]" value="Monday">
                                                <input name="from[]" type="text" class="form-control"
                                                    placeholder="{{ __('msg.From: 10:00 Am') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input name="to[]" type="text" class="form-control"
                                                    placeholder="{{ __('msg.To: 06:00 Pm') }}" id="">

                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3">
                                                <div
                                                    class="form-check crt_wrkshop d-flex justify-content-between align-items-center">
                                                    <label class="form-check-label"
                                                        for="autoSizingCheck">{{ __('msg.Closed:') }}</label>
                                                    <input name="closed[0]" class="form-check-input wrk_day_chek"
                                                        type="checkbox" id="autoSizingCheck">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center justify-content-center">
                                            <label for="inputEmail3"
                                                class="col-lg-2 mb-3 col-md-2 col-sm-3 col-form-label activeDaylabel">{{ __('msg.Tuesday') }}</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="hidden" name="day[]" value="Tuesday">
                                                <input type="text" name="from[]" class="form-control"
                                                    placeholder="{{ __('msg.From: 10:00 Am') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="text" name="to[]" class="form-control"
                                                    placeholder="{{ __('msg.To: 06:00 Pm') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3">
                                                <div
                                                    class="form-check crt_wrkshop d-flex justify-content-between align-items-center">
                                                    <label class="form-check-label"
                                                        for="autoSizingCheck">{{ __('msg.Closed:') }}</label>
                                                    <input class="form-check-input wrk_day_chek" name="closed[1]"
                                                        type="checkbox" id="autoSizingCheck">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center justify-content-center">
                                            <label for="inputEmail3"
                                                class="col-lg-2 mb-3 col-md-2 col-sm-3 col-form-label activeDaylabel">{{ __('msg.Wednesday') }}</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="hidden" name="day[]" value="Wednesday">
                                                <input type="text" name="from[]" class="form-control"
                                                    placeholder="{{ __('msg.From: 10:00 Am') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="text" name="to[]" class="form-control"
                                                    placeholder="{{ __('msg.To: 06:00 Pm') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3">
                                                <div
                                                    class="form-check crt_wrkshop d-flex justify-content-between align-items-center">
                                                    <label class="form-check-label"
                                                        for="autoSizingCheck">{{ __('msg.Closed:') }}</label>
                                                    <input class="form-check-input wrk_day_chek" name="closed[2]"
                                                        type="checkbox" id="autoSizingCheck">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center justify-content-center">
                                            <label for="inputEmail3"
                                                class="col-lg-2 mb-3 col-md-2 col-sm-3 col-form-label activeDaylabel">{{ __('msg.Thursday') }}</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="hidden" name="day[]" value="Thursday">
                                                <input type="text" name="from[]" class="form-control"
                                                    placeholder="{{ __('msg.From: 10:00 Am') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="text" name="to[]" class="form-control"
                                                    placeholder="{{ __('msg.To: 06:00 Pm') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3">
                                                <div
                                                    class="form-check crt_wrkshop d-flex justify-content-between align-items-center">
                                                    <label class="form-check-label"
                                                        for="autoSizingCheck">{{ __('msg.Closed:') }}</label>
                                                    <input class="form-check-input wrk_day_chek" name="closed[3]"
                                                        type="checkbox" id="autoSizingCheck">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center justify-content-center">
                                            <label for="inputEmail3"
                                                class="col-lg-2 mb-3 col-md-2 col-sm-3 col-form-label activeDaylabel">{{ __('msg.Friday') }}</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="hidden" name="day[]" value="Friday">
                                                <input type="text" name="from[]" class="form-control"
                                                    placeholder="{{ __('msg.From: 10:00 Am') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="text" name="to[]" class="form-control"
                                                    placeholder="{{ __('msg.To: 06:00 Pm') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3">
                                                <div
                                                    class="form-check crt_wrkshop d-flex justify-content-between align-items-center">
                                                    <label class="form-check-label"
                                                        for="autoSizingCheck">{{ __('msg.Closed:') }}</label>
                                                    <input class="form-check-input wrk_day_chek" name="closed[4]"
                                                        type="checkbox" id="autoSizingCheck">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center justify-content-center">
                                            <label for="inputEmail3"
                                                class="col-lg-2 mb-3 col-md-2 col-sm-3 col-form-label activeDaylabel">{{ __('msg.Saturday') }}</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="hidden" name="day[]" value="Saturday ">
                                                <input type="text" name="from[]" class="form-control"
                                                    placeholder="{{ __('msg.From: 10:00 Am') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="text" name="to[]" class="form-control"
                                                    placeholder="{{ __('msg.To: 06:00 Pm') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3">
                                                <div
                                                    class="form-check crt_wrkshop d-flex justify-content-between align-items-center">
                                                    <label class="form-check-label"
                                                        for="autoSizingCheck">{{ __('msg.Closed:') }}</label>
                                                    <input class="form-check-input wrk_day_chek" name="closed[5]"
                                                        type="checkbox" id="autoSizingCheck">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center justify-content-center">
                                            <label for="inputEmail3"
                                                class="col-lg-2 mb-3 col-md-2 col-sm-3 col-form-label activeDaylabel">{{ __('msg.Sunday') }}</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="hidden" name="day[]" value="Sunday">
                                                <input type="text" name="from[]" class="form-control"
                                                    placeholder="{{ __('msg.From: 10:00 Am') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3 crt_wrkshop">
                                                <input type="text" name="to[]" class="form-control"
                                                    placeholder="{{ __('msg.To: 06:00 Pm') }}" id="">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3">
                                                <div
                                                    class="form-check crt_wrkshop d-flex justify-content-between align-items-center">
                                                    <label class="form-check-label"
                                                        for="autoSizingCheck">{{ __('msg.Closed:') }}</label>
                                                    <input class="form-check-input wrk_day_chek" name="closed[6]"
                                                        type="checkbox" id="autoSizingCheck">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-grid gap-2 mt-3 mb-4">
                                                <button class="btn btn-secondary block get_appointment next-tab-btn"
                                                    type="submit">{{ __('msg.NEXT') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        const nextBtns = document.querySelectorAll(".btn-secondary");
        const formSteps = document.querySelectorAll(".form-step");


        let formStepsNum = 0;

        nextBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                formStepsNum++;
                updateFormSteps();
            });
        });


        function updateFormSteps() {

            formSteps.forEach((formStep) => {
                formStep.classList.contains("form-step-active") &&
                    formStep.classList.remove("form-step-active");
            });

            formSteps[formStepsNum].classList.add("form-step-active");
        }
    </script>
@endsection
