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
                                <h4>Edit ChildCategory</h4>
                            </div>
                            <form action="{{ route('admin.childcategory.update', ['childcategory' => $childcategory->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>ChildCategory Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $childcategory->name }}">
                                        @error('name')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Parent Category</label>
                                        <select class="form-control" name="subcategory_id">
                                            <option value="{{ $childcategory->parentSub->id }}" selected>{{ ucwords($childcategory->parentSub->name) }}</option>
                                            @if($subcategories)
                                                @foreach($subcategories as $subcategory)
                                                    <option value="{{$subcategory->id}}">{{ ucwords($subcategory->name) }}</option>
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
                                    <button class="btn btn-primary mr-1" type="submit">Update ChildCategory</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

