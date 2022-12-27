
@extends('web.layout.app')
@section('content')
    <section class="banner_section">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item Stor_detai_item active">
                    <div class="preferd_vendors_star">
                            <img src="{{ asset('public/assets/images/preferdicon.svg') }}">
                    </div>
                    <img @if (isset($preview_garage->image)) src="{{ asset($preview_garage->image)}}" @else src="{{ asset('public/assets/images/repair2.jpg') }}" @endif class="d-block w-100" alt="banner image">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" store_brances d-flex justify-content-center align-items-center">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-3 col-6">
                    <h6 class="store_addres">Garage Name: {{ ucfirst($preview_garage->garage_name) }}</h6>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-3 col-6">
                    <h6 class="store_addres">Address: {{ ucfirst($preview_garage->city) }}, {{ ucfirst($preview_garage->country) }}</h6>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <h6 class="store_addres mb-0">Phone: {{$preview_garage->phone}}</h6>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-3 col-6">
                    <h6 class="store_addres">Rating:
                        @if (round($overAllRatings) == '0')
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        @elseif(round($overAllRatings) == '1')
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        @elseif(round($overAllRatings) == '2')
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        @elseif(round($overAllRatings) == '3')
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        @elseif(round($overAllRatings) == '4')
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star"></i>
                        @elseif(round($overAllRatings) == '5')
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                            <i class="fa-solid fa-star" style="color:black;"></i>
                        @endif
                        ({{ round($overAllRatings) }})
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3">
        <div class="container-lg container-fluid">
            <div class="main_row d-grid align-items-center justify-content-between flex-wrap services-section">
				@foreach($preview_garage->garageCategory as $sevice)
				<div class="stor_add_show_wraper">
					<div class="stor_add_show_wraper_innr">
						<img src="{{asset($sevice->category->icon)}}">
					</div>
					<h6 class="mb-0 ms-2">{{$sevice->category->name}}</h6>
				</div>
			@endforeach
            </div>

        </div>
    </section>
    <section class=" py-lg-5 py-md-4 py-2">
        <div class="container-lg container-fluid">
            <div class="row g-4 gx-0">
                <div class="col-lg-8 col-md-6 col-sm-6">
                    <div class="over_view_part h-100">
                        <h5 class=" text-center mb-3 heading-color">{{ __('msg.OVERVIEW') }}</h5>
                        <p class="mb-0">{!! $preview_garage->description !!}</p>
                        @if (!isset($preview_garage->description))
                        <p>{{__('msg.garage_overview')}}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="over_view_part timing_hours">
                        <h5 class=" text-center mb-3 heading-color">{{ __('msg.OPENING HOURS') }}</h5>
                        <?php $g_timing = \App\Models\GarageTiming::where('garage_id', $preview_garage->id)->get(); ?>
                        @foreach ($g_timing as $timing)
                            <div class="timing_container">
                                <p class="time_for_opning mb-0">{{ ucfirst($timing->day) }}</p>
                                <p class="time_for_opning mb-1">
                                    @if ($timing->closed == 0)
                                        Closed @else{{ $timing->from }} -
                                        {{ $timing->to }}
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary get_appointment byCall heart" type="button">
                            <span class="d-inline-block">{{ __('msg.GET BOOKING') }}</span>
                            <span class="d-none">{{ $preview_garage->phone }}</span>
                            <img src="{{ asset('public/assets/images/appoinmenticon.svg') }}">
                        </button>
                    </div>
                </div>

            </div>
            <div class="row g-4 gx-0 mt-3" style="display:flex">
                <div class="col-lg-8 col-md-6 col-sm-6">
                    <div class="over_view_part">
                        <h5 class=" text-center mb-3 heading-color">{{__('msg.contact vendor')}}</h5>
                        @if (session()->has('alert-success'))
                            <div class="alert alert-success">
                                {{ session()->get('alert-success') }}
                            </div>
                        @endif
                        <form class="row gy-3 gx-0" method="post" action="{{ route('contact-vendor') }}"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="garage_id" value="{{ $preview_garage->id }}">
                            <div class="row gy-lg-3 gy-2 gx-0">
                                <div class="col-12 px-2">
                                    <select name="looking_for" class="form-select form-control" id="lookingFor" required>
                                        <option value=""></option>
                                        <option value="I have Inspection Report & Looking for the Quotations"
                                            @if (old('looking_for') == 'I have Inspection Report & Looking for the Quotations') selected @endif>{{__('msg.I have Inspection Report & Looking for the Quotation')}}</option>
                                        <option value="I don't know the Problem and Requesting for the Inspection"
                                            @if (old('looking_for') == "I don't know the Problem and Requesting for the Inspection") selected @endif>{{__("msg.I don't know the Problem and Requesting for the Inspection")}}</option>
                                        <option value="I know about what i'm looking for and requesting for the Quotations"
                                            @if (old('looking_for') == "I know about what i'm looking for and requesting for the Quotations") selected @endif>{{__("msg.I know about what i'm looking for and requesting for the Quotation")}}</option>
                                    </select>
                                    @error('looking_for')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 px-2">
                                    <input type="text" class="form-control" name="model"
                                    value="{{ old('model') }}" placeholder="{{__('msg.Model')}} ({{__('msg.Required')}})" aria-label="Car Milage"
                                        required>
                                    @error('model')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 px-2">
                                    <select class="form-select form-control company-name-field" name="company_id"
                                        aria-label="Type of Service" required>
                                        <option value=""></option>
                                        @foreach ($company as $data)
                                            <option value="{{ $data->id }}"
                                                @if (old('company_id') == $data->id) selected @endif>{{ $data->company }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 px-2">
                                    <input type="text" class="form-control" value="{{ old('registration_no') }}"
                                        name="registration_no" placeholder="{{__('msg.Registration No.')}} ({{__('msg.Required')}})" aria-label="Car Milage"
                                        required>
                                    @error('registration_no')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 px-2">
                                    <input type="text" class="form-control" value="{{ old('Chasis_no') }}"
                                        name="Chasis_no" placeholder="{{__('msg.Chasis No.')}} ({{__('msg.Required')}})" aria-label="Car Milage" required>
                                    @error('Chasis_no')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 px-2">
                                    <input type="text" class="form-control" name="color"
                                        value="{{ old('color') }}" placeholder="{{__('msg.Color')}} ({{__('msg.Required')}})" aria-label="Car Milage"
                                        required>
                                    @error('color')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 px-2">
                                    <select class="form-select form-control model-year-field" name="model_year_id"
                                        aria-label="Type of Service" required>
                                        <option value=""></option>
                                        @foreach ($year as $data)
                                            <option value="{{ $data->id }}"
                                                @if (old('model_year_id') == $data->id) selected @endif>{{ $data->model_year }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('model_year_id')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 px-2">
                                    <input type="number" class="form-control" name="mileage"
                                        value="{{ old('mileage') }}" placeholder="{{__('msg.Mileage e.g 40 Km')}} ({{__('msg.Required')}})"
                                        aria-label="Car Milage" required>
                                    @error('mileage')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 px-2">
                                    <input type="number" class="form-control" name="day"
                                        value="{{ old('day') }}" placeholder="{{__('msg.Days e.g (7)')}} ({{__('msg.Required')}})" aria-label="Day"
                                        required>
                                    @error('day')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 px-2 services-dropdown-block">
                                    <select class="form-select form-control garage-services" name="category[]" multiple
                                        aria-label="Type of Service" required>
                                        @foreach ($catagary as $data)
                                            <option value="{{ $data->id }}" {{ (collect(old('category'))->contains($data->id)) ? 'selected':'' }}>{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 px-2">
                                    <textarea name="description1" placeholder="{{__('msg.Add information in details')}} ({{__('msg.Optional')}})" class="form-control" rows="5">{{ old('description1') }}</textarea>
                                </div>
                                <div class="col-lg-12 px-2">
                                    <label class="mb-2 heading-color"><b>{{ __('msg.Upload image(s) of the car') }}  ({{ __('msg.Required') }}) <br><small>({{__('msg.Click the box again to upload another')}})</small></b></label>
                                    <div class="input-imagess"></div>
                                    @error('car_images')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="police-inspection-report">
                                    <div class="col-lg-12 mb-3">
                                        <label class="mb-2 heading-color"><b>{{__('msg.Upload Document')}} <small>({{__('msg.Upload Up to 5 PDF/Image')}})</small></b></label>
                                        <div class="input-imagess-2" accept="pdf/*" data-type='Pdf'></div>
                                        @error('files')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <textarea name="description2" placeholder="Special Requirements" class="form-control" rows="5">{{ old('description2') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0 gy-lg-3 gy-2 gx-0">
                                <div class="col-12 px-2">
                                    <label class="mb-2 heading-color"><b>{{__('msg.Upload upto 5 images')}}<small>({{__('msg.Click the box again to upload another')}})</small></b></label>
                                    <div class="input-imagess-3"></div>
                                    @error('document')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row gy-2 gx-0">

                                    <div class="col-lg-6 col-md-6 px-2">
                                        <input type="text" class="form-control"
                                            @if (isset(auth()->user()->name)) value="{{ auth()->user()->name }}" readonly @endif
                                            name="maker_name" placeholder="{{__('msg.Name')}} ({{__('msg.Required')}})" aria-label="Make" required>
                                        @error('maker_name')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 px-2">
                                        <input type="email" class="form-control"
                                            @if (isset(auth()->user()->email)) value="{{ auth()->user()->email }}" readonly @endif
                                            name="email" placeholder="{{__('msg.Email')}} ({{__('msg.Required')}})" aria-label="Email" required>
                                        @error('email')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 px-2">
                                        <div style="position: relative">
                                            <input type="text" name="address" value="{{ old('address') }}" class="form-control"  placeholder="{{__('msg.Address')}} ({{__('msg.Required')}})" style="padding-right: 2rem">
                                            <span class="fa fa-location" aria-hidden="true" style="position: absolute;top: 10px;right: 10px"></span>
                                        </div>
                                        @error('address')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="mt-sm-4 mt-3 d-flex justify-content-center">
                                <a href="#" class="btn btn-primary get_appointment heart text-center">{{__('msg.QUOTE REQUEST')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <div class="over_view_part timing_hours">
                        <h5 class="text-center mb-3 heading-color">{{ __('msg.reviews') }}</h5>
                        <div class="owl-carousel carousel_se_01_carousel owl-theme">
                            @if (count($user_review) > 0)
                                @foreach ($user_review as $review)
                                    <div class="item">
                                        <p class="text-center reviews">"{{ $review->review }}"</p>
                                        <p class="testimonail_person_name text-center mb-1 reviews">
                                            {{ getUserNameById($review->user_id) }}</p>
                                        <p class="testimonail_person_rating text-center reviews">
                                            <span>{{ $review->rating }}</span>
                                        </p>
                                    </div>
                                @endforeach
                            @else
                                <div class="item">
                                    <p class="text-center reviews">{{ __('msg.revies_data') }}</p>
                                    <p class="testimonail_person_name text-center mb-1 reviews">{{ __('msg.Hassan Ali') }}
                                    </p>
                                    <p class="testimonail_person_rating text-center reviews"><span>5.0</span></p>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">

                        @if (Auth::guard('web')->check())

                            @if (session()->has('alert-error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('alert-error') }}
                                </div>
                            @endif
                            <form class="g-3" method="post" action="{{ route('add-to-preffered-garage') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="garage_id" value="{{ $preview_garage->id }}">
                                <button class="w-100 btn btn-primary get_appointment heart" type="submit">
                                    @if ($user_wishlist) {{__('msg.PREFERRED GARAGE')}} <img src="{{ asset('public/vendor/assets/images/hearticoc.svg') }}">
                                    @else
                                        {{__('msg.ADD TO PREFERRED GARAGE')}} <img src="{{ asset('public/vendor/assets/images/hearticon.svg') }}">
                                    @endif
                                </button>
                            </form>
                        @else
                            <a href="#" class="w-100 btn btn-primary get_appointment heart">
                                {{__('msg.PREFERRED GARAGE')}} <img src="{{ asset('public/vendor/assets/images/hearticoc.svg') }}">

                            </a>
                        @endif
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <a href="#" class="w-100 btn btn-primary get_appointment heart">{{__('msg.CONTACT VIA MESSAGE')}}
                            <img src="{{ asset('public/vendor/assets/images/messageicon.svg') }}">
                        </a>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="over_view_part timing_hours mape_wraper pt-3 mt-4">
                        <h5 class="text-center mb-3 heading-color">{{__('msg.LOCATION')}}</h5>
                        <div class="responsive-map" id="map1">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2822.7806761080233!2d-93.29138368446431!3d44.96844997909819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x52b32b6ee2c87c91%3A0xc20dff2748d2bd92!2sWalker+Art+Center!5e0!3m2!1sen!2sus!4v1514524647889"
                                height="550" frameborder="0" style="border:0" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<div class="row mt-5 g-3">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<a href="{{route('vendor.workshop.edit',Auth::id())}}" class="btn btn-secondary d-block d-flex justify-content-center justify-content-center w-100">{{__('msg.EDIT GARAGE')}}</a>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
						<a href="{{url('vendor/garage-finish')}}" class="btn btn-primary btn_anchhor d-block d-flex justify-content-center justify-content-center" >{{__('msg.FINISH GARAGE')}}</a>
					</div>
					</div>

				</div>
			</div>
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
        $(function() {
            <?php if(session('alert-garage-success'))
                {
            ?>
            toastr.success('{{ Session::get('alert-garage-success') }}');
            <?php
                }
            ?>
        });




        $(function() {
            $('#lookingFor').select2({
                placeholder: "{{__('msg.What are you looking for? (Required)')}}",
            });
            lookingFor();
            $('#lookingFor').on('select2:select', function() {
                lookingFor();
            });

            function lookingFor() {
                var val = $('#lookingFor').val();
                let valOne = "I have Inspection Report & Looking for the Quotations";
                let valTwo = "I don't know the Problem and Requesting for the Inspection";
                let valThree = "I know about what i'm looking for and requesting for the Quotations";
                if (val == valOne) {
                    $('.services-dropdown-block').removeClass('d-none');
                    $('.police-inspection-report').removeClass('d-none');
                    $('#requestForInspection').addClass('d-none');
                    $('.get-quotes-block').removeClass('d-none');
                } else if (val == valTwo) {
                    $('.services-dropdown-block').addClass('d-none');
                    $('.police-inspection-report').addClass('d-none');
                    $('#requestForInspection').removeClass('d-none');
                    $('.get-quotes-block').addClass('d-none');
                } else {
                    $('.police-inspection-report').addClass('d-none');
                    $('.services-dropdown-block').removeClass('d-none');
                    $('#requestForInspection').addClass('d-none');
                    $('.get-quotes-block').removeClass('d-none');
                }
            }
        });
    </script>

    {{-- google map --}}
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwh-vVMRBE4HFwtz1a65drC7iw8feYr5w&callback=initMap&v=weekly"
        async></script>
    <script type="text/javascript">
        var lat = 30.762180;
        var long = 76.766090;

        function initMap() {

            const myLatLng = {
                lat: JSON.parse(lat),
                lng: JSON.parse(long)
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: myLatLng,
            });

            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "Hello Rajkot!",
            });
        }

        window.initMap = initMap;
    </script>
@endsection


