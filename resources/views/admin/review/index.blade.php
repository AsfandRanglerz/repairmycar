@extends('admin.layout.app')
@section('title', 'Review')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Reviews</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Customer Name</th>
                                            <th>Product Id</th>
                                            <th>Star</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($reviews as $review)
                                            <tr>
                                                {{--@dd($review->user->name)--}}
                                                <td>{{$loop->iteration}}</td>
                                                <td>@if(isset($review->product)) {{ $review->product->name }} @else Null @endif </td>
                                                <td>@if(isset($review->product)) {{ $review->product->name }} @else Null @endif </td>
                                                <td>{{ $review->star }}</td>
                                                <td>{{ $review->message }}</td>
                                                <td>
                                                    {{--<a href="{{ route('review.edit', ['review' => $review->id]) }}" class="btn btn-primary"><i data-feather="edit"></i></a>--}}
                                                    <form action="{{ route('review.destroy', ['review' => $review->id] ) }}" method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9"> Data not found!</td>
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

