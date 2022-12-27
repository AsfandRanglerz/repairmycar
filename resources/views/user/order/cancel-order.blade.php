@extends('user.layout.app')
@section('content')
<section class="pb-5 login_content_wraper" style="background-image:url(assets/images/gradiantbg.jpg);">
    <div class="container-lg container-fluid">
        <div class="row g-2 pt-5">
            <div class="col-lg-11 col-md-12 col-11  mx-auto">
                <div class="all_quote_card  vendor_rply_dtlL completed_orders">
                    <?php
                        $userbid = \App\Models\UserBid::where('id',$order->user_bid_id)->first();
                        $company = \App\Models\Company::where('id',$userbid->company_id)->first();
                        $garage = \App\Models\Garage::where('id',$order->garage_id)->first();
                        $vendor = \App\Models\Vendor::where('id',$garage->vendor_id)->first();
                        ?>
                    <div class="car_inner_imagg vendor_rply_dtl ">
                        <img @if($garage->image && $garage->image != null) src="{{asset($garage->image)}}" @else
                        src="{{ asset('public/assets/images/repair2.jpg') }}" @endif>
                    </div>
                    <div class=" w-100  quote_detail_wraper">
                        <div class="quote_info">
                            <h5 class="d-flex align-items-center active_quote">{{$garage->garage_name}}</h5>
                            <p class="mb-0">{{$vendor->name}}</p>
                            <p>{{$vendor->phone}}</p>
                            <div class="card_icons d-flex justify-content-center align-items-center">
                                <?php $category = \App\Models\GarageCategory::where('garage_id',$garage->id)->pluck('category_id');
                                    $category_name = \App\Models\Category::whereIn('id',$category)->get();
                                    ?>
                                @foreach($category_name as $catname)
                                <div class="icon_wrpaer">
                                    <img src="{{asset($catname->icon)}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="quote_detail_btn_wraper">
                            <div class="quote_detail_btn_wraper">
                                <h5 class=" text-sm-center vendor_replies_dtl allOrder">{{$order->status}}</h5>
                            </div>
                            <h5 class="text-sm-center"><span class="h5 heading-color">{{__('msg.Total')}}:</span> {{$order->total}} {{__('msg.AED')}}</h5>
                            <div class="completed_order_id">
                                <h5><span class="h5 heading-color">{{__('msg.Order Id:')}}</span> #{{ $order->order_code }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0 mt-3">
            <div class="col-lg-12">
                <div class="all_quote_card  vendor_rply_dtlL _text">
                    <div class="over_view_part carad_data vendor_detail">
                        <h5 class="heading-color text-center mb-5">{{__('msg.REPAIR DETAILS')}}</h5>
                    </div>
                    <?php $vendor_bid = \App\Models\VendorBid::where('garage_id',$order->garage_id)->where('user_bid_id',$order->user_bid_id)->first();?>
                    <div class="vendor__rply__dttl">
                        <p>{{$vendor_bid->description}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0 mt-3">
            <div class="col-lg-12">

                <div class="all_quote_card  vendor_rply_dtlL _text">
                    <div class="over_view_part carad_data vendor_detail">
                        <h5 class="heading-color text-center mb-5">{{__('msg.CAR DETAILS')}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="row mt-1 g-3">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="d-grid gap-2 ">
                                        <button class="btn text-center btn-secondary get_quot block get_appointment"
                                            type="button">{{__('msg.Model')}} : {{getModelByUserBid($order->user_bid_id)}}
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="d-grid gap-2 ">
                                        <button class="btn text-center btn-secondary get_quot block get_appointment"
                                            type="button">{{__('msg.Car Make')}} : {{$company->company}}
                                        </button>
                                    </div>
                                </div>
                                <?php $userbidcateg = \App\Models\UserBidCategory::where('user_bid_id',$order->user_bid_id)->pluck('category_id');
                                    $userbidcategories = \App\Models\Category::whereIn('id',$userbidcateg)->get(); ?>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="d-grid gap-2 ">
                                        <button class="btn text-center btn-secondary get_quot block get_appointment"
                                            type="button">{{__('msg.Type of Service')}} : @foreach($userbidcategories as
                                            $userbidcategory) {{$userbidcategory->name}}, @endforeach
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="d-grid gap-2 ">
                                        <button class="btn text-center btn-secondary get_quot block get_appointment"
                                            type="button">{{__('msg.Customer Name')}}: {{auth()->user()->name}}
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="over_view_part carad_data vendor_detail Leave_review">
                    <h5 class="heading-color text-center mb-2 mt-4">{{__('msg.REASON FOR CANCELING')}}</h5>
                </div>

            </div>
        </div>
        <div class="row mx-0 mt-3">
            <div class="col-lg-12">

                <div class="all_quote_card  vendor_rply_dtlL _text">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <form name="cancelOrder" action="{{route('user.order.cancel')}}" method="POST">
                                @csrf
                                <div class="row mt-1 g-3">
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <div class="col-lg-12 col-md-8 col-sm-10 mx-auto">
                                        <div class="form-floating">
                                            <textarea class="form-control description" id="floatingTextarea2" name="reason" style="height: 177px" required></textarea>
                                            <label for="floatingTextarea2">{{__('msg.REASON FOR CANCELING')}} ({{__('msg.Required')}})</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-8 col-sm-10 mx-auto">
                                        <div class="d-grid gap-2 ">
                                            <button  class="btn text-center btn-secondary get_quot block get_appointment"
                                                type="submit">{{__('msg.CANCEL ORDER')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        var validator = $("form[name='cancelOrder']").validate({
            ignore: [],
            onfocusout: function (element) {
                var $element = $(element);
                if ($element.hasClass('select2-search__field')) {
                    $element2 = $element.closest('.form-group').find('select');
                    if (!$element2.prop('required') && $element2.val() == '') {
                        $element.removeClass('is-valid');
                    } else {
                        this.element($element2)
                    }
                } else if (!$element.prop('required') && ($element.val() == '' || $element.val() == null)) {
                    $element.removeClass('is-valid');
                } else {
                    this.element(element)
                }
            },
            onkeyup: function (element) {
                var $element = $(element);
                if ($element.hasClass('select2-search__field')) {
                    $element.closest('.form-group').find('select').valid();
                } else {
                    $element.valid();
                }
            },
            rules: {
                // looking_for: "required",
                // model: "required",
                // company_id: "required",
                // registration_no: "required",
                // Chasis_no: "required",
                // color: "required",
                // model_year_id: "required",
                // mileage: "required",
                // day: "required",
                // "category[]": "required",
                // "car_images[]": "required",
                // "document[]": "required"
            },
            messages: {
                // business_type: "Please select your business type",
            },
            errorClass: 'is-invalid error',
            validClass: 'is-valid',
            highlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    elem.closest('.form-group').find('input').addClass(errorClass);
                    elem.closest('.form-group').find('input').removeClass(validClass);
                    elem.closest('.form-group').find('span.select2-selection').addClass(errorClass);
                    elem.closest('.form-group').find('span.select2-selection').removeClass(validClass);
                } else {
                    elem.addClass(errorClass);
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    elem.closest('.form-group').find('input').addClass(validClass);
                    elem.closest('.form-group').find('input').removeClass(errorClass);
                    elem.closest('.form-group').find('span.select2-selection').removeClass(errorClass);
                    elem.closest('.form-group').find('span.select2-selection').addClass(validClass);
                } else {
                    elem.removeClass(errorClass);
                    elem.addClass(validClass);
                }
            },
            errorPlacement: function (error, element) {
                var elem = $(element);
                console.log(elem);
                if (elem.hasClass("select2-hidden-accessible")) {
                    var element2 = elem.closest('.form-group').find('.select2-container');
                    error.insertAfter(element2);
                } else if (elem.closest('.form-group').find('div').hasClass('image-uploader')) {
                    var element2 = elem.closest('.form-group').find('.image-uploader');
                    error.insertAfter(element2);
                } else if (elem.hasClass('description')) {
                    var element2 = elem.closest('.form-floating');
                    error.insertAfter(element2);
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
@endsection
