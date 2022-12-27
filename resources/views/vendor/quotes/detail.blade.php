@extends('vendor.layout.app')
@section('content')
    <?php $company = \App\Models\Company::where('id', $data->company_id)->first(); ?>
    <section class="pb-5 login_content_wraper">
        <div class="px-md-4 container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.MY OFFERED QUOTE') }}</h4>
                        <p class="sec_main_para text-center">{{ __('msg.See How You Responded To This Request') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-lg-12 col-md-12 col-12  mx-auto">
                    <div class="table-responsive white-background-box">
                        <table class="table table-bordered table-striped table-dark mb-0">
                            <thead>
                                <tr>
                                    <th>{{ __('msg.Customer Name') }}</th>
                                    <th>{{ __('msg.Company') }}</th>
                                    <th>{{ __('msg.Registration No.') }}</th>
                                    <th>{{ __('msg.Chasis No.') }}</th>
                                    <th>{{ __('msg.Model') }}</th>
                                    <th>{{ __('msg.Mileage e.g 40 Km') }}</th>
                                    <th>{{ __('msg.Color') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $data->car_owner_name }}</td>
                                    <td>{{ $company->company }}</td>
                                    <td>{{ $data->registration_no }}</td>
                                    <td>{{ $data->Chasis_no }}</td>
                                    <td>{{ $data->modelYear->model_year }}</td>
                                    <td>{{ $data->mileage }}km</td>
                                    <td>{{ $data->color }}</td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive white-background-box mt-3">
                        <table class="table table-bordered table-striped table-dark mb-0">
                            <thead>
                                <tr>

                                    <th>{{ __('msg.Estimated Days e.g (7)') }}</th>

                                    <th>{{ __('msg.Services Required') }}</th>

                                    <th>{{ __('msg.Chat Now') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>


                                    <td>{{ isset($data->day) ? $data->day : '-' }}</td>
                                    <td>
                                        @forelse($data->services as $services)
                                            @if ($loop->iteration == 1)
                                                {{ $services->category->name }}@else, {{ $services->category->name }}
                                            @endif @empty
                                        @endforelse
                                    </td>

                                    <td>
                                        <div class="chat_view__detail d-flex justify-content-center">
                                            <a href="{{ url('vendor/chat/' . $data->user->id) }}"
                                                class="justify-content-center chat_icon">
                                                <i class="fa-solid fa-message"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row  mt-5">
                <div class="col-lg-12">
                    <div class="all_quote_card  vendor_rply_dtlL _text mb-5">
                        <h5 class="active_order_req">{{ __('msg.Requirements') }}</h5>

                        <div class="vendor__rply__dttl">
                            <p>{{ $data->description1 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $car_images = \App\Models\UserBidImage::where('user_bid_id', $data->id)
                ->where('type', 'image')
                ->first();
            $car_images = Explode(',', $car_images->car_image);
            ?>
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
            <?php
            $register_images = \App\Models\UserBidImage::where('user_bid_id', $data->id)
                ->where('type', 'registerImage')
                ->first();
            $register_images = Explode(',', $register_images->car_image);
            ?>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <h5 class="heading-color">{{ __('msg.Registration Copy Images') }} </h5>
                        <div class="owl-carousel carousel_se_03_carousel owl-theme mt-3">
                            @foreach ($register_images as $image)
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
            <?php
            $documents = \App\Models\UserBidImage::where('user_bid_id', $data->id)
                ->where('type', 'file')
                ->first();
            
            ?>
            @if ($data->looking_for == 'I have Inspection Report & Looking for the Quotations')
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="all_quote_card  vendor_rply_dtlL _text">
                            <h5 class="active_order_req">{{ __('msg.Police /Accident /Inspection Report') }}</h5>
                            <div class="owl-theme mt-4">


                                @if (isset($documents->car_image))
                                    <?php $pathinfo = pathinfo($documents->car_image);
                                    $supported_ext = ['docx', 'xlsx', 'pdf'];
                                    $src_file_name = $documents->car_image;
                                    $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>
                                    <div class="item">
                                        <div class="carAd_img_wraper doc_img customer_dashboard">
                                            @if ($ext == 'docx')
                                                <a class="text-decoration-none text-reset"
                                                    href="{{ url($documents->car_image) }}">
                                                    <img src="{{ asset('public/assets/images/wordicon.png') }}"
                                                        style="height: 100%;">
                                                </a>
                                            @elseif($ext == 'doc')
                                                <a class="text-decoration-none text-reset"
                                                    href="{{ url($documents->car_image) }}">
                                                    <img src="{{ asset('public/assets/images/wordicon.png') }}"
                                                        style="height: 100%;">
                                                </a>
                                            @elseif($ext == 'xlsx')
                                                <a class="text-decoration-none text-reset"
                                                    href="{{ url($documents->car_image) }}">
                                                    <img src="{{ asset('public/assets/images/excelicon.png') }}"
                                                        style="height: 100%;">
                                                </a>
                                            @elseif($ext == 'pdf')
                                                <a class="text-decoration-none text-reset"
                                                    href="{{ url($documents->car_image) }}">
                                                    <img src="{{ asset('public/assets/images/pdficon.png') }}"
                                                        style="height: 100%;">
                                                </a>
                                            @else
                                                <img src="{{ asset($documents->car_image) }}">
                                            @endif


                                        </div>
                                    </div>
                                @else
                                    <div class="item">
                                        <div class="carAd_img_wraper doc_img customer_dashboard">
                                            <img src="{{ asset('public/assets/images/no-file.png') }}">
                                        </div>
                                    </div>
                                @endif
                            </div>


                            <h5 class="heading-color mt-4">{{ __('msg.Special Requirements') }}</h5>

                            <div class="vendor__rply__dttl">
                                <p>{{ $data->description2 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="all_quote_card  vendor_rply_dtlL _text">
                        <form name="bidAdd" action="{{ route('vendor.bidresponse') }}" method="post">
                            @csrf
                            <div class="row ">
                                <div class="col-lg-9 mx-auto">
                                    <h6 class="heading-color">{{ __('msg.Services/Labor Details') }}
                                        ({{ __('msg.Required') }}) <sup class="fa fa-question label-fa-question"
                                            data-toggle="tooltip" data-placement="top"
                                            title=' "+" Sign will be used for Addition and "-" Sign will used be for Subtraction'></sup>
                                    </h6>
                                    <div class="conten-row-block-main-container services-details">
                                        <div class="mb-3 row content-block-row serDetail1">
                                            <div class="col-sm-4">
                                                <input type="text" name="service_name[]"
                                                    class="form-control particular-item"
                                                    placeholder="{{ __('msg.Particular') }}" required />
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="input-group">
                                                    <div class="p-0 input-group-text">
                                                        <button class='w-auto h-100 px-1 btn btn-secondary minus'><span
                                                                class="fa fa-minus"></span></button>
                                                    </div>
                                                    <input type='number' name='service_quantity[]' min='0'
                                                        value='0' class='form-control qty' />
                                                    <div class="p-0 input-group-text">
                                                        <button class='w-auto h-100 px-1 btn btn-secondary plus'><span
                                                                class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" min="1" value=''
                                                    name="services_rate[]" class="form-control item-rate"
                                                    placeholder="{{ __('msg.Rate') }}" required />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" min="1" value=''
                                                    name="services_amount[]" class="form-control item-amount"
                                                    placeholder="{{ __('msg.Amount') }}" required />
                                            </div>
                                            <div class="col-sm-2 d-flex flex-wrap">
                                                <button
                                                    class="w-auto btn btn-secondary add-btn services-detail-add-btn"><span
                                                        class="fa fa-plus"></span></button>
                                                <button class="w-auto btn btn-secondary remove-btn"><span
                                                        class="fa fa-minus"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="heading-color">{{ __('msg.Spares Details') }} ({{ __('msg.Optional') }})
                                        <sup class="fa fa-question label-fa-question" data-toggle="tooltip"
                                            data-placement="top"
                                            title=' "+" Sign will be used for Addition and "-" Sign will used be for Subtraction'></sup>
                                    </h6>
                                    <div class="conten-row-block-main-container spares-details">
                                        <div class="mb-3 row content-block-row spareDetail1">
                                            <div class="col-sm-4">
                                                <input type="text" name="spares_name[]"
                                                    class="form-control particular-item"
                                                    placeholder="{{ __('msg.Particular') }}" />
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="input-group">
                                                    <div class="p-0 input-group-text">
                                                        <button class='w-auto h-100 px-1 btn btn-secondary minus'><span
                                                                class="fa fa-minus"></span></button>
                                                    </div>
                                                    <input type='number' name='spares_quantity[]' min='0'
                                                        value='0' class='form-control qty' />
                                                    <div class="p-0 input-group-text">
                                                        <button class='w-auto h-100 px-1 btn btn-secondary plus'><span
                                                                class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" min="1" value='' name="spares_rate[]"
                                                    class="form-control item-rate" placeholder="{{ __('msg.Rate') }}" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" min="1" value=''
                                                    name="spares_amount[]" class="form-control item-amount"
                                                    placeholder="{{ __('msg.Amount') }}" />
                                            </div>
                                            <div class="col-sm-2 d-flex flex-wrap">
                                                <button
                                                    class="w-auto btn btn-secondary add-btn spares-detail-add-btn"><span
                                                        class="fa fa-plus"></span></button>
                                                <button class="w-auto btn btn-secondary remove-btn"><span
                                                        class="fa fa-minus"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="heading-color">{{ __('msg.Others') }} ({{ __('msg.Optional') }}) <sup
                                            class="fa fa-question label-fa-question" data-toggle="tooltip"
                                            data-placement="top"
                                            title=' "+" Sign will be used for Addition and "-" Sign will used be for Subtraction'></sup>
                                    </h6>
                                    <div class="conten-row-block-main-container extras-details">
                                        <div class="mb-3 row content-block-row othersDetail1">
                                            <div class="col-sm-4">
                                                <input type="text" name="others_name[]"
                                                    class="form-control particular-item"
                                                    placeholder="{{ __('msg.Particular') }}" />
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="input-group">
                                                    <div class="p-0 input-group-text">
                                                        <button class='w-auto h-100 px-1 btn btn-secondary minus'><span
                                                                class="fa fa-minus"></span></button>
                                                    </div>
                                                    <input type='number' name='others_quantity[]' min='0'
                                                        value='0' class='form-control qty' />
                                                    <div class="p-0 input-group-text">
                                                        <button class='w-auto h-100 px-1 btn btn-secondary plus'><span
                                                                class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" min="1" name="others_rate[]"
                                                    class="form-control item-rate" placeholder="{{ __('msg.Rate') }}" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" min="1" name="others_amount[]"
                                                    class="form-control item-amount"
                                                    placeholder="{{ __('msg.Amount') }}" />
                                            </div>
                                            <div class="col-sm-2 d-flex flex-wrap">
                                                <button
                                                    class="w-auto btn btn-secondary add-btn others-detail-add-btn"><span
                                                        class="fa fa-plus"></span></button>
                                                <button class="w-auto btn btn-secondary remove-btn"><span
                                                        class="fa fa-minus"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mt-3 mb-4 text-center heading-color">
                                                ({{ __('msg.Kindly Fill the above Fields First') }} !)</h5>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                            <h6 class="heading-color">{{ __('msg.Estimate Total') }}</h6>
                                            <input type="number" name="price" class="form-control amountTotal"
                                                placeholder="{{ __('msg.AED Price') }}" readonly>
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                            <h6 class="heading-color">{{ __('msg.vat') }} {{ Auth::user()->vat }}%</h6>
                                            <input type="hidden" name="bid_id" value="{{ $data->id }}">
                                            @error('bid_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <input type="hidden" name="vendor_id" value="{{ auth()->id() }}">
                                            @error('vendor_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <?php $garage = \App\Models\Garage::where('vendor_id', auth()->id())->first(); ?>
                                            <input type="hidden" name="garage_id" value="{{ $garage->id }}">
                                            <input type="number" name="vat" class="form-control vatPercent"
                                                placeholder="{{ __('msg.AED Price') }}" readonly>
                                            @error('vat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                            <h6 class="heading-color">{{ __('msg.Net Total') }}</h6>
                                            <input type="number" name="net_total" class="form-control netTotal"
                                                placeholder="{{ __('msg.AED Price') }}" readonly>
                                            @error('net_total')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                            <h6 class="heading-color">{{ __('msg.Time Frame') }}</h6>
                                            <input type="text" name="time" class="form-control"
                                                value="{{ old('time') }}"
                                                placeholder="{{ __('msg.Estimated Time') }} ({{ __('msg.Required') }})"
                                                required>
                                            @error('time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-3 form-group">
                                            <div class="form-floating">
                                                <textarea class="form-control description" name="description"
                                                    placeholder="({{ __('msg.Add information in details') }}) ({{ __('msg.Required') }})" id="floatingTextarea2"
                                                    style="height: 106px" required>{{ old('description') }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="floatingTextarea2">{{ __('msg.Add Repairing Details') }}
                                                    ({{ __('msg.Required') }})</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="d-grid gap-2 mt-3 mb-4">
                                                        <button class="btn btn-secondary block get_appointment"
                                                            id="btnSubmit"
                                                            type="submit">{{ __('msg.SUBMIT QUOTE') }}</button>
                                                    </div>

                                                </div>
                                                <input type="hidden" name="btnType" id="btnType" value="0">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="d-grid gap-2 mt-3 mb-4">
                                                        <button class="btn btn-secondary block get_appointment"
                                                            data-bs-toggle="modal" data-bs-target="#previewBidDetails"
                                                            type="button">{{ __('msg.PREVIEW QUOTE') }}</button>
                                                    </div>
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
    </section>
    <!-- Modal -->


    <div class="modal fade" id="previewBidDetails" aria-labelledby="previewBidDetails" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">PDF Live Preview</h6>
                </div>
                <div class="modal-body">
                    <div class="pb-0 main_content_wraper">
                        <h5 class="sec_main_heading text-center">
                            {{ \Illuminate\Support\Facades\Auth::user()->garage->garage_name }} {{ __('msg.GARAGE') }}
                            </h4>
                            <p class="sec_main_para text-center">
                                {{ \Illuminate\Support\Facades\Auth::user()->garage->address }} {{ __('msg.P/O Box') }}
                                {{ \Illuminate\Support\Facades\Auth::user()->garage->post_box }}</p>
                            <p class="sec_main_para text-center"><b>Tel :
                                </b><span>{{ \Illuminate\Support\Facades\Auth::user()->garage->phone }}</span>,
                                <b>{{ __('msg.Fax') }} :
                                </b><span>3881433</span>
                            </p>
                            <p class="sec_main_para text-center"><b>{{ __('msg.Email') }} :
                                </b><span>{{ \Illuminate\Support\Facades\Auth::user()->email }}</span></p>
                            <h5 class="sec_main_heading text-center my-3">{{ __('msg.JOB ESTIMATE') }}</h5>
                            <div class="table-responsive bg-white">
                                <table class="table table-bordered table-striped table-dark mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <td colspan="2">{{ \Illuminate\Support\Facades\Auth::user()->name }}</td>
                                            <th>{{ __('msg.id') }}</th>
                                            <td>{{ mt_rand(1, 999999) }}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>{{ __('msg.Phone') }}</th>
                                            <td>{{ \Illuminate\Support\Facades\Auth::user()->phone }}</td>
                                            <th>{{ __('msg.Fax') }} :</th>
                                            <th>{{ __('msg.Date') }}</th>
                                            <td>{{ \Carbon\Carbon::parse($data->created)->format('d-M-Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="mt-3">{{ __('msg.Vehicle Detail') }} :</h6>
                            <div class="table-responsive bg-white">
                                <table class="table table-bordered table-striped table-dark mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('msg.Registration No.') }}</th>
                                            <td>{{ $data->registration_no }}</td>
                                            <th>{{ __('msg.mileage') }}.</th>
                                            <td>{{ $data->mileage }}{{ __('msg.Km') }}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>{{ __('msg.Car Make') }}</th>
                                            <td>{{ $company->company }}</td>
                                            <th>{{ __('msg.Color') }}</th>
                                            <td>{{ $data->color }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('msg.Chasis No.') }}</th>
                                            <td>{{ $data->Chasis_no }}</td>
                                            <th>{{ __('msg.Color') }}</th>

                                            <td>{{ $data->modelYear->model_year }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="mt-3">{{ __('msg.Services Detail') }} :</h6>
                            <div class="table-responsive bg-white">
                                <table class="table table-bordered table-striped table-dark mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('msg.SL No') }}</th>
                                            <th>{{ __('msg.Particular') }}</th>
                                            <th>{{ __('msg.Qty') }}</th>
                                            <th>{{ __('msg.Rate') }}</th>
                                            <th>{{ __('msg.Amount') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="serDetail1">
                                            <td>1</td>
                                            <td class="particular-item"></td>
                                            <td class="qty"></td>
                                            <td><span class="item-rate"></span>.00</td>
                                            <td><span class="item-amount"></span>.00</td>
                                        </tr>
                                        <tr class="services-detail">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th>{{ __('msg.Services') }} : </th>
                                            <td class="services-details"><span class="inner"></span>.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="mt-3">{{ __('msg.Spares Details') }}:</h6>
                            <div class="table-responsive bg-white">
                                <table class="table table-bordered table-striped table-dark mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('msg.SL No') }}</th>
                                            <th>{{ __('msg.Particular') }}</th>
                                            <th>{{ __('msg.Qty') }}</th>
                                            <th>{{ __('msg.Rate') }}</th>
                                            <th>{{ __('msg.Amount') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="spareDetail1">
                                            <td>1</td>
                                            <td class="particular-item"></td>
                                            <td class="qty"></td>
                                            <td><span class="item-rate"></span>.00</td>
                                            <td><span class="item-amount"></span>.00</td>
                                        </tr>
                                        <tr class="spares-detail">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th>{{ __('msg.Spares') }} : </th>
                                            <td class="spares-details"><span class="inner"></span>.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="mt-3">{{ __('msg.Others') }} :</h6>
                            <div class="table-responsive bg-white">
                                <table class="table table-bordered table-striped table-dark mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('msg.SL No') }}</th>
                                            <th>{{ __('msg.Particular') }}</th>
                                            <th>{{ __('msg.Qty') }}</th>
                                            <th>{{ __('msg.Rate') }}</th>
                                            <th>{{ __('msg.Amount') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="othersDetail1">
                                            <td>1</td>
                                            <td class="particular-item"></td>
                                            <td class="qty"></td>
                                            <td><span class="item-rate"></span>.00</td>
                                            <td><span class="item-amount"></span>.00</td>
                                        </tr>
                                        <tr class="others-detail">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th>{{ __('msg.Others') }} : </th>
                                            <td class="extras-details"><span class="inner"></span>.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="my-3 row mx-0">
                                <div class="offset-md-7 col-md-5 offset-sm-4 col-sm-8">
                                    <div class="row">
                                        <b class="col-6">{{ __('msg.Estimate Total') }}</b>
                                        <div class="col-6 text-xl-right">
                                            <span class="amountTotal"></span>.00</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <b class="col-6">{{ __('msg.vat') }} 5%</b>
                                        <div class="col-6 text-xl-right">
                                            <span class="vatPercent"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <b class="col-6">{{ __('msg.Net Total') }}</b>
                                        <div class="col-6 text-xl-right">
                                            <span class="netTotal"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p id="repairingDetails" class="font-italic"></p>
                                <p class="font-italic">
                                    {{ __('msg.Remarks: ALL PARTS USED AND AFTERMARKET......... NO WARRANTY') }}</p>
                                <b class="font-italic small">{{ __('msg.offer_term') }}/b>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
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
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            var validator = $("form[name='bidAdd']").validate({
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
                    price: "required",
                    vat: "required",
                    net_total: "required",
                    time: "required",
                    description: "required",
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
                    } else if (elem.hasClass("description")) {
                        console.log('true');
                        var element2 = elem.closest('.form-group').find('.form-floating');
                        error.insertAfter(element2);
                    } else if (elem.hasClass('inteltel')) {
                        var element2 = elem.closest('.iti');
                        error.insertAfter(element2);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
        $(function() {
            if ($('span').hasClass('text-danger')) {
                toastr.error("Failed! You've to fill the Required Fields");
            }

            /*tooltip*/
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            });
            /*tooltip*/
        });
        $(document).ready(function() {
            $(document).on('click', '#preview', function(event) {
                $('#btnType').val('1');
            });
            $(document).on('click', '#btnSubmit', function(event) {
                $('#btnType').val('0');
            })
        });

        $('textarea[name="description"]').keyup(function() {
            let repDescription = $(this).val();
            $('#repairingDetails').text(repDescription);
        });

        let serDetail = 1;
        let sertrId = 1;
        let sertdId = 1;

        let sparesDetail = 1;
        let sparestrId = 1;
        let sparestdId = 1;

        let othersDetail = 1;
        let otherstrId = 1;
        let otherstdId = 1;

        $(document).on('click', '.services-detail-add-btn', function(e) {
            e.preventDefault();

            $('.services-detail').before(`<tr class="serDetail${++sertrId}">
                <td>${++sertdId}</td>
                <td class="particular-item"></td>
                <td class="qty"></td>
                <td><span class="item-rate"></span>.00</td>
                <td><span class="item-amount"></span>.00</td>
            </tr>`);

            $(this).closest('.conten-row-block-main-container').append(`<div class="mb-3 row content-block-row serDetail${++serDetail}">
                                        <div class="col-sm-4">
                                            <input type="text" name="service_name[]" class="form-control particular-item" placeholder="{{ __('msg.Particular') }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <div class="p-0 input-group-text">
                                                    <button class="w-auto h-100 px-1 btn btn-secondary minus"><span class="fa fa-minus" aria-hidden="true"></span></button>
                                                </div>
                                                <input type="number" name="service_quantity[]" min="0" value="0" class="form-control qty">
                                                <div class="p-0 input-group-text">
                                                    <button class="w-auto h-100 px-1 btn btn-secondary plus"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" min="1" value="" name="services_rate[]" class="form-control item-rate" placeholder="{{ __('msg.Rate') }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" min="1" value="" name="services_amount[]" class="form-control item-amount" placeholder="{{ __('msg.Amount') }}">
                                        </div>
                                        <div class="col-sm-2 d-flex flex-wrap">
                                            <button class="w-auto btn btn-secondary add-btn services-detail-add-btn"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                            <button class="w-auto btn btn-secondary remove-btn"><span class="fa fa-minus" aria-hidden="true"></span></button>
                                        </div>
                                    </div>`);

        });

        $(document).on('click', '.spares-detail-add-btn', function(e) {
            e.preventDefault();

            $('.spares-detail').before(`<tr class="spareDetail${++sparestrId}">
                <td>${++sparestdId}</td>
                <td class="particular-item"></td>
                <td class="qty"></td>
                <td><span class="item-rate"></span>.00</td>
                <td><span class="item-amount"></span>.00</td>
            </tr>`);

            $(this).closest('.conten-row-block-main-container').append(`<div class="mb-3 row content-block-row spareDetail${++sparesDetail}">
                                        <div class="col-sm-4">
                                            <input type="text" name="spares_name[]" class="form-control particular-item" placeholder="{{ __('msg.Particular') }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <div class="p-0 input-group-text">
                                                    <button class="w-auto h-100 px-1 btn btn-secondary minus"><span class="fa fa-minus" aria-hidden="true"></span></button>
                                                </div>
                                                <input type="number" name="spares_quantity[]" min="0" value="0" class="form-control qty">
                                                <div class="p-0 input-group-text">
                                                    <button class="w-auto h-100 px-1 btn btn-secondary plus"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" min="1" value="" name="spares_rate[]" class="form-control item-rate" placeholder="{{ __('msg.Rate') }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" min="1" value="" name="spares_amount[]" class="form-control item-amount" placeholder="{{ __('msg.Amount') }}">
                                        </div>
                                        <div class="col-sm-2 d-flex flex-wrap">
                                            <button class="w-auto btn btn-secondary add-btn spares-detail-add-btn"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                            <button class="w-auto btn btn-secondary remove-btn"><span class="fa fa-minus" aria-hidden="true"></span></button>
                                        </div>
                                    </div>`);

        });

        $(document).on('click', '.others-detail-add-btn', function(e) {
            e.preventDefault();

            $('.others-detail').before(`<tr class="othersDetail${++otherstrId}">
                <td>${++otherstdId}</td>
                <td class="particular-item"></td>
                <td class="qty"></td>
                <td><span class="item-rate"></span>.00</td>
                <td><span class="item-amount"></span>.00</td>
            </tr>`);

            $(this).closest('.conten-row-block-main-container').append(`<div class="mb-3 row content-block-row othersDetail${++othersDetail}">
                                        <div class="col-sm-4">
                                            <input type="text" name="others_name[]" class="form-control particular-item" placeholder="{{ __('msg.Particular') }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <div class="p-0 input-group-text">
                                                    <button class="w-auto h-100 px-1 btn btn-secondary minus"><span class="fa fa-minus" aria-hidden="true"></span></button>
                                                </div>
                                                <input type="number" name="others_quantity[]" min="0" value="0" class="form-control qty">
                                                <div class="p-0 input-group-text">
                                                    <button class="w-auto h-100 px-1 btn btn-secondary plus"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" min="1" value="" name="others_rate[]" class="form-control item-rate" placeholder="{{ __('msg.Rate') }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" min="1" value="" name="others_amount[]" class="form-control item-amount" placeholder="{{ __('msg.Amount') }}">
                                        </div>
                                        <div class="col-sm-2 d-flex flex-wrap">
                                            <button class="w-auto btn btn-secondary add-btn others-detail-add-btn"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                            <button class="w-auto btn btn-secondary remove-btn"><span class="fa fa-minus" aria-hidden="true"></span></button>
                                        </div>
                                    </div>`);

        });

        $(document).on('click', '.remove-btn', function(e) {
            e.preventDefault();
            let mainParent = $(this).closest('.content-block-row').attr('class').split(' ').pop();
            $('.' + mainParent).remove();
        });

        $(document).on('keyup', ".particular-item, .qty, .item-rate", function() {
            setTimeout(() => {
                let $parItem = $(this).closest('.content-block-row').find('input.particular-item').val();

                let $quanInput = $(this).closest('.content-block-row').find('input.qty');
                let val1 = parseInt($quanInput.val());

                let $rateInput = $(this).closest('.content-block-row').find('input.item-rate');
                let val2 = parseInt($rateInput.val());

                let $amountInput = $(this).closest('.content-block-row').find('input.item-amount');
                $amountInput.val(val1 * val2).change();
                amountTotal();

                let mainParent = $(this).closest('.content-block-row').attr('class').split(' ').pop();
                $('.' + mainParent).find('.particular-item').text($parItem);
                $('.' + mainParent).find('.item-rate').text(val2);
                $('.' + mainParent).find('.qty').text(val1);
                $('.' + mainParent).find('.item-amount').text(val1 * val2);

                let mainDiv = $(this).closest('.conten-row-block-main-container').attr('class').split(' ')
                    .pop();
                let itemAmount = $('.' + mainDiv).find('.item-amount');
                var sum = 0;
                $(itemAmount).each(function(e) {
                    sum += parseInt($(this).val());
                });
                $('.' + mainDiv).find('.inner').text(sum);
            }, 500);
        });

        /*Amount Total, Vat, Net Total Calculations*/
        $(document).on('click', '.plus', function(e) {
            e.preventDefault();
            let $quanInput = $(this).closest('.input-group').find('input.qty');
            let val1 = parseInt($quanInput.val());
            $quanInput.val(val1 + 1).change();

            let $rateInput = $(this).closest('.content-block-row').find('input.item-rate');
            let val2 = parseInt($rateInput.val());

            let $amountInput = $(this).closest('.content-block-row').find('input.item-amount');
            $amountInput.val((val1 + 1) * val2).change();

            let mainParent = $(this).closest('.content-block-row').attr('class').split(' ').pop();
            $('.' + mainParent).find('.qty').text(val1 + 1);
            $('.' + mainParent).find('.item-amount').text((val1 + 1) * val2);

            let mainDiv = $(this).closest('.conten-row-block-main-container').attr('class').split(' ').pop();
            let itemAmount = $('.' + mainDiv).find('.item-amount');
            var sum = 0;
            $(itemAmount).each(function(e) {
                sum += parseInt($(this).val());
            });
            $('.' + mainDiv).find('.inner').text(sum);
            amountTotal();
        });

        $(document).on('click', '.minus', function(e) {
            e.preventDefault();
            let $quanInput = $(this).closest('.input-group').find('input.qty');
            var val1 = parseInt($quanInput.val());

            let $rateInput = $(this).closest('.content-block-row').find('input.item-rate');
            let val2 = parseInt($rateInput.val());

            let $amountInput = $(this).closest('.content-block-row').find('input.item-amount');
            $amountInput.val((val1 - 1) * val2).change();

            if (val1 > 0) {
                $quanInput.val(val1 - 1).change();
                let mainParent = $(this).closest('.content-block-row').attr('class').split(' ').pop();
                $('.' + mainParent).find('.qty').text(val1 - 1);
                $('.' + mainParent).find('.item-amount').text((val1 - 1) * val2);

                let mainDiv = $(this).closest('.conten-row-block-main-container').attr('class').split(' ').pop();
                let itemAmount = $('.' + mainDiv).find('.item-amount');
                var sum = 0;
                $(itemAmount).each(function(e) {
                    sum += parseInt($(this).val());
                });
                $('.' + mainDiv).find('.inner').text(sum);
                amountTotal();
            }
        });

        function amountTotal() {
            var sum_value = 0;
            $('.item-amount').each(function() {
                sum_value += +$(this).val();
                $('.amountTotal').val(sum_value);
                $('.amountTotal').text(sum_value);
            });

            var amountTotal = parseInt($('.amountTotal').val());

            //The percent that we want to get.
            var percentToGet = {{ Auth::user()->vat }};

            //Calculate the percent.
            var percentCal = (percentToGet / 100) * amountTotal;

            var percentRoundOff = parseInt(Math.ceil(percentCal));
            //Alert it out for demonstration purposes.
            // alert(percentToGet + "% of " + amountTotal + " is " + percent);

            $('.vatPercent').val(percentRoundOff);
            $('.vatPercent').text(percentRoundOff);
            let netTotal = amountTotal + percentRoundOff
            $('.netTotal').val(netTotal);
            $('.netTotal').text(netTotal);
        }
        /*Amount Total, Vat, Net Total Calculations*/

        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        var validator = $("form[name='bidAdd']").validate({
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
                } else if (!$element.prop('required') && ($element.val() == '' || $element.val() == null)) {
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
                // looking_for: "required",
                // model: "required",
                // company_id: "required",
                // registration_no: "required",
                // Chasis_no: "required",
                // color: "required",
                // model_year_id: "required",
                // mileage: "required",
                // day: "required",
                // "category[]": "required",
                // "car_images[]": "required",
                // "document[]": "required"
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
                    elem.closest('.form-group').find('span.select2-selection').removeClass(validClass);
                } else {
                    elem.addClass(errorClass);
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    elem.closest('.form-group').find('input').addClass(validClass);
                    elem.closest('.form-group').find('input').removeClass(errorClass);
                    elem.closest('.form-group').find('span.select2-selection').removeClass(errorClass);
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
                } else if (elem.hasClass('description')) {
                    var element2 = elem.closest('.form-floating');
                    error.insertAfter(element2);
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
@endsection
