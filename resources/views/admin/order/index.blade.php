@extends('admin.layout.app')
@section('title', 'Order')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Orders</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Order Id</th>
                                                <th>Customer Name</th>
                                                <th>Garage Name</th>
                                                <th>Total Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($orders))
                                                @forelse ($orders as $order)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $order->order_code }}</td>
                                                        <td>
                                                            @if (isset($order->userbid))
                                                                {{ $order->userbid->user->name }}
                                                            @else
                                                                Null
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (isset($order->garage))
                                                                {{ $order->garage->garage_name }}
                                                            @else
                                                                Null
                                                            @endif
                                                        </td>
                                                        <td>{{ $order->total }}</td>
                                                        <td>
                                                            @if ($order->status == 'pending')
                                                                <div class="badge badge-warning badge-shadow">
                                                                    {{ ucwords($order->status) }}</div>
                                                                {{-- @elseif ($order->status == 'processing')
                                                            <div class="badge badge-danger badge-shadow">{{ ucwords($order->status) }}</div>
                                                        @elseif ($order->status == 'shipped')
                                                            <div class="badge badge-danger badge-shadow">{{ ucwords($order->status) }}</div> --}}
                                                            @elseif ($order->status == 'complete')
                                                                <div class="badge badge-success badge-shadow">
                                                                    {{ ucwords($order->status) }}</div>
                                                            @elseif ($order->status == 'cancelled')
                                                                <div class="badge badge-danger badge-shadow">
                                                                    {{ ucwords($order->status) }}</div>
                                                            @else<span>Not Found</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.order.edit', ['order' => $order->id]) }}"
                                                                class="btn btn-primary"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
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
                                                                </svg></a>
                                                            {{-- <form action="{{ route('admin.order.destroy', ['order' => $order->id] ) }}" method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
                                                        </form> --}}
                                                            <a>
                                                                {{-- <i class="fas fa-trash text-danger glyphicon glyphicon-trash"
                                                               data-toggle="tooltip" data-placement="top" title="delete"
                                                             data-id="{{ $content->id }}"></i> --}}
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    data-id="{{ $order->id }}"
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
                                                            <form id="del_form{{ $order->id }}"
                                                                action="{{ url('admin/delete-order/' . $order->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9"> Data not found!</td>
                                                    </tr>
                                                @endforelse
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
