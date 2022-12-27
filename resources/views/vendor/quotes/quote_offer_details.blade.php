@extends('vendor.layout.app')
@section('content')
<section class="pb-5 login_content_wraper" style="background-image:url(public/vendor/assets/images/gradiantbg.jpg);">
    <div class="container-lg container-fluid" >
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5 white-background-box">
                    <h5 class="sec_main_heading text-center">{{$data->vendordetail->garage_name}} {{__('msg.GARAGE')}}</h4>
                    <p class="sec_main_para text-center">{{$data->vendordetail->address}} {{__('msg.P/O Box')}} {{$data->vendordetail->post_box}}</p>
                    <p class="sec_main_para text-center"><b>{{__('msg.Tel')}}: </b><span>{{$data->vendordetail->phone}}</span></p>
                    <p class=" text-center"><b>{{__('msg.Email')}}: </b><span>{{$data->vendordetail->vendor->email}}</span></p>
                    <h5 class="sec_main_heading text-center my-3">{{__('msg.JOB ESTIMATE')}}</h4>
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered table-striped table-dark mb-0">
                            <thead>
                                <tr>
                                    <th>{{__('msg.Name')}}</th>
                                    <td colspan="2">{{$data->vendordetail->vendor->name}}</td>
                                    <th>{{__('msg.id')}}</th>
                                    <td>{{mt_rand(1, 999999)}}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{__('msg.Phone')}}</th>
                                    <td colspan="2">{{$data->vendordetail->vendor->phone}}</td>
                                    <th>{{__('msg.Date')}}</th>
                                    <td>{{ \Carbon\Carbon::parse($data->created)->format('d-M-Y')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h6 class="mt-3">{{__('msg.vendor_detail')}}</h4>
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered table-striped table-dark mb-0">
                            <thead>
                                <tr>
                                    <th>{{__('msg.Registration No.')}}</th>
                                    <td>{{$data->userBid->registration_no}}</td>
                                    <th>{{__('msg.Total Mileage')}}</th>
                                    <td>{{$data->userBid->mileage}}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{__('msg.Car Make')}}</th>
                                    <td>{{$data->userBid->company->company}}</td>
                                    <th>{{__('msg.Color')}}</th>
                                    <td>{{$data->userBid->color}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('msg.Chasis No.')}}</th>
                                    <td>{{$data->userBid->Chasis_no}}</td>
                                    <th>{{(__('msg.Year'))}}</th>

                                    <td>{{$data->userBid->modelYear->model_year}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h6 class="mt-3">{{__('msg.Services Detail')}}:</h4>
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered table-striped table-dark mb-0">
                            <thead>
                                <tr>
                                    <th>{{__('msg.SL No')}}</th>
                                    <th>{{__('msg.Particular')}}</th>
                                    <th>{{__('msg.Qty')}}</th>
                                    <th>{{__('msg.Rate')}}</th>
                                    <th>{{__('msg.Amount')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $total=0;
                             $grand_total=0;
                            @endphp
                            @forelse($data->part as $service)
                                @if($service->type=='services')
                                    @php
                                        $total+=$service->service_rate*$service->service_quantity;

                                    @endphp
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$service->service_name}}</td>
                                    <td>{{$service->service_quantity}}</td>
                                    <td><span>{{$service->service_rate}}</span>.00</td>
                                    <td><span>{{$service->service_rate*$service->service_quantity}}</span>.00</td>

                                </tr>
                                @endif
                            @empty
                            @endforelse
                            @php
                                $grand_total+=$total;
                            @endphp
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th>{{__('msg.Services')}}: </th>
                                    <td><span>{{$total}}</span>.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h6 class="mt-3">{{__('msg.Spares Details')}} :</h4>
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered table-striped table-dark mb-0">
                            <thead>
                                <tr>
                                    <th>{{__('msg.SL No')}}</th>
                                    <th>{{__('msg.Particular')}}</th>
                                    <th>{{__('msg.Qty')}}</th>
                                    <th>{{__('msg.Rate')}}</th>
                                    <th>{{__('msg.Amount')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $total=0;
                            @endphp
                            @forelse($data->part as $service)
                                @if($service->type=='spares')
                                    @php
                                        $total+=$service->service_rate*$service->service_quantity;

                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$service->service_name}}</td>
                                        <td>{{$service->service_quantity}}</td>
                                        <td><span>{{$service->service_rate}}</span>.00</td>
                                        <td><span>{{$service->service_rate*$service->service_quantity}}</span>.00</td>

                                    </tr>
                                @endif
                            @empty
                            @endforelse
                            @php
                                $grand_total+=$total;
                            @endphp
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th>{{__('msg.Spares')}}: </th>
                                    <td><span>{{$total}}</span>.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h6 class="mt-3">{{__('msg.Others')}}:</h4>
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered table-striped table-dark mb-0">
                            <thead>
                                <tr>
                                    <th>{{__('msg.SL No')}}</th>
                                    <th>{{__('msg.Particular')}}</th>
                                    <th>{{__('msg.Qty')}}</th>
                                    <th>{{__('msg.Rate')}}</th>
                                    <th>{{__('msg.Amount')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $total=0;
                                $grand_toal=0;
                            @endphp
                            @forelse($data->part as $service)
                                @if($service->type=='others')
                                    @php
                                        $total+=$service->service_rate*$service->service_quantity;

                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$service->service_name}}</td>
                                        <td>{{$service->service_quantity}}</td>
                                        <td><span>{{$service->service_rate}}</span>.00</td>
                                        <td><span>{{$service->service_rate*$service->service_quantity}}</span>.00</td>

                                    </tr>
                                @endif
                            @empty
                            @endforelse
                            @php
                                $grand_total+=$total;
                            @endphp
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th>{{__('msg.Others')}}: </th>
                                    <td><span>{{$total}}</span>.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="my-3 row mx-0">
                        <div class="offset-xl-8 col-xl-4 offset-md-7 col-md-5 offset-sm-6 col-sm-6">
                            <div class="row">
                                <b class="col-6">{{__('msg.Estimate Total')}}</b>
                                <div class="col-6 text-xl-right">
                                    <span><span>{{$grand_total}}</span>.00</span>
                                </div>
                            </div>
                            <div class="row">
                                <b class="col-6">{{__('msg.vat')}} {{Auth::user()->vat}}%</b>
                                <div class="col-6 text-xl-right">
                                    <span>{{$data->vat}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <b class="col-6">{{__('msg.Net Total')}}</b>
                                <div class="col-6 text-xl-right">
                                    <span>{{$grand_total+ $data->vat}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="font-italic">{{$data->description}}</p>
                        <p class="font-italic">{{__('msg.Remarks: ALL PARTS USED AND AFTERMARKET......... NO WARRANTY')}}</p>
                        <b class="font-italic small">
                           {{__('msg.offer_term')}}
                        </b>
                        <a class="btn-secondary get_appointment mt-3" href="#" id="pdf">{{__('msg.Download Pdf')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click','#pdf', function(event){
              $('header').hide();
                $('#dashboardSidebar').hide()
                $('.right_main').css('margin-left', 0)
                $('#pdf').hide();
                window.print();
                $('header').show();
                $('#dashboardSidebar').show()
                $('.right_main').css('margin-left', '255px')
                $('#pdf').show();

            });

        });
    </script>
@endsection
