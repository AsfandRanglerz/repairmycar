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
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Vendor Name</th>
                                                <th>Bank Holder Name</th>
                                                <th>Bank Name</th>
                                                <th>IBAN</th>
                                                <th>WithDraw Request</th>
                                                <th>Fee</th>
                                                <th>Payable</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($data))
                                                @foreach ($data as $content)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $content->vendor->name }}</td>
                                                        <td>{{ $content->owner_name }}</td>
                                                        <td>{{ $content->bank_name }}</td>
                                                        <td>{{ $content->iban }}</td>
                                                        <td>{{ $content->balance }}</td>
                                                        <td>{{ $content->deduction }}</td>
                                                        <td>{{ $content->recieved }}</td>
                                                        <td>
                                                            @if ($content->status == 0)
                                                                <div class="badge badge-danger badge-shadow">
                                                                    {{ ucwords("Pending") }}</div>
                                                            @else
                                                                <div class="badge badge-success badge-shadow">
                                                                    {{ ucwords("Approved") }}</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                           
                                                        @if ($content->status == 0)
                                                            <a href="{{ route('admin.withdraw.status', ['id' => $content->id]) }}" class="btn btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-left"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="8" cy="12" r="3"></circle></svg></a>
                                                        @else
                                                            <a href="{{ route('admin.withdraw.status', ['id' => $content->id]) }}" class="btn btn-success disabled">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-right"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="16" cy="12" r="3"></circle></svg></a>
                                                        @endif
                                                        </td>
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
