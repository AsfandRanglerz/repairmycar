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
                            <div class="card-header">
                                <h4>All Vendors List</h4>
                                <a href="{{ route('admin.vendor.create') }}" class="btn btn-primary"
                                    style="margin-left: auto; display: block;">Add New Vendor</a>
                            </div>
                            {{-- <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>All Vendors List</h4>
                            </div> --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Garage Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Address</th>
                                                <th>Post Box</th>
                                                <th>Appointment Number</th>
                                                <th>ID Card</th>
                                                <th>Trading License</th>
                                                <th>License Number</th>
                                                <th>Vat</th>
                                                <th>Billing Area</th>
                                                <th>Billing City</th>
                                                <th>Billing Address</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($vendors as $vendor)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $vendor->name }}</td>
                                                    <td class="images">
                                                        <a href="{{ asset($vendor->image) }}"><img
                                                                @if ($vendor->image) src="{{ asset('/' . $vendor->image) }}" @else src="https://ranglerz.pw/repairmycar/public/admin/assets/img/user.png" @endif
                                                                style="height: 50px;width:50px"></a>
                                                    </td>
                                                    <td>{{ $vendor->garage_name }}</td>
                                                    <td>{{ $vendor->email }}</td>
                                                    <td>{{ $vendor->phone }}</td>
                                                    <td>{{ $vendor->city }}</td>
                                                    <td>{{ $vendor->address }}</td>
                                                    <td>{{ $vendor->post_box }}</td>
                                                    <td>{{ $vendor->appointment_number }}</td>
                                                    @php
                                                        $ext = explode('.', $vendor->id_card);
                                                        $ext1 = explode('.', $vendor->image_license);
                                                    @endphp
                                                    @if ($ext[1] == 'pdf')
                                                        <td>
                                                        @else
                                                        <td class="images">
                                                    @endif
                                                    @if ($ext[1] == 'pdf')
                                                        <a target="_black" href="{{ asset($vendor->id_card) }}"><img
                                                                src="{{ asset('public/assets/images/pdficon.png') }}"
                                                                style="height: 50px;width:50px"></a>
                                                    @else
                                                        <a href="{{ asset($vendor->id_card) }}"><img
                                                                @if ($vendor->id_card) src="{{ asset('/' . $vendor->id_card) }}" @else src="{{ asset('public/admin/assets/img/user.png') }}" @endif
                                                                style="height: 50px;width:50px"></a>
                                                    @endif
                                                    </td>
                                                    @if ($ext1[1] == 'pdf')
                                                        <td>
                                                        @else
                                                        <td class="images">
                                                    @endif
                                                    @if ($ext1[1] == 'pdf')
                                                        <a href="{{ asset($vendor->image_license) }}"><img
                                                                src="{{ asset('public/assets/images/pdficon.png') }}"
                                                                style="height: 50px;width:50px"></a>
                                                    @else
                                                        <a target="_black" href="{{ asset($vendor->image_license) }}"><img
                                                                @if (isset($vendor->image_license)) src="{{ asset('/' . $vendor->image_license) }}" @else src="{{ asset('public/admin/assets/img/user.png') }}" @endif
                                                                style="height: 50px;width:50px"></a>
                                                    @endif
                                                    </td>
                                                    <td>{{ $vendor->trading_license }}</td>
                                                    <td>{{ $vendor->vat }}%</td>
                                                    <td>{{ $vendor->billing_area }}</td>
                                                    <td>{{ $vendor->billing_city }}</td>
                                                    <td>{{ $vendor->billing_address }}</td>
                                                    <td>
                                                        @if ($vendor->action == 1)
                                                            <div class="badge badge-success badge-shadow">Active</div>
                                                        @else
                                                            <div class="badge badge-danger badge-shadow">DeActive</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.vendor.edit', ['vendor' => $vendor->id]) }}"
                                                            class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-edit">
                                                                <path
                                                                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                </path>
                                                                <path
                                                                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                </path>
                                                            </svg></a>
                                                        @if ($vendor->action == 0)
                                                            <a href="{{ route('admin.vendor.activate', ['vendor' => $vendor->id]) }}"
                                                                class="btn btn-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-toggle-right">
                                                                    <rect x="1" y="5" width="22"
                                                                        height="14" rx="7" ry="7"></rect>
                                                                    <circle cx="8" cy="12" r="3">
                                                                    </circle>
                                                                </svg></a>
                                                        @else
                                                            <a href="#"
                                                                data-toggle="modal"onclick="editVendor('{{ $vendor->id }}')"
                                                                class="btn btn-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-toggle-left">
                                                                    <rect x="1" y="5" width="22"
                                                                        height="14" rx="7" ry="7"></rect>
                                                                    <circle cx="16" cy="12" r="3">
                                                                    </circle>
                                                                </svg></a>
                                                        @endif
                                                        <a>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                data-id="{{ $vendor->id }}"
                                                                class="fas fa-trash text-danger glyphicon glyphicon-trash"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                            </svg>
                                                        </a>
                                                        <form id="del_form{{ $vendor->id }}"
                                                            action="{{ url('admin/delete-vendor/' . $vendor->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7"> No More Users In this Table.</td>
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
    @include('admin.vendor.modal')
@endsection
@section('script')
    <script>
        $('#edit_comment').on('keyup', function() {
            if ($(this).val() != "") {
                $('.update_student').removeClass('a-disabled');
            } else {
                $('.update_student').addClass('a-disabled');
            }
        });

        function editVendor(user_id, comment_val) {
            $('#editStudentModal').modal('show');
            $('#edit_stud_id').val(user_id);
            $('#edit_comment').val(comment_val);
        }
        $('.update_student').on('click', function() {
            $(this).find('.spinner-border-sm').removeClass('d-none');

            let user_id = $('#edit_stud_id').val();
            let edit_comment = $('#edit_comment').val();

            $.ajax({
                type: "POST",
                url: '{{ url('admin/deactivate-vendor') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    user_id: user_id,
                    comment_val: edit_comment,
                },
                success: function(response) {
                    if (response.success) {
                        $('#editStudentModal').modal('hide');
                        toastr.success(response.success);
                        window.location.reload();
                    }
                }
            });
        });
    </script>
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
    </script>
@endsection
