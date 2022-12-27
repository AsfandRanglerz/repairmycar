@extends('web.layout.app')
@section('style')
    <style type="text/css">
        .login_sinup {
            display: none;
        }
    </style>
@endsection
@section('content')
    <section class="banner_section">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active "
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item Stor_detai_item active">
                    <div class="preferd_vendors_star"><img src="{{ asset('public/assets/images/preferdicon.svg')}} ">
                    </div>
                    <img src="{{ asset('public/assets/images/repair2.jpg')}}" class="d-block w-100" alt="banner image">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <!-- <div class="carousel-item ">
                    <img src="assets/images/repair2.jpg" class="d-block w-100" alt="banner image">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="preferd_vendors_star"><img src="assets/images/preferdicon.svg"></div>
                    <img src="assets/images/repair2.jpg" class="d-block w-100" alt="banner image">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/repair2.jpg" class="d-block w-100" alt="banner image">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div> -->


            </div>
        </div>
    </section>
    <section class=" store_brances d-flex justify-content-center align-items-center">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <h4 class="store_addres mb-0">SUZUKI REPAIRS</h4>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <h4 class="store_addres mb-0">SHARJAH, UAE</h4>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <h4 class="store_addres mb-0">+92 345 123 4567</h4>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <h4 class="store_addres mb-0"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                            class="fa-solid fa-star"></i> 5.0</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3">
        <div class="container-lg container-fluid">
            <div class="main_row d-grid align-items-center justify-content-between flex-wrap services-section">
                <div class="stor_add_show_wraper">
                    <div class="stor_add_show_wraper_innr">
                        <img src="{{ asset('public/assets/images/slidecaricon.svg')}}">
                    </div>
                    <h6 class="mb-0 ms-2 ">ROAD ASSIST</h6>
                </div>
                <div class="stor_add_show_wraper">
                    <div class="stor_add_show_wraper_innr">
                        <img src="{{ asset('public/assets/images/slidecaricon.svg')}}">
                    </div>
                    <h6 class="mb-0 ms-2 ">RTA REGISTRATION</h6>
                </div>
                <div class="stor_add_show_wraper">
                    <div class="stor_add_show_wraper_innr">
                        <img src="{{ asset('public/assets/images/iconrp3.svg')}}">
                    </div>
                    <h6 class="mb-0 ms-2 ">OIL CHANGE</h6>
                </div>
                <div class="stor_add_show_wraper">
                    <div class="stor_add_show_wraper_innr">
                        <img src="{{ asset('public/assets/images/iconrp4.svg')}}">
                    </div>
                    <h6 class="mb-0 ms-2 ">SPARE PARTS</h6>
                </div>
                <div class="stor_add_show_wraper">
                    <div class="stor_add_show_wraper_innr">
                        <img src="{{ asset('public/assets/images/tickicon.svg')}}">
                    </div>
                    <h6 class="mb-0 ms-2 ">INSURANCE REGISTRATION</h6>
                </div>
            </div>

        </div>
    </section>
    <section class=" py-lg-5 py-md-4 py-2">
        <div class="container-lg container-fluid">
            <div class="row g-4">
                <div class="col-lg-8 col-md-6 col-sm-6">
                    <div class="over_view_part">
                        <h5 class=" text-center mb-5 heading-color">OVERVIEW</h5>
                        <p>We service domestics and imports of every Suzuki model. If your vehicle is having problems,
                            please bring it to us for an honest diagnosis and trustworthy quote. We are expert mechanics
                            and have built their business on high-quality customer service.
                        </p>
                        <br>
                        <p> We service domestics and imports of every Suzuki model. If your vehicle is having problems,
                            please bring it to us for an honest diagnosis and trustworthy quote.</p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="over_view_part timing_hours">
                        <h5 class=" text-center mb-5 heading-color">OPENING HOURS</h5>
                        <div class="timing_container">
                            <p class="time_for_opning mb-0">Monday</p>
                            <p class="time_for_opning mb-1">8:30am - 5:30pm</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">Tuesday</p>
                            <p class="time_for_opning mb-1">8:30am - 5:30pm</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">Wednesday</p>
                            <p class="time_for_opning mb-1">8:30am - 5:30pm</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">Thursady</p>
                            <p class="time_for_opning mb-1">8:30am - 5:30pm</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">Friday</p>
                            <p class="time_for_opning mb-1">8:30am - 5:30pm</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">Saturday</p>
                            <p class="time_for_opning mb-1">Closed</p>
                        </div>
                        <div class="timing_container">
                            <p class="time_for_opning mb-1">Sunday</p>
                            <p class="time_for_opning mb-1">Closed</p>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary get_appointment" type="button">GET BOOKING
                            <img src="{{ asset('public/assets/images/appoinmenticon.svg')}}">
                        </button>
                    </div>
                </div>

            </div>
            <div class="row g-4 mt-3">
                <div class="col-lg-8 col-sm-6 col-md-6">
                    <div class="over_view_part">
                        <h5 class=" text-center mb-5 heading-color">CONTACT VENDOR</h5>
                        <form action="" method="post" class="row g-3">
                            <div class="col-md-12 col-lg-6">
                                <input type="text" class="form-control" name="carmodel" id="inputCarModel"
                                       placeholder="Car Model">
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <input type="text" class="form-control" make="make" id="inputCarMake"
                                       placeholder="Car Make">
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <select id="inputService" name="servicetype" class="form-select">
                                    <option value="0" selected>Type of Service</option>
                                    <option value="1">Service 1</option>
                                    <option value="2">Service 2</option>
                                    <option value="3">Service 3</option>
                                </select>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <input type="text" class="form-control" name="owner_name" id="inputCustomerName"
                                       placeholder="Customer Name">
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <input type="email" class="form-control" name="email" id="inputEmail"
                                       placeholder="Email ID">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="contact_info" id="inputContactNo"
                                       placeholder="Contact No.">
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <textarea class="form-control" name="description" placeholder="Add more in details"
                                          id="" style="height: 108px"></textarea>
                                <!-- <label for="floatingTextarea2">Comments</label> -->
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <button class="btn btn-primary get_appointment text-center" type="submit">QUOTE REQUEST
                                    <!-- <img src="assets/images/appoinmenticon.svg"> -->
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="col-lg-4 col-sm-6 col-md-6 ">
                    <div class="over_view_part timing_hours">
                        <h5 class="text-center mb-5 heading-color">REVIEWS</h5>
                        <div class="owl-carousel carousel_se_01_carousel owl-theme">
                            <div class="item">
                                <p class="text-center reviews">"Suzuki repairs are best in town. They did everything
                                    best at affordable rates and speedily. Thumbs up!"</p>
                                <p class="testimonail_person_name text-center mb-1">Hassan Ali</p>
                                <p class="testimonail_person_rating text-center"><span>5.0</span></p>
                            </div>
                            <div class="item">
                                <p class="text-center reviews">"Suzuki repairs are best in town. They did everything
                                    best at affordable rates and speedily. Thumbs up!"</p>
                                <p class="testimonail_person_name text-center mb-1">Hassan Ali</p>
                                <p class="testimonail_person_rating text-center"><span>5.0</span></p>
                            </div>
                            <div class="item">
                                <p class="text-center reviews">"Suzuki repairs are best in town. They did everything
                                    best at affordable rates and speedily. Thumbs up!"</p>
                                <p class="testimonail_person_name text-center mb-1">Hassan Ali</p>
                                <p class="testimonail_person_rating text-center"><span>5.0</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary get_appointment" type="button">ADD TO PREFFERED GARAGE
                            <img src="{{ asset('public/assets/images/hearticoc.svg')}}">
                        </button>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary get_appointment" type="button">CONTACT VIA MESSAGE
                            <img src="{{ asset('public/assets/images/messageicon.svg')}}">
                        </button>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="over_view_part timing_hours mape_wraper mt-4">
                        <h5 class="text-center mb-5 heading-color">REVIEWS</h5>
                        <div class="responsive-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2822.7806761080233!2d-93.29138368446431!3d44.96844997909819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x52b32b6ee2c87c91%3A0xc20dff2748d2bd92!2sWalker+Art+Center!5e0!3m2!1sen!2sus!4v1514524647889"
                                height="550" frameborder="0" style="border:0" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="row mt-5 g-3">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <a href=""
                               class="btn btn-secondary d-block d-flex justify-content-center justify-content-center w-100">EDIT
                                GARAGE</a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <a href=""
                               class="btn btn-primary btn_anchhor d-block d-flex justify-content-center justify-content-center">FINISH
                                CREATING GARAGE</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
