@extends('admin.layout.app')
@section('title', 'Edit About Us')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form method="post" action="{{ route('admin.about.update', $about->id) }}">
                                @csrf
                                <div class="card-header">
                                    <h4>About Us</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea name="description" id="editor" cols="30" rows="10">{{ $about->description }}</textarea>
                                        @error('descripton')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Update About</button>
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
