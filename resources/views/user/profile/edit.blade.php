@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-9 col-sm-9 mx-auto">
                    <div class="cuatomer_signup_form_wraper mt-5">
                        <div class="main_content_wraper">
                            <h4 class="sec_main_heading text-center mb-0">{{ __('msg.edit') }}</h4>
                            <p class="sec_main_para text-center mb-0">{{ __('msg.Edit your profile details') }}</p>
                        </div>

                        <form class="pt-4" action="{{ route('user.profile.post', $profile->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading-color">{{ __('msg.Profile Picture') }}</h5>
                            </div>
                            <div class="col-12 mb-3  signup_input_wraper">
                                {{-- <div class="image-uploader-edit"></div> --}}
                                <div id="profileImage">
                                </div>
                            </div>
                            @if (Auth::user()->type == 'company')

                                <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                    <h5 class="mb-0 heading-color">{{ __('msg.Your ID') }}</h5>
                                </div>
                                <div class="col-12 mb-3  signup_input_wraper">
                                    <div id="id_card">
                                    </div>
                                </div>
                            @endif
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading">{{ __('msg.Business Info') }}</h5>
                            </div>
                            @if (Auth::user()->type == 'user')
                                <div class="col-12 mb-3  signup_input_wraper">
                                    <input type="text" class="form-control" id="inputName" name="name"
                                        placeholder="{{ __('msg.Name') }}" value="{{ $profile->name }}">
                                    @error('name')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                <div class="col-12 mb-3  signup_input_wraper">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $profile->insurance->owner_name }}" id="inputName"
                                        placeholder="{{ __('msg.Owner Name') }} ({{ __('msg.Required') }})">
                                    @error('name')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3 signup_input_wraper">
                                    <input type="text" name="company_name" class="form-control"
                                        value="{{ $profile->name }}" id="inputgarageName"
                                        placeholder="{{ __('msg.Company Legal Name') }} ({{ __('msg.Required') }})">
                                    @error('company_name')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-12 mb-3 signup_input_wraper">
                                <input type="email" disabled class="form-control" name="email" id="inputEmail"
                                    value="{{ $profile->email }}">
                                @error('email')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            @if (Auth::user()->type == 'user')
                                <div class="col-12 mb-3  signup_input_wraper">
                                    <input type="text" class="form-control" id="inputNumber" name="country"
                                        placeholder="{{ __('msg.Country') }}" value="{{ $profile->country }}" readonly>
                                    @error('country')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3  signup_input_wraper">
                                    <select class="form-select form-control" name="city" aria-label="City">
                                        <option selected disabled value="">{{ __('msg.Select City') }}
                                            ({{ __('msg.Required') }})</option>
                                        <option value="Dubai" @if ($profile->city == 'Dubai') selected @endif>
                                            {{ __('msg.Dubai') }}</option>
                                        <option value="Abu Dhabi" @if ($profile->city == 'Abu Dhabi') selected @endif>
                                            {{ __('msg.Abu Dhabi') }}</option>
                                        <option value="Sharjah" @if ($profile->city == 'Sharjah') selected @endif>
                                            {{ __('msg.Sharjah') }}</option>
                                        <option value="Ras Al Khaimah" @if ($profile->city == 'Ras Al Khaimah') selected @endif>
                                            {{ __('msg.Ras Al Khaimah') }}</option>
                                        <option value="Ajman" @if ($profile->city == 'Ajman') selected @endif>
                                            {{ __('msg.Ajman') }}</option>
                                    </select>
                                    @error('city')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3  signup_input_wraper">
                                    <input type="text" class="form-control" id="inputName" name="address"
                                        placeholder="{{ __('msg.Address') }}" value="{{ $profile->address }}">
                                    @error('address')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3 signup_input_wraper">
                                    <select class="form-select form-control insurance-company" name="company"
                                        aria-label="company" value="">
                                        @foreach ($company as $data)
                                            <option value="{{ $data->id }}"
                                                @if (isset($profile->company[0])) @if ($profile->company[0]->name == $data->name) selected @endif
                                                @endif>{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('garage_catagary')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            @if (Auth::user()->type == 'company')
                                <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                    <h5 class="mb-0 heading">{{ __('msg.Legal Info') }}</h5>
                                </div>
                                <div class="col-12 mb-3  signup_input_wraper">
                                    {{-- <div class="image-uploader-edit"></div> --}}
                                    <div id="image_license">
                                    </div>
                                </div>
                                <div class="col-12 mb-3 signup_input_wraper">
                                    <input type="text" name="trading_license"
                                        value="{{ $profile->insurance->trading_license }}" class="form-control"
                                        placeholder="{{ __('msg.Trading License No.') }} (Required)">
                                    @error('trading_license')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                    <h5 class="mb-0 heading">{{ __('msg.Address') }}</h5>
                                </div>
                                <div class="col-12 mb-3 signup_input_wraper">
                                    <div class="row">
                                        <div class="col-6 mb-3" style="padding-right: 4px">
                                            <input type="number" class="form-control" id="inputNumber" name="post_box"
                                                placeholder="{{ __('msg.P/O Box') }} ({{ __('msg.Required') }})"
                                                value="{{ $profile->post_box }}">
                                            @error('post_box')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-3" style="padding-left: 4px">
                                            <input type="text" name="billing_area"
                                                value="{{ $profile->insurance->billing_area }}" class="form-control"
                                                placeholder="{{ __('msg.Billing Area') }} ({{ __('msg.Required') }})">
                                            @error('billing_area')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-3" style="padding-right: 4px">
                                            <input type="text" class="form-control" id="inputNumber" name="country"
                                                placeholder="{{ __('msg.Country') }}" value="{{ $profile->country }}"
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
                                                <option value="Abu Dhabi"
                                                    @if ($profile->city == 'Abu Dhabi') selected @endif>
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
                                            <input type="text" name="billing_city"
                                                value="{{ $profile->insurance->billing_city }}" class="form-control"
                                                placeholder="{{ __('msg.Billing City') }} ({{ __('msg.Required') }})">
                                            @error('billing_city')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3 signup_input_wraper">
                                    <div style="position: relative">
                                        <input type="text" name="billing_address"
                                            value="{{ $profile->insurance->billing_address }}" class="form-control"
                                            placeholder="{{ __('msg.Address') }} ({{ __('msg.Required') }})"
                                            style="padding-right: 2rem">
                                        <span class="fa fa-location" aria-hidden="true"
                                            style="position: absolute;top: 10px;right: 10px"></span>
                                    </div>
                                    @error('billing_address')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading">{{ __('msg.Contact Numbers') }}</h5>
                            </div>
                            <div class="col-12 mb-3 signup_input_wraper">
                                <input type="number" class="form-control" id="inputNumber" name="phone"
                                    placeholder="+971 XXXXXXXX ({{ __('msg.Required') }})" value="{{ $profile->phone }}"
                                    onkeypress="if(this.value.length==12) return false">
                                @error('phone')
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
                                        type="submit">{{ __('msg.update your profile') }}</button>
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



        var role = '<?php echo auth()->user()->type; ?>'
        var id_card = '{{ isset($profile->insurance->id_card) ? asset($profile->insurance->id_card) : '' }}'
        var image_license = '{{ isset($profile->insurance->id_card) ? asset($profile->insurance->image_license) : '' }}'

        $(function() {
            let preloaded = [{
                id: 1,
                src: '{{ asset($profile->image) }}'
            }, ];
            $('#profileImage').imageUploader({
                preloaded: preloaded,
                extensions: ['.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                maxFiles: 1,
                maxSize: 2097152, // 3 MB
            });
            $("#profileImage>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Profile Picture ({{ __('msg.Required') }}) </br><b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic only)</b></p><input name="profile_image" type="file" size="60"></label>'
                );
        });
        if (role === 'company') {
            $(function() {
                let preloaded = [{
                    id: 1,
                    src: id_card
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
                    src: image_license
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
        }
    </script>
@endsection
