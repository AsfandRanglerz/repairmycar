@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.EDIT YOUR AD FOR USED CAR') }}</h4>
                        <p class="sec_main_para text-center">{{ __('msg.Edit your ad') }}</p>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-9 col-md-11  mx-auto">
                    <div class="bid_form_wraper">
                        <div class="row">
                            <div class="col-lg-8 mx-auto px-5 px-lg-1 ">
                            </div>
                            <form name="sellCar" action="{{ route('user.ads.update', $ads->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row g-lg-3 g-2">
                                    <?php
                                    $images = Explode(',', $ads->images);
                                    $preImages = [];
                                    foreach ($images as $image) {
                                        $obj = (object) ['id' => '', 'src' => ''];
                                        $obj->id = $image;
                                        $obj->src = asset($image);
                                        $preImages[] = $obj;
                                    }
                                    $preImages = json_encode($preImages);

                                    //update the documents images
                                    $docx = Explode(',', $ads->document_file);
                                    $preDocx = [];
                                    foreach ($docx as $doc) {
                                        $obj = (object) ['id' => '', 'src' => ''];
                                        $obj->id = $doc;
                                        $obj->src = asset($doc);
                                        $preDocx[] = $obj;
                                    }
                                    $preDocx = json_encode($preDocx);
                                    ?>
                                    <div class="col-lg-6 col-md-6 mb-3">
                                        <label class="heading-color"><b>{{ __('msg.Upload image(s) of the car') }} ({{ __('msg.Required') }}) <br><small>
                                                    ({{ __('msg.Click the box again to upload another') }})</small></b></label>
                                        <div class="car_images">
                                        </div>
                                        @error('car_images')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-3">
                                        <label class="heading-color"><b>{{ __('msg.Upload upto 5 images') }}<small>
                                                    ({{ __('msg.Click the box again to upload another') }})</small></b></label>
                                        <div class="doc_images">
                                        </div>
                                        @error('files')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <select class="form-select" name="company_id" id="company" aria-label="Type of Service">
                                            @foreach ($company as $data)
                                                <option value="{{ $data->id }}"  @if ($ads->company->company == $data->company) selected @endif>{{ $data->company }}</option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                        <span class="text-danger" id="companyError"></span>
                                    </div>

                                    <div class="col-lg-6 col-md-6" id="car_model">
                                        <select class="form-select form-control company-name-field" name="model"
                                            aria-label="car model" required>
                                            <option value="" selected disabled>
                                                {{ __('msg.Model') }}
                                                ({{ __('msg.Required') }})</option>
                                            @foreach ($model as $data)
                                                <option value="{{ $data->car_model }}"
                                                    @if ($ads->model == $data->car_model) selected @endif>
                                                    {{ $data->car_model }}</option>
                                            @endforeach
                                        </select>
                                        @error('model')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <select class="form-select" name="model_year_id" aria-label="Type of Service">
                                            <option value="" disabled>{{ __('msg.Model Year') }}
                                                ({{ __('msg.Required') }})</option>
                                            <option value="{{ $ads->model_year_id }}" selected>
                                                {{ $ads->modelYear->model_year }}
                                            </option>
                                            @foreach ($year as $data)
                                                <option value="{{ $data->id }}">{{ $data->model_year }}</option>
                                            @endforeach
                                        </select>
                                        @error('model_year_id')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                        <span class="text-danger" id="model_year_Error"></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" name="price" value="{{ $ads->price }}"
                                            class="form-control"
                                            placeholder="{{ __('msg.Price') }} ({{ __('msg.Required') }})"
                                            aria-label="Price">
                                        @error('price')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" name="color" value="{{ $ads->color }}"
                                            class="form-control"
                                            placeholder="{{ __('msg.Color') }} ({{ __('msg.Required') }})"
                                            aria-label="Color">
                                        @error('color')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" name="engine" value="{{ $ads->engine }}"
                                            class="form-control"
                                            placeholder="{{ __('msg.Engine') }} ({{ __('msg.Required') }})"
                                            aria-label="Engine">
                                        @error('engine')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" name="mileage" class="form-control"
                                            value="{{ $ads->mileage }}"
                                            placeholder="{{ __('msg.Mileage e.g 40 Km') }} ({{ __('msg.Required') }})"
                                            aria-label="Price">
                                        @error('mileage')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div style="position: relative">
                                            <input type="text" name="address" value="{{ $ads->address }}"
                                                class="form-control"
                                                placeholder="{{ __('msg.Address') }} ({{ __('msg.Required') }})"
                                                aria-label="address" style="padding-right: 2rem">
                                            <span class="fa fa-location" aria-hidden="true"
                                                style="position: absolute;top: 10px;right: 10px"></span>
                                        </div>
                                        @error('address')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <select class="form-select form-control" name="country" aria-label="Country"
                                            disabled>
                                            <option disabled value="">{{ __('msg.Country') }}</option>
                                            <option value="United Arab Emirates" selected>
                                                {{ __('msg.United Arab Emirates') }}</option>
                                        </select>
                                        @error('country')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <select class="form-select form-control" name="city" aria-label="City">

                                            <option value="Dubai" @if ($ads->city == 'Dubai') selected @endif>
                                                {{ __('msg.Dubai') }}</option>
                                            <option value="Abu Dhabi" @if ($ads->city == 'Abu Dhabi') selected @endif>
                                                {{ __('msg.Abu Dhabi') }}</option>
                                            <option value="Sharjah" @if ($ads->city == 'Sharjah') selected @endif>
                                                {{ __('msg.Sharjah') }}</option>
                                            <option value="Ras Al Khaimah"
                                                @if ($ads->city == 'Ras Al Khaimah') selected @endif>
                                                {{ __('msg.Ras Al Khaimah') }}</option>
                                            <option value="Ajman" @if ($ads->city == 'Ajman') selected @endif>
                                                {{ __('msg.Ajman') }}</option>
                                        </select>
                                        @error('city')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="number" name="phone" value="{{ $ads->phone }}"
                                            class="form-control" placeholder="+971 XXXXXXXX ({{ __('msg.Required') }})"
                                            aria-label="phone" onkeypress="if(this.value.length==12) return false">
                                        @error('phone')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="number" name="landline_no" class="form-control" value="{{$ads->landline_no}}">
                                        <input type="number" class="form-control landline-number line-dubai d-none" name="landlineDu" placeholder="04 XXXXXXXX ({{ __('msg.Optional') }})">
                                        <input type="number" class="form-control landline-number line-dhabi d-none" name="landlineAD" placeholder="02 XXXXXXXX ({{ __('msg.Optional') }})">
                                        <input type="number" class="form-control landline-number line-sharjah d-none" name="landlineSh" placeholder="06 XXXXXXXX ({{ __('msg.Optional') }})">
                                        <input type="number" class="form-control landline-number line-khaimah d-none" name="landlineRAK" placeholder="07 XXXXXXXX ({{ __('msg.Optional') }})">
                                        <input type="number" class="form-control landline-number line-ajman d-none" name="landlineAj" placeholder="06 XXXXXXXX ({{ __('msg.Optional') }})">
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="description" placeholder="{{ __('msg.Add more details') }}"
                                                id="floatingTextarea2" style="height: 100px">{{ $ads->description }}</textarea>
                                            <label for="floatingTextarea2">{{ __('msg.Add information in details') }}
                                                ({{ __('msg.Optional') }})</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="d-grid gap-2 mt-lg-3 mb-lg-4">
                                            <button class="btn btn-secondary block get_appointment"
                                                type="submit">{{ __('msg.SUBMIT') }}
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
    </section>
