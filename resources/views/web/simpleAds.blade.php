@extends('web.layout.app')
@section('content')
<style>
    .package-block {
        padding-right: 4px;
    }
    .days-block {
        padding: 0 4px;
    }
    @media (max-width: 575px) {
        .package-block {
            padding-right: 12px;
        }
        .days-block {
            padding: 0 4px 0 12px;
        }
    }
</style>
<section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);min-height: 100vh">
    <div class="container" >
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="mt-md-5 mt-3 cuatomer_signup_form_wraper">
                    <div class="main_content_wraper">
                        <h5 class="sec_main_heading text-center mb-0">{{__('msg.Post Your Ad')}}</h5>
                    </div>
                    <form name="postAd" class="pt-3 px-2" action="{{route('simpleAd.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mx-0">
                            <label for="formFile" class="form-label heading-color"><b>Select Package ({{__('msg.Required')}})</b></label>
                            <div class="form-group col-sm-4 mb-3 package-block">
                                <select class="form-select form-control" id="package" name="package" required>
                                    <option value="" selected disabled>Select Package</option>
                                    @foreach ($package as $data)
                                    <option value="{{ $data->id }}">{{ $data->package_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4 col-6 mb-3 days-block">
                                <input type="text" class="form-control" value="" placeholder="Days Validity i.e..." readonly>
                            </div>
                            <div class="form-group col-sm-4 col-6 mb-3 price-block" style="padding-left: 4px">
                                <input type="text" class="form-control" value="" placeholder="Price AED" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="formFile" class="form-label heading-color"><b>Image (720 x 90) ({{__('msg.Required')}})</b></label>
                                <input class="form-control" type="file"name="image" id="simpleAdImage" accept=".jpeg, .jpg, .png, .PNG, .heic" required>
                            </div>
                            <div class="form-group col-6" style="padding-right: 4px">
                                <input type="url" class="form-control" name="url" value="{{ old('url') }}" placeholder="URL ({{__('msg.Required')}})" required>
                            </div>
                            <div class="form-group col-6" style="padding-left: 4px">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{__('msg.Email')}} ({{__('msg.Required')}})" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea rows="4" name="description" placeholder="Description ({{__('msg.Optional')}})" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="d-grid gap-2 mt-3 mb-4">
                                <button class="btn btn-secondary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script src="{{asset('public/assets/Check-Image-Resolution/jquery.checkImageSize.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function() {
            $("#package").on("change", function() {
                var id = $(this).val();
                var $this = $(this);
                $.ajax({
                    url: '{{ route('select-package') }}',
                    type: 'GET',
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        console.log(response.data);
                        $('.days-block input').val(response.data.validity);
                        $('.price-block input').val(response.data.price);
                    }
                });
            });
            $("#simpleAdImage").checkImageSize({
                minWidth: 720,
                minHeight: 90,
                maxWidth: 720,
                maxHeight: 90,
                showError:true,
                ignoreError:false
            });

            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            var validator = $("form[name='postAd']").validate({
                onfocusout: function (element) {
                    var $element = $(element);
                    if ($element.prop('required')) {
                        this.element(element)
                    } else if ($element.val() != '') {
                        this.element($element)
                    } else {
                        $element.removeClass('is-valid');
                    }
                },
                rules: {
                    onkeyup: function (element) {
                        var $element = $(element);
                        $element.valid();
                    },
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                highlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    elem.addClass(errorClass);
                    elem.removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    elem.removeClass(errorClass);
                    elem.addClass(validClass);
                    if (elem.siblings('small.text-danger')) {
                        elem.siblings('small.text-danger').html('');
                    } else if (elem.closest('.form-group').find('small.text-danger')) {
                        elem.closest('.form-group').find('small.text-danger').html('');
                    } else if (elem.closest('.form-group').closest('.form-group').find('small.text-danger')) {
                        elem.closest('.form-group').closest('.form-group').find('small.text-danger').html('');
                    }
                },
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    error.insertAfter(element);
                }
            });
        });
    </script>
@endsection
