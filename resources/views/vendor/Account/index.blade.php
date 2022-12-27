@extends('vendor.layout.app')
@section('content')
    <section class="dashboard_main_section"
        style="background-image:url({{ url('/public/vendor/assets/images/gradiantbg.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper mt-5">
                        <h4 class="sec_main_heading text-center mb-0">{{__('msg.FINANCE')}}</h4>
                        <p class="sec_main_para text-center"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-12 mx-auto ">
                    <div class="edit_profile_link_wraper mb-lg-4 mb-3">
                        <a href="{{ route('vendor.acount.create') }}"><img
                                src="{{ asset('public/vendor/assets/images/editicon.svg') }}">{{__('msg.Account')}}</a>
                    </div>
                </div>
                <div class="col-lg-7 mx-auto">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-lg-center mb-4">
                                <div class="user_icon">
                                    {{-- <img src="{{ asset('public/vendor/assets/images/user.svg') }}"> --}}
                                </div>
                                <p class="mb-0">{{__('msg.Total')}}: {{ Auth::guard('vendor')->user()->balance }} {{ __('msg.AED') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-center mb-4">
                                <div class="user_icon">
                                    {{-- <img src="{{ asset('public/vendor/assets/images/location.svg') }}"> --}}
                                </div>
                                <a class="nav-link " href="{{ route('vendor.orders') }}">
                                    <p class="mb-0 text-white" >{{__('msg.Pending Order')}}: {{ $pending }} {{ __('msg.AED') }}</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-center mb-4">
                                <div class="user_icon">
                                    {{-- <img src="{{ asset('public/vendor/assets/images/mailicon.svg') }}"> --}}
                                </div>
                                <p class="mb-0">{{__('msg.Withdraw Request')}}: {{ $request }} {{ __('msg.AED') }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-center mb-4">
                                <div class="user_icon">
                                    {{-- <img src="{{ asset('public/vendor/assets/images/callicon.svg') }}"> --}}
                                </div>
                                <p class="mb-0">{{__('msg.withdrawn')}}: {{ $withdraw }} {{ __('msg.AED') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->

                    <button type="button"
                        class="btn btn-primary mx-auto @if (Auth::guard('vendor')->user()->balance < 20) disabled @endif "
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        {{__('msg.Go To Withdraw')}}
                    </button>

                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="sec_main_heading text-center mb-0">{{__('msg.Withdraw Request')}}</h5>
                        <a type="button" class="heading-color" data-bs-dismiss="modal"><span
                                class="fa fa-times"></span></a>
                    </div>
                    <div class="modal-body">
                        <div class="garage_name">
                            <form action="{{ route('vendor.withdraw_request') }}" method="post" id="submitform"
                                class="my-2">
                                @csrf
                                <div class="row">

                                    <div class="col-12 mb-3 signup_vendo">
                                        <h5 class="mb-0 heading-color">{{__('msg.payment')}}</h5>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input type="number" name="payment" value="" class="form-control"
                                            id="payment">
                                        @error('payment')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3 signup_vendo">
                                        <h5 class="mb-0 heading-color">{{__('msg.Deduction')}}</h5>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input type="number" name="deduction" value="" class="form-control"
                                            id="deduction" readonly>
                                        @error('deduction')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3 signup_vendo">
                                        <h5 class="mb-0 heading-color">{{__('msg.Received')}}</h5>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input type="number" name="receive" value="" class="form-control"
                                            id="receive" readonly>
                                        @error('receive')
                                            <div class="text-danger p-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary flterClass" id="submit"
                            type="submit">{{ __('msg.SUBMIT') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <?php
    $per = \App\Models\PaymentPercentage::where('type', 'withdraw')
        ->pluck('percentage')
        ->first();
    ?>

    <script>
        $(document).ready(function() {
            $(document).on('keyup', '#payment', function() {
                var per = '<?php echo $per; ?>';
                var balance = '<?php echo Auth::guard('vendor')->user()->balance; ?>';
                var payment = $(this).val();
                var balanceNum = parseInt(balance);
                if (payment > balanceNum) {
                    $('.danger-msg').remove();
                    $(this).after(
                        '<p class="mt-2 mb-0 text-danger danger-msg">You dont have enough money in your account</p>'
                        );
                    $('#submit').attr('disabled', true);
                } else {
                    $('.danger-msg').remove();
                    $('#submit').attr('disabled', false);
                }

                if (payment == '') {
                    var payment = 0;
                    $("#deduction").val();
                    $("#receive").val();
                } else {
                    var deduct = Math.round((payment * per) / 100);
                    var receive = payment - deduct;
                    $("#deduction").val(deduct);
                    $("#receive").val(receive);
                }
            });
        });
    </script>
@endsection
