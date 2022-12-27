@extends('vendor.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-9 mx-auto">
                    <div class="cuatomer_signup_form_wraper mt-5">
                        <div class="main_content_wraper">
                            <h4 class="sec_main_heading text-center mb-0">{{ __('msg.Account') }}</h4>
                            <p class="sec_main_para text-center mb-0">{{__('msg.Update Your Finance Detail')}}</p>
                        </div>
                        <form action="{{ route('vendor.acount.update') }}" method="POST" enctype="multipart/form-data"
                            class="pt-5">
                            @csrf
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading-color">{{__('msg.Bank Account Holder Name') }}</h5>
                            </div>

                            <div class="col-12 mb-3  signup_input_wraper">
                                <input type="text" name="name" value="{{ $account->owner_name }}" class="form-control"
                                    id="inputName" placeholder="{{ __('msg.Owner Name') }}">
                                @error('name')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading-color">{{ __('msg.Bank Name') }}</h5>
                            </div>

                            <div class="col-12 mb-3  signup_input_wraper">
                                <input type="text" name="bank_name" value="{{ $account->bank_name }}"
                                    class="form-control" id="inputName" placeholder="{{ __('msg.Bank Name') }}">
                                @error('bank_name')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 signup_vendor signup_input_wraper">
                                <h5 class="mb-0 heading-color">IBAN</h5>
                            </div>

                            <div class="col-12 mb-3  signup_input_wraper">
                                <input type="number" name="iban" value="{{ $account->iban }}" class="form-control"
                                    id="inputName" placeholder="IBAN">
                                @error('iban')
                                    <div class="text-danger p-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3 signup_input_wraper">
                                <div class="d-grid gap-2 mt-3 mb-4">
                                    <button class="btn btn-secondary block get_appointment"
                                        type="submit">{{ __('msg.SUBMIT') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
