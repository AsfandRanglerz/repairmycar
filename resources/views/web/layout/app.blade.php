<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/vendor/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('public/assets/css/connect.min.css') }}" rel="stylesheet"> -->
    <!-- custome css -->
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('public/web/assets/favicon/favicon-2.png') }}' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/poppins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/inter.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/newstyle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/assets/css/style.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/assets/css/newstyle.css') }}">
    <!-- <link rel="stylesheet" asset('public/href="assets}}') /slick-master/slick/slick.css">
      <link rel="stylesheet"  asset('public/href="assets}}') /slick-master/slick/slick-theme.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
    <link rel="stylesheet" href="{{ asset('public/assets/OwlCarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/user/assets/image-uploader/dist/image-uploader.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/slickslider/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/slickslider/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/toastr/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/OwlCarousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.14/css/lightgallery.css" />
    <title>{{__('msg.Repair my Car')}}|{{$page_title ?? ''}}</title>
    <style>
        .ads-slider img {
            margin: 0 auto;
        }
        .form-switch .form-check-input {
            background-image: url(./public/user/assets/images/orangesvg.svg);
        }
        .form-switch .form-check-input:checked {
            background-image: url(./public/user/assets/images/toggler.svg);
        }
        .form-switch .form-check-input:focus {
            background-image: url(./public/user/assets/images/toggler.svg);
        }
        header .form-switch.toggler_switch {
            padding: 0;
            position: absolute;
            right: 8px;
            top: 4px;
            font-size: 14px;
            width: 140px;
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            margin: 0!important;
        }
        header .lang_toggler>label.english, header .lang_toggler>label.arabi {
            position: unset;
        }
        header .lang_toggler>label {
            color: unset;
        }
        header input#flexSwitchCheckDefault {
            margin-left: 0;
        }
    </style>
</head>

