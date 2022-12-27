@extends('user.layout.app')
@section('content')
    <?php use \Illuminate\Support\Facades\Auth; ?>
    <section class="dashboard_main_section" style="background-image:url({{ url('public/user/assets/images/gradiantbg.jpg') }});">
        <div class="container-lg container-fluid">
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

                        <a href="{{ route('user.profile.edit',Auth::id()) }}"><img src="{{ asset('public/user/assets/images/editicon.svg') }}">{{__('msg.edit')}}</a>
                    </div>
                </div>
                <div class="col-lg-7 mx-auto">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-lg-center mb-4">
                                <div class="user_icon">
                                    <img src="{{ asset('public/user/assets/images/user.svg') }}">
                                </div>
                                <p class="mb-0">{{ Auth::user()->name }}</p>

                            </div>
                        </div>
                        @if(Auth::user()->address !== null)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="profile_name_box text-center mb-4">
                                    <div class="user_icon">
                                        <img src="{{ asset('public/user/assets/images/location.svg') }}">
                                    </div>
                                    <p class="mb-0">{{ Auth::user()->address }}, {{ Auth::user()->city }}, {{ Auth::user()->country }}</p>
                                </div>
                            </div>
                        @endif
                        @if(Auth::user()->post_box !== null)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="profile_name_box text-center mb-4">
                                    <div class="user_icon">
                                        <img src="{{ asset('public/user/assets/images/location.svg') }}">
                                    </div>
                                    <p class="mb-0">{{ Auth::user()->post_box }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-center mb-4">
                                <div class="user_icon">
                                    <img src="{{ asset('public/user/assets/images/mailicon.svg') }}">
                                </div>
                                <p class="mb-0">{{ Auth::user()->email }}</p>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="profile_name_box text-center mb-4">
                                <div class="user_icon">
                                    <img src="{{ asset('public/user/assets/images/callicon.svg') }}">
                                </div>
                                <p class="mb-0">{{ Auth::user()->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
