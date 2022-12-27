@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">

                            <div class="card-header">
                                <h4>Quotation Detail</h4>
                            </div>
                            @php
                                $img = \App\Models\UserBidImage::where('user_bid_id', $quote->id)
                                    ->where('type', 'image')
                                    ->oldest()
                                    ->first();
                                $registerImage = \App\Models\UserBidImage::where('user_bid_id', $quote->id)
                                    ->where('type', 'registerImage')
                                    ->oldest()
                                    ->first();
                                $file = \App\Models\UserBidImage::where('user_bid_id', $quote->id)
                                    ->where('type', 'file')
                                    ->oldest()
                                    ->first();
                                $company = \App\Models\Company::where('id', $quote->company_id)->first();
                                $total_bid = \App\Models\VendorBid::where('user_bid_id', $quote->id)->count();
                                $images = Explode(',', $img->car_image);
                                $registerImage = Explode(',', $registerImage->car_image);
                                $files = Explode(',', $file->car_image);
                            @endphp
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Car Images</label>
                                        <div class=" border border-dark p-1 images">
                                            @foreach ($images as $image)
                                                <a href="{{ asset($image) }}">
                                                    <img src="{{ asset($image) }}" alt="" height="60px"
                                                        width="90px">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Documents</label>
                                        <div class="border border-dark p-1 images">
                                            @foreach ($registerImage as $file)
                                                <a href="{{ asset($file) }}">
                                                    <img src="{{ asset($file) }}" alt="" w height="60px"
                                                        width="90px">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @if (isset($files))
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Accident/Inspection Report</label>
                                            @foreach ($files as $file)
                                                @php
                                                    $ext = explode('.', $file);
                                                @endphp
                                                @if ($ext[1] == 'pdf')
                                                    <div class="border border-dark p-1">
                                                        <a target="_black" href="{{ asset($file) }}">
                                                            <img src="{{ asset('public/assets/images/pdficon.png') }}"
                                                                height="60px" width="90px"></a>
                                                    @else
                                                        <div class="border border-dark p-1 images">
                                                            <a href="{{ asset($file) }}">
                                                                <img src="{{ asset('/' . $file) }}" height="60px"
                                                                    width="90px"></a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Description</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="" id="" cols="40" rows="5"> {{ $quote->description2 }}</textarea>
                                        </div>
                                    </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Owner Name</label>
                                    <p class="form-control">{{ $quote->car_owner_name }}</p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Role</label>
                                    @if ($quote->user->type == 'user')
                                        <p class="form-control">Customer</p>
                                    @else
                                        <p class="form-control">Insurance Company</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Company</label>
                                    <p class="form-control">{{ $quote->company->company }}</p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Model</label>
                                    <p class="form-control">{{ $quote->model }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Model year</label>
                                    <p class="form-control">{{ $quote->modelYear->model_year }}</p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Color</label>
                                    <p class="form-control">{{ $quote->color }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Registeration Number</label>
                                    <p class="form-control">{{ $quote->registration_no }}</p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Chasis Number</label>
                                    <p class="form-control">{{ $quote->Chasis_no }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Requirement Description</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="" id="" cols="40" rows="5"> {{ $quote->description2 }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Services</label>
                                    <p class="form-control">
                                        @foreach ($categoreis as $data)
                                            {{ $data->name }},
                                        @endforeach
                                    </p>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">

                            <div class="row">

                            </div>
                        </div>

                    </div>
                </div>
            </div>

    </div>
    </section>
    </div>
@endsection
