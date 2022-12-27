@extends('vendor.layout.app')
@section('content')
    <style>
        .insurance-company+.select2 {
            width: 100% !important;
        }
    </style>
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-9 mx-auto">
                    <div class="cuatomer_signup_form_wraper mt-5">
                        <div class="main_content_wraper">
                            <h4 class="sec_main_heading text-center mb-0">{{ __('msg.edit') }}</h4>
                            <p class="sec_main_para text-center mb-0">{{ __('msg.Edit your profile details') }}</p>
                        </div>
                        <form action="{{ route('vendor.profile.update', $profile->id) }}" method="post"
                            enctype="multipart/form-data" class="pt-4">
                            @csrf
                            @method('put')
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading-color">{{ __('msg.Profile Picture') }}</h5>
                            </div>
                            <div class="col-12 mb-3  signup_input_wraper">
                                <div id="profileImage">
                                </div>
                            </div>
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading-color">{{ __('msg.Your ID') }}</h5>
                            </div>
                            <div class="col-12 mb-3  signup_input_wraper">
                                <div id="id_card">
                                </div>
                            </div>


                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading-color">{{ __('msg.Business Info') }}</h5>
                            </div>

                            <div class="col-12 mb-3  signup_input_wraper">
                                <input type="text" name="name" value="{{ $profile->name }}" class="form-control"
                                    id="inputName" placeholder="Owner Name">
                                @error('name')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <input type="email" name="email" value="{{ $profile->email }}"class="form-control"
                                    id="inputEmail" placeholder="Email" readonly>
                                @error('email')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <select class="form-select form-control insurance-company insurance-company-multiple"
                                    name="company[]" aria-label="company" value="" multiple="multiple">
                                    @foreach ($company as $data)
                                        <option value="{{ $data->id }}"
                                            @if (isset($profile->company[0])) @foreach ($profile->company as $company)
                                            @if ($company->name == $data->name)
                                            selected @endif
                                            @endforeach
                                    @endif>

                                    {{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('garage_catagary')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3  signup_input_wraper">
                                <div id="image_license">
                                </div>
                            </div>
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading">{{ __('msg.Legal Info') }}</h5>
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <input type="text" name="trading_license" value="{{ $profile->trading_license }}"
                                    class="form-control"
                                    placeholder="{{ __('msg.Trading License No.') }} ({{ __('msg.Required') }})">
                                @error('trading_license')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <input type="text" name="vat" class="form-control"
                                    value="{{ $vat->percentage }}% VAT"
                                    placeholder="{{ __('msg.VAT Details') }} ({{ __('msg.Required') }})" readonly>
                                @error('vat')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading">{{ __('msg.Address') }}</h5>
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <div class="row">
                                    <div class="col-6 mb-3" style="padding-right: 4px">
                                        <input type="number" name="postbox" value="{{ $profile->post_box }}"
                                            class="form-control" id="inputNumber"
                                            placeholder="{{ __('msg.P/O Box') }} ({{ __('msg.Required') }})">
                                        @error('postbox')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3" style="padding-left: 4px">
                                        <input type="text" name="billing_area" value="{{ $profile->billing_area }}"
                                            class="form-control"
                                            placeholder="{{ __('msg.Billing Area') }} ({{ __('msg.Required') }})">
                                        @error('billing_area')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3" style="padding-right: 4px">
                                        <input type="text" name="country" value="{{ $profile->country }}"
                                            class="form-control" id="inpuCountry" placeholder="{{ __('msg.Country') }}"
                                            readonly>
                                        @error('country')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3" style="padding-left: 4px">
                                        <select class="form-select form-control" name="city" aria-label="City">
                                            <option selected disabled value="">{{ __('msg.Select City') }}
                                                ({{ __('msg.Required') }})</option>
                                            <option value="Dubai" @if ($profile->city == 'Dubai') selected @endif>
                                                {{ __('msg.Dubai') }}</option>
                                            <option value="Abu Dhabi" @if ($profile->city == 'Abu Dhabi') selected @endif>
                                                {{ __('msg.Abu Dhabi') }}</option>
                                            <option value="Sharjah" @if ($profile->city == 'Sharjah') selected @endif>
                                                {{ __('msg.Sharjah') }}</option>
                                            <option value="Ras Al Khaimah"
                                                @if ($profile->city == 'Ras Al Khaimah') selected @endif>
                                                {{ __('msg.Ras Al Khaimah') }}</option>
                                            <option value="Ajman" @if ($profile->city == 'Ajman') selected @endif>
                                                {{ __('msg.Ajman') }}</option>
                                        </select>
                                        @error('city')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <input type="text" name="billing_city" value="{{ $profile->billing_city }}"
                                            class="form-control"
                                            placeholder="{{ __('msg.Billing City') }} ({{ __('msg.Required') }})">
                                        @error('billing_city')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <div style="position: relative">
                                    <input type="text" name="billing_address" value="{{ $profile->billing_address }}"
                                        class="form-control"
                                        placeholder="{{ __('msg.Address') }} ({{ __('msg.Required') }})"
                                        style="padding-right: 2rem">
                                    <span class="fa fa-location" aria-hidden="true"
                                        style="position: absolute;top: 10px;right: 10px"></span>
                                </div>
                                @error('billing_address')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading">{{ __('msg.Contact Numbers') }}</h5>
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <input type="text" name="appointment_number"
                                    value="{{ $profile->appointment_number }}" class="form-control"
                                    placeholder="+971 XXXXXXXX ({{ __('msg.Required') }})"
                                    onkeypress="if(this.value.length==12) return false">
                                @error('appointment_number')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <input type="number" name="landline_no" class="form-control"
                                    value="{{ $profile->landline_no }}">
                                <input type="number" class="form-control landline-number line-dubai d-none"
                                    name="landlineDu" placeholder="04 XXXXXXXX ({{ __('msg.Optional') }})">
                                <input type="number" class="form-control landline-number line-dhabi d-none"
                                    name="landlineAD" placeholder="02 XXXXXXXX ({{ __('msg.Optional') }})">
                                <input type="number" class="form-control landline-number line-sharjah d-none"
                                    name="landlineSh" placeholder="06 XXXXXXXX ({{ __('msg.Optional') }})">
                                <input type="number" class="form-control landline-number line-khaimah d-none"
                                    name="landlineRAK" placeholder="07 XXXXXXXX ({{ __('msg.Optional') }})">
                                <input type="number" class="form-control landline-number line-ajman d-none"
                                    name="landlineAj" placeholder="06 XXXXXXXX ({{ __('msg.Optional') }})">
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <div class="d-grid gap-2 mt-3 mb-4">
                                    <button class="btn btn-secondary block get_appointment"
                                        type="submit">{{ __('msg.update_your_business_profile') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function() {
            $('select[name="city"]').on('change', function() {
                $('input[name="landline_no"]').hide();
                if ($(this).val() == "Dubai") {
                    $('.line-dubai').removeClass('d-none');
                    $('.line-dhabi').addClass('d-none');
                    $('.line-sharjah').addClass('d-none');
                    $('.line-khaimah').addClass('d-none');
                    $('.line-ajman').addClass('d-none');
                } else if ($(this).val() == "Abu Dhabi") {
                    $('.line-dhabi').removeClass('d-none');
                    $('.line-dubai').addClass('d-none');
                    $('.line-sharjah').addClass('d-none');
                    $('.line-khaimah').addClass('d-none');
                    $('.line-ajman').addClass('d-none');
                } else if ($(this).val() == "Sharjah") {
                    $('.line-sharjah').removeClass('d-none');
                    $('.line-dubai').addClass('d-none');
                    $('.line-dhabi').addClass('d-none');
                    $('.line-khaimah').addClass('d-none');
                    $('.line-ajman').addClass('d-none');
                } else if ($(this).val() == "Ras Al Khaimah") {
                    $('.line-khaimah').removeClass('d-none');
                    $('.line-dubai').addClass('d-none');
                    $('.line-dhabi').addClass('d-none');
                    $('.line-sharjah').addClass('d-none');
                    $('.line-ajman').addClass('d-none');
                } else if ($(this).val() == "Ajman") {
                    $('.line-ajman').removeClass('d-none');
                    $('.line-dubai').addClass('d-none');
                    $('.line-dhabi').addClass('d-none');
                    $('.line-sharjah').addClass('d-none');
                    $('.line-khaimah').addClass('d-none');
                }
            });

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

        $(function() {
            let preloaded = [{
                id: 1,
                src: '{{ asset($profile->image) }}'
            }, ];
            $('#profileImage').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'profile_images',
                extensions: ['.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                maxFiles: 1,
                maxSize: 2097152, // 3 MB
            });
            $("#profileImage>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Profile Picture ({{ __('msg.Optional') }}) </br><b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic only)</b></p><input name="profile_image" type="file" size="60"></label>'
            );
        });
        $(function() {
            let preloaded = [{
                id: 1,
                src: '{{ asset($profile->id_card) }}'
            }, ];
            $('#id_card').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'id_card',
                extensions: ['.pdf', '.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                mimes: ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'image/heic'],
                maxFiles: 1,
                maxSize: 2097152, // 3 MB
            });
            $("#id_card>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Your ID ({{ __('msg.Required') }}) </br> <b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic, pdf only)</b></p><input name="id_card" type="file" size="60" ></label> '
            );
        });
        $(function() {
            let preloaded = [{
                id: 1,
                src: '{{ asset($profile->image_license) }}'
            }, ];
            $('#image_license').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'image_license',
                extensions: ['.pdf', '.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                mimes: ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'image/heic'],
                maxFiles: 1,
                maxSize: 2097152, // 3 MB
            });
            $("#image_license>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Your ID ({{ __('msg.Required') }}) </br> <b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic, pdf only)</b></p><input name="id_card" type="file" size="60" ></label> '
            );
        });
    </script>
@endsection
