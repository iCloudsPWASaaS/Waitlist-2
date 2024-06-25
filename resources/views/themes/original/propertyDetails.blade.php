@extends($theme.'layouts.user') <!--extra-->
@section('title', trans('Property Details'))

@push('seo')
<meta name="description" content="{{ optional($singlePropertyDetails->details)->property_title }}">
<meta name="keywords" content="{{ config('seo')['meta_keywords'] }}">
<link rel="shortcut icon" href="{{getFile(config('location.logoIcon.path').'favicon.png') }}" type="image/x-icon">
<!-- Apple Stuff -->
<link rel="apple-touch-icon" href="{{ getFile(config('location.propertyThumbnail.path').$singlePropertyDetails->thumbnail) }}">
<title>@lang($basic->site_title) | {{ optional($singlePropertyDetails->details)->property_title }} </title>
<link rel="icon" type="image/png" sizes="16x16" href="{{getFile(config('location.logoIcon.path').'favicon.png') }}">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="@lang($basic->site_title) | {{ optional($singlePropertyDetails->details)->property_title }}">
<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="@lang($basic->site_title) | {{ optional($singlePropertyDetails->details)->property_title }}">
<meta itemprop="description" content="{{ optional($singlePropertyDetails->details)->details }}">
<meta itemprop="image" content="{{ getFile(config('location.propertyThumbnail.path').$singlePropertyDetails->thumbnail) }}">
<!-- Facebook Meta Tags -->
<meta property="og:type" content="website">
<meta property="og:title" content="{{ optional($singlePropertyDetails->details)->property_title }}">
<meta property="og:description" content="{{ optional($singlePropertyDetails->details)->details }}">
<meta property="og:image" content="{{ getFile(config('location.propertyThumbnail.path').$singlePropertyDetails->thumbnail) }}" />
<meta property="og:url" content="{{ url()->current() }}">
<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="{{ getFile(config('location.propertyThumbnail.path').$singlePropertyDetails->thumbnail) }}">
@endpush


@section('content')

<style>
    /*extra*/
    .property-details .gallery-box {
        padding: 0px;
    }

    .property-details .side-bar .side-box {
        padding: 0px;
        box-shadow: var(--none);
        margin-bottom: 0px;
    }

    .property-details .side-bar {
        box-shadow: var(--none);
        border-radius: 15px;
    }

    #content .overlay {
        padding: 15px;
    }

    /* extra gallery */
    .css-1hsb4p {
        width: 100%;
        margin-inline-start: 0px;
        margin-inline-end: auto;
        /* max-width: 1280px;
        padding-inline-start: 1.5rem;
        padding-inline-end: 1.5rem; */
    }

    .css-1y2zgbc {
        display: grid;
        grid-gap: 0.5rem;
        grid-template-rows: repeat(2, 1fr);
        grid-template-columns: repeat(8, 1fr);
        height: 420px;
    }

    .css-1flqwi9 {
        grid-area: span 2 / span 4 / span 2 / span 4;
    }

    .css-1i2mg89 {
        animation: auto ease 0s 1 normal none running none;
        height: 100%;
    }


    .css-tuh9u2 {
        grid-column: span 2 / span 2;
    }

    .css-1kddejf {
        border-radius: 8px;
        height: 100%;
        flex: 1 1 0%;
        width: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }


    .css-14j3dlp {
        position: absolute;
        left: auto;
        right: 2rem;
        border-radius: 15px;
        background-color: var(--white);
        padding-inline-start: 1.5rem;
        padding-inline-end: 1.5rem;
        padding-top: 1rem;
        margin-top: -50px;
        cursor: pointer;
    }

    .css-mhvh14 {
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        justify-content: space-evenly;
        flex-direction: row;
    }
</style>

