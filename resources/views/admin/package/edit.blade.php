@extends('admin.layout.app')
@section('title', 'Edit Package')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('package.update', ['package' => $package->id]) }}">
                                @csrf
                                @method('put')
                                <div class="card-header">
                                    <h4>Edit Package</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row"></div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" required="" name="name" value="{{ old('name', $package->name) }}">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Package Limit</label>
                                            <input type="number" class="form-control" required="" name="sending_limit" value="{{old('sending_limit', $package->sending_limit) }}">
                                        </div>
                                        <div class="form-group col-8">
                                            <label>Package type</label>
                                            {{--                                            <input type="text" class="form-control" name="description">--}}
                                            <select name="package_type" class="form-control">
                                                <option value="daily" @if($package->package_type == 'daily') selected @endif>Daily</option>
                                                <option value="weekly" @if($package->package_type == 'weekly') selected @endif>Weekly</option>
                                                <option value="monthly" @if($package->package_type == 'monthly') selected @endif>Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-8">
                                            <label>Price</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        PKR
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" name="price" value="{{ old('price', $package->price) }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="exampleColorInput" class="form-label">Color picker</label>
                                            <input type="color" class="form-control form-control-color" id="exampleColorInput" name="color" value="{{ $package->color }}" title="Choose your color">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Update Package</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
