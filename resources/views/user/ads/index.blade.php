@extends('user.layout.app')
@section('content')
<section class="pb-5 login_content_wraper">
    <div class="container-lg container-fluid" >
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                    <h4 class="sec_main_heading text-center mb-0">{{__('msg.MY ADS')}}</h4>
                    <p class="sec_main_para text-center">{{__('msg.Edit Or Delete Your Previous Ads')}}</p>
                </div>
            </div>
        </div>

        <div class="row g-2">
            @if(count($ads) >0)
            @foreach($ads as $data )
                <div class="col-lg-11 col-md-12 col-sm-12 col-11 mx-auto">
                    <div class="all_quote_card ">
                        <div class="car_inner_imagg ">
                            <?php
                            $img = explode(",", $data->images);
                            ?>
                            <img src="{{ asset($img[0]) }}">
                        </div>
                        <div class="  w-100  quote_detail_wraper align-items-md-center">
                            <div class="quote_info Leavereview">
                                <h5 class="d-flex align-items-center active_quote">{{$data->model}}</h5>
                                <p class="mb-0">{{__('msg.Car Maker')}} : {{$data->company->company}}</p>
                                <p class="mb-0">{{__('msg.Model Year')}} : {{$data->modelYear->model_year}}</p>
                                <p >{{__('msg.Engine')}} : {{$data->engine}} CC</p>
                            </div>
                            <div>
                                <div class="heading-color"
                                    style="border: 2px solid;border-radius: 50px;padding: 6px 16px">
                                    {{ $data->status }}</div>
                            </div>
                            <div class="quote_detail_btn_wraper">
                                <h5 class=" text-sm-center">{{__('msg.AED')}} {{$data->price}}</h5>
                                <div class="d-flex  align-items-center chat_view__detail">
                                    <form method="post" action="{{route('user.ads.destroy', $data->id )}}" >
                                        @method('delete')
                                        @csrf
                                        <button  type="submit" class="btn-secondary edit_del_btns me-2">{{__('msg.delete')}}</button>
                                    </form>
                                    <a href="{{ route('user.ads.edit' ,  $data->id) }}" class="btn btn-primary edit_del_btns">{{__('msg.edit')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <div class="col-lg-11 col-md-12 col-sm-12 col-11 mx-auto">
                    <div class="all_quote_card ">
                        <div class="  w-100  quote_detail_wraper align-items-md-center">
                            <div class="quote_info Leavereview">
                                <p class="mb-0">{{__('msg.No Ads has been added !')}}</p>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            <span >{!! $ads->links() !!}</span>

        </div>
    </div>
</section>
@endsection