@endsection
@section('script')
    <script>
        $(function() {
            $('select[name="city"]').on('change', function() {
                $('input[name="landline_no"]').hide();
                if($(this).val()=="Dubai") {
                    $('.line-dubai').removeClass('d-none');
                    $('.line-dhabi').addClass('d-none');
                    $('.line-sharjah').addClass('d-none');
                    $('.line-khaimah').addClass('d-none');
                    $('.line-ajman').addClass('d-none');
                } else if ($(this).val()=="Abu Dhabi") {
                    $('.line-dhabi').removeClass('d-none');
                    $('.line-dubai').addClass('d-none');
                    $('.line-sharjah').addClass('d-none');
                    $('.line-khaimah').addClass('d-none');
                    $('.line-ajman').addClass('d-none');
                } else if ($(this).val()=="Sharjah") {
                    $('.line-sharjah').removeClass('d-none');
                    $('.line-dubai').addClass('d-none');
                    $('.line-dhabi').addClass('d-none');
                    $('.line-khaimah').addClass('d-none');
                    $('.line-ajman').addClass('d-none');
                } else if ($(this).val()=="Ras Al Khaimah") {
                    $('.line-khaimah').removeClass('d-none');
                    $('.line-dubai').addClass('d-none');
                    $('.line-dhabi').addClass('d-none');
                    $('.line-sharjah').addClass('d-none');
                    $('.line-ajman').addClass('d-none');
                } else if ($(this).val()=="Ajman") {
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
            let imagePre = <?php echo $preImages; ?>;
            console.log(imagePre);
            $('.car_images').imageUploader({
                preloaded: imagePre,
                imagesInputName: 'car_images',
                preloadedInputName: 'car_old',
                extensions: ['.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                maxFiles: 5,
                maxSize: 2097152, // 3 MB
            });
            $(".car_images>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0"><b class="small">up to 5 images, maximum 2 mb, format: png, jpeg, heice</b></p><input type="file" size="60"></label>'
                );
        });
        //update the documents images
        $(function() {
            let preDocx = <?php echo $preDocx; ?>;
            $('.doc_images').imageUploader({
                preloaded: preDocx,
                imagesInputName: 'doucment',
                preloadedInputName: 'doc_old',
                extensions: ['.pdf', '.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                mimes: ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'image/heic'],
                maxFiles: 5,
                maxSize: 2097152, // 3 MB
            });
            $(".doc_images>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">{{ __('msg.Registration Copy Image') }} ({{ __('msg.Required') }}) </br> <b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic, pdf only)</b></p><input type="file" name="document[]" size="60" ></label>'
                );
        });
    </script>
@endsection
