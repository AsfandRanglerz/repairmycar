@extends('vendor.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/vendor/assets/images/gradiantbg.jpg);">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5 white-background-box">
                        <h5 class="sec_main_heading text-center">{{ $garage->garage_name }} {{ __('msg.GARAGE') }}</h5>
                        <p class="sec_main_para text-center">{{ $garage->address }} {{ __('msg.P/O Box') }}
                            {{ $garage->post_box }}</p>
                        <p class="sec_main_para text-center"><b>{{ __('msg.Tel') }} :
                            </b><span>{{ $garage->phone }}</span>, <b>Fax : </b><span>3881433</span></p>
                        <p class="sec_main_para text-center"><b>{{ __('msg.Email') }} :
                            </b><span>{{ auth()->user()->email }}</span></p>
                        <h5 class="sec_main_heading text-center my-3">{{ __('msg.JOB ESTIMATE') }}</h5>
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered table-striped table-dark mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('msg.Name') }}</th>
                                        <td colspan="2">{{ $data->vendordetail->vendor->name }}</td>
                                        <th>{{ __('msg.id') }}</th>
                                        <td>{{ $data->id }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{ __('msg.Phone') }}</th>
                                        <td>{{ $data->vendordetail->vendor->phone }}</td>
                                        <th>{{ __('msg.Fax') }} :</th>
                                        <th>{{ __('msg.Date') }}</th>
                                        <td>{{ \Carbon\Carbon::parse($data->created)->format('d-M-Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h6 class="mt-3">{{ __('msg.view_details') }} :</h6>
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered table-striped table-dark mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('msg.Registration No.') }}.</th>
                                        <td>{{ $data->userBid->registration_no }}</td>
                                        <th>{{ __('msg.mileage') }}.</th>
                                        <td>{{ $data->userBid->mileage }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Make</th>
                                        <td>{{ $data->userBid->company->company }}</td>
                                        <th>Color</th>
                                        <td>{{ $data->userBid->color }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chasis No.</th>
                                        <td>{{ $data->userBid->Chasis_no }}</td>
                                        <th>Year</th>

                                        <td>{{ $data->userBid->modelYear->model_year }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h6 class="mt-3">Services Detail :</h6>
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered table-striped table-dark mb-0">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Particulars</th>
                                        <th>Qty</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                        $grand_total = 0;
                                    @endphp
                                    @forelse($data->part as $service)
                                        @if ($service->type == 'services')
                                            @php
                                                $total += $service->service_rate * $service->service_quantity;
                                                
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $service->service_name }}</td>
                                                <td>{{ $service->service_quantity }}</td>
                                                <td><span>{{ $service->service_rate }}</span>.00</td>
                                                <td><span>{{ $service->service_rate * $service->service_quantity }}</span>.00
                                                </td>

                                            </tr>
                                        @endif
                                    @empty
                                    @endforelse
                                    @php
                                        $grand_total += $total;
                                    @endphp
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>Services : </th>
                                        <td><span>{{ $total }}</span>.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h6 class="mt-3">Spares Detail :</h6>
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered table-striped table-dark mb-0">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Particulars</th>
                                        <th>Qty</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @forelse($data->part as $service)
                                        @if ($service->type == 'spares')
                                            @php
                                                $total += $service->service_rate * $service->service_quantity;
                                                
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $service->service_name }}</td>
                                                <td>{{ $service->service_quantity }}</td>
                                                <td><span>{{ $service->service_rate }}</span>.00</td>
                                                <td><span>{{ $service->service_rate * $service->service_quantity }}</span>.00
                                                </td>

                                            </tr>
                                        @endif
                                    @empty
                                    @endforelse
                                    @php
                                        $grand_total += $total;
                                    @endphp
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>Spares : </th>
                                        <td><span>{{ $total }}</span>.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h6 class="mt-3">Others :</h6>
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered table-striped table-dark mb-0">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Particulars</th>
                                        <th>Qty</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                        $grand_toal = 0;
                                    @endphp
                                    @forelse($data->part as $service)
                                        @if ($service->type == 'others')
                                            @php
                                                $total += $service->service_rate * $service->service_quantity;
                                                
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $service->service_name }}</td>
                                                <td>{{ $service->service_quantity }}</td>
                                                <td><span>{{ $service->service_rate }}</span>.00
                                                </td>
                                                <td><span>{{ $service->service_rate * $service->service_quantity }}</span>.00
                                                </td>

                                            </tr>
                                        @endif
                                    @empty
                                    @endforelse
                                    @php
                                        $grand_total += $total;
                                    @endphp
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>Others : </th>
                                        <td><span>{{ $total }}</span>.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="my-3 row mx-0">
                            <div class="offset-xl-8 col-xl-4 offset-md-7 col-md-5 offset-sm-6 col-sm-6">
                                <div class="row">
                                    <b class="col-6">Estimate Total</b>
                                    <div class="col-6 text-xl-right">
                                        <span><span>{{ $grand_total }}</span>.00</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-6">VAT 5%</b>
                                    <div class="col-6 text-xl-right">
                                        <span>{{ $data->vat }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <b class="col-6">Net Total</b>
                                    <div class="col-6 text-xl-right">
                                        <span>{{ $grand_total + $data->vat }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="font-italic px-4">
                                <li>
                                    The above estimate is an approximate and is based on our initial
                                    inspection of the vehicle. An additional estimate shall be
                                    prepared and send for any extra work or parts required, after
                                    dismantling
                                </li>
                                <li>
                                    When an estimation for repair is given, it is understood that
                                    the total cost of repair would be ±25% of the
                                    estimated amount. After preparation of the estimation, if the
                                    customer does not repair the car he/she should pay a
                                    minimum of AED 450/- or more ( depending on the diagnose time
                                    expenditure) will be charged if job estimated and
                                    not repaired / pulled out.
                                </li>
                                <li>
                                    If estimate value is above AED 1000 customer is required to make
                                    full advance payment for parts and 50% of labour.
                                </li>
                                <li>Estimate is valid for 7 days only</li>
                                <li>Vehicle delivery is subject to availability of parts.</li>
                                <li>Signed copy of estimate with approval has to be sent for
                                    commencement of work.</li>
                                <li>Vehicle once ready for delivery should be collected with in 3
                                    days, after which MOTORMEC GARAGE will not be liable for any
                                    damages or losses.</li>
                                <li>Please note after replacement/repair of the above any additional
                                    requirement if required can only be ascertained after testing of
                                    said repair/replacement.</li>
                            </ul>
                            <p class="font-italic">Remarks : ALL PARTS USED AND AFTER
                                MARKET......... NO WARRANTY</p>
                            <b class="font-italic small">
                                Please Note : Vehicle Must be collected with 3 days of
                                Invoice/Estimate date, Failing which there
                                will be a parking charge of AED 50/- per day incurred by customer.
                                Motormec will not be
                                responsible if the vehcile is collected / picked / impounded by
                                Dubai local authorities for which
                                it will be the customers responibility to get the vehicle released
                                at thier own costs.
                            </b>
                            <a class="btn-secondary get_appointment mt-3" href="#" id="pdf">Download Pdf</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#pdf', function(event) {
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