<!-- property details -->
<section class="property-details" style="padding: 0px;"> <!--extra-->
    <div class="overlay">
        <!--<div class="container">-->

        <div class="row g-lg-5">
            <div class="col-lg-12 d-md-none d-lg-none">
                <div class="gallery-box">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($singlePropertyDetails->image as $key=>$img)
                            <div class="carousel-item {{$key==0 ? 'active' : ''}}">
                                <img src="{{ getFile(config('location.property.path').$img->image) }}" style="width:640px;height:360px;" />
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                    <!--extra-->
                    <!--<div id="thumbCarousel" class="carousel max-w-xl mx-auto thumb_carousel">
                        @if(count($singlePropertyDetails->image) > 0)
                            @foreach($singlePropertyDetails->image as $img)
                                <div class="carousel__slide">
                                    <img class="panzoom__content img-fluid"
                                        src="{{ getFile(config('location.property.path').$img->image) }}"/>
                                </div>
                            @endforeach
                        @else
                            <div class="">
                                <img class="panzoom__content img-fluid"
                                    src="{{ getFile(config('location.propertyThumbnail.path').$singlePropertyDetails->thumbnail) }}"/>
                            </div>
                        @endif

                    </div>-->
                </div>
            </div>


            <div class="col-lg-12 d-none d-sm-block d-sm-none d-md-block d-lg-block">
                <div class="chakra-container css-1hsb4p">
                    <div class="css-7ym3yz">
                        <div class="css-1y2zgbc">
                            <div class="css-1flqwi9">
                                <div class="chakra-skeleton css-1i2mg89">
                                    <img class="css-1kddejf" src="{{ $singlePropertyDetails->image->count() > 0 ? getFile(config('location.property.path').$singlePropertyDetails->image[0]->image) : '' }}" />
                                </div>
                            </div>
 
                            @foreach ($singlePropertyDetails->image->take(5) as $img)
                            @if ($loop->first) @continue @endif
                            <div class="css-tuh9u2">
                                <a href="{{ getFile(config('location.property.path').$img->image) }}" data-fancybox="gallery">
                                    <img class="css-1kddejf" src="{{ getFile(config('location.property.path').$img->image) }}" />
                                </a>
                            </div>
                            @endforeach
                        </div>

                        <div class="css-14j3dlp" id="my-fancybox">
                            <div class="chakra-stack css-mhvh14">
                                <div class="chakra-skeleton css-cdkrf0">
                                    <p class="chakra-text css-1bsgmhw">See All</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 pt-4">
                <div id="description" class="description-box">
                    <div class="row">
                        <div class="col-lg-12 mb-5 border-bottom">
                            <div style="width: 840px; display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start; gap: 16px;">
                                <h2 style="position: relative;"> @lang(optional($singlePropertyDetails->details)->property_title)</h2>
                                <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px; font-size: 18px; color: #616161; font-family: Poppins;">
                                    @foreach($singlePropertyDetails->allamenity as $key=>$amenity)
                                    @if ($key > 0)
                                    <div style="position: relative; border-right: 1px solid #616161; box-sizing: border-box; width: 1px; height: 25px;"></div>
                                    @endif
                                    <div style="flex-shrink: 0; display: flex; flex-direction: row; align-items: flex-start; justify-content: flex-start;">
                                        <div style="position: relative;">@lang(optional($amenity->details)->title)</div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-5">
                            <div class="row">

                                <div class="col-12">
                                    <div style="align-self: stretch; display: flex; font-size: 24px; color: rgba(0, 0, 0, 0.8);gap: 40px;">
                                        <img style="position: relative; border-radius: 50%; width: 38px; height: 38px; object-fit: cover;margin-top: 10px;" alt="" src="{{ url('./public/property/ellipse-48@2x.png')}}" />
                                        <div style="position: relative;">
                                            <span style="position: relative; font-weight: 600;">
                                                <!-- Oxford UK -->
                                                UK Property
                                            </span>
                                            <p style="position: relative; font-size: 17px !important; color: #515151;">
                                                Mature real estate market with high returns on investment
                                            </p>
                                        </div>
                                    </div>


                                    <div style="align-self: stretch; display: flex; font-size: 24px; color: rgba(0, 0, 0, 0.8);gap: 40px; margin-top: 10px;">
                                        <img style="position: relative; width: 38px; height: 38px; overflow: hidden; flex-shrink: 0; object-fit: cover;margin-top: 10px;" alt="" src="{{ url('./public/property/stayathome-1@2x.png')}}" />
                                        <div style="position: relative;">
                                            <span style="position: relative; font-weight: 600;">
                                                Holiday Let
                                            </span>
                                            <p style="position: relative; font-size: 17px !important; color: #515151;">
                                                Currently occupied all year round 92.7% managed by company called bnbliving
                                            </p>
                                        </div>
                                    </div>



                                    

                                    <div style="align-self: stretch; display: flex; font-size: 24px; color: rgba(0, 0, 0, 0.8);gap: 40px; margin-top: 10px;">
                                        <img style="position: relative; width: 38px; height: 38px; overflow: hidden; flex-shrink: 0; object-fit: cover;margin-top: 10px;" alt="" src="{{ url('./public/property/coins-1@2x.png')}}" />
                                        <div style="position: relative;">
                                            <span style="position: relative; font-weight: 600;">
                                                Expected returns
                                            </span>
                                            <p style="position: relative; font-size: 17px !important; color: #515151;">
                                            Cards have been issued and owners will be receiving earning at the end of the month.
                                            </p>
                                        </div>
                                    </div>

                                    <div style="align-self: stretch; display: flex; font-size: 24px; color: rgba(0, 0, 0, 0.8);gap: 40px; margin-top: 10px;">
                                        <img style="position: relative; width: 38px; height: 38px; overflow: hidden; flex-shrink: 0; object-fit: cover;" alt="" src="{{ url('./public/property/growth-2-1@2x.png')}}" />
                                        <div style="position: relative;">
                                            <span style="position: relative; font-weight: 600;">
                                                Estimated appreciation
                                            </span>
                                            <p style="position: relative; font-size: 17px !important; color: #515151;">
                                            The average anticipated growth of the property will be updated Quarterly and a Valuation for the property Annually.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12  mb-5">
                            <h4>@lang('Property Overview')</h4>
                            <p class="property__description">
                                {!! optional($singlePropertyDetails->details)->details !!}
                            </p>
                        </div>

                        <div class="col-12  mb-5">
                            <h4>@lang('Financials')</h4>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="float-start">
                                            <h5>Property cost</h5>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p class="float-start">Property market value</p>
                                        </div>

                                        <div class="col-6">
                                            <p class="float-end fw-bold">
                                                {{ config('basic.currency_symbol') . $singlePropertyDetails->property_value }}
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p class="float-start">Deal type</p>
                                        </div>

                                        <div class="col-6">
                                            <p class="float-end fw-bold">
                                                {{ $singlePropertyDetails->propertydeal->name }}
                                            </p>
                                        </div>

                                        <div class="col-6">
                                            <p class="float-start">Strategy</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="float-end fw-bold">
                                                {{ $singlePropertyDetails->propertytype->name }}
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <hr />
                                        </div>

                                        <div class="col-6">
                                            <p class="float-start">Development cost</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="float-end fw-bold">{{ config('basic.currency_symbol') . $singlePropertyDetails->development_cost }}</p>
                                        </div>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="float-start">
                                            <h5>Current rental (Latest year)</h5>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p class="float-start">Annual gross rent</p>
                                        </div>

                                        <div class="col-6">
                                            <p class="float-end fw-bold">
                                                {{ config('basic.currency_symbol') . $singlePropertyDetails->rental_income_gross }}
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p class="float-start">Service charges</p>
                                        </div>

                                        <div class="col-6">
                                            <p class="float-end fw-bold">
                                                {{ config('basic.currency_symbol') . $singlePropertyDetails->service_charges }}
                                            </p>
                                        </div>

                                        <div class="col-6">
                                            <p class="float-start">Mgmt. and maintenance</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="float-end fw-bold">
                                                {{ $singlePropertyDetails->maintenance }}
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <hr />
                                        </div>

                                        <div class="col-6">
                                            <p class="float-start">Invested</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="float-end fw-bold">
                                                @if($singlePropertyDetails->fixed_amount > $singlePropertyDetails->available_funding && $singlePropertyDetails->available_funding > 0)
                                                {{ config('basic.currency_symbol') }}{{ $singlePropertyDetails->available_funding }}
                                                @else
                                                @if($singlePropertyDetails->available_funding < $singlePropertyDetails->minimum_amount && $singlePropertyDetails->available_funding !=0)
                                                    {{ config('basic.currency_symbol') }}{{ $singlePropertyDetails->minimum_amount }}
                                                    @else
                                                    {{ $singlePropertyDetails->investmentAmount }}
                                                    @endif
                                                    @endif
                                            </p>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12  mb-5">
                            <h4>@lang('Funding Timeline')</h4>
                            <p class="property__description">
                                {!! optional($singlePropertyDetails->details)->funding_timeline !!}
                            </p>
                        </div>

                        <div id="amenities" class="col-12  mb-5">
                            <h4 class="mb-4">@lang('Amenities')</h4>
                            <div class="row gy-4">
                                @foreach($singlePropertyDetails->allamenity as $amenity)
                                <div class="col-3 col-md-2">
                                    <div class="amenity-box">
                                        <i class="{{ @$amenity->icon }}"></i>
                                        <h6>@lang(optional($amenity->details)->title)</h6>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="col-12  mb-5">
                            <h4>@lang('Location')</h4>
                            <iframe src="{{ $singlePropertyDetails->location }}" width="100%" height="400" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="col-12  mt-2 mb-2">
                            <h4>@lang('Documents')</h4>
                        </div>
                        @if($singlePropertyDetails->details->faq != null)
                        <div class="faq-box col-12  mb-5" class="accordion" id="accordionExample">
                            @php
                            $faq_key = 0;
                            @endphp
                            @foreach($singlePropertyDetails->details->faq as $key => $faq)
                            @php
                            $faq_key++;
                            @endphp
                            <div style="
                                    align-self: stretch;
                                    border-radius: 12px;
                                    border: 1px solid rgba(0, 0, 0, 0.1);
                                    display: flex;
                                    flex-direction: column;
                                    align-items: flex-start;
                                    justify-content: flex-start;
                                    padding: 22px;
                                    margin-bottom: 10px;
                                ">
                                <div style="
                                    align-self: stretch;
                                    display: flex;
                                    flex-direction: row;
                                    align-items: center;
                                    justify-content: space-between;
                                    ">
                                    <div style="
                                            flex-shrink: 0;
                                            display: flex;
                                            flex-direction: row;
                                            align-items: center;
                                            justify-content: flex-start;
                                            gap: 16px;
                                        ">
                                        <img style="
                                            position: relative;
                                            width: 24px;
                                            height: 24px;
                                            overflow: hidden;
                                            flex-shrink: 0;
                                            object-fit: cover;
                                            " alt="" src="{{ url('./public/property/file-1@2x.png')}}">

                                        <div style="position: relative">
                                            @lang(@$faq->field_name)
                                        </div>
                                    </div>

                                    <a href="{{@$faq->field_value}}" target="_blank">
                                        <img style="
                                            position: relative;
                                            width: 24px;
                                            height: 24px;
                                            overflow: hidden;
                                            flex-shrink: 0;
                                            object-fit: cover;
                                        " alt="" src="{{ url('./public/property/download-4-1@2x.png')}}">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif



                        <div style="
                                align-self: stretch;
                                display: flex;
                                flex-direction: column;
                                align-items: flex-start;
                                justify-content: flex-start;
                                gap: 45px;
                            ">
                            <h3 style="position: relative">Have any more questions about this property?</h3>
                            <div style="
                            display: flex;
                            flex-direction: row;
                            align-items: flex-start;
                            justify-content: flex-start;
                            gap: 30px;
                            font-size: 18px;
                            ">
                                <img style="
                            position: relative;
                            border-radius: 50%;
                            width: 101px;
                            height: 101px;
                            object-fit: cover;
                        " alt="" src="{{ url('./public/property/ellipse-3@2x.jpg')}}">

                                <div style="
                                flex-shrink: 0;
                                display: flex;
                                flex-direction: column;
                                align-items: flex-start;
                                justify-content: flex-start;
                                gap: 20px;
                            ">
                                    <div style="position: relative">
                                        Our team will be able to assist you.
                                    </div>

                                    <a href="{{route('contact')}}" target="_blank">
                                        <div style="
                                border-radius: 12px;
                                border: 1.5px solid rgba(0, 0, 0, 0.4);
                                flex-shrink: 0;
                                display: flex;
                                flex-direction: row;
                                align-items: center;
                                justify-content: center;
                                padding: 12px 30px 12px 24px;
                                gap: 12px;
                                color: #515151;
                                ">
                                            <img style="
                                    position: relative;
                                    width: 32px;
                                    height: 32px;
                                    overflow: hidden;
                                    flex-shrink: 0;
                                    object-fit: cover;
                                " alt="" src="{{ url('./public/property/message-1@2x.png')}}">

                                            <div style="
                                    position: relative;
                                    text-transform: capitalize;
                                    font-weight: 600;
                                    ">
                                                Contact Us
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="shop-section">
                <h4>@lang('Similar Properties')</h4>
                    <div class="row g-4 mb-5">
                        @foreach($latestProperties as $key => $property)                      
                        <div class="col-md-4 col-lg-4 p-2">
                            @include($theme.'partials.propertyBox')
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- sidebar start -->

            <div class="col-lg-4 pt-4">
                <div class="side-bar sticky-top">
                    <form action="{{route('user.invest-property', $singlePropertyDetails->id)}}" method="post">
                        @csrf
                        <div class="side-box">
                            <div class="d-flex justify-content-between">
                                <p><b>@lang('Property Value')</b></p>
                                <p><b>{{ config('basic.currency_symbol') . $singlePropertyDetails->property_value }}</b></p>
                            </div>

                            <!-- @if($singlePropertyDetails->is_available_funding == 1)
                            <p class="primary_color">@lang('Available for funding'):
                                @if($singlePropertyDetails->available_funding < $singlePropertyDetails->minimum_amount && $singlePropertyDetails->available_funding !=0)
                                    {{ config('basic.currency_symbol') }}{{ $singlePropertyDetails->minimum_amount }}
                                    @else
                                    <span>{{ config('basic.currency_symbol') }}{{ $singlePropertyDetails->available_funding }}</span>
                                    @endif
                            </p>
                            @endif -->

                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-12 text-end">
                                    @php
                                    $investment = \App\Models\Investment::with('property.details')
                                            ->where('user_id', Auth::id())->groupBy('property_id')
                                            ->where('property_id', $singlePropertyDetails->id)
                                            ->selectRaw('*, SUM(amount * card_quantity) AS total_amount')
                                            ->first();
                                    $investment_total = $investment?$investment->total_amount:'0.00';
                                    @endphp
                                    {{ getAmount(@$investment_total / @$singlePropertyDetails->available_funding  * 100, config('basic.fraction_number'))  }}% cards purchased
                                    <!-- 100% Sold -->
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ @$investment_total / @$singlePropertyDetails->available_funding  * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ @$investment_total / @$singlePropertyDetails->available_funding * 100 }}%; background-color: #189ad3 !important;">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <ul class="profit-calculation">
                                <li>
                                    <p><b>@lang('Property Cost')</b></p>
                                </li>
                                <li>Est. Gross Yield P.A <span>{{ $singlePropertyDetails->property_yield  }}%</span></li>
                                <li>Est. Property Appreciation <span>{{ $singlePropertyDetails->capital_appreciation  }}%</span></li>
                                <li>Total Shares Sold<span>25%</span></li>
                                <!-- <li>Projected net yield<span>{{ $singlePropertyDetails->property_yield  }}%</span></li> -->
                                <li>Deal Type<span>{{ $singlePropertyDetails->propertydeal->name  }}</span></li>

                                <!-- <li>@lang('Invest Amount'):
                                    <span>
                                        @if($singlePropertyDetails->fixed_amount > $singlePropertyDetails->available_funding && $singlePropertyDetails->available_funding > 0)
                                        {{ config('basic.currency_symbol') }}{{ $singlePropertyDetails->available_funding }}
                                        @else
                                        @if($singlePropertyDetails->available_funding < $singlePropertyDetails->minimum_amount && $singlePropertyDetails->available_funding !=0)
                                            {{ config('basic.currency_symbol') }}{{ $singlePropertyDetails->minimum_amount }}
                                            @else
                                            {{ $singlePropertyDetails->investmentAmount }}
                                            @endif
                                        @endif
                                    </span>
                                </li> 
                                <li>ROI (Return on Investment):
                                    <span>{{ $singlePropertyDetails->profit_type == 1 ? (int)$singlePropertyDetails->profit.'%' : config('basic.currency_symbol').$singlePropertyDetails->profit }}</span>
                                </li>
                                <li>ROI Time:
                                    <span>{{ $singlePropertyDetails->how_many_times == null ? optional($singlePropertyDetails->managetime)->time.' '.optional($singlePropertyDetails->managetime)->time_type :  optional($singlePropertyDetails->managetime)->time.' '.optional($singlePropertyDetails->managetime)->time_type.' '.'('.$singlePropertyDetails->how_many_times. ' '. 'times'. ')' }}</span>
                                </li> -->
                            </ul>

                            <!-- <div class="input-box col-12 mt-2 mb-2">
                                <label for="@lang('Amount')">@lang('Amount')</label>
                                <input class="form-control invest-amount" type="text" value="{{ $singlePropertyDetails->investableAmount() }}" {{ $singlePropertyDetails->is_invest_type == 0 ? 'readonly' : '' }} placeholder="@lang('Enter amount')" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount" id="amount" />
                            </div> -->

                            <!-- <div>
                                <button type="submit" class="btn-custom w-100">{{ trans('Invest Now') }}</button>
                            </div> -->

                            <button type="button" class="btn-custom w-100 investNowExtra" {{ $singlePropertyDetails->rud()['upcomingProperties'] ? 'disabled' : '' }} data-route="{{route('user.invest-property', $singlePropertyDetails->id)}}" data-property="{{ $singlePropertyDetails }}" data-expired="{{ dateTime($singlePropertyDetails->expire_date) }}" data-symbol="{{ $basic->currency_symbol }}" data-currency="{{ $basic->currency }}">
                                @lang('Add To Cart')
                            </button>

                        </div>
                    </form>

                    <!-- @if(count($singlePropertyDetails->getInvestment) > 0)
                    <div class="side-box">
                        <h4>@lang('Investor')</h4>
                        <div class="owl-carousel property-agents">
                            @foreach($singlePropertyDetails->getInvestment as $key => $investor)
                            <div class="agent-box-wrapper">
                                <div class="agent-box">
                                    <div class="img-box">
                                        <img src="{{ getFile(config('location.user.path').optional($investor->user)->image) }}" class="img-fluid profile" alt="@lang('not found')" />
                                    </div>
                                    <div class="text-box">
                                        <a href="{{ route('investorProfile', [@slug(optional($investor->user)->username), optional($investor->user)->id]) }}" class="agent-name">@lang(optional($investor->user)->fullname)</a>
                                        <span>@lang('Agent of Property')</span>
                                    </div>
                                </div>
                                <ul>
                                    <li>
                                        <i class="fal fa-building"></i>
                                        <span>
                                            {{ optional($investor->user)->countTotalInvestment() }}
                                            @if(optional($investor->user)->countTotalInvestment() == 1)
                                            @lang('Property')
                                            @else
                                            @lang('Propertys')
                                            @endif
                                        </span>
                                    </li>

                                    @if(optional($investor->user)->address)
                                    <li>
                                        <i class="fal fa-map-marker-alt" aria-hidden="true"></i>
                                        <span>@lang(optional($investor->user)->address)</span>
                                    </li>
                                    @endif
                                </ul>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif -->

                    
                </div>
            </div>
        </div>
        <!--</div>-->
    </div>
