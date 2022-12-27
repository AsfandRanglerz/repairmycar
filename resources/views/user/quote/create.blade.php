@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-3">{{ __('msg.REQUEST QUOTE') }}</h4>
                        <!-- <p class="sec_main_para text-center">See what's happening on your profile</p> -->
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-8 col-md-11  mx-auto">
                    <div class="bid_form_wraper">
                        <div class="row">
                            <div class="col-lg-8 mx-auto px-5 px-lg-1 ">
                                <ul class="nav nav-tabs " id="myTab" role="tablist">
                                    <li class="nav-item nav_item_li" role="presentation">
                                        <button class="nav-link active tab_btns" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true"></button>
                                    </li>
                                    <li class="nav-item nav_item_li" role="presentation">
                                        <button class="nav-link tab_btns" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                            aria-selected="false" disabled></button>
                                    </li>
                                    <li class="nav-item nav_item_li d-none" role="presentation">
                                        <button class="nav-link tab_btns" id="inspection-report-link" data-bs-toggle="tab"
                                            data-bs-target="#inspectionReport" type="button" role="tab"
                                            aria-controls="inspectionReport" aria-selected="false" disabled></button>
                                    </li>
                                    <li class="nav-item nav_item_li" role="presentation">
                                        <button class="nav-link tab_btns " id="fourth-tab" data-bs-toggle="tab"
                                            data-bs-target="#fourthtab" type="button" role="tab"
                                            aria-controls="contact" aria-selected="false" disabled></button>
                                    </li>
                                </ul>
                                <div class="col-lg-9 mx-auto">
                                    <p class=" request_quote_heading">{{ __('msg.CAR INFORMATION') }}</p>
                                </div>
                            </div>
                            <form enctype="multipart/form-data" name="requestQuote" method="post"
                                action="{{ route('user.quotestore') }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active form-step form-step-active" id="home"
                                        role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row g-lg-3 g-2">
                                            <div class="col-12 form-group">
                                                <select name="looking_for" class="form-select form-control" id="lookingFor">
                                                    <option value="" selected disabled>
                                                        {{ __('msg.What are you looking for? (Required)') }}</option>
                                                    <option value="I have Inspection Report & Looking for the Quotations"
                                                        @if (old('looking_for') == 'I have Inspection Report & Looking for the Quotations') selected @endif>
                                                        {{ __('msg.I have Inspection Report & Looking for the Quotation') }}
                                                    </option>
                                                    <option
                                                        value="I don't know the Problem and Requesting for the Inspection"
                                                        @if (old('looking_for') == "I don't know the Problem and Requesting for the Inspection") selected @endif>
                                                        {{ __("msg.I don't know the Problem and Requesting for the Inspection") }}
                                                    </option>
                                                    <option
                                                        value="I know about what i'm looking for and requesting for the Quotations"
                                                        @if (old('looking_for') == "I know about what i'm looking for and requesting for the Quotations") selected @endif>
                                                        {{ __("msg.I know about what i'm looking for and requesting for the Quotation") }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <select class="form-select form-control company-name-field"id="company"
                                                    name="company_id" aria-label="Type of Service" required>
                                                    <option value="" selected disabled>
                                                        {{ __('msg.Manufacturer/Brand') }}
                                                        ({{ __('msg.Required') }})</option>
                                                    @foreach ($company as $data)
                                                        <option value="{{ $data->id }}"
                                                            @if (old('company_id') == $data->id) selected @endif>
                                                            {{ $data->company }}</option>
                                                    @endforeach
                                                </select>
                                                @error('company_id')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 form-group" id="car_model">
                                                <select class="form-select form-control company-name-field" name="model" aria-label="car model" required>
                                                    <option value="" selected disabled>
                                                        {{ __('msg.Model') }}
                                                        ({{ __('msg.Required') }})</option>
                                                    @foreach ($model as $data)
                                                        <option value="{{ $data->car_model }}"
                                                            @if (old('company_id') == $data->car_model) selected @endif>
                                                            {{ $data->car_model }}</option>
                                                    @endforeach
                                                </select>
                                                @error('model')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <input type="text" class="form-control"
                                                    value="{{ old('registration_no') }}" name="registration_no"
                                                    placeholder="{{ __('msg.Registration No.') }} ({{ __('msg.Required') }})"
                                                    aria-label="Car Milage">
                                                @error('registration_no')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <input type="text" class="form-control"
                                                    value="{{ old('Chasis_no') }}" name="Chasis_no"
                                                    placeholder="{{ __('msg.Chasis No.') }} ({{ __('msg.Required') }})"
                                                    aria-label="Car Milage">
                                                @error('Chasis_no')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <input type="text" class="form-control" name="color"
                                                    value="{{ old('color') }}"
                                                    placeholder="{{ __('msg.Color') }} ({{ __('msg.Required') }})"
                                                    aria-label="Car Milage">
                                                @error('color')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <select class="form-select form-control model-year-field"
                                                    name="model_year_id" aria-label="Type of Service" required>
                                                    <option value="" selected disabled>{{ __('msg.Model Year') }}
                                                        ({{ __('msg.Required') }})</option>
                                                    @foreach ($year as $data)
                                                        <option value="{{ $data->id }}"
                                                            @if (old('model_year_id') == $data->id) selected @endif>
                                                            {{ $data->model_year }}</option>
                                                    @endforeach
                                                </select>
                                                @error('model_year_id')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- <div class="col-lg-6 col-md-6 form-group">
                                                  <input type="text" class="form-control" placeholder="Timeline For Work" aria-label="Timeline For Work">
                                                </div> -->
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <input type="number" class="form-control" name="mileage"
                                                    value="{{ old('mileage') }}"
                                                    placeholder="{{ __('msg.Mileage e.g 40 Km') }} ({{ __('msg.Required') }})"
                                                    aria-label="Car Milage" required>
                                                @error('mileage')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <input type="number" class="form-control" name="day"
                                                    value="{{ old('day') }}"
                                                    placeholder="{{ __('msg.Days e.g (7)') }} ({{ __('msg.Optional') }})"
                                                    aria-label="Day">
                                                @error('day')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 form-group services-dropdown-block">
                                                <select class="form-select form-control garage-services" name="category[]"
                                                    multiple required aria-label="Type of Service" required>
                                                    @foreach ($catagary as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12">
                                                <textarea name="description1" placeholder="{{ __('msg.Add information in details') }} ({{ __('msg.Optional') }})"
                                                    class="form-control" rows="5">{{ old('description1') }}</textarea>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="d-grid gap-2 mt-3 mb-4">
                                                    <button class="btn btn-secondary block get_appointment next-tab-btn"
                                                        type="button">{{ __('msg.NEXT') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade form-step px-lg-3" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="row g-lg-3 g-2">
                                            <div class="col-lg-12 mb-3 form-group">
                                                <label class="mb-2 heading-color"><b>{{ __('msg.Upload image(s) of the car') }} ({{ __('msg.Required') }}) <br><small>
                                                            ({{ __('msg.Click the box again to upload another') }})</small></b></label>
                                                <div class="input-images">
                                                    {{-- input field name  car_images --}}

                                                </div>
                                                @error('car_images')
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
                                    </div>
                                    <div class="tab-pane fade form-step px-lg-3" id="inspectionReport" role="tabpanel"
                                        aria-labelledby="inspection-report-link">
                                        <div class="row g-lg-3 g-2">
                                            <div class="col-lg-12 mb-3 form-group">
                                                <label class="mb-2 heading-color"><b>{{ __('msg.Upload Document') }}
                                                        <small>({{ __('msg.Upload Up to 5 PDF/Image') }})</small></b></label>
                                                <div class="input-images-2">
                                                    {{-- input field name files --}}
                                                </div>
                                                @error('files')
                                                    <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12">
                                                <textarea name="description2" placeholder="{{ __('msg.Special Requirements') }} ({{ __('msg.Optional') }})"
                                                    class="form-control" rows="5">{{ old('description2') }}</textarea>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="d-grid gap-2 mt-3 mb-4">
                                                    <button class="btn btn-secondary block get_appointment next-tab-btn"
                                                        type="button">{{ __('msg.NEXT') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade form-step px-lg-3" id="fourthtab" role="tabpanel"
                                        aria-labelledby="fourth-tab">
                                        <div class="row g-lg-3 g-2">
                                            <div class="row g-2 col-lg-12 mb-3 form-group">
                                                <label class="heading-color"><b>{{ __('msg.Upload upto 5 images') }}<small>
                                                            ({{ __('msg.Click the box again to upload another') }})</small></b></label>
                                                <div class="input-images-3"></div>
                                                {{-- input field name doucment --}}
                                            </div>
                                            @error('document')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                            <div class="row g-2">
                                                <div class="col-lg-6 col-md-6 form-group">
                                                    <input type="text" class="form-control"
                                                        value="{{ \Illuminate\Support\Facades\Auth::user()->name }}"
                                                        name="maker_name" placeholder="Name" aria-label="Make" required
                                                        readonly>
                                                    @error('name')
                                                        <div class="text-danger p-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 col-md-6 form-group">
                                                    <input type="email" name="email" class="form-control" readonly
                                                        value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div style="position: relative">
                                                        <input type="text" class="form-control address-field"
                                                            name="address"
                                                            value="{{ old('address') }}"
                                                            placeholder="{{ __('msg.Address') }}" aria-label="Car Milage"
                                                            style="padding-right: 2rem" required>
                                                        <span class="fa fa-location" aria-hidden="true"
                                                            style="position: absolute;top: 10px;right: 10px"></span>
                                                    </div>
                                                    @error('address')
                                                        <div class="text-danger p-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <select class="form-select form-control" name="qoute_range" required>
                                                        <option value="" selected disabled>
                                                            {{ __('msg.Select Garages Range') }}</option>
                                                        <option value="all">All</option>
                                                        <option value="5">Top 5</option>
                                                        <option value="10">Top 10</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-12 get-quotes-block">
                                                    <div class="d-grid gap-2 mt-lg-3 mb-lg-4">
                                                        <button class="btn btn-secondary block get_appointment"
                                                            name="action" value="all_garage"
                                                            type="submit">{{ __('msg.GET QUOTES FROM GARAGES') }}</button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12 get-quotes-block">
                                                    <div class="d-grid gap-2 mt-lg-3 mb-4">
                                                        <button
                                                            class="btn text-center btn-primary get_quot block get_appointment"
                                                            name="action" value="preferred_garage"
                                                            type="submit">{{ __('msg.GET QUOTES FROM PREFERRED GARAGES') }}</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-none" id="requestForInspection">
                                                    <div align="center" class="mt-3">
                                                        <button
                                                            class="btn text-center btn-primary get_quot block get_appointment"
                                                            name="action" value="all_garage"
                                                            type="submit">{{ __('msg.SEND REQUEST FOR INSPECTION') }}</button>
                                                    </div>
                                                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function() {
            $("#company").change(function() {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    url: "{{ route('user.company-model') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#car_model').empty();
                        $('#car_model').append(response.data);
                    }
                });
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
        $(function() {
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            var validator = $("form[name='requestQuote']").validate({
                ignore: [],
                onfocusout: function(element) {
                    var $element = $(element);
                    if ($element.hasClass('select2-search__field')) {
                        $element2 = $element.closest('.form-group').find('select');
                        if (!$element2.prop('required') && $element2.val() == '') {
                            $element.removeClass('is-valid');
                        } else {
                            this.element($element2)
                        }
                    } else if (!$element.prop('required') && ($element.val() == '' || $element.val() ==
                            null)) {
                        $element.removeClass('is-valid');
                    } else {
                        this.element(element)
                    }
                },
                onkeyup: function(element) {
                    var $element = $(element);
                    if ($element.hasClass('select2-search__field')) {
                        $element.closest('.form-group').find('select').valid();
                    } else {
                        $element.valid();
                    }
                },
                rules: {
                    looking_for: "required",
                    model: "required",
                    company_id: "required",
                    registration_no: "required",
                    Chasis_no: "required",
                    color: "required",
                    model_year_id: "required",
                    mileage: "required",
                    "car_images[]": "required",
                    "document[]": "required"
                },
                messages: {
                    // business_type: "Please select your business type",
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                highlight: function(element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-group').find('input').addClass(errorClass);
                        elem.closest('.form-group').find('input').removeClass(validClass);
                        elem.closest('.form-group').find('span.select2-selection').addClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').removeClass(
                            validClass);
                    } else {
                        elem.addClass(errorClass);
                    }
                },
                unhighlight: function(element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-group').find('input').addClass(validClass);
                        elem.closest('.form-group').find('input').removeClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').removeClass(
                            errorClass);
                        elem.closest('.form-group').find('span.select2-selection').addClass(validClass);
                    } else {
                        elem.removeClass(errorClass);
                        elem.addClass(validClass);
                    }
                },
                errorPlacement: function(error, element) {
                    var elem = $(element);
                    console.log(elem);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        var element2 = elem.closest('.form-group').find('.select2-container');
                        error.insertAfter(element2);
                    } else if (elem.closest('.form-group').find('div').hasClass('image-uploader')) {
                        var element2 = elem.closest('.form-group').find('.image-uploader');
                        error.insertAfter(element2);
                    } else if (elem.hasClass('inteltel')) {
                        var element2 = elem.closest('.iti');
                        error.insertAfter(element2);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('.next-tab-btn').on('click', function() {
                if (!$(
                        "form[name='requestQuote'] .active .form-control, form[name='requestQuote'] .active input"
                        )
                    .valid()) {
                    setTimeout(() => {
                        var navbarHeight = $('.navbar').innerHeight();
                        $('html,body').animate({
                                scrollTop: $('.error:not(:empty)').eq(0).closest('.form-group')
                                    .offset().top - (navbarHeight)
                            },
                            'slow');
                    }, 500);
                    if ($('input.error:first, select.error:first, .select2-selection.error:first').closest(
                            '.tab-pane').hasClass('show')) {
                        // alert("Enter the missing data");
                        return false;
                    } else {
                        return true;
                    }
                }
            });
        });

        const nextBtns = document.querySelectorAll(".btn-secondary");
        // const progress = document.getElementById("progress");
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

        $(function() {
            // $('#lookingFor').select2({
            //     placeholder: "{{ __('msg.What are you looking for? (Required)') }}",
            // });
            lookingFor();
            $('#lookingFor').change(function() {
                lookingFor();
            });
            // $('#lookingFor').on('select2:select', function() {
            //     lookingFor();
            // });

            function lookingFor() {
                var val = $('#lookingFor').val();
                let valOne = "I have Inspection Report & Looking for the Quotations";
                let valTwo = "I don't know the Problem and Requesting for the Inspection";
                let valThree = "I know about what i'm looking for and requesting for the Quotations";
                if (val == valOne) {
                    $('.services-dropdown-block').removeClass('d-none');
                    $('#inspection-report-link').closest('li').removeClass('d-none');
                    $('#requestForInspection').addClass('d-none');
                    $('.get-quotes-block').removeClass('d-none');
                    $('.garage-services').prop('required', true);
                } else if (val == valTwo) {
                    $('.services-dropdown-block').addClass('d-none');
                    $('#inspection-report-link').closest('li').addClass('d-none');
                    $('#requestForInspection').removeClass('d-none');
                    $('.get-quotes-block').addClass('d-none');
                    $('.garage-services').prop('required', false);
                } else if (val == valThree) {
                    $('.garage-services').prop('required', false);
                } else {
                    $('#inspection-report-link').closest('li').addClass('d-none');
                    $('.services-dropdown-block').removeClass('d-none');
                    $('#requestForInspection').addClass('d-none');
                    $('.get-quotes-block').removeClass('d-none');
                }
            }
            $('.next-tab-btn').on('click', function() {
                var val = $('#lookingFor').val();
                let valOne = "I have Inspection Report & Looking for the Quotations";
                let valTwo = "I don't know the Problem and Requesting for the Inspection";
                let valThree = "I know about what i'm looking for and requesting for the Quotations";
                if (val == valTwo || val == valThree) {
                    if ($('#profile').hasClass('active') && $('.uploaded .uploaded-image').length == 1) {
                        setTimeout(() => {
                            $('#inspectionReport').removeClass('show active');
                        }, 50);
                        $('#fourthtab').addClass('show active');
                    }
                }
                setTimeout(() => {
                    if ($('div[aria-labelledby="home-tab"]').hasClass('active')) {
                        $('#home-tab').addClass('active');
                    } else if ($('div[aria-labelledby="profile-tab"]').hasClass('active')) {
                        $('#profile-tab').addClass('active').removeAttr('disabled');
                    } else if ($('div[aria-labelledby="inspection-report-link"]').hasClass(
                            'active')) {
                        $('#inspection-report-link').addClass('active').removeAttr('disabled');
                    } else if ($('div[aria-labelledby="fourth-tab"]').hasClass('active')) {
                        $('#fourth-tab').addClass('active').removeAttr('disabled');
                    }
                }, 50);
            });

            setInterval(() => {
                /*Car Image*/
                if (!$('input[name="car_images[]"]').val() == "") {
                    $('label[for="car_images[]"]').empty().hide();
                    $('input[name="car_images[]"]').removeClass('is-invalid error').addClass('is-valid');
                } else {
                    $('label[for="car_images[]"]').text("This field is required.").show();
                    $('input[name="car_images[]"]').removeClass('is-valid').addClass('is-invalid error');
                }
                if ($('.uploaded .uploaded-image').length == 0) {
                    $('label[for="car_images[]"]').text("This field is required.").show();
                    $('input[name="car_images[]"]').removeClass('is-valid').addClass('is-invalid error');
                    $('input[name="car_images[]"]').val('');
                }
                /*Car Image*/

                /*Upload Police/Accident/Inspection Report*/
                if (!$('input[name="files"]').val() == "") {
                    $('label[for="files"]').empty().hide();
                    $('input[name="files"]').removeClass('is-invalid error').addClass('is-valid');
                } else {
                    $('label[for="files"]').text("This field is required.").show();
                    $('input[name="files"]').removeClass('is-valid').addClass('is-invalid error');
                }
                if ($('input[name="files"]').closest('.image-uploader').find('.uploaded .uploaded-image')
                    .length == 0) {
                    $('label[for="files"]').text("This field is required.").show();
                    $('input[name="files"]').removeClass('is-valid').addClass('is-invalid error');
                    $('input[name="files"]').val('');
                }
                /*Upload Police/Accident/Inspection Report*/

                /*Registration Copy Image*/
                if (!$('input[name="document[]"]').val() == "") {
                    $('label[for="document[]"]').empty().hide();
                    $('input[name="document[]"]').removeClass('is-invalid error').addClass('is-valid');
                } else {
                    $('label[for="document[]"]').text("This field is required.").show();
                    $('input[name="document[]"]').removeClass('is-valid').addClass('is-invalid error');
                }
                if ($('input[name="document[]"]').closest('.image-uploader').find(
                        '.uploaded .uploaded-image').length == 0) {
                    $('label[for="document[]"]').text("This field is required.").show();
                    $('input[name="document[]"]').removeClass('is-valid').addClass('is-invalid error');
                    $('input[name="document[]"]').val('');
                }
                /*Registration Copy Image*/
            }, 500);
        });
    </script>
@endsection
