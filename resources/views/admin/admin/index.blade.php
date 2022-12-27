@extends('admin.layout.app')
@section('title', 'All Admins List')
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
                                <h4>All Admins List</h4>
                                {{--<a href="{{ route('admin.create') }}" class="btn btn-primary float-right" >Add New Admin</a>--}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($admins as $admin)
                                            <tr>
                                                <td>{{$admins->firstItem()+$loop->index}}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>@foreach($admin->roles as $role){{ $role->name }}@endforeach</td>
                                                <td>{{ $admin->phone }}</td>
                                                <td>@if($admin->action == 1)
                                                        <div class="badge badge-success badge-shadow">Activate</div>
                                                    @else
                                                        <div class="badge badge-danger badge-shadow">DeActivate</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{--<a href="{{ route('admin.edit', ['id' => $admin->id]) }}" class="btn btn-primary"><i data-feather="edit"></i></a>
--}}{{--                                                    <a href="{{ route('admin.show', ['id' => $admin->id]) }}" class="btn btn-primary"><i data-feather="eye"></i></a>--}}{{--
                                                    @if ($admin->action == 0)
                                                        <a href="{{ route('admin.activate', ['id' => $admin->id]) }}" class="btn btn-danger">
                                                            <i data-feather="toggle-left"></i></a>
                                                    @else
                                                        <a href="{{ route('admin.deactivate', ['id' => $admin->id]) }}" class="btn btn-primary">
                                                            <i data-feather="toggle-right"></i></a>
                                                    @endif--}}
                                                    <a href="{{ route('admin.delete', ['id' => $admin->id]) }}" class="btn btn-primary">
                                                        <i data-feather="trash-2"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"> No More Admins In this Table.</td>
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
