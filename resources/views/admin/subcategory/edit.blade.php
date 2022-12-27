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
                                <h4>Edit Sub Category</h4>
                            </div>
                            <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>SubCategory Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $subcategory->name }}">
                                        @error('name')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Parent Category</label>
                                        <select class="form-control" name="category_id">
                                            <option value="{{ $subcategory->parent->id }}" selected>{{ ucwords($subcategory->parent->name) }}</option>
                                            @if($categories)
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{ ucwords($category->name) }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{--<div class="custom-file">
                                        <input type="file" class="custom-file-input" id="validatedCustomFile" accept="image/*" name="image">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        @error('image')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>--}}
                                    {{--<input type="hidden" name="old_image" value="{{ $subcategory->image }}">
                                    @if(isset($subcategory->image))
                                        <img src="{{ asset($subcategory->image) }}" alt="" class="mt-4" width="200px" height="150px">
                                    @endif--}}
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Update SubCategory</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

