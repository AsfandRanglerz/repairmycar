@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('admin.vendor.update', ['vendor' => $vendor->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Vendor</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name', $vendor->name) }}">
                                            @error('name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" autocomplete="off"
                                                readonly value="{{ old('email', $vendor->email) }}">
                                            @error('email')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone"
                                                value="{{ old('phone', $vendor->phone) }}">
                                            @error('phone')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Garage Name</label>
                                            <input type="text" class="form-control" name="garage_name"
                                                value="{{ old('garage_name', $vendor->garage_name) }}">
                                            @error('garage_name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country"
                                                value="United Arab Emirates"readonly>
                                            @error('country')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="city" class="form-label">City</label>
                                            <select class="form-control selectric category" name="city">
                                                <option selected disabled value="">{{ __('msg.Select City') }}
                                                </option>
                                                <option value="Dubai" @if ($vendor->city == 'Dubai') selected @endif
                                                    @if (old('city') == 'Dubai') selected @endif>
                                                    {{ __('msg.Dubai') }}</option>
                                                <option value="Abu Dhabi" @if ($vendor->city == 'Abu Dhabi') selected @endif
                                                    @if (old('city') == 'Abu Dhabi') selected @endif>
                                                    {{ __('msg.Abu Dhabi') }}</option>
                                                <option value="Sharjah" @if ($vendor->city == 'Sharjah') selected @endif
                                                    @if (old('city') == 'Sharjah') selected @endif>
                                                    {{ __('msg.Sharjah') }}</option>
                                                <option value="Ras Al Khaimah"
                                                    @if ($vendor->city == 'Ras Al Khaimah') selected @endif
                                                    @if (old('city') == 'Ras Al Khaimah') selected @endif>
                                                    {{ __('msg.Ras Al Khaimah') }}</option>
                                                <option value="Ajman" @if ($vendor->city == 'Ajman') selected @endif
                                                    @if (old('city') == 'Ajman') selected @endif>
                                                    {{ __('msg.Ajman') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ old('address', $vendor->address) }}">
                                            @error('address')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Post Box</label>
                                            <input type="text" class="form-control" name="post_box"
                                                value="{{ old('post_box', $vendor->post_box) }}">
                                            @error('post_box')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Appointment Number</label>
                                            <input type="text" class="form-control" name="appointment_number"
                                                value="{{ old('appointment_number', $vendor->appointment_number) }}">
                                            @error('appointment_number')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Billing Address</label>
                                            <input type="text" class="form-control" name="billing_address"
                                                value="{{ old('billing_address', $vendor->billing_address) }}">
                                            @error('billing_address')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Billing Area</label>
                                            <input type="text" class="form-control" name="billing_area"
                                                value="{{ old('billing_area', $vendor->billing_area) }}">
                                            @error('billing_area')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Billing City</label>
                                            <input type="text" class="form-control" name="billing_city"
                                                value="{{ old('billing_city', $vendor->billing_city) }}">
                                            @error('billing_city')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="city" class="form-label">Insurance Company</label>
                                            <select class="form-control selectric category" name="company[]"
                                                multiple="multiple">
                                                @foreach ($company as $data)
                                                    <option value="{{ $data->id }}"
                                                        @if (isset($vendor->company[0])) @foreach ($vendor->company as $company)
                                                    @if ($company->name == $data->name)
                                                    selected @endif
                                                        @endforeach
                                                @endif>

                                                {{ $data->name }}</option>
                                                @endforeach

                                            </select>
                                            @error('company')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Vat %</label>
                                            <input type="text" class="form-control" name="vat"
                                                value="{{ old('vat', $vendor->vat) }}">
                                            @error('vat')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @php
                                        $ext = explode('.', $vendor->id_card);
                                        $ext1 = explode('.', $vendor->image_license);
                                    @endphp
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Profile Image</label>
                                            <input type="file" name="image[]" class="form-control">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div><img
                                                    @if ($vendor->image) src="{{ asset('/' . $vendor->image) }}" @else src="{{ asset('public/admin/assets/img/user.png') }}" @endif
                                                    style="height: 100px;width:100px">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ID Card Image</label>
                                            <input type="file" name="id_card[]" class="form-control">
                                            @error('id_card')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div>
                                                @if ($ext[1] == 'pdf')
                                                    <img src="{{ asset('public/assets/images/pdficon.png') }}"
                                                        style="height: 100px;width:100px"></a>
                                                @else
                                                    <img @if ($vendor->id_card) src="{{ asset('/' . $vendor->id_card) }}" @else src="{{ asset('public/admin/assets/img/user.png') }}" @endif
                                                        style="height: 100px;width:100px"></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Trading License</label>
                                            <input type="file" name="image_license[]" class="form-control">
                                            @error('image_license')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div>
                                                @if ($ext1[1] == 'pdf')
                                                    <img src="{{ asset('public/assets/images/pdficon.png') }}"
                                                        style="height: 100px;width:100px"></a>
                                                @else
                                                    <img @if (isset($vendor->image_license)) src="{{ asset('/' . $vendor->image_license) }}" @else src="{{ asset('public/admin/assets/img/user.png') }}" @endif
                                                        style="height: 100px;width:100px"></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>License Number</label>
                                            <input type="text" class="form-control" name="trading_license"
                                                value="{{ old('trading_license', $vendor->trading_license) }}">
                                            @error('trading_license')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Update Vendor</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post"
                                action="{{ route('admin.vendor.updatePassword', ['vendor' => $vendor->id]) }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Password</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" name="old_password"
                                            autocomplete="off">
                                        @error('old_password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" autocomplete="off">
                                        @error('password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            autocomplete="off">
                                        @error('password_confirmation')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
    </div>
@endsection
@section('script')
@endsection
