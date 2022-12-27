@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h4>Image</h4>
                            </div>
                            <div class="d-flex space-between">
                                <div class="m-4">
                                    @if (isset($image[0]->image))
                                        <img src="{{ asset($image[0]->image) }}" alt="" width="200px" height="200px">
                                    @else
                                        Null
                                    @endif
                                </div>
                                <div class="m-4">
                                    <form action="{{ route('admin.project.image') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="validatedImage"
                                                    accept="image/*" name="image" required>
                                                <label class="custom-file-label" for="validatedImage">Choose
                                                    Image...</label>
                                                @error('image')
                                                    <div class="text-danger p-2">df</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary mr-1" type="submit">Add Image</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Description</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive table-bordered" id="table_one">
                                        <thead class="mb-2">
                                            <tr>
                                                <th>Project Detail</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{!! $detail[0]->description !!}</td>
                                                <td class="align-top">
                                                    <a href="{{ route('admin.detail.edit', $detail[0]) }}"
                                                        class="btn "><i data-feather="edit-2"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
{{-- @section('script')
<script>
    $(function() {
       $("#table_one").DataTable();
    });
</script>
@endsection --}}
