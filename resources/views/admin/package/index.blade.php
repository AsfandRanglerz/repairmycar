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
                                <h4>All Packages List</h4>
                                <a href="{{ route('package.create') }}" class="btn btn-primary float-right" >Add New Package</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Number limit</th>
                                            <th>Type</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($package as $item)
                                            <tr>
                                                <td>{{$package->firstItem()+$loop->index}}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->sending_limit }}</td>
                                                <td>{{ $item->package_type }}</td>
                                                <td>AED {{ $item->price }}</td>
                                                <td>
                                                    <a href="{{ route('package.edit', ['package' => $item->id]) }}" class="btn btn-primary"><i data-feather="edit"></i></a>
{{--                                                    @if ($package->action == 0)--}}
{{--                                                        <a href="{{ route('package.activate', ['id' => $package->id]) }}" class="btn btn-danger">--}}
{{--                                                            <i data-feather="toggle-left"></i></a>--}}
{{--                                                    @else--}}
{{--                                                        <a href="{{ route('package.deactivate', ['id' => $package->id]) }}" class="btn btn-primary">--}}
{{--                                                            <i data-feather="toggle-right"></i></a>--}}
{{--                                                    @endif--}}
                                                    <form action="{{ route('package.destroy', ['package' => $item->id]) }}" method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-danger"><i data-feather="trash-2"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center"> No More Data In this Table.</td>
                                            </tr>
                                        @endforelse
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
