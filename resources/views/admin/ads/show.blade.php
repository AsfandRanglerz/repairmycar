@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">

                            <div class="card-header">
                                <h4>Car Ad Detail</h4>
                            </div>
                            @php
                                $images = explode(',', $ad->images);
                                $documents = explode(',', $ad->document_file);
                            @endphp
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Car Images</label>
                                        <div class=" border border-dark p-1">
                                            @foreach ($images as $image)
                                                <img src="{{ asset($image) }}" alt=""  height="60px" width="90px">
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Documents</label>
                                        <div class="border border-dark p-1">
                                            @foreach ($documents as $document) 
                                                <img src="{{ asset($document) }}" alt="" w height="60px" width="90px">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Model</label>
                                        <p class="form-control">{{ $ad->model }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Company</label>
                                        <p class="form-control">{{ $ad->company->company }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Model year</label>
                                        <p class="form-control">{{ $ad->modelYear->model_year }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Price</label>
                                        <p class="form-control">{{ $ad->price }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Color</label>
                                        <p class="form-control">{{ $ad->color }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Engine</label>
                                        <p class="form-control">{{ $ad->engine }} cc</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Phone</label>
                                        <p class="form-control">{{ $ad->phone }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Address</label>
                                        <p class="form-control">{{ $ad->address }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>City</label>
                                        <p class="form-control">{{ $ad->city }}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Total Mileage</label>
                                        <p class="form-control">{{ $ad->mileage }}</p>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="card-body">

                            <div class="row">
                                <label>Description</label>
                                <div class="form-group col-md-6">
                                    <textarea name="" id="" cols="40" rows="5"> {{$ad->description}}</textarea>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
