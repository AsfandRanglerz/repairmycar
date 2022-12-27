@extends('admin.layout.app')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Garage</h4>
                            </div>
                            <form action="{{ route('admin.garage.update', $garage->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="name">Garage Name</label>
                                            <input type="text" class="form-control" id="name" name="garage_name"
                                                placeholder="WorkShop Name"
                                                value="{{ old('garage_name', $garage->garage_name) }}">
                                            @error('garage_name')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="vendor_id">Owner Name</label>
                                            <input type="text" class="form-control" id="vendor_id" name="vendor_id"
                                                value="{{ $garage->vendor->name}}" readonly>
                                            @error('vendor_id')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="category_id" class="form-label">Service Category</label>
                                            <select class="form-control selectric category" multiple=""
                                                name="category_id[]" required>
                                                @foreach ($category as $data)
                                                    <option value="{{ $data->id }}"
                                                        @foreach ($garage->garageCategory as $data2)
                                                            @if ($data2->category_id == $data->id) selected @endif @endforeach>
                                                        {{ $data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="post_box">P/O Box</label>
                                            <input type="number" class="form-control" id="post_box" name="post_box"
                                                placeholder="P/O Box" value="{{ old('post_box', $garage->post_box) }}">
                                            @error('post_box')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="trading_no">Trading Number</label>
                                            <input type="text" class="form-control" id="trading_no" name="trading_no"
                                                placeholder="Treading No"
                                                value="{{ old('trading_no', $garage->trading_no) }}">
                                            @error('trading_no')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="vat">VAT %</label>
                                            <input type="text" class="form-control" name="vat" placeholder="VAT"
                                                value="{{ old('vat', $garage->vat) }}" readonly>
                                            @error('vat')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country"
                                                placeholder="Country" value="{{ old('country', $garage->country) }}" readonly>
                                            @error('country')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="city" class="form-label">City</label>
                                            <select class="form-control selectric category" name="city">
                                                <option selected disabled value="">{{ __('msg.Select City') }}
                                                </option>
                                                <option value="Dubai" @if ($garage->city == 'Dubai') selected @endif
                                                    @if (old('city') == 'Dubai') selected @endif>
                                                    {{ __('msg.Dubai') }}</option>
                                                <option value="Abu Dhabi" @if ($garage->city == 'Abu Dhabi') selected @endif
                                                    @if (old('city') == 'Abu Dhabi') selected @endif>
                                                    {{ __('msg.Abu Dhabi') }}</option>
                                                <option value="Sharjah" @if ($garage->city == 'Sharjah') selected @endif
                                                    @if (old('city') == 'Sharjah') selected @endif>
                                                    {{ __('msg.Sharjah') }}</option>
                                                <option value="Ras Al Khaimah"
                                                    @if ($garage->city == 'Ras Al Khaimah') selected @endif
                                                    @if (old('city') == 'Ras Al Khaimah') selected @endif>
                                                    {{ __('msg.Ras Al Khaimah') }}</option>
                                                <option value="Ajman" @if ($garage->city == 'Ajman') selected @endif
                                                    @if (old('city') == 'Ajman') selected @endif>
                                                    {{ __('msg.Ajman') }}</option>
                                            </select>
                                            @error('city')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="phone">Phone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone"
                                                placeholder="Phone" value="{{ old('phone', $garage->phone) }}">
                                            @error('phone')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address"
                                                value="{{ old('address', $garage->address) }}">
                                            @error('address')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="form-group col-12">
                                            <label for="editor">Description</label>
                                            <textarea name="description" id="editor" cols="30" rows="10">{!! $garage->description !!}</textarea>
                                            @error('description')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <label for="banner">WorkShop Banner Image</label>
                                        <input type="file" class="custom-file-input" id="validatedCustomFile"
                                            accept="image/*" name="image">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        @error('image')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if ($garage->image !== null && $garage->image !== '')
                                        <img src="{{ asset($garage->image) }}" alt="" width="100%"
                                            height="400px">
                                    @endif
                                    <input type="hidden" name="old_image" value="{{ $garage->image }}">
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Update Garage</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
