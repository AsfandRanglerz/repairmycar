@extends('vendor.layout.app')

@section('content')
    <section class="pb-5 login_content_wraper" style="background-image:url(public/vendor/assets/images/gradiantbg.jpg);">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5 bid-type-block">
                        <h4 class="sec_main_heading text-center mb-0">{{ __('msg.All Quotes') }}</h4>
                        <select class="form-select" name="Bidtype" id="BidType" aria-label="Type of Service">
                            <option value="all">{{__('msg.All Quotes')}}</option>
                            <option value="user" {{isset($_SESSION['search']) && $_SESSION['search'] == 'user' ? 'selected' : ''}}>{{__('msg.Customer')}}</option>
                            <option value="company" {{isset($_SESSION['search']) && $_SESSION['search'] == 'company' ? 'selected' : ''}}>{{__('msg.Insurance Company')}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="appendQoute" class="row g-2">
                @if (count($user_all_bid) > 0)
                    @foreach ($user_all_bid as $value)
                        <?php
                        $total_bid = \App\Models\VendorBid::where('user_bid_id', $value->user_bit_id)->count();
                        $img = \App\Models\UserBidImage::where('user_bid_id', $value->user_bit_id)
                            ->where('type', 'image')
                            ->oldest()
                            ->first();
                        $img1 = Explode(',', $img->car_image);
                        $user = \App\Models\User::find($value->userbid->user_id);
                        ?>
                        <div class="col-lg-10 col-sm-12 mx-auto">
                            <div class="all_quote_card ">
                                <div class="car_inner_imagg ">
                                    <img src="{{ asset($img1[0]) }}">
                                </div>
                                <div class=" w-100  quote_detail_wraper">
                                    <div class="quote_info">
                                        <h5 class="d-flex align-items-center active_quote heading-color"><a href="#"
                                                class="heading-color">{{ $value->userBid->company->company }}
                                                ({{ $value->userbid->model }})
                                            </a> <span class="order_id">#{{ $value->userbid->reference_no }}</span></h5>
                                        <p class="mb-0">
                                            <b>{{ $user->type == 'user' ? 'Customer' : 'Insurance Company' }}:</b>
                                            {{ $value->userbid->car_owner_name }}
                                        </p>
                                        <p class="mb-0"><b>Phone: </b>{{ $user->phone }}</p>
                                    </div>
                                    <div class="mt-5 quote_info ">
                                        <p class="quote_rev vndr_rply__dtl "><span> {{ $total_bid }}
                                                {{ __('msg.bids') }}</span>
                                        </p>
                                    </div>
                                    <div class="quote_detail_btn_wraper">
                                        <h5 class="text-sm-center">{{ __('msg.AED') }} {{ $value->userbid->price }}
                                        </h5>
                                        <div class="d-flex align-items-center chat_view__detail">
                                            <a type="button" href="{{ url('vendor/chat/' . $value->user_id) }}"
                                                class="chat_icon"><i class="fa-solid fa-message"></i>
                                            </a>
                                            <?php
                                            $id = $value->userbid->id;
                                            $offer = \App\Models\VendorBidStatus::where([['user_bid_id', $id], ['vendor_id', Auth::id()]])->first();
                                            ?>
                                            @if ($offer == null)
                                                <a href="{{ route('vendor.quotedetail', $value->userbid->id) }}"
                                                    class="btn-secondary">{{ __('msg.view_details') }}</a>
                                            @else
                                                <a href="{{ route('vendor.view-offer', $value->userbid->id) }}"
                                                    class="btn-secondary">{{ __('msg.View offer') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-11 col-md-12  mx-auto">
                        <div class="all_quote_card ">
                            <div class=" w-100  quote_detail_wraper">
                                <div class="quote_info">
                                    <p class="mb-0">{{ __('msg.No Quote has been added !') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {!! $user_all_bid->links() !!}
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function() {
            $("#BidType").change(function() {
                var value = $(this).val();
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    url: "{{ route('vendor.search-quote') }}",
                    data: {
                        'value': value
                    },
                    success: function(response) {
                        $('#appendQoute').empty();
                        $('#appendQoute').append(response.data);
                    }
                });
            });
        });
    </script>
@endsection
