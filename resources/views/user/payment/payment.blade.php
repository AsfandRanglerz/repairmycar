@extends('user.layout.app')
@section('content')
    <style>
        .btn-primary {
            width: 265px;
            min-width: fit-content;
            text-align: center;
        }

        .alert-danger {
            margin-top: 10%;
        }

        @media (min-width: 992px) {
            .col-lg-2 {
                width: 5.666667%;
            }

            .col-lg-5 {
                width: 46.666667%;
            }
        }
    </style>
    <section class="pb-5 login_content_wraper">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10  mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.SELF PAYMENTS') }}</h4>
                        <p class="sec_main_para text-center">{{ __('msg.Choose and add your payment details below') }}</p>
                    </div>
                </div>
            </div>
            <?php
            $garage = \App\Models\Garage::find($vendorbid->garage_id);
            $vendor = \App\Models\Vendor::with('company')->find($garage->vendor_id);
            $user = \App\Models\User::with('company')->find(Auth::id());
            $per = \App\Models\PaymentPercentage::select('percentage')
                ->where('type', 'order')
                ->first();
            $per = $per->percentage;
            $order = \App\Models\Order::where([['user_bid_id', $vendorbid->user_bid_id], ['vendor_bid_id', $vendorbid->id]])->first();

            if (isset($user->company[0]->name) && isset($vendor->company[0])) {
                foreach ($vendor->company as $company) {
                    if ($user->company[0]->name == $company->name) {
                        $status = 'yes';
                        break;
                    } else {
                        $status = 'no';
                    }
                }
            } else {
                $status = 'no';
            }

            if ($type == 'order') {
                $amount = $order->total - $order->advance;
            } else {
                $amount = round(($vendorbid->net_total * $per) / 100);
            }
            ?>
            <div class="row mx-0">
                <div class="col-lg-9 col-md-12 mx-auto" style="background: #FFF;padding: 16px;border-radius: 8px">
                    <form role="form" action="{{ route('user.payment-info') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_bid_id" value="{{ $vendorbid->user_bid_id }}">
                        <input type="hidden" name="vendor_bid_id" value="{{ $vendorbid->id }}">
                        <input type="hidden" name="garage_id" value="{{ $vendorbid->garage_id }}">
                        <input type="hidden" name="net_total" value="{{ $vendorbid->net_total }}">
                        <div class=" billing_info">
                            <h5 class="mb-3 text-center text-uppercase heading-color">{{ __('msg.Payment Info') }}</h5>
                            <h6 class="mb-3 text-center text-uppercase">Price: {{ $amount }} {{ __('msg.AED') }}</h6>
                            <input class='form-control' value="{{ $amount }} {{ __('msg.AED') }}" type='hidden' name="amount">
                        </div>
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group d-none'>
                                <div class='alert-danger alert'>{{ __('msg.Please correct the errors and try again.') }}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div>
                                @if ($type == 'order')
                                    <div class="d-flex justify-content-center align-items-center" style="gap: 30px">
                                        <input type="hidden" name="type" value="order">
                                        <button class="btn btn-primary btn-lg btn-block"
                                            type="submit">{{ __('msg.PAY THROUGH CREDIT') }}</button>
                                        @if ($user->type == 'company')
                                            <h6 class="mb-0 heading-color">OR</h6>
                                            <a class="btn btn-primary btn-lg btn-block" data-bs-toggle="modal"
                                                data-bs-target="#checkAttachModel"
                                                style="font-size: 14px">{{ __('msg.Pay Through Cheque') }}</a>
                                        @endif
                                    </div>
                                @else
                                    <div class="d-flex flex-wrap justify-content-center align-items-center"
                                        style="gap: 30px">
                                        <input type="hidden" name="type" value="quote">
                                        @if ($status == 'no')
                                            <div class="col-sm-5 mx-auto center" style="text-align: center">
                                                <button class="btn btn-primary btn-lg btn-block"
                                                    type="submit">{{ __('msg.PAY THROUGH CREDIT') }}</button>
                                            </div>
                                        @else
                                            <button class="btn btn-primary btn-lg btn-block"
                                                type="submit">{{ __('msg.PAY THROUGH CREDIT') }}</button>
                                            <h6 class="mb-0 heading-color">OR</h6>
                                            <a href="{{ route('user.payment-insurance', $vendorbid->id) }}"
                                                class="btn text-center btn-primary get_quot block get_appointment d-flex align-items-center justify-content-center"
                                                type="button"
                                                style="font-size: 14px">{{ __('msg.PAY VIA INSURANCE COMPANY') }}</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="mt-5">
                        @if ($type == 'order')
                            @if (Auth::user()->type == 'company')
                                <p class="mb-0" style="text-align: center">"You've paid the 100% of the total amount
                                    {{ $order->total }} to make the order as completed"</p>
                            @else
                                <p class="mb-0" style="text-align: center">"You've paid the {{ $per }}% of the
                                    total amount
                                    {{ $order->total }} in the first
                                    half to make the order in process, right
                                    now we are asking you to pay the remaining dues to make the order as completed"</p>
                            @endif
                        @else
                            <p class="mb-0" style="text-align: center">"Right now you are going to pay
                                {{ $per }}% of the
                                total amount
                                {{ $vendorbid->net_total }}, the remaining dues will be asked to
                                pay when the order get completed, thank you"</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="checkAttachModel" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="sec_main_heading text-center mb-0">{{ __('msg.Pay Through Cheque') }}</h5>
                            <a type="button" class="heading-color" data-bs-dismiss="modal"><span
                                    class="fa fa-times"></span></a>
                        </div>
                        <div class="modal-body">
                            <div class="garage_name">
                                <form action="{{ route('user.payment-throughCheck') }}" method="POST" id="submitform"
                                    enctype="multipart/form-data" class="my-2">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <label class="mb-2 heading-color"><b>{{ __('msg.Upload Cheque image') }}<small>
                                                        ({{ __('msg.Click the box to upload') }})</small></b></label>
                                            <div class="cheque-image">
                                                {{-- input field name  check_image --}}

                                            </div>
                                            @error('cheque_image')
                                                <div class="text-danger p-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <input type="hidden" name="user_bid_id"
                                                value="{{ $vendorbid->user_bid_id }}">
                                            <input type="hidden" name="vendor_bid_id" value="{{ $vendorbid->id }}">
                                            <input type="hidden" name="garage_id" value="{{ $vendorbid->garage_id }}">
                                            <input type="hidden" name="net_total" value="{{ $vendorbid->net_total }}">
                                            <input value="{{ $amount }} {{ __('msg.AED') }}" type='hidden'
                                                name="amount">
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button class="btn btn-primary flterClass disabled" id="submit"
                                            type="submit">{{ __('msg.SUBMIT') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        @error('cheque_image')
            $(function() {
                $('#checkAttachModel').modal('show');
            });
        @enderror
    </script>
    <script type="text/javascript">
        $(function() {
            setInterval(() => {
                if (!$('input[name="images[]"]').val() == "") {
                    $('.flterClass').removeClass('disabled');
                } else {
                    $('.flterClass').addClass('disabled');
                }
            }, 500);
        });
    </script>
@endsection
