<style>
    /* extra */
    .nav-logo {
        display: flex;
        align-items: center;
    }

    @media (max-width: 600px) {
        .navbar .nav-item-button {
            margin-top: 20px;
        }
    }

    .navbar .nav-item .nav-link.active, .navbar .nav-item .nav-link:hover {
        color: #000;
    }
</style>

<!-- navbar -->
<!-- <nav class="navbar navbar-expand-lg fixed-top"> -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-white">
    <div class="container">

        <a class="navbar-brand" href="{{url('/')}}">
            <div class="nav-logo">
                <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="{{config('basic.site_title')}}" />
                <h3>{{config('basic.site_title')}}</h3>
            </div>
        </a>

        <button class="navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="flex-grow: 0; gap: 60px;">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('home') ? 'active' : ''}}" href="{{route('home')}}">@lang('Home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('howitwork') ? 'active' : ''}}" href="{{route('howitwork')}}">@lang('How it Works')</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('property') ? 'active' : ''}}" href="{{route('property')}}">@lang('Marketplace')</a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('blog') ? 'active' : ''}}" href="{{route('blog')}}">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('faq') ? 'active' : ''}}" href="{{route('faq')}}">@lang('FAQ')</a>
                </li>

                <!--extra-->
                <!--
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('contact') ? 'active' : ''}}" href="{{route('contact')}}">@lang('Contact')</a>
                </li>-->

                @guest
                <li class="nav-item nav-item-button">
                    <a class="btn-custom" style="background-color: #fff; width: 100px !important; color: black;border-radius: 15px;border: 1px solid #ddd;" href="{{ route('login') }}">@lang('Login')</a>
                </li>
                @else
                <li class="nav-item nav-item-button">
                    <a class="btn-custom" style="background-color: #fff; width: 100px !important; color: black;border-radius: 15px;border: 1px solid #ddd;" href="{{route('user.home')}}">@lang('Dashboard')</a>
                </li>
                @endguest

                @guest
                <li class="nav-item nav-item-button">
                
                <a class="btn-custom mb-2" style="background-color: #189ad3; width: 140px !important; color: white" href="{{ route('register') }}">Get Started</a>
                     
                </li>
                @endguest
            </ul>
        </div>

    </div>
</nav>