
@extends('vendor.layout.app')
@section('content')
    <section class="dashboard_main_section" style="background-image:url({{url("/public/vendor/assets/images/gradiantbg.jpg")}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper mt-5">
                        <h4 class="sec_main_heading text-center mb-0">{{__('msg.Profile')}}</h4>
                        <p class="sec_main_para text-center">{{__('msg.Your profile')}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-12 mx-auto ">
                    <div class="edit_profile_link_wraper mb-lg-4 mb-3">
                        <a href="{{route('vendor.profile.edit', Auth::id())}}"><img src="{{ asset('public/vendor/assets/images/editicon.svg') }}">{{__('msg.edit')}}</a>
                    </div>
                </div>
                <div class="col-lg-7 mx-auto">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-lg-center mb-4">
                                <div class="user_icon">
                                    <img src="{{ asset('public/vendor/assets/images/user.svg') }}">
                                </div>
                                <p class="mb-0">{{$data->name}}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-center mb-4">
                                <div class="user_icon">
                                    <img src="{{ asset('public/vendor/assets/images/location.svg') }}">
                                </div>
                                <p class="mb-0">{{$data->address}}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-center mb-4">
                                <div class="user_icon">
                                    <img src="{{ asset('public/vendor/assets/images/mailicon.svg') }}">
                                </div>
                                <p class="mb-0">{{$data->email}}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-center mb-4">
                                <div class="user_icon">
                                    <img src="{{ asset('public/vendor/assets/images/callicon.svg') }}">
                                </div>
                                <p class="mb-0">+{{$data->phone}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
