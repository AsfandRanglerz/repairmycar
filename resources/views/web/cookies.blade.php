@extends('web.layout.app')
@section('content')
    <style>
        .admin-pages h1, .admin-pages h2, .admin-pages h3, .admin-pages h4, .admin-pages h5, .admin-pages h6 {
            text-transform: uppercase;
            color: var(--orange);
        }
        .admin-pages b, .admin-pages strong {
            font-family: Inter,sans-serif!important;
        }
        .admin-pages p {
            text-align: justify;
        }
        @media (max-width: 575px) {
            .admin-pages h1, .admin-pages h2, .admin-pages h3, .admin-pages h4, .admin-pages h5, .admin-pages h6 {
                text-align: center;
            }
        }
    </style>
    <section class="admin-pages about_connect looking_for lates_news_main">
        <div class="container-lg container-fluid">
            <h4 class="sec_main_heading text-center">{{__('msg.Cookie Policy')}}</h4>
            {!! $cookiePolicy->description !!}
        </div>
    </section>
@endsection
