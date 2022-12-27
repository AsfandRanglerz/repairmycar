@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('admin.insurance.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Add Insurance Company</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Company Name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Owner Name</label>
                                            <input type="text" class="form-control" name="owner_name"
                                                placeholder="OwnerName" value="{{ old('owner_name') }}">
                                            @error('owner_name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Example@gmail.com" autocomplete="off"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone" placeholder="Phone"
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="city" class="form-label">City</label>
                                            <select class="form-control selectric category" name="city">
                                                <option selected disabled value="">{{ __('msg.Select City') }}
                                                </option>
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
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address"
                                                value="{{ old('address') }}">
                                            @error('address')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ID Image</label>
                                            <input type="file" name="id_card" class="form-control" multiple>
                                            @error('id_card')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            {{-- <div>
                                                @if ($ext[1] == 'pdf')
                                                    <a target="_black" href="{{ asset($company->insurance->id_card) }}"><img
                                                            
                                                            src="{{ asset('public/assets/images/pdficon.png') }}"
                                                            style="height: 100px;width:100px"></a>
                                                @else
                                                    <a target="_black" href="{{ asset($company->insurance->id_card) }}"><img
                                                            
                                                            @if ($company->id_card) src="{{ asset('/' . $company->id_card) }}" @else src="{{ asset('public/admin/assets/img/user.png') }}" @endif
                                                            style="height: 100px;width:100px"></a>
                                                @endif
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Trading License</label>
                                            <input type="file" name="image_license" class="form-control" multiple>
                                            @error('image_license')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            {{-- <div>
                                                @if ($ext1[1] == 'pdf')
                                                    <a target="_black"
                                                        href="{{ asset($company->insurance->image_license) }}"><img
                                                            
                                                            src="{{ asset('public/assets/images/pdficon.png') }}"
                                                            style="height: 100px;width:100px"></a>
                                                @else
                                                    <a target="_black"
                                                        href="{{ asset($company->insurance->image_license) }}"><img
                                                            
                                                            @if (isset($company->image_license)) src="{{ asset('/' . $company->image_license) }}" @else src="{{ asset('public/admin/assets/img/user.png') }}" @endif
                                                            style="height: 100px;width:100px"></a>
                                                @endif
                                            </div> --}}
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>License Number</label>
                                            <input type="text" class="form-control" name="trading_license"
                                                placeholder="License Number" value="{{ old('trading_license') }}">
                                            @error('trading_license')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Billing Area</label>
                                            <input type="text" class="form-control" name="billing_area"
                                                placeholder="Billing Area" value="{{ old('billing_area') }}">
                                            @error('billing_area')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Billing City</label>
                                            <input type="text" class="form-control" name="billing_city"
                                                placeholder="Billing City" value="{{ old('billing_city') }}">
                                            @error('billing_city')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Billing Address</label>
                                            <input type="text" class="form-control" name="billing_address"
                                                placeholder="Billing Address" value="{{ old('billing_address') }}">
                                            @error('billing_address')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Post Box</label>
                                            <input type="number" class="form-control" name="post_box"
                                                placeholder="Post Box" value="{{ old('post_box') }}">
                                            @error('post_box')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post"
                                action="{{ route('admin.insurance-company.updatePassword', ['id' => $company->id]) }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Password</h4>
                                </div>
                                <input type="hidden" name="email" value="{{ $company->email }}">
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
