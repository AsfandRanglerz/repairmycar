@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/assets/images/gradiantbg.jpg);">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.RESPONSE TO YOUR QUOTES') }}</h4>
                        <p class="sec_main_para text-center">
                            {{ __('msg.See what garage owners have to say about your quote') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mx-0 mb-3">
                @if (count($data) > 0)
                    @foreach ($data as $value)
                        <?php
                        $garage = \App\Models\Garage::find($value->garage_id);
                        $vendor = \App\Models\Vendor::with('company')->find($garage->vendor_id);
                        $user = \App\Models\User::with('company')->find(Auth::id());
                        $userbid = \App\Models\UserBid::where('id', $value->user_bid_id)->first();
                        $img = \App\Models\UserBidImage::where('user_bid_id', $userbid->id)
                            ->where('type', 'image')
                            ->oldest()
                            ->first();
                        $company = \App\Models\Company::where('id', $userbid->company_id)->first();
                        $img1 = Explode(',', $img->car_image);
                        ?>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-10  mx-auto">
                            <div class="all_quote_card replies_allquot h-100 ">
                                <div class="car_inner_imagg replies_qout">
                                    <img src="{{ asset($img1[0]) }}">
                                </div>
                                <div class=" w-100  quote_detail_wraper replies ">
                                    <div class="quote_info">
                                        <h5 class="d-flex align-items-center active_quote nowrape heading-color">
                                            {{ $company->company }} {{ $userbid->model }}</h5>
                                        <p class="mb-0">{{ $userbid->description1 }}</p>
                                        <p>{{ $userbid->phone }}</p>
                                    </div>
                                    <div class="quote_detail_btn_wraper replies">
                                        <div class="d-flex chat_view__detail qoute_replies">
                                            <a href="{{ url('user/chat/' . $garage->vendor_id) }}" class="chat_icon"><i
                                                    class="fa-solid fa-message"></i></a>
                                            <div
                                                class="card_icons respons_qoute d-flex justify-content-center align-items-center">
                                                <?php
                                                    $category = \App\Models\GarageCategory::where('garage_id', $value->garage_id)->pluck('category_id');
                                                    $category_name = \App\Models\Category::whereIn('id', $category)->get();
                                                    $count = $category_name->count();
                                                    if($count>5){
                                                        $count = 5;
                                                    }
                                                ?>
                                                @for ($i = 0; $i < $count; $i++)
                                                    <div class="icon_wrpaer">
                                                        <img src="{{ asset($category_name[$i]->icon) }}">
                                                    </div>
                                                @endfor
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-10   mx-auto">
                            <div class="d-flex flex-column align-items-start all_quote_card replies_allquot h-100">
                                <div class="d-flex align-items-center chat_view__detail allreplies mb-4">
                                    @if (isset($user->company[0]->name, $vendor->company))
                                        @foreach ($vendor->company as $company)
                                            @if ($user->company[0]->name == $company->name)
                                                <div class="w-100 pay_via_insurance_header_garages">
                                                    <p style="margin-right: 8px">{{ $company->name }}</p>
                                                    <i class="bi bi-star-fill"></i>
                                                </div>
                                            @break
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class=" w-100  quote_detail_wraper replies second">
                                <div class="quote_info">
                                    <h5 class="d-flex align-items-center active_quote nowrape heading-color">
                                        {{ $value->vendordetail->vendor->name }}</h5>
                                    <div class="quote_detail_btn_wraper">
                                        <h5 class="quotereplies">{{ __('msg.AED') }} {{ $value->net_total }} </h5>
                                    </div>
                                </div>
                                <div class="quote_detail_btn_wraper">
                                    <div class="d-flex align-items-center chat_view__detail allreplies ">
                                        <a href="{{ route('user.vendorReply', $value->id) }}"
                                            class="btn-secondary">{{ __('msg.view_details') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-6 col-md-6 col-sm-6 col-10  mx-auto">
                    <div class="all_quote_card replies_allquot h-100 ">

                        <div class=" w-100  quote_detail_wraper replies ">

                            <p class="mb-0">{{ __('msg.No response has been added by users to your quote!') }}</p>

                        </div>
                    </div>
                </div>
            @endif
            <span>{!! $data->links() !!}</span>
        </div>
    </div>
</section>
@endsection
