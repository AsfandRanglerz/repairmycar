@extends('web.layout.app')
@section('content')
<section class="about_connect looking_for lates_news_main">
    <div class="container-lg container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="main_content_wraper">
                    <h4 class="sec_main_heading text-center">{{__('msg.FAQ')}}</h4>
                    <p class="sec_main_para text-center">{{__('msg.Most Answered Questions')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 ">
                <div class="faq_wraper">
                    <div class="accordion" id="accordionExample">
                        @foreach($data as $content)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$content->id}}" aria-expanded="true" aria-controls="collapseOne">
                                 {!! $content->question !!}
                                </button>
                            </h2>
                            <div id="collapseOne{{$content->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> {!! $content->answer !!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
