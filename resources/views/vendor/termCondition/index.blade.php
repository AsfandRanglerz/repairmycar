@extends('vendor.layout.app')
@section('content')
    <section class="m-4 p-4 rounded login_content_wraper">
        <h4 class="sec_main_heading">{{__('msg.Agreement')}}</h4>
        <h5 class="sec_main_heading text-center">{{__('msg.Privicy Policy')}}</h6>
        <p class="text-justify">{!! $data['policy']->description !!}</p>
        <h5 class="sec_main_heading text-center">{{__('msg.Terms & Conditions')}}</h5>
        <p class="text-justify">{!! $data['terms']->description !!}</p>
    </section>
@endsection
