@extends('admin.layout.app')
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
                                <h4>All Car Ads List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Car Image</th>
                                                <th>Document Image</th>
                                                <th>Owner Name</th>
                                                <th>Model</th>
                                                <th>Company</th>
                                                <th>Year</th>
                                                <th>Price</th>
                                                <th>City</th>
                                                <th>Country</th>
                                                <th>Mileage</th>
                                                <th>Color</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($ads as $ad)
                                                @php
                                                    $image = explode(',', $ad->images);
                                                    $documents = explode(',', $ad->document_file);
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="images">
                                                        @foreach($image as $images)
                                                        <a href="{{ asset($images) }}">
                                                        <img src="{{ asset($images) }}" alt="" width="50px">
                                                        @endforeach
                                                    </td>
                                                    <td class="images">
                                                        @foreach($documents as $document)
                                                        <a href="{{ asset($document) }}">
                                                        <img src="{{ asset($document) }}" alt="" width="50px">
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if (isset($ad->user_id))
                                                            {{ $ad->user->name }} @else{{ $ad->vendor->name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $ad->model }}</td>
                                                    <td>{{ $ad->company->company }}</td>
                                                    <td>{{ $ad->modelYear->model_year }}</td>
                                                    <td>{{ $ad->price }}</td>
                                                    <td>{{ $ad->city }}</td>
                                                    <td>{{ $ad->country }}</td>
                                                    <td>{{ $ad->mileage }}</td>
                                                    <td>{{ $ad->color }}</td>
                                                    <td>
                                                        <div class="badge badge-shadow @if ($ad->status=='Pending') badge-warning @elseif ($ad->status=='Approved') badge-success @else badge-danger @endif">@if ($ad->status=='Pending') Pending @elseif ($ad->status=='Approved') Approved @else Rejected @endif</div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('admin/status-request-ad/' . $ad->id) }}" class="btn @if ($ad->status=='Pending') btn-warning @elseif ($ad->status=='Approved') btn-success @else btn-danger @endif"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-left"> <rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle @if ($ad->status == 'Approved') cx="16" @else cx="8" @endif  cy="12" r="3"> </circle> </svg></a>
                                                        <a href="{{ route('admin.ads.edit', $ad->id) }}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"> <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"> </path> <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"> </path></svg></a>
                                                        <a><svg xmlns="http://www.w3.org/2000/svg" data-id="{{ $ad->id }}" class="fas fa-trash text-danger glyphicon glyphicon-trash" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"> <polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"> </path> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> </svg></a>
                                                        <form id="del_form{{ $ad->id }}"
                                                            action="{{ url('admin/delete-ads/' . $ad->id) }}">
                                                            @csrf
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7"> No More Car Ads In this Table.</td>
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
    <script>
        $(document).on('click', '.glyphicon-trash', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del_form' + $(this).data('id')).submit();
                }
            });
        });

        // $(document).on('click', '.glyphicon-check', function() {
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You want to approved it!",
        //         icon: 'success',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, Approved it!'
        //     }).then((result) => {
        //         if (result.value) {
        //             document.getElementById('approve_form' + $(this).data('id')).submit();
        //         }
        //     });
        // });
        // $(document).on('click', '.glyphicon-update-status', function() {
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to reject this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, reject it!'
        //     }).then((result) => {
        //         if (result.value) {
        //             document.getElementById('dell_form' + $(this).data('id')).submit();
        //         }
        //     });
        // });
    </script>
@endsection
