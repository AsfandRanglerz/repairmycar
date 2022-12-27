@extends('admin.layout.app')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Garages</h4>
                                <a href="{{ route('admin.garage.create') }}" class="btn btn-primary" style="margin-left: auto; display: block;">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Garage Name</th>
                                                <th>Owner Name</th>
                                                <th>Cover Image</th>
                                                <th>Category</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Country</th>
                                                <th>City</th>
                                                <th>Post Box</th>
                                                <th>Trading License No</th>
                                                <th>Vat</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($garages as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->garage_name }}</td>
                                                    <td>{{ isset($data->vendor) ? $data->vendor->name : 'Null' }}</td>
                                                    <td class="images"><a  href="{{asset($data->image)}}"><img
                                                            @if (isset($data->image)) src="{{ asset('/' . $data->image) }}" @else src="../public/admin/assets/img/user.png" @endif
                                                            style="height:50px;width:50px"></a></td>
                                                    <td>
                                                        @foreach ($data->garageCategory as $category)
                                                            {{ $category->category->name }},
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $data->phone }}</td>
                                                    <td>{{ $data->address }}</td>
                                                    <td>{{ isset($data->country) ? $data->country : 'Null' }}</td>
                                                    <td>{{ isset($data->city) ? $data->city : 'Null' }}</td>
                                                    <td>{{ $data->post_box }}</td>
                                                    <td>{{ $data->trading_no }}</td>
                                                    <td>{{ $data->vat }}%</td>
                                                    <td>{!!  substr_replace($data->description, " read more...", 20) !!}</td>
                                                    <td>
                                                        <a href="{{ route('admin.garage.edit', ['garage' => $data->id]) }}"
                                                            class="btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-edit">
                                                                <path
                                                                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                </path>
                                                                <path
                                                                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                        {{-- <form action="{{ route('admin.garage.destroy', ['garage' => $data->id] ) }}" method="post" style="display: inline-block">
                                                        @method('DELETE')
                                                        @csrf

                                                        <button class="btn btn-primary" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </form> --}}
                                                        <a>
                                                            {{-- <i class="fas fa-trash text-danger glyphicon glyphicon-trash"
                                                           data-toggle="tooltip" data-placement="top" title="delete"
                                                         data-id="{{ $content->id }}"></i> --}}
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                data-id="{{ $data->id }}"
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
                                                        <form id="del_form{{ $data->id }}"
                                                            action="{{ url('admin/delete-garage/' . $data->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center"> Data not found!</td>
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
    </script>
@endsection
