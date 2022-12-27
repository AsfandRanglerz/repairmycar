@extends('admin.layout.app')
@section('title', 'Create New User')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('admin.vendor.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Add New Vendor</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name">
                                            @error('name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Garage Legal Name</label>
                                            <input type="text" class="form-control" placeholder="Garage Name"
                                                name="garage_name" autocomplete="off">
                                            @error('garage_name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Select Category</label>
                                            <select class="form-select form-control selectric category offer-garage-services"
                                                name="garages_catagary[]" aria-label="Type of Service" multiple="multiple">
                                                @foreach ($categories as $value)
                                                    <option value="{{ $value->name }}"
                                                        {{ collect(old('garages_catagary'))->contains($value->name) ? 'selected' : '' }}>
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('garage_catagary')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="" Placeholder="Example@gmail.com">
                                            @error('email')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country"
                                                value="United Arab Emirates" readonly>
                                            @error('country')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">City</label>
                                            <select class="form-select form-control" name="city" aria-label="City">
                                                <option selected disabled value="">{{ __('msg.Select City') }}
                                                    ({{ __('msg.Required') }})</option>
                                                <option value="Dubai" @if (old('city') == 'Dubai') selected @endif>
                                                    {{ __('msg.Dubai') }}</option>
                                                <option value="Abu Dhabi" @if (old('city') == 'Abu Dhabi') selected @endif>
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
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Company</label>
                                            <select class="form-select form-control selectric category offer-garage-services"
                                                name="company[]" aria-label="Type of Service" multiple="multiple">
                                                @foreach ($company as $value)
                                                    <option value="{{ $value->name }}"
                                                        {{ collect(old('garages_catagary'))->contains($value->name) ? 'selected' : '' }}>
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('company')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>P/O Box</label>
                                            <input type="number" class="form-control" name="post_box"
                                                placeholder="Post Box">
                                            @error('post_box')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Trading Liscense No.</label>
                                            <input type="text" class="form-control" name="trading_license"
                                                placeholder="Trading License No">
                                            @error('trading_license')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Vat</label>
                                            <input type="text" class="form-control" value="{{ $vat->percentage }}% VAT" name="vat" readonly>
                                            @error('vat')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Billing Area</label>
                                            <input type="text" class="form-control" name="billing_area"
                                                placeholder="Billing Area">
                                            @error('billing_area')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Billing City</label>
                                            <input type="text" class="form-control" name="billing_city"
                                                placeholder="Billing City">
                                            @error('billing_city')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Billing Address</label>
                                            <input type="text" class="form-control" name="billing_address"
                                                placeholder="Billing Address">
                                            @error('billing_address')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="appointment_number"
                                                placeholder="+971 XXXXXXXX">
                                            @error('appointment_number')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Profile Image</label>
                                            <input type="file" class="form-control" name="profile_image">
                                            @error('profile_image')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ID Image</label>
                                            <input type="file" class="form-control" name="id_card">
                                            @error('id_card')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Trade License and ID</label>
                                            <input type="file" class="form-control" name="image_license">
                                            @error('image_license')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
