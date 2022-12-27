@extends('admin.layout.app')
@section('title', 'Create New Package')
@section('style')
    <link rel="stylesheet" href="{{ asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('package.store') }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Add New Package</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row"></div>
                                    <div class="form-group">
                                        <label>Package Name</label>
                                        <input type="text" class="form-control" required="" name="name">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Package Limit</label>
                                            <input type="number" class="form-control" required="" name="sending_limit">
                                        </div>
                                        <div class="form-group col-8">
                                            <label>Package type</label>
                                            {{--                                            <input type="text" class="form-control" name="description">--}}
                                            <select name="package_type" class="form-control">
                                                <option value="daily">Daily</option>
                                                <option value="weekly">Weekly</option>
                                                <option value="monthly">Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-8">
                                            <label>Package Price</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        PKR
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" name="price">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="exampleColorInput" class="form-label">Color picker</label>
                                            <input type="color" class="form-control form-control-color" id="exampleColorInput" name="color" value="#563d7c" title="Choose your color">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Add new Package</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('public/admin/assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
@endsection
