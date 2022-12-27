@extends('admin.layout.app')
@section('title', 'Order Detail')
@section('content')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #print_of_order,
            #print_of_order * {
                visibility: visible;
                width: 100% !important;

            }

            #print_of_order {
                position: absolute;
                left: 0;
                top: 0;
            }

            .sidebar-left {
                /*display: none!important;*/
            }

            #status_content {
                display: none;
            }

            #status {
                display: none !important;
            }
        }
    </style>
    @php
        $insurancestatus = \App\Models\InsuranceRequest::where('vendor_bid_id', $order->vendor_bid_id)->first();
        
    @endphp
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Order ID: {{ $order->order_code }}</h4>
                                <button class="btn btn-primary" style="margin-left: auto; display: block;"
                                    onclick="PrintElem()">Print</button>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div id="print_of_order">
                                        <div class="row d-flex">
                                            <div class="col-md-3 col-lg-3 col-sm-3">
                                                <h6 class="dark-pink">Customer Name</h6>
                                                <span class="dark-pink">{{ ucwords($order->userbid->user->name) }}</span>
                                            </div>
                                            <div class="col-md-3  col-lg-3 col-sm-3">
                                                <h6 class="dark-pink">Contact</h6>
                                                <span>{{ $order->userbid->user->phone }}</span>
                                            </div>
                                            <div class="col-md-3  col-lg-3 col-sm-3">
                                                <h6>Address</h6>
                                                <span>{{ $order->customer_address }}</span>
                                            </div>
                                            <div class="col-md-3   col-lg-3 col-sm-3" id="status">
                                                <h6 class="dark-pink">Order Status</h6>
                                                @if ($order->status == 'pending')
                                                    <span class="badge badge-warning"
                                                        style="height:45%;margin-top: 4px;font-size: 11px;">Pending</span>
                                                @elseif($order->status == 'processing')
                                                    <span class="badge badge-warning"
                                                        style="height:45%;margin-top: 4px;font-size: 11px;">Processing</span>
                                                @elseif($order->status == 'shipped')
                                                    <span class="badge badge-warning"
                                                        style="height:45%;margin-top: 4px;font-size: 11px;">Shipped</span>
                                                @elseif($order->status == 'complete')
                                                    <span class="badge badge-success"
                                                        style="height:45%;margin-top: 4px;font-size: 11px;">Completed</span>
                                                @elseif($order->status == 'cancelled')
                                                    <span class="badge badge-danger"
                                                        style="height:45%;margin-top: 4px;font-size: 11px;">Cancelled</span>
                                                @else<span>Not Found</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row pt-5 pb-5">
                                            <div class="col-md-8  col-lg-8 col-sm-8">
                                                {{-- <h4 class="dark-pink" style="font-weight: bold">Subtotal: {{$order->subtotal}}</h4> --}}
                                                {{-- <h4 class="dark-pink">Tax: {{$order->tax}}</h4> --}}

                                                @if ($order->status != 'complete' && ($order->paid_by == 'insurance' && $insurancestatus->status == 1))
                                                    <h6 class="dark-pink" style="font-weight: bold">Advance Payment:
                                                        {{ $order->total }}</h6>
                                                @endif
                                                @if ($order->status != 'complete' && $order->paid_by != 'insurance')
                                                    <h6 class="dark-pink" style="font-weight: bold">Advance Payment:
                                                        {{ $order->advance }}</h6>
                                                @endif
                                                <h6 class="dark-pink" style="font-weight: bold">Total: {{ $order->total }}
                                                </h6>
                                            </div>
                                            <div class="col-md-4 col-lg-4 col-sm-4">
                                                <h6>Created At:
                                                    {{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</h6>
                                            </div>
                                            @if (isset($order->cheque_image))
                                                @php
                                                    
                                                    $images = explode(',', $order->cheque_image);
                                                @endphp
                                                <div class="col-md-4 col-lg-4 col-sm-4 images">
                                                    @foreach ($images as $image)
                                                        <a href="{{ url($image) }}">
                                                            <img src="{{ asset($image) }}" class="header-logo"
                                                                style="width: 100px" /></a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <form class="needs-validation"
                                        action="{{ route('admin.order.update', ['order' => $order->id]) }}" method="post"
                                        novalidate="novalidate">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <label for="validationCustom01" class="font-20 dark-pink">Order
                                                    Status</label>
                                                <select class="form-control" id="validationCustom01" required="required"
                                                    name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="pending"
                                                        {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    {{-- <option value="processing" {{($order->status =="processing")?'selected':''}}>Processing</option> --}}
                                                    {{-- <option value="shipped" {{($order->status =="shipped")?'selected':''}}>Shipped</option> --}}
                                                    <option value="complete"
                                                        {{ $order->status == 'complete' ? 'selected' : '' }}>Complete
                                                    </option>
                                                    <option value="cancelled"
                                                        {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please Select Status!
                                                </div>
                                            </div>
                                            <div class="col-md-3 d-flex align-items-end mb-4">
                                                <button class="btn btn-primary " type="submit">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                    {{-- @if ($order->rider) --}}
                                    {{-- <div class="row"> --}}
                                    {{-- <div class="col-md-4"> --}}
                                    {{-- <h4 class="dark-pink">Rider Information</h4> --}}
                                    {{-- <strong>Name:</strong> --}}
                                    {{-- <p>{{$order->rider->name}}</p> --}}
                                    {{-- <strong>Email:</strong> --}}
                                    {{-- <p>{{$order->rider->email}}</p> --}}
                                    {{-- <strong>Phone:</strong> --}}
                                    {{-- <p>{{$order->rider->phone}}</p> --}}
                                    {{-- </div> --}}
                                    {{-- </div> --}}
                                    {{-- @endif --}}
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
        function PrintElem() {
            window.print();
            return true;
        }

        function deleteRecord(id) {
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
                    document.getElementById('del_form' + id).submit();
                }
            })
        }
    </script>
@endsection
