@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form method="post" action="{{ route('admin.simpleAd.update', $packages->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="card-header">
                                        <h4>Edit Package</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Package Name</label>
                                            <input type="text" class="form-control" name="package_name" value="{{$packages->package_name}}"  required >
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-8">
                                                <label>Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            AED
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="price" value="{{$packages->price}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Validity</label>
                                            <input type="text" class="form-control" required="" name="validity" value="{{$packages->validity}}">
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
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $("#table_one").DataTable();
        });
    </script>
@endsection
