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
                                <h4>All Quotations Request</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Image</th>
                                                <th>Owner Name</th>
                                                <th>Owner Role</th>
                                                <th>Company</th>
                                                <th>Model</th>
                                                <th>Color</th>
                                                <th>Registeration No</th>
                                                <th>Chasis No</th>
                                                <th>Total Bids</th>
                                                <th>Requirement</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($quotes))
                                                @forelse ($quotes as $quote)
                                                <?php
                                                    $img = \App\Models\UserBidImage::where('user_bid_id',$quote->id)->where('type','image')->oldest()->first();
                                                    $company = \App\Models\Company::where('id',$quote->company_id)->first();
                                                    $total_bid = \App\Models\VendorBid::where('user_bid_id',$quote->id)->count();
                                                    $img1=Explode(",",$img->car_image);
                                                ?>
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="images">
                                                            <a href="{{asset($img1[0])}}">
                                                            <img src="{{asset($img1[0])}}" width="80px">
                                                        </td>
                                                        <td>{{ $quote->car_owner_name }}</td>
                                                        <td>
                                                            @if ($quote->user->type == "user")
                                                                <b>Customer</b>
                                                            @else
                                                                <b>Insurance Company</b>
                                                            @endif
                                                        </td>
                                                        <td>{{ $company->company }}</td>
                                                        <td>{{ $quote->model }}</td>
                                                        <td>{{ $quote->color }}</td>
                                                        <td>{{ $quote->registration_no }}</td>
                                                        <td>{{ $quote->Chasis_no }}</td>
                                                        <td>{{ $total_bid }}</td>
                                                        <td>{!!  substr_replace( $quote->description1, " ....", 20) !!}</td>
                                                        <td>
                                                            @if ($quote->offer_status == 'pending')
                                                                <div class="badge badge-warning badge-shadow">{{ ucwords($quote->offer_status) }}</div>
                                                            @else
                                                                <div class="badge badge-success badge-shadow">{{ ucwords($quote->offer_status) }}</div>
                                                            @endif
                                                        </td>
                                                        <td class="d-flex align-items-center">
                                                            <a href="{{route('admin.quote.show',['quote' => $quote->id])}}" class="d-flex text-decoration-none"><span class="fa fa-eye text-warning" style="font-size: 18px"></span></a>
                                                            <form id="del_form{{ $quote->id }}"
                                                                action="{{ route('admin.quote.destroy', ['quote' =>$quote->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a><svg xmlns="http://www.w3.org/2000/svg" data-id="{{ $quote->id }}" class="fas fa-trash text-danger glyphicon glyphicon-trash" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
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
