<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">

            <a href="{{ route('admin.dashboard') }}"> <img
                    src="{{ asset('public/assets/images/repair-my-car-logos/repairmycarlogo.png') }}"
                    class="header-logo" />
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown @if (request()->routeIs('admin.dashboard')) active @endif">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown @if (request()->routeIs('admin.order*','admin.quote*')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="tag"></i><span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link " href="{{ route('admin.quote.index') }}">All Quotations</a></li>
                    <li class=""><a class="nav-link " href="{{ route('admin.order.index') }}">All Orders</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs(
                'admin.garage*',
                'admin.addUser',
                'admin.user*',
                'admin.ads*',
                'admin.insurance*',
                'admin.vendor*',
                // 'admin.subcategory*',
                // 'admin.childcategory*',
                'admin.category*')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="tag"></i><span>Master List</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link " href="{{ route('admin.garage.index') }}">Garages</a></li>
                    <li class=""><a class="nav-link " href="{{ route('admin.user.index') }}">Customers</a></li>
                    <li class=""><a class="nav-link " href="{{ route('admin.ads.index') }}">Car Ads</a></li>
                    <li class=""><a class="nav-link " href="{{ route('admin.insurance.index') }}">Insurance
                            Company</a></li>
                    <li class=""><a class="nav-link " href="{{ route('admin.vendor.index') }}">Vendors</a></li>
                    <li class=""><a class="nav-link " href="{{ route('admin.category.index') }}">Services</a></li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs(
                'admin.simpleAd*',
                'admin.all-packages',
                'admin.slider*',
                'admin.detail*',
                'admin.news*',
                'admin.about*',
                'admin.faq.index',
                'admin.faq.add',
                'admin.faq.edit',
                'admin.term.index',
                'admin.term.edit',
                'admin.privacyPolicy.index',
                'admin.privacyPolicy.edit',
                'admin.cookie*')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="tag"></i><span>Main Settings</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown @if (request()->routeIs(
                        'admin.simpleAd*',
                        'admin.slider*',
                        'admin.detail*',
                        'admin.news*',
                        'admin.about*',
                        'admin.faq.index',
                        'admin.faq.add',
                        'admin.faq.edit',
                        'admin.term.index',
                        'admin.term.edit',
                        'admin.privacyPolicy.index',
                        'admin.privacyPolicy.edit',
                        'admin.all-packages',
                        'admin.cookie*')) active @endif">
                        <a href="#" class="menu-toggle nav-link has-dropdown">
                            <i data-feather="tag"></i><span>Site Settings</span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown @if (request()->routeIs(
                                'admin.slider*',
                                'admin.detail*',
                                'admin.news*',
                                'admin.about*',
                                'admin.faq.index',
                                'admin.faq.add',
                                'admin.faq.edit',
                                'admin.term.index',
                                'admin.term.edit',
                                'admin.privacyPolicy.index',
                                'admin.privacyPolicy.edit',
                                'admin.cookie*')) active @endif">
                                <a href="#" class="menu-toggle nav-link has-dropdown">
                                    <i data-feather="tag"></i><span>Pages</span></a>
                                <ul class="dropdown-menu">

                                    <li><a href="{{ url('admin/slider') }}" class="nav-link">Home Banner Slides</a>
                                    </li>
                                    {{-- <li><a href="{{ url('admin/detail') }}" class="nav-link">Home Project Detail</a>
                                    </li> --}}
                                    <li class=""><a class="nav-link "
                                            href="{{ route('admin.news.index') }}">News</a></li>
                                    <li><a href="{{ route('admin.about.index') }}" class="nav-link">About Us</a></li>
                                    <li class=""><a class="nav-link " href="{{ url('/admin/faqs') }}">Faq</a>
                                    </li>
                                    <li><a href="{{ route('admin.term.index') }}" class="nav-link">Terms &
                                            Condition</a></li>
                                    <li><a class="nav-link" href="{{ route('admin.privacyPolicy.index') }}">Privacy
                                            Policy</a></li>
                                    <li><a class="nav-link" href="{{ route('admin.cookie.index') }}">Cookies
                                            Policy</a></li>
                                </ul>
                            </li>
                            {{-- <li class="dropdown @if (request()->routeIs('admin.simpleAd*', 'admin.all-packages')) active @endif">
                                <a href="#" class="menu-toggle nav-link has-dropdown">
                                    <i data-feather="tag"></i><span>Simple Ads</span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('admin.simpleAd.index') }}" class="nav-link">All Ads</a>
                                    </li>
                                    <li class=""><a class="nav-link"
                                            href="{{ route('admin.all-packages') }}">Packages</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="dropdown @if (request()->routeIs(
                'admin.company*',
                'admin.brand*',
                'admin.car-model',
                'admin.edit-model',
                'admin.view-model',
                'admin.model_year*',
                'admin.childcategory*')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="tag"></i><span>Car Setup</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link " href="{{ route('admin.company.index') }}">Cars
                            Manufacture/Brand</a></li>
                    <li class=""><a class="nav-link " href="{{ route('admin.car-model') }}">Cars Model</a></li>
                    <li class=""><a class="nav-link " href="{{ route('admin.model_year.index') }}">Cars Year</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown @if (request()->routeIs('admin.percentage.index', 'admin.percentage.edit')) active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="tag"></i><span>Setting</span></a>
                <ul class="dropdown-menu">
                    {{-- <li class=""><a class="nav-link " href="{{ route('admin.brand.index') }}">Brands</a></li> --}}
                    <li class=""><a class="nav-link " href="{{ url('/admin/percentage') }}">Payment and
                            Vat</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