</section>
@endsection

@push('css-lib')
<link rel="stylesheet" href="{{ asset($themeTrue.'css/owl.carousel.min.css') }}" />
<link rel="stylesheet" href="{{ asset($themeTrue.'css/owl.theme.default.min.css') }}" /> <!-- extra -->
@endpush

@push('extra-js')
<!-- fancybox slider -->
<!-- extra -->
<!-- <script> 
    let scriptTag = '';

    if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        scriptTag = document.createElement("script");
        scriptTag.src = "{{ asset($themeTrue.'js/fancybox.umd.js') }}";
        document.head.appendChild(scriptTag);
    } else {
        scriptTag = document.createElement("script");
        scriptTag.src = "https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js";
        document.head.appendChild(scriptTag);
    }
</script> -->
@endpush

@push('script')
<!-- <script src="{{ asset($themeTrue.'js/carousel.js?v=5') }}"></script> -->

<!-- extra -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="{{ asset($themeTrue.'js/investNow.js') }}"></script>

<script>
    'use strict'
    var newApp = new Vue({
        el: "#review-app",
        data: {
            item: {
                feedback: "",
                propertyId: '',
                feedArr: [],
                reviewDone: "",
                rating: "",
            },

            pagination: [],
            links: [],
            error: {
                feedbackError: ''
            }
        },
        beforeMount() {
            let _this = this;
            _this.getReviews()
        },
        mounted() {
            let _this = this;
            _this.item.propertyId = "{{$singlePropertyDetails->id}}"
            _this.item.reviewDone = "{{$reviewDone}}"
            _this.item.rating = "5";
        },
        methods: {
            rate(rate) {
                this.item.rating = rate;
            },
            addFeedback() {
                let item = this.item;
                this.makeError();
                axios.post("{{route('user.review.push')}}", this.item)
                    .then(function(response) {
                        console.log(response)
                        if (response.data.status == 'success') {

                            item.feedArr.unshift({
                                review: response.data.data.review,
                                review_user_info: response.data.data.review_user_info,
                                rating2: parseInt(response.data.data.rating2),
                                date_formatted: response.data.data.date_formatted,
                            });
                            item.reviewDone = 5;
                            item.feedback = "";
                            Notiflix.Notify.Success("Review done");
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    });
            },
            makeError() {
                if (!this.item.feedback) {
                    this.error.feedbackError = "Your review message field is required"
                }
            },

            getReviews() {
                var app = this;
                axios.get("{{ route('api-propertyReviews',[$singlePropertyDetails->id]) }}")
                    .then(function(res) {
                        app.item.feedArr = res.data.data.data;
                        app.pagination = res.data.data;
                        app.links = res.data.data.links;
                        app.links = app.links.slice(1, -1);
                        console.log(app.links);
                    })

            },
            updateItems(page) {
                var app = this;
                if (page == 'back') {
                    var url = this.pagination.prev_page_url;
                } else if (page == 'next') {
                    var url = this.pagination.next_page_url;
                } else {
                    var url = page.url;
                }
                axios.get(url)
                    .then(function(res) {
                        app.item.feedArr = res.data.data.data;
                        app.pagination = res.data.data;
                        app.links = res.data.data.links;
                    })
            },
        }
    })

    $(document).ready(function() {
        $(document).on('click', '#pay_installment', function() {
            if ($(this).prop("checked") == true) {
                $(this).val(1);
                let installmentAmount = $(this).data('installmentamount');
                console.log(installmentAmount);
                $('.invest-amount').val(installmentAmount);
                $('#amount').attr('readonly', true);
            } else {
                let fixedAmount = $(this).data('fixedamount');
                console.log(fixedAmount);
                $('.invest-amount').val(fixedAmount);
                $('#amount').attr('readonly', true);
                $(this).val(0);
            }

        });
    });

    //extra
    Fancybox.bind('[data-fancybox="gallery"]', {});
    $('#my-fancybox').click(function() {
        //alert("xxx")
        Fancybox.fromSelector('[data-fancybox="gallery"]');
    });
</script>
@endpush