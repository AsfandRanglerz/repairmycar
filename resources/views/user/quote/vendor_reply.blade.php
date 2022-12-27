@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);">
        <div class="px-4 container-lg container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-sm-9  col-md-10 mx-auto">
                    <div class="row mt-5 mb-4 g-3">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="d-grid gap-2 mt-lg-3 ">
                                <a href="{{ route('user.quoteindex') }}"
                                    class="btn text-center btn-primary get_quot block get_appointment d-flex justify-content-center align-items-center"
                                    type="button">{{ __('msg.GO BACK TO ALL QUOTES') }}
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6  col-md-6 col-sm-6">
                            <div class="d-grid gap-2 mt-lg-3 ">
                                @if (Auth::user()->type == 'company')
                                    <a href="#" data-id="{{ $data->id }}"
                                        class="btn btn-secondary block get_appointment d-flex justify-content-center align-items-center placeOrder">{{ __('msg.ACCEPT QUOTE') }}</a>
                                    <form enctype="multipart/form-data" method="post"
                                        action="{{ url('user/order/place') }}" class="needs-validation"
                                        id="order_form{{ $data->id }}" novalidate>
                                        @csrf
                                        <input type="hidden" name="user_bid_id" value="{{ $data->user_bid_id }}">
                                        <input type="hidden" name="vendor_bid_id" value="{{ $data->id }}">
                                        <input type="hidden" name="garage_id" value="{{ $data->garage_id }}">
                                        <input type="hidden" name="net_total" value="{{ $data->net_total }}">
                                        {{-- <button
                                            class="btn btn-secondary block get_appointment d-flex justify-content-center align-items-center"
                                            type="submt">{{ __('msg.ACCEPT QUOTE') }}</button> --}}
                                    </form>
                                @else
                                    <form enctype="multipart/form-data" method="post"
                                        action="{{ route('user.payment_page') }}" class="needs-validation" novalidate>
                                        @csrf
                                        <input type="hidden" name="bid_id" value="{{ $data->id }}">
                                        <input type="hidden" name="type" value="qoute">
                                        <button
                                            class="btn btn-secondary block get_appointment d-flex justify-content-center align-items-center"
                                            type="submt">{{ __('msg.ACCEPT QUOTE') }}</button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-12">
                    <div class="all_quote_card  vendor_rply_dtlL">
                        <?php
                        $userbid = \App\Models\UserBid::where('id', $data->user_bid_id)->first();
                        $company = \App\Models\Company::where('id', $userbid->company_id)->first();
                        $garage = \App\Models\Garage::where('id', $data->garage_id)->first();
                        ?>
                        <div class="car_inner_imagg vendor_rply_dtl ">
                            <img
                                @if ($garage->image && $garage->image != null) src="{{ asset($garage->image) }}" @else src="{{ asset('public/assets/images/repair2.jpg') }}" @endif>
                        </div>
                        <div class=" w-100  quote_detail_wraper">
                            <div class="quote_info">
                                <h5 class="active_quote rply_dtl heading-color"><span
                                        class="h5 mb-0 heading-color">{{ __('msg.Garage') }}:</span>
                                    {{ $garage->garage_name }}</h5>
                                <span class="small h6 d-block mb-0 rply__dtl"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Garage Owner') }}:</span>
                                    {{ $garage->vendor->name }}</span>
                                <span class="small h6 d-block mb-0 rply__dtl"><span
                                        class="small h6 mb-0 heading-color">{{ __('msg.Garage Number') }}:</span>
                                    {{ $garage->vendor->phone }}</span>
                                <div class="card_icons respons_qoute d-flex align-items-center">
                                    <?php
                                        $category = \App\Models\GarageCategory::where('garage_id', $data->garage_id)->pluck('category_id');
                                        $category_name = \App\Models\Category::whereIn('id', $category)->get();
                                        $count = $category_name->count();
                                        if ($count > 5) {
                                            $count = 5;
                                        }
                                    ?>
                                    @for ($i = 0; $i < $count; $i++)
                                        <div class="icon_wrpaer">
                                            <img src="{{ asset($category_name[$i]->icon) }}">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="quote_detail_btn_wraper">
                                <h4 class=" text-sm-center vendor_replies_dtl">{{ __('msg.AED') }} {{ $data->net_total }}
                                </h4>
                                <div class="quote_info">
                                    <p class="quote_rev vndr_rply__dtl">{{ __('msg.Time Frame Offered') }}<span>
                                            {{ $data->time }} {{ __('msg.Days') }}</span></p>
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
                                                        class="form-control" placeholder="{{ __('msg.Particular') }}"
                                                        readonly>
                                                @else
                                                    <input type="text" value="{{ $service->service_name }}"
                                                        class="form-control mt-2" placeholder="{{ __('msg.Particular') }}"
                                                        readonly>
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
                                                        placeholder="{{ __('msg.Rate') }}" readonly>
                                                @else
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate }}" class="form-control mt-2"
                                                        placeholder="{{ __('msg.Rate') }}" readonly>
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
                                                        class="heading-color">{{ __('msg.Particular') }}</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $service->service_name }}"
                                                        placeholder="{{ __('msg.Particular') }}" readonly>
                                                @else
                                                    <input type="text" value="{{ $service->service_name }}"
                                                        class="form-control mt-2"
                                                        placeholder="{{ __('msg.Particular') }}" readonly>
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
                                                        placeholder="{{ __('msg.Rate') }}" readonly>
                                                @else
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate }}" class="form-control mt-2"
                                                        placeholder="{{ __('msg.Rate') }}" readonly>
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
                                                        class="form-control" placeholder="{{ __('msg.Particular') }}"
                                                        readonly>
                                                @else
                                                    <input type="text" value="{{ $service->service_name }}"
                                                        class="form-control mt-2"
                                                        placeholder="{{ __('msg.Particular') }}" readonly>
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
                                                        placeholder="{{ __('msg.Rate') }}" readonly>
                                                @else
                                                    <input type="number" min="1"
                                                        value="{{ $service->service_rate }}" class="form-control mt-2"
                                                        placeholder="{{ __('msg.Rate') }}" readonly>
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
                                    <h6 class="heading-color">{{ __('msg.vat') }} {{ $garage->vendor->vat }}%</h6>
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
                            <a class="btn-secondary get_appointment"
                                href="{{ url('user/print-order-details', $data->id) }}">{{ __('msg.Preview') }}</a>
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
                                            <button title=" @foreach ($userbidcategories as $userbidcategory) {{ $userbidcategory->name }}, @endforeach" class="text-truncate btn text-center btn-primary get_quot block get_appointment"
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
                                                {{ auth()->user()->name }}</button>
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
@section('script')
    <script>
        $(document).on('click', '.placeOrder', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to place order!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('order_form' + $(this).data('id')).submit();
                }
            });
        });
    </script>
@endsection
