<div id="dashboardSidebar">
    <div class="main_profile_img_name">
        <div class="customer_dashboard_img_wraper">
            <img src="{{ asset('/' . Illuminate\Support\Facades\Auth::guard('vendor')->user()->image) }}">
        </div>
        <div class="name_of_person mx-auto text-center">
            <h5 class="heading">{{ Auth::guard('vendor')->user()->name }}</h5>
        </div>
        <div class="name_of_person mx-auto text-center">
            <a class="heading">{{Auth::guard('vendor')->user()->balance}} {{__('msg.AED')}}</a>
        </div>
        <div class="name_of_person mx-auto text-center">
        </div>
    </div>

    <div class="sidebar_navigation">
        <ul class="sidebar_navcigation">
            <li>
                <a href="{{ route('vendor.dashboard') }}"><img
                        src="{{ asset('public/assets/images/home.png') }}">
                    <span>{{ __('msg.Home') }}</span></a>
            </li>
            <li>
                <a href="{{ route('vendor.chat.index') }}"><img
                        src="{{ asset('public/assets/images/inbox.png') }}"><span>{{ __('msg.Inbox') }}</span></a>
            </li>
            <li>
                <a href="{{ route('vendor.quoteindex') }}"><img
                        src="{{ asset('public/assets/images/all-quotes.png') }}"><span>{{ __('msg.All Quotes') }}</span></a>

            </li>
            <li>
                <a href="{{ url('vendor/requested-inspections') }}"><img
                        src="{{ asset('public/assets/images/inspections.png') }}"><span>{{ __('msg.Requested Inspections') }}</span></a>
            </li>
            <li>
                <a href="{{ route('vendor.all-active-order') }}"><img
                        src="{{ asset('public/assets/images/active-orders.png') }}"><span>{{ __('msg.Active Orders') }}</span></a>
            </li>
            <li><a href="{{ route('vendor.archive') }}"><img
                        src="{{ asset('public/assets/images/archived.png') }}"><span>{{ __('msg.Archived') }}</span></a>
            </li>

            <li>
                <a href="{{ route('vendor.workshop.edit', Auth::id()) }}"><img
                        src="{{ asset('public/assets/images/workshop.png') }}"><span>{{ __('msg.Edit Workshop') }}</span></a>
            </li>
            <li>
                <a href="{{ route('vendor.ads.create') }}"><img
                        src="{{ asset('public/assets/images/sell-car.png') }}"><span>{{ __('msg.Sell Your Car') }}</span></a>
            </li>

            <li><a href="{{ route('vendor.term_condition') }}"><img
                        src="{{ asset('public/assets/images/T-&-C.png') }}"><span>{{ __('msg.Terms & Conditions (Agreed)') }}</span></a>
            </li>



        </ul>
    </div>
    <div class="soignou_plus_language_wraper">
        <button class="btn" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
            {{ __('msg.Logout') }}
        </button>
        <form id="frm-logout" action="{{ route('vendor.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @include('locale/index');
    </div>
</div>
