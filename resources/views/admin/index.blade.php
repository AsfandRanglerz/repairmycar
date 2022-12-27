@extends('admin.layout.app')
@section('style')
    <!-- General CSS Files -->
@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="row mb-3">
                {{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">New Order</h5>
                                            <h2 class="mb-3 font-18">{{ $monthlyRevenue }}</h2>
                                            <?php
                                            if ($previousMonthlyRevenue > 0 || $monthlyRevenue > 0) {
                                            if ($previousMonthlyOrder < $monthlyOrder):
                                            if ($previousMonthlyOrder > 0):
                                            $percent_from_order = $monthlyOrder - $previousMonthlyOrder;
                                            $order = $percent_from_order / $previousMonthlyOrder * 100; ?>
                                            <p class="mb-0"><span class="col-green">{{ $order }}%</span> Increase
                                            </p><?php
                                            else:
                                            $order = 100;?>
                                            <p class="mb-0"><span class="col-green">{{ $order }}%</span> Increase
                                            </p><?php
                                            endif;
                                            else:
                                            $percent_from_order = $previousMonthlyOrder - $monthlyOrder;
                                            $order = $percent_from_order / $previousMonthlyOrder * 100;?>
                                            <p class="mb-0"><span class="col-orange">{{ $order }}%</span> Decrease
                                            </p><?php
                                            endif;
                                            } else {
                                            $order = 0;?>
                                            <p class="mb-0"><span class="col-green">{{ $order }}%</span> Increase
                                            </p><?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/admin/assets/img/banner/1.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15"> Customers</h5>
                                            <h2 class="mb-3 font-18">{{ $monthlyAdmin }}</h2>
                                            <?php
                                            if ($previousMonthlyAdmin < $monthlyAdmin):
                                            if ($previousMonthlyAdmin > 0):
                                            $percent_from_user = $previousMonthlyAdmin - $monthlyAdmin;
                                            $user = $percent_from_user / $previousMonthlyAdmin * 100; ?>
                                            <p class="mb-0"><span class="col-green">{{ $user }}%</span> Increase
                                            </p><?php
                                            else:
                                            $user = 100;?>
                                            <p class="mb-0"><span class="col-green">{{ $user }}%</span> Increase
                                            </p><?php
                                            endif;
                                            else:
                                            $percent_from_user = $monthlyAdmin - $previousMonthlyAdmin;
                                            if($percent_from_user>0){
                                            $user = $percent_from_user / $previousMonthlyAdmin * 100;
                                            }
                                            ?>
                                            <p class="mb-0"><span class="col-orange">
                                                    @if (isset($user))
                                                        ?{{ $user }}%:''
                                                    @endif
                                                </span> Decrease</p><?php
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/admin/assets/img/banner/2.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">New Package</h5>
                                            <h2 class="mb-3 font-18">128</h2>
                                            <p class="mb-0"><span class="col-green">18%</span>
                                                Increase</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/admin/assets/img/banner/3.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Revenue</h5>
                                            <?php
                                            if ($previousMonthlyRevenue > 0 || $monthlyRevenue > 0) {
                                            if ($previousMonthlyRevenue < $monthlyRevenue) {
                                            if ($previousMonthlyRevenue > 0) {
                                            $percent_from = $monthlyRevenue - $previousMonthlyRevenue;
                                            $percentRevenue = $percent_from / $previousMonthlyRevenue * 100; ?>
                                            <h2 class="mb-3 font-18">AED {{ $percent_from }}</h2>
                                            <p class="mb-0"><span class="col-green">{{ $percentRevenue }}%</span>
                                                Increase</p><?php
                                            } else {
                                            $percentRevenue = 100; //increase percent?>
                                            <h2 class="mb-3 font-18">AED {{ $percent_from }}</h2>
                                            <p class="mb-0"><span class="col-green">{{ $percentRevenue }}%</span>
                                                Increase</p><?php
                                            }
                                            } else {
                                            $percent_from = $previousMonthlyRevenue - $monthlyRevenue;
                                            $percentRevenue = $percent_from / $previousMonthlyRevenue * 100; //decrease percent?>
                                            <h2 class="mb-3 font-18">AED {{ $percent_from }}</h2>
                                            <p class="mb-0"><span class="col-green">{{ $percentRevenue }}%</span>
                                                Decrease</p><?php
                                            }
                                            } else {
                                            $percent_from = 0;
                                            $percentRevenue = 0;?>
                                            <h2 class="mb-3 font-18">AED {{ $percent_from }}</h2>
                                            <p class="mb-0"><span class="col-green">{{ $percentRevenue }}%</span>
                                                Increase</p><?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/admin/assets/img/banner/4.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card ">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Customers</h5><br>
                                            @if (isset($customer))
                                                <h2 class="mb-3 font-18">{{ $customer->count() }}</h2>
                                            @else
                                                <h2 class="mb-3 font-18">0</h2>
                                            @endif
                                            {{-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0  d-flex align-items-center">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/admin/assets/img/Customer.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card ">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Vendors</h5><br>
                                            @if (isset($vendor))
                                                <h2 class="mb-3 font-18">{{ $vendor->count() }}</h2>
                                            @else
                                                <h2 class="mb-3 font-18">0</h2>
                                            @endif
                                            {{-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0  d-flex align-items-center">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/admin/assets/img/Vendor.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card ">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Companies</h5><br>
                                            @if (isset($company))
                                                <h2 class="mb-3 font-18">{{ $company->count() }}</h2>
                                            @else
                                                <h2 class="mb-3 font-18">0</h2>
                                            @endif
                                            {{-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 d-flex align-items-center">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/admin/assets/img/insurance.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card ">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Garages</h5><br>
                                            @if (isset($garage))
                                                <h2 class="mb-3 font-18">{{ $garage->count() }}</h2>
                                            @else
                                                <h2 class="mb-3 font-18">0</h2>
                                            @endif
                                            {{-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0  d-flex align-items-center">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/admin/assets/img/garages.png') }}" alt="">
                                        </div>
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
@section('script')
    <!-- JS Library -->
    <script src="{{ asset('public/admin/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('public/admin/assets/js/page/index.js') }}"></script>
@endsection
