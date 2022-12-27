@extends('admin.layout.app')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Coupons</h4>
                            </div>
                            <form action="{{ route('coupon.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Coupons Name</label>
                                        <input type="text" class="form-control" name="name">
                                        @error('name')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <select name="type" id="" class="form-control">
                                                    <option value="percentage" selected><span class="input-group-text">%</span></option>
                                                    <option value="price"><span class="input-group-text">$</span></option>
                                                </select>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="amount" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                            @error('amount')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Card Limit</label>
                                        <input type="number" class="form-control" name="cart_limit">
                                        @error('cart_limit')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Add Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Coupons</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Card Limit</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($coupons as $coupon)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucwords($coupon->name) }}</td>
                                                <td>{{ $coupon->type }}</td>
                                                <td>{{ $coupon->amount }}</td>
                                                <td>{{ $coupon->cart_limit }}</td>
                                                <td>
                                                    <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-primary"><i data-feather="edit"></i></a>
                                                    @if ($coupon->status == 'deactive')
                                                        <a href="{{ route('coupon.activate', $coupon->id) }}" class="btn btn-danger">
                                                            <i data-feather="toggle-left"></i></a>
                                                    @else
                                                        <a href="{{ route('coupon.deactivate', $coupon->id) }}" class="btn btn-primary">
                                                            <i data-feather="toggle-right"></i></a>
                                                    @endif
                                                    <form action="{{ route('coupon.destroy', $coupon->id ) }}" method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-primary" type="submit"><i data-feather="trash-2"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">Data Not Found!</td>
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

