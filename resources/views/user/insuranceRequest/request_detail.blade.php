@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);">
        <div class="px-4 container-lg container-fluid">
            <?php
            $userbid = \App\Models\UserBid::where('id', $data->user_bid_id)->first();
            $insurance = \App\Models\InsuranceRequest::where('vendor_bid_id', $data->id)->first();
            $company = \App\Models\Company::where('id', $userbid->company_id)->first();
            $garage = \App\Models\Garage::where('id', $data->garage_id)->first();
            $car_images = \App\Models\UserBidImage::where('user_bid_id', $userbid->id)
                ->where('type', 'image')
                ->first();
            $car_images = Explode(',', $car_images->car_image);
            ?>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-3">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.CAR DETAILS') }}</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <h5 class="heading-color">{{ __('msg.CAR IMAGES') }}</h5>
                        <div class="owl-carousel carousel_se_03_carousel owl-theme mt-3">
                            @foreach ($car_images as $image)
                                <div class="item">
                                    <div class="carAd_img_wraper doc_img customer_dashboard">
                                        <img src="{{ asset($image) }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  mt-5">
                <div class="col-lg-12">

                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <div class="over_view_part carad_data vendor_detail">
                            <h5 class=" text-center mb-5 heading heading-color">{{ __('msg.REPAIR DETAILS') }}</h5>
                        </div>
                        <div class="col-md-9 mx-auto vendor__rply__dttl">
                            <h6 class="heading-color">{{ __('msg.Services Detail') }}</h6>
                            <div class="conten-row-block-main-container services-details">
                                <div class="mb-3 row content-block-row">
                                    @php
                                        $count = 0;
                                    @endphp
                                    @forelse($data->part as $service)
                                        @if ($service->type == 'services')
                                            <div class="col-sm-4">

                                                @if ($count == 0)
                                                    <label for="particular"
                                                        class="heading-color">{{ __('msg.Particular') }}</label>
                                                    <input type="text" value="{{ $service->service_name }}"
                                                        class="form-control" placeholder="Particular" readonly>
                                                @else
                                                    <input type="text" value="{{ $service->service_name }}"
                                                        class="form-control mt-2" placeholder="Particular" readonly>
                                                @endif

                                            </div>
                                            <div class="col-sm-2">
                                                @if ($count == 0)
                                                    <label for="quantity"
                                                        class="heading-color">{{ __('msg.Quantity') }}</label>
                                                    <input type="number" value="{{ $service->service_quantity }}"
                                                        class="form-control" readonly>
                                                @else
                                                    <input type="number" value="{{ $service->service_quantity }}"
                                                        class="form-control mt-2" readonly>
                                                @endif

                                            </div>
                                            <div class="col-sm-3">
                                                @if ($count == 0)
                                                    <label for="rate"
                                                        class="heading-color">{{ __('msg.Rate') }}</label>
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate }}" class="form-control"
                                                        placeholder="Rate" readonly>
                                                @else
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate }}" class="form-control mt-2"
                                                        placeholder="Rate" readonly>
                                                @endif

                                            </div>
                                            <div class="col-sm-3">
                                                @if ($count++ == 0)
                                                    <label for="amount"
                                                        class="heading-color">{{ __('msg.Amount') }}</label>
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate * $service->service_quantity }}"
                                                        class="form-control" placeholder="Amount" readonly>
                                                @else
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate * $service->service_quantity }}"
                                                        class="form-control mt-2" placeholder="Amount" readonly>
                                                @endif

                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <h6 class="heading-color">{{ __('msg.Spares Details') }}</h6>
                            <div class="conten-row-block-main-container services-details">
                                <div class="mb-3 row content-block-row">
                                    @php
                                        $count = 0;
                                    @endphp
                                    @forelse($data->part as $service)
                                        @if ($service->type == 'spares')
                                            <div class="col-sm-4">
                                                @if ($count == 0)
                                                    <label for="particular"
                                                        class="heading-color">{{ __('msg.Amount') }}</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $service->service_name }}" placeholder="Particular"
                                                        readonly>
                                                @else
                                                    <input type="text" value="{{ $service->service_name }}"
                                                        class="form-control mt-2" placeholder="Particular" readonly>
                                                @endif
                                            </div>
                                            <div class="col-sm-2">
                                                @if ($count == 0)
                                                    <label for="quantity"
                                                        class="heading-color">{{ __('msg.Quantity') }}</label>
                                                    <input type="number" value="{{ $service->service_quantity }}"
                                                        class="form-control" readonly>
                                                @else
                                                    <input type="number" value="{{ $service->service_quantity }}"
                                                        class="form-control mt-2" readonly>
                                                @endif
                                            </div>
                                            <div class="col-sm-3">
                                                @if ($count == 0)
                                                    <label for="rate"
                                                        class="heading-color">{{ __('msg.Rate') }}</label>
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate }}" class="form-control"
                                                        placeholder="Rate" readonly>
                                                @else
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate }}" class="form-control mt-2"
                                                        placeholder="Rate" readonly>
                                                @endif
                                            </div>
                                            <div class="col-sm-3">
                                                @if ($count++ == 0)
                                                    <label for="amount"
                                                        class="heading-color">{{ __('msg.Amount') }}</label>
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate * $service->service_quantity }}"
                                                        class="form-control" placeholder="Amount" readonly>
                                                @else
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate * $service->service_quantity }}"
                                                        class="form-control mt-2" placeholder="Amount" readonly>
                                                @endif
                                            </div>
                                        @endif

                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <h6 class="heading-color">{{ __('msg.Others') }}</h6>
                            <div class="conten-row-block-main-container services-details">
                                <div class="mb-3 row content-block-row">
                                    @php
                                        $total = 0;
                                        $count = 0;
                                    @endphp
                                    @forelse($data->part as $service)
                                        @php
                                            $total += $service->service_rate * $service->service_quantity;
                                        @endphp
                                        @if ($service->type == 'others')
                                            <div class="col-sm-4">
                                                @if ($count == 0)
                                                    <label for="particular"
                                                        class="heading-color">{{ __('msg.Particular') }}</label>
                                                    <input type="text" value="{{ $service->service_name }}"
                                                        class="form-control" placeholder="Particular" readonly>
                                                @else
                                                    <input type="text" value="{{ $service->service_name }}"
                                                        class="form-control mt-2" placeholder="Particular" readonly>
                                                @endif
                                            </div>
                                            <div class="col-sm-2">
                                                @if ($count == 0)
                                                    <label for="quantity"
                                                        class="heading-color">{{ __('msg.Quantity') }}</label>
                                                    <input type="number" value="{{ $service->service_quantity }}"
                                                        class="form-control" readonly>
                                                @else
                                                    <input type="number" value="{{ $service->service_quantity }}"
                                                        class="form-control mt-2" readonly>
                                                @endif
                                            </div>
                                            <div class="col-sm-3">
                                                @if ($count == 0)
                                                    <label for="rate"
                                                        class="heading-color">{{ __('msg.Rate') }}</label>
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate }}" class="form-control"
                                                        placeholder="Rate" readonly>
                                                @else
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate }}" class="form-control mt-2"
                                                        placeholder="Rate" readonly>
                                                @endif
                                            </div>
                                            <div class="col-sm-3">
                                                @if ($count++ == 0)
                                                    <label for="amount"
                                                        class="heading-color">{{ __('msg.Amount') }}</label>
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate * $service->service_quantity }}"
                                                        class="form-control" placeholder="Amount" readonly>
                                                @else
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate * $service->service_quantity }} mt-2"
                                                        class="form-control" placeholder="Amount" readonly>
                                                @endif
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <h6 class="heading-color">{{ __('msg.Estimate Total') }}</h6>
                                    <input type="number" value="{{ $total }}" class="form-control"
                                        placeholder="AED Price" readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <h6 class="heading-color">{{ __('msg.vat') }} 5%</h6>
                                    <input type="number" value="{{ $data->vat }}" class="form-control"
                                        placeholder="AED Price" readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <h6 class="heading-color">{{ __('msg.Net Total') }}</h6>
                                    <input type="number" value="{{ $data->vat + $total }}" class="form-control"
                                        placeholder="AED Price" readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <h6 class="heading-color">{{ __('msg.Time Frame') }}</h6>
                                    <input type="text" value="{{ $data->time }}" name="time"
                                        class="form-control" placeholder="Estimated Time" readonly>
                                </div>
                            </div>
                            <h6 class="heading-color">{{ __('msg.REPAIR DETAILS') }}</h6>
                            <p>{{ $data->description }}</p>
                            <div class="row">
                                <div class="col-xl-8 col-lg-7 col-sm-9  col-md-10 mx-auto">
                                    @if ($insurance->status == 0)
                                        <div class="row mt-5 mb-4 g-3">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="d-grid gap-2 mt-lg-3 ">
                                                    <a target="_blank"href="{{ url('user/print-order-details', $data->id) }}"
                                                        class="btn text-center btn-primary get_quot block get_appointment d-flex justify-content-center align-items-center"
                                                        type="button">{{ __('msg.Preview') }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6  col-md-6 col-sm-6">
                                                <div class="d-grid gap-2 mt-lg-3 ">
                                                    <a href="{{ route('user.payments', $data->id) }}"
                                                        class="btn text-center btn-primary get_quot block get_appointment d-flex justify-content-center align-items-center"
                                                        type="button">{{ __('msg.Make Payment') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <a target="_blank" class="btn-secondary get_appointment"
                                            href="{{ url('user/print-order-detail', $data->id) }}">Preview</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  mt-5">
                <div class="col-lg-12">

                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <div class="over_view_part carad_data vendor_detail">
                            <h5 class="text-center mb-5 heading heading-color">{{ __('msg.CAR DETAILS') }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-10 col-sm-8  mx-auto">
                                <div class="row mt-1 g-3">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="d-grid gap-2 ">
                                            <button class="btn text-center btn-primary get_quot block get_appointment"
                                                type="button">{{ __('msg.Model') }} : {{ $userbid->model }}</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="d-grid gap-2">
                                            <button class="btn text-center btn-primary get_quot block get_appointment"
                                                type="button">{{ __('msg.Car Make') }} :
                                                {{ $company->company }}</button>
                                        </div>
                                    </div>
                                    <?php $userbidcateg = \App\Models\UserBidCategory::where('user_bid_id', $data->user_bid_id)->pluck('category_id');
                                    $userbidcategories = \App\Models\Category::whereIn('id', $userbidcateg)->get(); ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="d-grid gap-2 ">
                                            <button class="btn text-center btn-primary get_quot block get_appointment"
                                                type="button">{{ __('msg.Type of Service') }} : @foreach ($userbidcategories as $userbidcategory)
                                                    {{ $userbidcategory->name }},
                                                @endforeach
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="d-grid gap-2 ">
                                            <button class="btn text-center btn-primary get_quot block get_appointment"
                                                type="button">{{ __('msg.Customer Name') }} :
                                                {{ $userbid->car_owner_name }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
