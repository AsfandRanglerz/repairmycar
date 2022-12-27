@extends('admin.layout.app')
@section('style')
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }

        .form-control-color {
            width: 18rem !important;
        }
    </style>
@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Product</h4>
                            </div>
                            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="name">Product Name<span style="color: red; font-size: 15px">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name">
                                            @error('name')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="store_id">Store<span style="color: red; font-size: 15px">*</span></label>
                                            <select class="form-control" id="store_id" name="store_id">
                                                <option label="Choose Category"></option>
                                                @foreach($stores as $data)
                                                    <option value="{{ $data->id }}">{{ $data->store_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('store_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="category_id">Category<span style="color: red; font-size: 15px">*</span></label>
                                            <select class="form-control" id="category_id" name="category_id">
                                                <option label="Choose Category"></option>
                                                @foreach($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="subcategory_id">Sub Category:</label>
                                            <select class="form-control" id="subcategory_id" name="subcategory_id">
                                                <option label="Choose First Category"></option>
                                            </select>
                                            @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div id="error_sub"></div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="child_category_id">Child Category:</label>
                                            <select class="form-control" id="child_category_id" name="child_category_id">
                                                <option label="Choose First Sub Category"></option>
                                                <option value="">Null</option>
                                            </select>
                                            @error('child_category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for="price">Price<span style="color: red; font-size: 15px">*</span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="price" name="price">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                            @error('price')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="discount_price">Discount Price</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="discount_price" name="discount_price">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                            @error('discount_price')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="shipping_cost">Shipping Cost<span style="color: red; font-size: 15px">*</span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="shipping_cost" name="shipping_cost">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                            @error('shipping_cost')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for="stock">Stock<span style="color: red; font-size: 15px">*</span></label>
                                            <input type="number" class="form-control" id="stock" name="stock">
                                            @error('stock')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="sku">SKU</label>
                                            <input type="number" class="form-control" id="sku" name="sku">
                                            @error('sku')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="shipping_days">Shipping Days</label>
                                            <input type="text" class="form-control" id="shipping_days" placeholder="5-7" name="shipping_days">
                                            @error('shipping_days')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for="model">Model</label>
                                            <input type="text" id="model" class="form-control" name="model">
                                            @error('model')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="brand">Brand</label>
                                            <select id="brand" class="form-control" name="brand_id">
                                                <option value="" selected>None</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{ ucwords($brand->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="color" class="name">Color</label>
                                            <a href="#" class="data" data-toggle="modal" data-target="#exampleModal" style="margin-left: auto; display: block;">Add Color</a><br>
                                            <div class="row gutters-xs" id="showId">
                                                @include('admin.product.color')
                                            </div>
                                            @error('color')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--<div class="row">
                                        <div class="form-group col-4">
                                            <label class="name">Select Size </label>
                                            <a href="#" class="data" data-toggle="modal" data-target="#size">Add Size</a>
                                            <div id="showSize">
                                                @include('admin.product.size')
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <div class="control-label">Product Review Allows</div>
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" name="product_review" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">You Want Product Review Allows</span>
                                            </label>
                                        </div>
                                        <div class="form-group col-4">
                                            <div class="control-label">Make Featured Product</div>
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" name="featured" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">You Want Make Featured Product</span>
                                            </label>
                                            @error('featured')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="form-group col-12">
                                            <label for="editor">Description<span style="color: red; font-size: 15px">*</span></label>
                                            <textarea name="description" id="editor" cols="30" rows="10"></textarea>
                                            @error('description')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="form-group col-12">
                                            <label for="editor1">Specification{{--<span style="color: red; font-size: 15px">*</span>--}}</label>
                                            <textarea name="specification" id="editor1" cols="30" rows="10"></textarea>
                                            @error('specification')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Image</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" accept="image/*" name="image[]" multiple>
                                                <label class="custom-file-label" for="image">Choose file...</label>
                                                @error('image')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="image_type" value="image">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Add Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add Color And Size Model -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Add New Color</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-6">
                        <label for="color">Color</label>
                        <input type="color" id="color-input" class="form-control" name="color" value="#002AFF"><br><br>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-color">Create Color</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="size" tabindex="-1" role="dialog" aria-labelledby="formModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Add New Size</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-6">
                        <label for="color">Size</label>
                        <input type="number" id="size-input" class="form-control" name="size" placeholder="10 (like this type here)"><br><br>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-size">Create Size</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('select[name="category_id"]').on('change', function () {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('admin/get/subcategory/') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="subcategory_id"]').append('<option value="">Null</option>');
                            } else {
                                $('select[name="subcategory_id"]').append('<option value="">Please Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            $('select[name="subcategory_id"]').on('change', function () {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ url('admin/get/child_category/') }}/" + subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var d = $('select[name="child_category_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="child_category_id"]').append('<option value="">Null</option>');
                            } else {
                                $('select[name="child_category_id"]').append('<option value="">Please  Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="child_category_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            $('#save-color').on('click', function () {
                var color = $('#color-input').val();
                if (color) {
                    $.ajax({
                        url: "{{ url('admin/product/add-color') }}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            color: color,
                        },
                        success: function (response) {
                            /*console.log(response);*/
                            $('#showId').empty();
                            $('#showId').append(response);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Add New Color Successfully.',
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            $('#save-size').on('click', function () {
                var size = $('#size-input').val();
                if (size) {
                    $.ajax({
                        url: "{{ url('admin/product/add-size') }}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            size: size,
                        },
                        success: function (response) {
                            /*console.log(response);*/
                            $('#showSize').empty();
                            $('#showSize').append(response);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Add New Size Successfully.',
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#image').on('change', function () {
                console.log("I am inside upload event");
                files = $(this)[0].files;
                name = '';
                for (var i = 0; i < files.length; i++) {
                    name += '\"' + files[i].name + '\"' + (i != files.length - 1 ? ", " : "");
                }
                $(".custom-file-label").html(name);
            })
        });
    </script>
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
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
