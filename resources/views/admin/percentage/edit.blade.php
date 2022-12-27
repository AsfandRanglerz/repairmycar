@extends('admin.layout.app')
@section('title', 'Edit Package')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ url('/admin/update-percentage/'. $data->id)  }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Package</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row"></div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" class="form-control" required="" name="type" value="{{$data->type}}" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Percentage % (First-Half Payment)</label>
                                        <input type="number" class="form-control" required="" name="percentage" value="{{$data->percentage}}">
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