<body>
    <!--paste this code under the head tag-->
    <div id="pgLoader">
        <span id="pgLoaderGif"></span>
    </div>
    <!--paste this code under the head tag-->
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white ">
            <div class="container-lg container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <div class="logo_wraper">
                        <img src="{{ asset('public/assets/images/repair-my-car-logos/repairmycarlogo.png') }}">
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link px-lg-2 px-3 px-md-2" href="{{ route('car_service') }}">{{ __('msg.Garages & Services')}}</a>
                        </li>
                        @if (!Auth::guard('vendor')->check())
                            <li class="nav-item">
                                <a class="nav-link px-lg-2 px-3 px-md-2"
                                    href="@if (auth()->check()) {{ url('user/quotecreate') }}@else{{ url('user/login') }} @endif">{{ __('msg.Request A Quote')}}</a>
                            </li>
                        @elseif(Auth::guard('vendor')->check())
                            <li class="nav-item">
                                <a class="nav-link px-lg-2 px-3 px-md-2"
                                    href="@if (auth()->guard('vendor')->check()) {{ route('vendor.ads.index') }}@else{{ url('vendor/login') }} @endif">{{__('msg.My Ads Listing')}}</a>
                            </li>
                        @endif
                    </ul>
                    <div class="d-flex login_header_main">
                        @if (Auth::guard('vendor')->check() || Auth::guard('web')->check())
                            @if (Auth::guard('web')->check())
                                <a href="{{ route('user.dashboard') }}" class="me-4 me-md-3">{{ __('msg.DASHBOARD')}}</a>
                                <a href=""
                                    onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i
                                        class="fas fa-sign-out-alt"></i>{{ __('msg.Logout')}}</a>
                                <form id="frm-logout" action="{{ route('user.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            @elseif(Auth::guard('vendor')->check())
                                <a href="{{ route('vendor.dashboard') }}" class="me-4 me-md-3">{{ __('msg.DASHBOARD')}}</a>
                                <a href=""
                                    onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i
                                        class="fas fa-sign-out-alt"></i>{{ __('msg.Logout')}}</a>
                                <form id="frm-logout" action="{{ route('vendor.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            @endif
                        @else
                            <div class="login_sinup">
                                <a href="{{ route('registerpage') }}"> <i
                                        class="fa fa-briefcase me-2 me-md-1"></i>{{ __('msg.register')}}</a>
                                <a href="{{ route('loginpage') }}" class="login ms-lg-2">{{ __('msg.Login')}}</a>
                            </div>
                        @endif
                    </div>
                </div>
                @include('locale/index')
            </div>
        </nav>
    </header>
    @yield('content')
    <footer class="py-5 position-relative">
        <a href="https://www.ranglerz.com/cost-to-make-a-web-ios-or-android-app-and-how-long-does-it-take.php" target="_blank" class="position-absolute w-100" style="left: 0;bottom: 0;color: rgb(213 163 56);z-index: 1">Developed By: Web &amp; Mobile APP Development Company Lahore</a>
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer_link">
                        <h5 class="text-white main-heading">{{__('msg.LINKS')}}</h5>
                        <ul class="text-capitalize">
                            <li class="d-none"><a href="{{ route('simpleAd.create') }}"><span class="fa fa-plus"
                                style="margin-right: 8px"></span>{{__('msg.Post Your Ad')}}</a></li>
                            <li><a href="{{ route('about') }}"><span class="fa fa-info-circle me-2 me-md-1"
                                style="margin-right: 8px"></span>{{__('msg.About Us')}}</a></li>
                            <li><a href="{{ route('vendor.register') }}"><span class="fa fa-briefcase me-2 me-md-1"
                                        style="margin-right: 8px"></span>{{__('msg.Register your business')}}</a></li>
                            <li><a href="{{ route('term') }}"><span class="fa fa-pencil-square"
                                        style="margin-right: 8px"></span>{{__('msg.Terms & Conditions')}}</a></li>
                            <li><a href="{{ route('news') }}"><span class="fa fa-newspaper"
                                style="margin-right: 8px" aria-hidden="true"></span>{{__('msg.News')}}</a></li>
                            <li><a href="{{ route('faq') }}"><span class="fa fa-question-circle"
                                        style="margin-right: 8px" aria-hidden="true"></span>{{__('msg.FAQ')}}</a></li>
                            <li><a href="{{ route('privacy_policy') }}"><span class="fa fa-lock"
                                style="margin-right: 8px"></span>{{__('msg.Privicy Policy')}}</a></li>
                            <li><a href="{{ route('cookies') }}"><span class="fa fa-cookie"
                                style="margin-right: 8px"></span>{{__('msg.Cookie Policy')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-lg-0 mt-sm-4 mt-0 col-lg-4">
                    <div class="footer_link">
                        <h5 class="text-white main-heading">{{__('msg.Follow Us')}}</h5>
                        <div class="social_icons mb-3">
                            <a href="#">
                                <img src="{{ asset('public/assets/images/facbook.svg') }}">
                            </a>
                            <a href="#">
                                <img src="{{ asset('public/assets/images/insta.svg') }}">
                            </a>
                            <a href="#">
                                <img src="{{ asset('public/assets/images/linkin.svg') }}">
                            </a>
                            <a href="#">
                                <img src="{{ asset('public/assets/images/youtube.svg') }}">
                            </a>
                        </div>
                        <h5 class="mt-sm-4 mt-3 text-white main-heading">{{__('msg.Payment Methods')}}</h5>
                        <img src="{{ asset('public/assets/images/payment-methods.jpg') }}" alt="payment-methods">
                    </div>
                </div>
                <div class="mt-lg-0 mt-sm-4 mt-0 col-lg-4">
                    <div class="footer_link">
                        <h5 class="text-white main-heading">{{__('msg.CONTACT US')}}</h5>
                        <p class="mb-0 footer_address"><b>Company Name :</b> Macros FZ LLC ( Repairmycarserivce is a brand wholly owned by Macros FZLLC)</p>
                        <p class="mb-0 footer_address"><b>Office Address :</b> HD47A, First Floor, In5 Tech, Dubai Internet City- Dubai, UAE</p>
                        <p class="mb-0 footer_address"><b>Country :</b> UAE</p>
                        <p class="mb-0 footer_address"><b>P.O Box No :</b> 121161, Dubai-UAE</p>
                        <p class="mb-0 footer_address"><b>Contact Number :</b> +971 56 928 9928</p>
                        <p class="mb-0 footer_address"><b>Email Address :</b> <a href="mailto:info@macrosonline.ae" class="text-white" style="text-decoration: underline">info@macrosonline.ae</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('msg.Top Searches')}}</h6>
                    <a type="button" class="heading-color" data-bs-dismiss="modal"><span
                            class="fa fa-times"></span></a>
                </div>
                <div class="modal-body">
                    <div class="garage_name">
                        <p>{{__('msg.Fields Required From Client Side')}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{__('msg.OK')}}</button>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/611bc9fae4.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/assets/OwlCarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/user/assets/image-uploader/dist/image-uploader.min.js') }}"></script>
    <script src="{{ asset('public/assets/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('public/assets/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/slickslider/slick/slick.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.14/js/lightgallery-all.min.js"></script>
    <script src="{{ asset('public/assets/js/custom.js') }}"></script>
    @yield('script')
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $('.ads-slider').slick({
                autoplay: true,
                autoplaySpeed: 5000,
                fade: true,
                cssEase: 'linear',
                centerMode: true
            });
        });

        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            width: '27rem',
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if (isset($_SESSION["msg"]))


    var type = "{{ $_SESSION["alert"] }}";
    switch (type) {
        case'info':
            Toast.fire({
                icon: 'info',
                title: '{{ $_SESSION["msg"] }}'
            })
            break;
        case 'success':
            Toast.fire({
                icon: 'success',
                title: '{{ $_SESSION["msg"] }}'
            })
            break;
        case 'warning':
            Toast.fire({
                icon: 'warning',
                title: '{{ $_SESSION["msg"] }}'
            })
            break;
        case'error':
            Toast.fire({
                icon: 'error',
                title: '{{ $_SESSION["msg"] }}'
            })
            break;
    }


    @endif
    @php
    unset($_SESSION['alert']);
    unset($_SESSION['msg']);
    @endphp
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";
            $(document).ready(function() {
                $('.input-images-signup').imageUploader({
                    extensions: ['.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                    maxFiles: 1,
                    maxSize: 2097152, // 3 MB
                });
                $(".input-images-signup>.image-uploader>.upload-text").append(
                    '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Profile Picture ({{__('msg.Optional')}}) </br> <b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic only)</b></p><input type="file" size="60" ></label> '
                );
            });
        })(jQuery);

        /*scrolling banner*/
        (function($) {
            "use strict";

            $(document).ready(function() {

                $(".carousel_se_01_carousel").owlCarousel({
                    loop: true,
                    items: 1,
                    margin: 10,
                    nav: true,
                    autoplay: true,
                    // responsive:{
                    //     0:{
                    //         items:1
                    //     },
                    //     600:{
                    //         items:3
                    //     },
                    //     1000:{
                    //         items:5
                    //     }
                    // }

                });
            });

            $(document).ready(function() {
                $(".carousel_se_02_carousel").owlCarousel({
                    items: 3,
                    nav: false,
                    // loop: true,
                    dots: true,
                    mouseDrag: true,
                    responsiveClass: true,
                    margin: 10,
                    // navText: ["<i class='icofont-bubble-left'></i>", "<i class='icofont-bubble-right'></i>"],
                    responsive: {
                        0: {
                            items: 1,
                        },
                        576: {
                            items: 2,
                        },
                        768: {
                            items: 3,
                        },
                        992: {
                            items: 3,
                        },
                        1200: {
                            items: 3,
                        },
                    },
                });
            });

        })(jQuery);
        /*scrolling banner*/
        $(document).ready(function() {
            $('.input-images').imageUploader();
            $(".input-images>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Car image</p><input  name="car_images" type="file" size="60" ></label>  '
            );
            $('.input-images-2').imageUploader();
            $(".input-images-2>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label skip"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Police/Accident/Inspection Report ({{__('msg.Required')}})</p><a href="#" class="skip">Skip</a><input type="file" size="60" ></label>   '
            );
            $('.input-images-3').imageUploader();
            $(".input-images-3>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Add Registration Copy Image</p><input type="file" size="60" ></label>'
            );
            $('.input-images-4').imageUploader({
                maxFiles: 1,
            });
            $(".input-images-4>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload workshop image ({{__('msg.Optional')}})</p><input type="file" size="60" ></label>'
            );
            $('.input-images-5').imageUploader({
                maxFiles: 1,
            });
            $(".input-images-5>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Your Picture ({{__('msg.Optional')}}) </p><input type="file"   size="60" ></label>'
            );
            $('.input-images-6').imageUploader();
            $(".input-images-6>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Your ID ({{__('msg.Required')}})</p><input type="file" size="60" ></label>'
            );
            $('.input-images-7').imageUploader();
            $(".input-images-7>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Trade License and ID ({{__('msg.Required')}}) </p><input type="file" size="60" ></label> '
            );
            $('.Upload_final_report').imageUploader({
                extensions: ['.pdf', '.doc'],
                mimes: ['application/pdf', 'application/msword'],
                maxFiles: 1,
            });
            $(".Upload_final_report>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Final Report</p><input type="file" size="60" ></label>'
            );
            $('.input-images-8').imageUploader({
                extensions: ['.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                maxFiles: 1,
                maxSize: 2097152, // 3 MB
            });
            $(".input-images-8>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Profile Picture ({{__('msg.Optional')}}) </br> <b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic only)</b></p><input name="profile_image" type="file" size="60" ></label> '
            );
            $('.input-images-9').imageUploader({
                extensions: ['.pdf', '.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                mimes: ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'image/heic'],
                maxFiles: 1,
                maxSize: 2097152, // 3 MB
            });
            $(".input-images-9>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Your ID ({{__('msg.Required')}}) </br> <b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic, pdf only)</b></p><input name="id_card" type="file" size="60" ></label> '
            );
            $('.input-images-10').imageUploader({
                extensions: ['.pdf', '.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                mimes: ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'image/heic'],
                maxFiles: 1,
                maxSize: 2097152, // 3 MB
            });
            $(".input-images-10>.image-uploader>.upload-text").append(
                '<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Trade License and ID ({{__('msg.Required')}}) </br> <b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic, pdf only)</b></p><input name="image_license" type="file" size="60" ></label>'
            );

            $(document).on('click', '#menuToggle', function() {
                $("#dashboardSidebarRightContent").toggleClass("toggled");
                $("#dashboardSidebar").toggleClass("sidebar-toggle");
            });
            /*dashboard right side content toggle*/
            /*dashboard right side content and sidebar toggle switching*/
            sideBarToggleSwitch();
            /*dashboard right side content and sidebar toggle switching*/
            if ($(window).width() <= 991) {
                /*Side-nav-overlay*/
                sideNavOverlay();
                /*Side-nav-overlay*/
            }
            $(window).resize(function() {
                /*dashboard right side content and sidebar toggle switching*/
                sideBarToggleSwitch();
                /*dashboard right side content and sidebar toggle switching*/
                /*Side-nav-overlay*/
                sideNavOverlay();
                /*Side-nav-overlay*/
            });

            /*Side-nav-overlay*/
            function sideNavOverlay() {
                $(document).on('click', '#menuToggle', function() {
                    $('#sideNavOverlay').removeClass('d-none');
                });
            }

            /*Side-nav-overlay*/

            /*dashboard right side content toggle*/
            function sideBarToggleSwitch() {
                $(document).on('click', function(event) {
                    if ($(window).width() <= 991 && !$(event.target).closest(
                            '#dashboardSidebar, #menuToggle').length) {
                        $('#dashboardSidebar').addClass('sidebar-toggle');
                        /*Side-nav-overlay*/
                        $('#sideNavOverlay').addClass('d-none');
                        /*Side-nav-overlay*/
                    }
                });
                if ($(window).width() >= 992) {
                    $('#dashboardSidebar').removeClass('sidebar-toggle');
                    $('#dashboardSidebarRightContent').removeClass('toggled');
                } else {
                    $('#dashboardSidebar').addClass('sidebar-toggle');
                    $('#sideNavOverlay').addClass('d-none');
                }
            }

            // $('.notification_tooltip').hide();
            $(document).on('click', '.notify-btn', function() {
                $('#notification_tolltip').toggle();
            });
            $(document).on('click', '#Logout_Profile', function() {
                $('#TopProfile').toggle();
            });
            $(document).on('click', '#chat_toggle', function() {

                $(".submenue").toggle();
            });
            window.addEventListener('click', function(e) {
                if (document.getElementById('chat_toggle').contains(e.target)) {
                    // Clicked inside the  box
                    // alert("inside clicked");
                    $("#delet_message_toggle").css("display", "block");
                } else {
                    $("#delet_message_toggle").css("display", "none");
                    // alert("out side");
                }
            });

            $("#search_input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".main_contact>a>.inbox_contact").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


            // code for message send
            $(document).on('click', '#sendMsg', function() {
                // alert('hello');
                var typeMsg = $("#typeMsg").val();
                if (typeMsg == "") {
                    return false;
                } else {
                    // $(".cahtting_messages").append('<div class="main_message"><div class="inbox_contact align-items-end justify-content-end top_main"><div class="message_txt_wraper"><p class="mb-2 text-end">11:20 AM, Today</p><p class="mb-0 message_txt second">' + typeMsg + '</p></div><div class="contact_img second_msg"><img src="assets/images/repair2.jpg"></div></div></div>');
                    var chat_message = $(".cahtting_messages");
                    chat_message.animate({
                        scrollTop: chat_message[0].scrollHeight
                    }, 1000);
                    $("#typeMsg").val("");
                }
            });
            $(document).on('keypress', function(e) {
                if (e.which == 13) {
                    $("#sendMsg").click();
                }
            });
            $("input.messages_file[type=file]").before(
                "<img src='assets/images/File.svg' class='messages_file_uploader_image' width='20' height='20' />"
            );


            sidebarScrollHeight();
            $(window).resize(function() {
                sidebarScrollHeight();
            });


        });

        $(document).ready(function() {
            $('.input-imagess').imageUploader({
                extensions: ['.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                maxFiles:5,
                maxSize: 2097152, // 3 MB
            });
            $(".input-imagess>.image-uploader>.upload-text").append('<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0"><b class="small">up to 5 images, maximum 2 mb, format: png, jpeg, heice</b></p><input type="file" name="car_images[]" size="60" ></label>');
            $('.input-imagess-2').imageUploader({
                extensions: ['.pdf', '.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                mimes: ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'image/heic'],
                maxFiles:5,
                maxSize: 2097152, // 3 MB
            });
            $(".input-imagess-2>.image-uploader>.upload-text").append('<label class="img_wraper_label skip"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">Upload Police/Accident/Inspection Report ({{__('msg.Optional')}}) </br> <b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic, pdf only)</b></p><input type="file" name="files" size="60" ></label>');
            $('.input-imagess-3').imageUploader({
                extensions: ['.pdf', '.jpeg', '.jpg', '.png', '.PNG', '.heic'],
                mimes: ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'image/heic'],
                maxFiles:5,
                maxSize: 2097152, // 3 MB
            });
            $(".input-imagess-3>.image-uploader>.upload-text").append('<label class="img_wraper_label"><div class="file_icon_wraper"><span class="fa fa-paperclip text-white messages_file_uploader_image" aria-hidden="true"></span></div><p class="mb-0">{{__('msg.Registration Copy Image')}} ({{__('msg.Required')}}) </br> <b class="small">(Max-Size: 2 MB)</br>(Format: png, jpeg, heic, pdf only)</b></p><input type="file" name="document[]" size="60" ></label>');
        });

        (function($) {
            "use strict";

            $(document).ready(function() {
                $(".carousel_se_01_carousel").owlCarousel({
                    loop: true,
                    items: 1,
                    margin: 10,
                    nav: true,
                    autoplay: true,

                });
            });

            // $(document).ready(function() {
            //     $(".carousel_se_02_carousel").owlCarousel({
            //         items: 3,
            //         nav: false,
            //         loop: true,
            //         dots: true,

            //         mouseDrag: true,
            //         responsiveClass: true,
            //         responsive: {
            //             0: {
            //                 items: 1,
            //             },
            //             // 480: {
            //             //   items: 2,
            //             // },
            //             768: {
            //                 items: 2,
            //             },
            //             992: {
            //                 items: 3,
            //             },
            //             1200: {
            //                 items: 3,
            //             },
            //         },
            //     });
            // });
            $(document).ready(function() {
                $('input').change(function() {
                    $('input[accept=".pdf"] + .uploaded').find('img').attr('src', './public/assets/images/pdficon.png');
                });

                $(".carousel_se_03_carousel").owlCarousel({
                    items: 3,
                    nav: false,
                    loop: true,
                    dots: true,

                    mouseDrag: true,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        576: {
                            items: 2,
                        },
                        768: {
                            items: 3,
                        },
                        992: {
                            items: 3,
                        },
                        1200: {
                            items: 3,
                        },
                    },
                });
            });

        })(jQuery);

        function sidebarScrollHeight() {
            var dashboardSidebar = $("#dashboardSidebar").innerHeight();
            var topHeaght = $(".main_profile_img_name").innerHeight();
            var bottomHeaght = $(".soignou_plus_language_wraper").innerHeight();
            var sidebarHeight = dashboardSidebar - topHeaght - bottomHeaght - 50;
            $(".sidebar_navcigation").innerHeight(sidebarHeight);
        }

        $(function() {
            var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
            $(".sidebar_navcigation>li>a").each(function() {
                if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
                    $(this).addClass("active");
            })
            $(".navbar-nav>.nav-item>.nav-link").each(function() {
                if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
                    $(this).addClass("active");
            })

        });
    </script>
        <script>
            $('#flexSwitchCheckDefault').on('click', function() {
                if ($(this).prop('checked') == true) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        url: "{{url('language/en')}}",
                        data: {
                            'id': 1
                        },
                        success: function(response) {
                            window.location.reload();
                            // console.log(response);
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        url: "{{url('language/arb')}}",
                        data: {
                            'id': 1
                        },
                        success: function(response) {
                             window.location.reload();
                            // console.log(response);
                        }
                    });
                }
            });
        </script>
</body>

</html>
