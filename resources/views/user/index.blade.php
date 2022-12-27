@extends('user.layout.app')
@section('content')
    <section class="pb-5 login_content_wraper">
        <div class="container-lg container-fluid" >
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_content_wraper dashboard mt-1 mt-lg-5 mt-md-5">
                        {{-- <h4 class="sec_main_heading text-center mb-0">{{__('msg.DASHBOARD')}}</h4>
                        <p class="sec_main_para text-center">{{__('msg.View your profile')}}</p> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-11 col-sm-11  mx-auto">
                    <div class="quote_card_heading  mb-lg-4 mb-2 mt-lg-5 mt-3">
                        <h5 class="text-uppercase">{{__('msg.All Quotes')}}</h5>
                        <a href="{{route('user.quoteindex')}}">{{__('msg.VIEW ALL')}}</a>
                    </div>
                    @if($user_bid)
                        <?php
                        $img = \App\Models\UserBidImage::where('user_bid_id',$user_bid->id)->where('type','image')->oldest()->first();
                        $company = \App\Models\Company::where('id',$user_bid->company_id)->first();
                        ?>
                        <div class="all_quote_card">
                            <div class="quote_info">
                                <h5 class="heading-color">{{$company->company}}  {{$user_bid->model}}</h5>
                                <p >{{$user_bid->description1}}</p>
                                <p class="quote_rev"><span>{{$vendor_bid}} </span> Quotes Recieved</p>
                            </div>
                            <div class="quote_detail_btn_wraper">
                                <a href="{{route('user.response',$user_bid->id)}}" class="btn-secondary">{{__('msg.view_details')}}</a>

                            </div>

                        </div>
                    @else
                        <div class="all_quote_card">
                            <div class="quote_info">
                                <p >{{__('msg.No Quote has been added !')}}</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-10 col-md-11 col-sm-11   mx-auto">
                    <div class="quote_card_heading mb-lg-4 mb-2 mt-lg-5 mt-3">
                        <h5>{{__('msg.ALL ORDERS')}}</h5>
                        <a href="{{route('user.order.index')}}">{{__('msg.VIEW ALL')}}</a>
                    </div>
                    @if($order)
                    <?php
                    $userbidid = \App\Models\UserBid::where('id',$order->user_bid_id)->first();
                    if($userbidid){
                    $company = \App\Models\Company::where('id',$userbidid->company_id)->first();
                    }

                    ?>

                    <div class="all_quote_card">
                        <div class="quote_info">
                            <h5 class="heading-color">{{$company->company}}  ({{$userbidid->model}})</h5>
                            <p >{{$userbidid->description1}}</p>
                            <p class="quote_rev">Order ID:<span> #{{$order->order_code}} </span></p>
                        </div>
                        <div class="quote_detail_btn_wraper">
                            <a href="{{route('user.order.show',$order->id)}}" class="btn-secondary">{{__('msg.view_details')}}</a>

                        </div>

                    </div>
                    @else
                        <div class="all_quote_card">
                            <div class="quote_info">

                                <p >{{__('msg.No Orders has been added !')}}</p>

                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
      <!-- Modal -->
      <div class="modal fade" id="privTermsPolicyModal" aria-labelledby="privTermsPolicy" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="privTermsPolicy">{{__('msg.Privacy Policy and Terms & Conditions')}}</h6>
                </div>
                <div class="modal-body">
                    <h6 class="sec_main_heading text-center">{{__('msg.Privicy Policy')}}</h6>
                    <p class="text-justify">{!! $data['policy']->description !!}</p>
                    <h6 class="sec_main_heading text-center">Terms & Conditions</h6>
                    <p class="text-justify">{!! $data['terms']->description !!}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="agreePrivTerms" data-bs-dismiss="modal" style="padding: 8px 16px!important;height: unset">I Agree</button>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--<form id="frm-logout" action="{{ route('user.logout') }}" method="POST" style="display: none;">
    @csrf
</form>--}}
@section('script')
    <?php
        $user = \App\Models\User::find(Auth::id());
        $term = $user->term_condition;
        
    ?>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script>
    var term = '<?php echo $term; ?>';
    var authid = '<?php echo $user->id; ?>';

    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    if(term == 0){
        $(function() {
            $('#privTermsPolicyModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#privTermsPolicyModal").modal('show');
            $(document).on('click', '#agreePrivTerms', function() {
                toastr.success("You've agreed to our Privacy Policy and Terms & Conditions");
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    headers: {'X-CSRF-Token': '{{ csrf_token() }}',},
                    url: "{{ route('user.terms_condition') }}",
                    data: {'id': 1,'authid':authid},
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    }
    </script>
@endsection

