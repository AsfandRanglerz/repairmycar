@extends('admin.layout.app')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header"><h4>Edit News</h4></div>
                            <form action="{{ route('admin.news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}">
                                            @error('title')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="form-group col-12">
                                            <label for="editor">Description</label>
                                            <textarea name="description" id="editor" cols="30" rows="10">{!! $news->description !!}</textarea>
                                            @error('description')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Image</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" accept="image/*" name="image">
                                                <label class="custom-file-label" for="image">Choose file...</label>
                                                @error('image')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="image_type" value="image">
                                        <input type="hidden" name="old_image" value="{{ $news->image }}">
                                        @if ($news->image !== null)
                                            <img src="{{ asset($news->image) }}" alt="" width="100%" height="400px">
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Edit News</button>
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
                editor.ui.view.editable.element.style.height = '400px';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
