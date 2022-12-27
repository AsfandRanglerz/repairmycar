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
                                <h4>Edit Service</h4>
                            </div>
                            <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Service Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                                        @error('name')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="validatedCustomFile" accept="image/*" name="image">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        @error('image')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="old_image" value="{{ $category->image }}">
                                    @if(isset($category->image))
                                        <img src="{{ asset($category->image) }}" alt="" class="mt-4" width="200px" height="150px">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="validatedCustomIcon" accept="image/*" name="icon">
                                        <label class="custom-file-label" for="validatedCustomIcon">Choose Icon...</label>
                                        @error('icon')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="old_icon" value="{{ $category->icon }}">
                                    @if(isset($category->icon))
                                        <img src="{{ asset($category->icon) }}" alt="" class="mt-4" width="200px" height="150px">
                                    @endif
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Update Service</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

