@extends('admin.layout.app')
@section('title', 'Create New User')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form  action="{{ url('admin/add-user') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Add New Customer</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control"  name="name"
                                                placeholder="Name">
                                            @error('name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control"
                                                placeholder="Example@gmail.com" name="email" autocomplete="off">
                                            @error('email')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone" placeholder="Phone">
                                            @error('phone')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country"
                                                value="United Arab Emirates" readonly>
                                            @error('country')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <select class="form-select form-control" name="city" aria-label="City"
                                                >
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
                                        <div class="form-group col-md-6">
                                            <select class="form-select form-control insurance-company" name="company"
                                                aria-label="company">
                                                <option value="" selected disabled>{{ __('msg.Insurance Company') }}
                                                    ({{ __('msg.Optional') }})</option>
                                                @foreach ($company as $data)
                                                    <option value="{{ $data->id }}"
                                                        @if (old('company') == $data->id) selected @endif>
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('company')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address">
                                            @error('address')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Image</label>
                                            <input type="file" class="form-control" name="image">
                                            @error('image')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" autocomplete="off"
                                            required>
                                        @error('password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
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
