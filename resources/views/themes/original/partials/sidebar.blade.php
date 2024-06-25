<!-- sidebar -->
@php
$user = \Illuminate\Support\Facades\Auth::user();
$user_badge = \App\Models\Badge::with('details')->where('id', @$user->last_level)->first();
@endphp

<!--extra-->

<style>
    .navbar .user-panel .user-dropdown {
        position: relative;
    }

    #sidebar {
        overflow-y: hidden;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }

    #sidebar ul li a.active,
    #sidebar ul li a:hover {
        background: var(--bgLight);
    }

    .navbar .user-panel:hover .user-dropdown {
        top: 10px !important;
    }

    .navbar .user-panel .user-dropdown {
        top: 5px;
    }

    .navbar.active {
        box-shadow: var(--none);
    }

    #sidebar ul.main {
        padding-bottom: 0px;
    }

    /* extra */
    .nav-logo {
        display: flex;
        align-items: center;
    }

    @media only screen and (max-width: 600px) {
        #div2 {
            margin-top: 10px;
        }
    }

    @media only screen and (min-width: 1280px) {
        #div2 {
            margin-top: 200px;
        }
    }
</style>

<div id="sidebar" class="">
    <div class="sidebar-top">
        <a class="navbar-brand d-none d-lg-block" href="{{url('/')}}">
            <div class="nav-logo">
                <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="{{config('basic.site_title')}}" />
                <h3>{{config('basic.site_title')}}</h3>
            </div>
        </a>
        <div class="mobile-user-area d-lg-none">
            <div class="thumb">
                <img class="img-fluid user-img" src="{{getFile(config('location.user.path').auth()->user()->image)}}" alt="...">
                <!-- @if(optional($user->userBadge)->badge_icon)
                <img src="{{ getFile(config('location.badge.path').optional($user->userBadge)->badge_icon) }}" alt="" class="rank-badge">
                @endif -->
            </div>
            <div class="content">
                <h5 class="mt-1 mb-1">{{ __(auth()->user()->fullname) }}</h5>
                <span class="">{{ __(auth()->user()->username) }}</span>
                <!-- @if(@$user->last_level != null && $user_badge)
                <p class="text-small mb-0">@lang(optional($user->userBadge->details)->rank_name) - (@lang((optional($user->userBadge->details)->rank_level)))</p>
                @endif -->
            </div>
        </div>
        <button class="sidebar-toggler d-lg-none" onclick="toggleSideMenu()">
            <i class="fal fa-times"></i>
        </button>
    </div>

    <ul class="main">
        @php
        $segments = request()->segments();
        $last = end($segments);
        $propertyMarketSegments = ['investment-properties', 'property-share-market', 'my-investment-properties', 'my-shared-properties', 'my-offered-properties', 'receive-offered-properties', 'offer-conversation'];
        @endphp

        <li>
            <a class="{{($last == 'investment-properties') ? 'active' : '' }}" href="{{ route('user.propertyMarket', 'investment-properties') }}"><i class="fal fa-sack-dollar"></i>@lang('Properties')</a>
        </li>

        <li>
            <!--<a class="{{menuActive(['user.home'])}}" href="{{ route('user.home') }}"><i class="fal fa-house-flood"></i>@lang('Dashboard')</a>-->
            <a class="{{menuActive(['user.home'])}}" href="{{ route('user.home') }}"><i class="fal fa-house-flood"></i>Portfolio</a>
        </li>



        <!--<li>
            <a
                class="dropdown-toggle {{ in_array($last, $propertyMarketSegments) || in_array($segments[1], $propertyMarketSegments) ? 'propertyMarketActive' : '' }}"
                data-bs-toggle="collapse"
                href="#dropdownCollapsible"
                role="button"
                aria-expanded="false"
                aria-controls="collapseExample">
                <i class="fal fa-car-building"></i>@lang('Property Market')
            </a>
            <div class="collapse {{menuActive(['user.propertyMarket','user.offerList', 'user.offerConversation'],4)}} dropdownCollapsible" id="dropdownCollapsible">
                <ul class="">
                    <li>
                        <a class="{{($last == 'investment-properties') ? 'active' : '' }}" href="{{ route('user.propertyMarket', 'investment-properties') }}"><i class="fal fa-sack-dollar"></i>@lang('Investment Properties')</a>
                    </li>
                    @if(config('basic.is_share_investment') == 1)
                        <li>
                            <a class="{{($last == 'property-share-market') ? 'active' : '' }}"  href="{{ route('user.propertyMarket', 'property-share-market') }}"><i class="fal fa-house-return"></i>@lang('Share Market')</a>
                        </li>
                    @endif
                    <li>
                        <a  class="{{($last == 'my-investment-properties') ? 'active' : '' }}" href="{{ route('user.propertyMarket', 'my-investment-properties') }}"><i class="fal fa-building"></i>@lang('My Properties')</a>
                    </li>
                    @if(config('basic.is_share_investment') == 1)
                        <li>
                            <a  class="{{($last == 'my-shared-properties') ? 'active' : '' }}" href="{{ route('user.propertyMarket', 'my-shared-properties') }}"><i class="fal fa-share-alt"></i>@lang('My Shared Properties')</a>
                        </li>
                        <li>
                            <a  class="{{($last == 'my-offered-properties') ? 'active' : '' }}" href="{{ route('user.propertyMarket', 'my-offered-properties') }}"><i class="fal fa-paper-plane"></i>@lang('Send Offer')</a>
                        </li>
                        <li>
                            <a  class="{{($last == 'receive-offered-properties' || request()->routeIs('user.offerList')) ? 'active' : '' }}" href="{{ route('user.propertyMarket', 'receive-offered-properties') }}"><i class="fal fa-bell-on"></i>@lang('Receive Offer')</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>-->

        <!-- <li>
            <a class="{{menuActive(['user.blog'])}}" href="{{route('blog')}}"><i class="fal fa-blog"></i>Learning</a>
        </li> -->

        <!--@if(config('basic.is_share_investment') == 1)
            <li>
                <a class="{{($last == 'property-share-market') ? 'active' : '' }}"  href="{{ route('user.propertyMarket', 'property-share-market') }}"><i class="fal fa-house-return"></i>@lang('Marketplace')</a>
            </li>
        @endif-->

        @if(config('basic.is_share_investment') == 1)
        <!--<li>
                <a class="{{($last == 'property-share-market') ? 'active' : '' }}"  href="{{ route('user.shareMarket', 'property-share-market') }}"><i class="fal fa-house-return"></i>@lang('Marketplace')</a>
            </li>-->
        @endif

        <!-- <li>
            <a class="{{menuActive(['user.invest-history'])}}" href="{{route('user.invest-history')}}"><i class="fal fa-history"></i>@lang('Wallet')</a>
        </li> -->

        <li>
            <a class="{{menuActive(['user.fund-history', 'user.fund-history.search'])}}" href="{{route('user.fund-history')}}"><i class="fal fa-money-check-alt"></i>@lang('Transactions')</a>
        </li>

        <li>
            <a class="{{menuActive(['user.wishListProperty'])}}" href="{{ route('user.wishListProperty') }}">
                <i class="fal fa-heart"></i>@lang('WishList')
                <span class="badge rounded-pill bg-danger ms-3 item-in-wish-count {{ propertyWishCount() > 0 ? '' : 'd-none' }}">
                {{propertyWishCount()}}
                </span>
            </a>
        </li>

        <!--<li>
            <a class="{{menuActive(['user.addFund'])}}" href="{{route('user.addFund')}}"><i class="fal fa-funnel-dollar"></i>@lang('Add Fund')</a>
        </li>

        <li>
            <a class="{{menuActive(['user.fund-history', 'user.fund-history.search'])}}" href="{{route('user.fund-history')}}"><i class="fal fa-file-invoice-dollar"></i>@lang('Fund History')</a>
        </li>


        <li>
            <a class="{{menuActive(['user.money-transfer'])}}" href="{{route('user.money-transfer')}}"><i class="fal fa-exchange-alt"></i>@lang('Money Transfer')</a>
        </li>-->



        <!--<li>
            <a class="{{menuActive(['user.payout.money','user.payout.preview'])}}" href="{{route('user.payout.money')}}"><i class="fal fa-credit-card"></i>@lang('Payout')</a>
        </li>
        <li>
            <a class="{{menuActive(['user.payout.history','user.payout.history.search'])}}" href="{{route('user.payout.history')}}"><i class="fal fa-usd-square"></i>@lang('Payout History')</a>
        </li>-->

        <li>
            <a class="{{menuActive(['user.referral.index'])}}" href="{{route('user.referral.index')}}"><i class="fal fa-sync"></i>@lang('Referral')</a>
        </li>

        <li>
            <a class="{{menuActive(['user.market'])}}"  href="{{route('user.market')}}"><i class="fal fa-house-return"></i>@lang('Marketplace')</a>
        </li>

        <li>
            <a class="{{menuActive(['user.invest-property-cart'])}}" href="{{route('user.invest-property-cart')}}">
                <i class="fal fa-shopping-cart"></i>@lang('Cart')
                <span class="badge rounded-pill bg-danger ms-3 item-in-cart-count {{ investmentCartCount() > 0 ? '' : 'd-none' }}">
                    {{investmentCartCount()}}
                </span>
            </a>
        </li>

        <!--<li>
            <a class="{{menuActive(['user.referral.bonus', 'user.referral.bonus.search'])}}" href="{{route('user.referral.bonus')}}"><i class="fal fa-hand-holding-usd"></i>@lang('Referral Bonus')</a>
        </li>

        <li>
            <a class="{{menuActive(['user.badges'])}}" href="{{route('user.badges')}}"><i class="fal fa-badge-check"></i>@lang('Badges')</a>
        </li>-->

        <!--<li class="d-lg-none">
            <a href="{{route('user.twostep.security')}}">
                <i class="fal fa-lock"></i> @lang('2FA Security')
            </a>
        </li>-->

        <!--<li class="d-lg-none">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fal fa-sign-out-alt"></i> @lang('Logout')
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>-->

        


        <li>
            <a class="{{menuActive(['user.ticket.list', 'user.ticket.create', 'user.ticket.view'])}}" href="{{route('user.ticket.list')}}"><i class="fal fa-ticket"></i>@lang('Help & Support')</a>
        </li>

        <li>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{getFile(config('location.user.path').auth()->user()->image)}}" alt="hugenerd" width="30" height="30" class="rounded-circle" style="margin-right: 8px;">
                    <span class="d-none d-sm-inline mx-1">{{auth()->user()->firstname}} {{auth()->user()->lastname}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="background-color: #fff;">
                    <li>
                        <a href="{{route('user.home')}}">
                            <i class="fal fa-border-all"></i> {{trans('Dashboard')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.profile') }}">
                            <i class="fal fa-user"></i> @lang('My Profile')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fal fa-sign-out-alt"></i> @lang('Logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </li>

        <li class="mt-3">
            <a class="{{menuActive(['user.ticket.list', 'user.ticket.create', 'user.ticket.view'])}} btn-custom text-white" href="{{route('user.subscription.index')}}"><i class="fal fa-crown text-white"></i>@lang('Upgrade Plan')</a>
        </li>   
    </ul>








</div>



<!--extra-->