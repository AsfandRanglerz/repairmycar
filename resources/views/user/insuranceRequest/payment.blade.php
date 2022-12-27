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

            <div class="row mx-0">
                <div class="col-lg-9 col-md-12 mx-auto" style="background: #FFF;padding: 16px;border-radius: 8px">
                    <form role="form" action="{{ route('user.insurance-throughCard') }}" method="POST">
                        @csrf
                        <div class=" billing_info">
                            <h5 class="mb-3 text-center text-uppercase heading-color">{{ __('msg.Payment Info') }}</h5>
                            <h6 class="mb-3 text-center text-uppercase">Price: {{ $data->net_total }} {{ __('msg.AED') }}</h6>
                            <input class='form-control' value="{{ $data->net_total }} {{ __('msg.AED') }}" type='hidden' name="amount">
                        </div>
                        <div class="row g-2">
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <div class="inpu_wraper mb-3">
                                    <div class='col-xs-12 form-group required'>
                                        <input type="hidden" name="vendor_bid_id" value="{{ $data->id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="d-flex flex-wrap justify-content-center align-items-center" style="gap: 30px">
                                    <button class="btn btn-primary btn-lg btn-block"
                                        type="submit">{{ __('msg.PAY THROUGH CREDIT') }}</button>
                                    <h6 class="mb-0 heading-color">OR</h6>
                                    <a class="btn btn-primary btn-lg btn-block" data-bs-toggle="modal"
                                        data-bs-target="#checkAttachModel">{{ __('msg.Pay Through Cheque') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mt-5">
                        <p class="mb-0" style="text-align: center">"Right now you are going to pay 100% of the total
                            ammount
                            {{ $data->net_total }}, thank you"</p>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="checkAttachModel" tabindex="-1" aria-labelledby="checkAttachModelLabel"
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
                                <form action="{{ route('user.insurance-throughCheck') }}" method="POST" id="submitform"
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
                                            <input type="hidden" name="vendor_bid_id" value="{{ $data->id }}">
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
    <script type="text/javascript">
        @error('cheque_image')
            $(function() {
                $('#checkAttachModel').modal('show');
            });
        @enderror
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
