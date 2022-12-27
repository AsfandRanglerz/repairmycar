@extends('web.layout.app')
@section('content')
    <section class="about_connect looking_for lates_news_main">
        <div class="container-lg container-fluid">
            <div class="row mx-0">
                <div class="col-lg-8 mx-auto">
                    <div class="main_content_wraper">
                        <h4 class="sec_main_heading text-center">{{__('msg.latest_news')}}</h4>
                        <p class="sec_main_para text-center">{{__('msg.See what is new for you in our portal')}}</p>
                    </div>
                </div>
            </div>


            <div class="row mx-0 g-3">
                @foreach($news as $value)
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <a href="{{route('news_detail',$value->id)}}">
                        <div class="card card_vendors shadow" >
                            <div class="car_img_wrapper latest_news">
                                <img src="{{$value->image}}" class="card-img-top" alt="Car image">
                            </div>
                            <div class="card-body px-lg-4 px-sm-2">
                                <p class="card-title date ">{{$value->created_at->format('M d, Y')}}</p>
                                <p class="sec_main_para car_text ">{{$value->title}}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row mx-0">
            <div class="col-lg-8 mx-auto text-center">
                <nav aria-label="..." class="d-flex align-items-center justify-content-center">
                    <span class="mt-4">{!! $news->links() !!}</span>
                </nav>
            </div>
        </div>
    </section>
@endsection
