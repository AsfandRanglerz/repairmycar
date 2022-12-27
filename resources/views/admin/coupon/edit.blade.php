@extends('admin.layout.app')
@section('title', 'Edit Coupon')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Coupon</h4>
                            </div>
                            <form action="{{ route('coupon.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Coupon Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $coupon->name }}">
                                        @error('name')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <select name="type" id="" class="form-control">
                                                    <option value="{{ $coupon->type }}" selected><span class="input-group-text">
                                                            {{ ($coupon->type == 'percentage') ? '%' : '$' }}
                                                        </span></option>
                                                    <option value="percentage"><span class="input-group-text">%</span></option>
                                                    <option value="price"><span class="input-group-text">$</span></option>
                                                </select>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="amount" required value="{{ $coupon->amount }}">
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
                                        <input type="number" class="form-control" name="cart_limit" value="{{ $coupon->cart_limit }}">
                                        @error('cart_limit')
                                        <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Update Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

