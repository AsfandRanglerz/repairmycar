@extends('admin.layout.app')
@section('title', 'About Us')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>About US</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive table-bordered" id="table_one">
                                        <thead class="mb-2">
                                        <tr>
                                            <th>About Us</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{!! $about->description  !!}</td>
                                            <td class="align-top">
                                                <a href="{{ route('admin.about.edit', $about->id) }}" class="btn "><i data-feather="edit-2"></i></a>
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
@section('script')
<script>
    $(function() {
       $("#table_one").DataTable();
    });
</script>
@endsection
