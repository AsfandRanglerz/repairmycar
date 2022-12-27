@extends('admin.layout.app')
@section('title', 'Product')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Products</h4>
                                <a href="{{ route('product.create') }}" class="btn btn-primary" style="margin-left: auto; display: block;">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Publisher Name</th>
                                            <th>Market</th>
                                            <th>City</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($products))
                                            @forelse ($products as $product)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>@if(isset($product->category))
                                                            {{ $product->category->name }}, {{ isset($product->subcategory->name) ? $product->subcategory->name : 'Null' }}
                                                            , {{ isset($product->childcategory->name) ? $product->childcategory->name : 'Null' }}
                                                        @else
                                                            Null
                                                        @endif
                                                    </td>
                                                    <td>{{ (isset($product->user)) ? $product->user->name : 'Null' }}</td>
                                                    <td>{{ (isset($product->market)) ? $product->market->name : 'Null' }}</td>
                                                    <td>{{ (isset($product->area)) ? $product->area->city : 'Null' }}</td>
                                                    <td>
                                                        @if ($product->status == 'active')
                                                            <div class="badge badge-success badge-shadow">{{ ucwords($product->status) }}</div>
                                                        @else
                                                            <div class="badge badge-danger badge-shadow">{{ ucwords($product->status) }}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary"><i data-feather="edit"></i></a>
                                                        @if ($product->status == 'deactive')
                                                            <a href="{{ route('product.activate', $product->id) }}" class="btn btn-danger">
                                                                <i data-feather="toggle-left"></i></a>
                                                        @else
                                                            <a href="{{ route('product.deactivate', $product->id) }}" class="btn btn-primary">
                                                                <i data-feather="toggle-right"></i></a>
                                                        @endif
                                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-primary" type="submit"><i data-feather="trash-2"></i></button>
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

