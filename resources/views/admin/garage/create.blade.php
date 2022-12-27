@extends('admin.layout.app')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header"><h4>Add Garage</h4></div>
                            <form action="{{ route('admin.garage.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="vendor_id">Owner</label>
                                            <select id="vendor_id" class="form-control" name="vendor_id" required>
                                                <option value="">Select Owner</option>
                                                @foreach($vendor as $data)
                                                    <option value="{{$data->id}}">{{ $data->name }}, ({{$data->email ? $data->email : $data->phone}})</option>
                                                @endforeach
                                            </select>
                                            @error('vendor_id')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="name">WorkShop Name</label>
                                            <input type="text" class="form-control" id="name" name="garage_name" placeholder="WorkShop Name" value="{{ old('garage_name') }}">
                                            @error('garage_name')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="category_id" class="form-label">Category</label>
                                            <select id="category_id" class="form-control selectric" multiple="" name="category_id[]" required>
{{--                                                <option>Type of Service</option>--}}
                                                @foreach($category as $data)
                                                    <option value="{{$data->id}}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="trading_no">Trading No</label>
                                            <input type="text" class="form-control" id="trading_no" name="trading_no" placeholder="Treading No" value="{{ old('trading_no') }}">
                                            @error('trading_no')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="vat">VAT</label>
                                            <input type="text" class="form-control" name="vat" placeholder="Vat" value="{{$vat->percentage}}" readonly>
                                            @error('vat')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="phone">Phone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                                            @error('phone')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">
                                            @error('address')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{ old('country') }} United Arab Emirates" readonly>
                                            @error('country')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" name="city" placeholder="City" value="{{ old('city') }}">
                                            @error('city')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="post_box">P/O Box</label>
                                            <input type="number" class="form-control" id="post_box" name="post_box" placeholder="P/O Box" value="{{ old('post_box') }}">
                                            @error('post_box')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="form-group col-12">
                                            <label for="editor">Description</label>
                                            <textarea name="description" id="editor" cols="30" rows="10"></textarea>
                                            @error('description')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <label for="banner">WorkShop Banner Image</label>
                                        <input type="file" class="custom-file-input" id="validatedCustomFile" accept="image/*" name="image" value="{{ old('image') }}">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        @error('image')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Add WorkShop</button>
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
