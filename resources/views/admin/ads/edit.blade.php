@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Ads</h4>
                            </div>
                            <form action="{{ route('admin.ads.update', $ads->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    {{-- @php
                                        $images = explode(',', $ads->images);
                                        $documents = explode(',', $ads->document_file);
                                    @endphp --}}
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
                                    <div class="row mb-2">
                                        <div class="form-group col-md-6">
                                            {{-- <label>Car Images</label>
                                            <div class=" border border-gray p-1">
                                                @foreach ($images as $image)
                                                    <img src="{{ asset($image) }}" alt="" height="60px"
                                                        width="90px">
                                                @endforeach
                                            </div>
                                            <input type="file" multiple name="car_images[]" class="form-control" value="" aria-label="Model"> --}}
                                            <label class="heading-color"><b>{{ __('msg.Upload image(s) of the car') }} ({{ __('msg.Required') }}) <br><small>
                                                        ({{ __('msg.Click the box again to upload another') }})</small></b></label>
                                            <div class="car_images">
                                            </div>
                                            @error('car_images')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{-- <label>Documents</label>
                                            <div class="border border-gray p-1">
                                                @foreach ($documents as $document)
                                                    <img src="{{ asset($document) }}" alt="" w height="60px"
                                                        width="90px">
                                                @endforeach
                                            </div>
                                            <input type="file" multiple name="document[]" class="form-control"
                                                value="" aria-label="Model"> --}}
                                            <label class="heading-color"><b>{{ __('msg.Upload upto 5 images') }}<small>
                                                        ({{ __('msg.Click the box again to upload another') }})</small></b></label>
                                            <div class="doc_images">
                                            </div>
                                            @error('files')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Model</label>
                                            <input type="text" name="model" class="form-control"
                                                placeholder="{{ __('msg.Model') }} ({{ __('msg.Required') }})"
                                                value="{{ $ads->model }}" aria-label="Model">
                                            @error('model')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="">Company</label>
                                            <select class="form-select form-control" name="company_id"
                                                aria-label="Type of Service">
                                                <option value="{{ $ads->company_id }}" selected>
                                                    {{ $ads->company->company }}
                                                </option>
                                                @foreach ($company as $data)
                                                    <option value="{{ $data->id }}">{{ $data->company }}</option>
                                                @endforeach
                                            </select>
                                            @error('company_id')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                            <span class="text-danger" id="companyError"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="" class="">Year</label>
                                            <select class="form-select form-control" name="model_year_id"
                                                aria-label="Type of Service">
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
                                            <label for="" class="">Price</label>
                                            <input type="text" name="price" value="{{ $ads->price }}"
                                                class="form-control"
                                                placeholder="{{ __('msg.Price') }} ({{ __('msg.Required') }})"
                                                aria-label="Price">
                                            @error('price')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Color</label>
                                            <input type="text" name="color" value="{{ $ads->color }}"
                                                class="form-control"
                                                placeholder="{{ __('msg.Color') }} ({{ __('msg.Required') }})"
                                                aria-label="Color">
                                            @error('color')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Engine</label>
                                            <input type="text" name="engine" value="{{ $ads->engine }}"
                                                class="form-control"
                                                placeholder="{{ __('msg.Engine') }} ({{ __('msg.Required') }})"
                                                aria-label="Engine">
                                            @error('engine')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Phone</label>
                                            <input type="text" name="phone" value="{{ $ads->phone }}"
                                                class="form-control"
                                                placeholder="{{ __('msg.Phone Number') }} ({{ __('msg.Required') }})"
                                                aria-label="phone" onkeypress="if(this.value.length==12) return false">
                                            @error('phone')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div style="position: relative">
                                                <label for="">Address</label>
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
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="">Country</label>
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
                                            <label for="">City</label>
                                            <select class="form-select form-control" name="city" aria-label="City">
                                                @if (isset($ads->city))
                                                    <option selected value="{{ $ads->city }}">{{ $ads->city }}
                                                    </option>
                                                @endif
                                                <option value="Dubai" @if (old('city') == 'Dubai') selected @endif>
                                                    {{ __('msg.Dubai') }}</option>
                                                <option value="Abu Dhabi"
                                                    @if (old('city') == 'Abu Dhabi') selected @endif>
                                                    {{ __('msg.Abu Dhabi') }}</option>
                                                <option value="Sharjah" @if (old('city') == 'Sharjah') selected @endif>
                                                    {{ __('msg.Sharjah') }}</option>
                                                <option value="Ras Al Khaimah"
                                                    @if (old('city') == 'Ras Al Khaimah') selected @endif>
                                                    {{ __('msg.Ras Al Khaimah') }}</option>
                                                <option value="Ajman" @if (old('city') == 'Ajman') selected @endif>
                                                    {{ __('msg.Ajman') }}</option>
                                            </select>
                                            @error('city')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Mileage</label>
                                            <input type="text" name="mileage" class="form-control"
                                                value="{{ $ads->mileage }}"
                                                placeholder="{{ __('msg.Mileage e.g 40 Km') }} ({{ __('msg.Required') }})"
                                                aria-label="Price">
                                            @error('mileage')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-floating">
                                                <label for="">Description</label>
                                                <textarea class="form-control" name="description" placeholder="{{ __('msg.Add more details') }}"
                                                    id="floatingTextarea2" style="height: 100px">{{ $ads->description }}</textarea>
                                                <label for="floatingTextarea2">{{ __('msg.Add information in details') }}
                                                    ({{ __('msg.Optional') }})</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Update Ads</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
<script>
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
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">{{ __('msg.Upload Car image') }} ({{ __('msg.Required') }}) </br><b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic only)</b></p><input type="file" size="60"></label>'
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
