@extends('admin.layout.app')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Simple Ads</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Image</th>
                                            <th>Email</th>
                                            <th>URL</th>
                                            <th>Description</th>
                                            <th>Package</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ads as $ad)
                                            <td class="images">
                                                <a href="{{ asset($ad->image) }}"> <img src="{{ asset('/' . $ad->image) }}"
                                                        style="height: 50px;width:80px"></a>
                                            </td>
                                            <td>{{ $ad->email ?? '' }}</td>
                                            <td><a href="{{ $ad->url }}">{{ $ad->url }} </a> </td>
                                            <td>{{ $ad->description ?? '' }}</td>
                                            <td>
                                                <div class="badge badge-shadow badge-dark">
                                                    {{ $ad->package->package_name }}</div>
                                            </td>
                                            <td>
                                                <div class="badge badge-shadow @if ($ad->status == 'Pending') badge-warning @else badge-success @endif">
                                                    {{ $ad->status }}
                                                </div>
                                            </td>
                                            </td>
                                            <td>
                                                @if ($ad->status == 'Pending')
                                                    <a href="{{ route('admin.package/status', $ad->id) }}" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-left"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="8" cy="12" r="3"> </circle></svg></a>
                                                @endif
                                                <a href="{{ route('admin.simpleAd/delete', $ad->id) }}"><svg
                                                        xmlns="htt p://www.w3.org/2000/svg" data-id="{{ $ad->id }}"
                                                        class="fas fa-trash text-danger glyphicon glyphicon-trash"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-trash-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17">
                                                        </line>
                                                        <line x1="14" y1="11" x2="14" y2="17">
                                                        </line>
                                                    </svg></a>
                                            </td>
                                            </tr>
                                        @endforeach
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
