@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.Preferred Garages') }}</h4>
                        <p class="sec_main_para text-center">
                            {{ __('msg.See your favorite stores and what they have new to offer to you') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                @if (count($wishlists) > 0)
                    @foreach ($wishlists as $wishlist)
                        <div class="col-lg-11 col-md-12  mx-auto">
                            <div class="all_quote_card ">
                                <div class="car_inner_imagg">
                                    <img
                                        @if ($wishlist->image && $wishlist->image != null) src="{{ asset($wishlist->image) }}" @else src="{{ asset('public/assets/images/repair2.jpg') }}" @endif>
                                </div>
                                <div class=" w-100  quote_detail_wraper align-items-sm-center">
                                    <div class="quote_info Leavereview mb-sm-3">
                                        <h5 class="d-flex align-items-center active_quote">
                                            {{ ucfirst($wishlist->garage_name) }}
                                        </h5>
                                        <p class="mb-0">{{ $wishlist->city }}, {{ $wishlist->country }}</p>
                                        <p>{{ $wishlist->phone }}</p>
                                        <div class="mt-2 card_icons d-flex justify-content-center align-items-center">
                                            <?php $category = \App\Models\GarageCategory::where('garage_id', $wishlist->id)->pluck('category_id');
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
                                    <div class="quote_detail_btn_wraper">



                                        <div class="d-flex align-items-center chat_view__detail">
                                            <a href="{{ url('user/chat/' . $wishlist->vendor_id) }}" class="chat_icon"><i
                                                    class="fa-solid fa-message"></i></a>

                                            <?php $userwishlist = \App\Models\UserWishlist::where('user_id', auth()->id())
                                                ->where('garage_id', $wishlist->id)
                                                ->first(); ?>
                                            <form action="{{ route('user.wishlist.destroy', $userwishlist->id) }}"
                                                method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="chat_icon" type="submit" style="margin-right: 8px;background: none;border: none">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('gerage_detail', $wishlist->id) }}" class="btn-secondary">{{__('msg.view_details')}}</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-11 col-md-12  mx-auto">
                        <div class="all_quote_card ">

                            <div class=" w-100  quote_detail_wraper align-items-sm-center">
                                <div class="quote_info Leavereview">
                                    <p class="mb-0">No preferred garage has been added !</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection
