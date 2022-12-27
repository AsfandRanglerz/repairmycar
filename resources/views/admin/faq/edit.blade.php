@extends('admin.layout.app')
@section('title', 'Edit Faq')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ url('/admin/update-faq/' . $data->id) }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Faq</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Question</label>

                                        <textarea name="question" id="question" cols="30" rows="10">{!! $data->question !!}</textarea>
                                        @error('question')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Answer</label>

                                        <textarea name="answer" id="answer" cols="30" rows="10">{!! $data->answer !!}</textarea>
                                        @error('answer')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
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
        .create(document.querySelector('#question'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '200px';
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#answer'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '200px';
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection

