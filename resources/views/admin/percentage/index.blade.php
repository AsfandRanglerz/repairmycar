@extends('admin.layout.app')
@section('title', 'All Package')
@section('style')

@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>All Percentages List</h4>
                                {{-- <a href="{{ route('package.create') }}" class="btn btn-primary float-right">Add New
                                    Package</a> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Type</th>
                                                <th>Percentage</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($data))
                                                @foreach ($data as $content)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $content->type }}</td>
                                                        <td>{{ $content->percentage }}%</td>
                                                        <td><a href="{{ url('/admin/edit-percentage/' . $content->id) }}"
                                                                class="btn btn-primary"><i data-feather="edit"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            @endif
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
@endsection
