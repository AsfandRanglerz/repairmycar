@extends('web.layout.app')
@section('content')
    <style>
        .select2-container {
            z-index: 5555;
            width: 100% !important;
        }
    </style>
    <section class="looking_for garages">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="main_content_wraper">
                        <h4 class="sec_main_heading text-center">{{ __('msg.CAR FOR SALE') }}</h4>
                        <p class="sec_main_para allgarages text-center">{{ __('msg.Search For Pre-Owned Cars') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-5 mt-3">
                    <div class="input-group mb-3 search_garages_wraper">
                        <input type="text" class="form-control search_garages"
                            placeholder="{{ __('msg.Search For Your Next Car') }}" aria-label="Recipient's username"
                            aria-describedby="button-addon2">
                        <button class="btn search" type="button" id="button-addon2">{{ __('msg.SEARCH') }}</button>
                        <div class="srearch_icon_wraper">
                            <img src="{{ asset('public/assets/images/searchicon.svg') }}">
                        </div>
                        <div class="slide_icon_wraper">
                            <a href="" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img src="{{ asset('public/assets/images/slideicon.svg') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">{{ __('msg.Top Searches') }}</h6>
                            <a type="button" class="heading-color" data-bs-dismiss="modal"><span
                                    class="fa fa-times"></span></a>
                        </div>
                        <div class="modal-body">
                            <div class="garage_name">
                                <form action="{{ url('search-used-car') }}" method="post" id="submitform" class="my-2">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="col-12 mb-2 signup_vendor ">
                                                <h6 class="mb-0 heading">{{ __('msg.Price From') }} ({{ __('msg.Optional') }})</h6>
                                            </div>
                                            <input type="text" name="priceFrom" class="form-control"
                                                placeholder="{{ __('msg.AED') }}" aria-label="Model">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-sm-0 mt-2">
                                            <div class="col-12 mb-2 signup_vendor ">
                                                <h6 class="mb-0 heading">{{ __('msg.Price To') }} ({{ __('msg.Optional') }})</h6>
                                            </div>
                                            <input type="text" name="priceTo" class="form-control"
                                                placeholder="{{ __('msg.AED') }}" aria-label="Model">
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                            <div class="col-12 mb-2 signup_vendor ">
                                                <h6 class="mb-0 heading">{{ __('msg.Model From') }} ({{ __('msg.Optional') }})</h6>
                                            </div>
                                            <select class="form-select form-control model-year-field-1" name="modelFrom"
                                                aria-label="Type of Service">
                                                <option value=""></option>
                                                @foreach ($year as $data)
                                                    <option value="{{ $data->model_year }}">{{ $data->model_year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                            <div class="col-12 mb-2 signup_vendor ">
                                                <h6 class="mb-0 heading">{{ __('msg.Model To') }} ({{ __('msg.Optional') }})</h6>
                                            </div>
                                            <select class="form-select form-control model-year-field-1" name="modelTo"
                                                aria-label="Type of Service">
                                                <option value=""></option>
                                                @foreach ($year as $data)
                                                    <option value="{{ $data->model_year }}">{{ $data->model_year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                            <div class="col-12 mb-2 signup_vendor ">
                                                <h6 class="mb-0 heading">{{ __('msg.Car Maker') }} ({{ __('msg.Optional') }})</h6>
                                            </div>
                                            <select class="form-select form-control company-name-field-1" name="company_id"
                                                aria-label="Type of Service">
                                                <option value=""></option>
                                                @foreach ($company as $data)
                                                    <option value="{{ $data->company }}">{{ $data->company }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                            <div class="col-12 mb-2 signup_vendor ">
                                                <h6 class="mb-0 heading text-capitalize">{{ __('msg.mileage') }} ({{ __('msg.Optional') }})</h6>
                                            </div>
                                            <input type="text" name="milage" class="form-control"
                                                placeholder="{{ __('msg.Mileage e.g 40 Km') }}" aria-label="Model">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                            <div class="col-12 mb-2 signup_vendor ">
                                                <h6 class="mb-0 heading">{{ __('msg.Country') }} ({{ __('msg.Optional') }})</h6>
                                            </div>
                                            <select class="form-select form-control" name="country" aria-label="Country"
                                                disabled>
                                                <option disabled value="">{{ __('msg.Select Country') }}</option>
                                                <option value="United Arab Emirates" selected>
                                                    {{ __('msg.United Arab Emirates') }}</option>
                                            </select>
                                            @error('country')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                            <div class="col-12 mb-2 signup_vendor ">
                                                <h6 class="mb-0 heading">{{ __('msg.City') }} ({{ __('msg.Optional') }})</h6>
                                            </div>
                                            <select class="form-select form-control select-city" name="city" aria-label="City">
                                                <option selected disabled value="">{{ __('msg.Select City') }}
                                                </option>
                                                <option value="Dubai" @if (old('city') == 'Dubai') selected @endif>
                                                    {{ __('msg.Dubai') }}
                                                </option>
                                                <option value="Abu Dhabi"
                                                    @if (old('city') == 'Abu Dhabi') selected @endif>
                                                    {{ __('msg.Abu Dhabi') }}</option>
                                                <option value="Sharjah" @if (old('city') == 'Sharjah') selected @endif>
                                                    {{ __('msg.Sharjah') }}
                                                </option>
                                                <option value="Ras Al Khaimah"
                                                    @if (old('city') == 'Ras Al Khaimah') selected @endif>
                                                    {{ __('msg.Ras Al Khaimah') }}</option>
                                                <option value="Ajman" @if (old('city') == 'Ajman') selected @endif>
                                                    {{ __('msg.Ajman') }}
                                                </option>
                                            </select>
                                            @error('city')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary flterClass" type="submit">{{ __('msg.SEARCH') }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                @if (count($ads) > 0)
                    @foreach ($ads as $value)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="{{ route('car_detail', $value->id) }}">
                                <div class="card card_vendors shadow">
                                    <div class="car_img_wrapper">
                                        <?php
                                        $img1 = Explode(',', $value->images);
                                        ?>
                                        <img src="{{ asset($img1[0]) }}" class="card-img-top" alt="Car image">
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="card-title">{{ $value->model }}</h6>
                                            <!-- <h5 class="card-title">{{ modelYear($value->model_year_id) }}</h5> -->
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="card-title price mb-0 ">{{ __('msg.Price') }}:
                                                {{ $value->price }}</h5>
                                            <h5 class="card-title location mb-0 ">{{ $value->city }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    {{ __('msg.Oops... Sorry, no pre-owned cars found!') }}
                @endif
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <nav aria-label="..." class="d-flex align-items-center justify-content-center">
                        <span class="mt-5">{!! $ads->links() !!}</span>
                    </nav>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('script')
<script>
    $(function() {
        $('.model-year-field-1').select2({
            placeholder: 'Select Year',
        });
        $('.company-name-field-1').select2({
            placeholder: 'Select Company',
        });
        $('.select-city').select2({
            placeholder: 'Select City',
        });
    });
</script>
@endsection
