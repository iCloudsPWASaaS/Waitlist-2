<div class="property-box">
    @php
    $investment = \App\Models\Investment::with('property.details')
            ->groupBy('property_id')
            ->where('property_id', $property->id)
            ->selectRaw('*, SUM(amount * card_quantity) AS total_amount')
            ->first();
    $investment_total = $investment?$investment->total_amount:'0.00';
    $investment_now = \App\Models\Investment::with('property.details')->where('user_id', Auth::id())->where('is_active', 0)->where('invest_status', '!=', 4)->where('deleted_at', NULL)->where('property_id', $property->id)->exists();
    $investment_limit = \App\Models\Investment::with('property.details')->where('user_id', Auth::id())->where('card_quantity', '=', $property->	user_card_limit)->where('deleted_at', NULL)->where('property_id', $property->id)->exists();
    @endphp

    <div class="img-box">
        <div class="badges" style="z-index: 999;">
            <button class="save wishList" type="button" id="{{$key}}" data-property="{{ $property->id }}">
                @if($property->get_favourite_count > 0)
                <i class="fas fa-heart save{{$key}}"></i>
                @else
                <i class="fal fa-heart save{{$key}}"></i>
                @endif
            </button>
        </div>
        <div id="myCarousel{{$key}}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-inner" role="listbox">
                    @foreach($property->image as $img)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img class="img-fluid" src="{{ getFile(config('location.property.path').$img->image) }}" />

                    </div>
                    @endforeach
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel{{$key}}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel{{$key}}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="text-box" style="background: #ffffff;">
        <!--extra-->
        <!--<div class="review">
            @include($theme.'partials.propertyReview')
        </div>-->

        @php
        $property_tags = explode(",", $property->property_tags);
        @endphp

        @if ($property->property_tags)
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-8">
                @foreach ($property_tags as $property_tag)
                <span class="badge">{{ $property_tag }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <div class="row" style="margin-bottom: 5px;">
            <div class="col-12">
                @guest
                <a class="title" href="{{ route('login') }}">{{
                    \Str::limit(optional($property->details)->property_title, 30) }}</a>
                @endguest
                @auth
                <a class="title" href="{{ route('user.propertyDetails',[slug(optional($property->details)->property_title), $property->id]) }}">{{
                    \Str::limit(optional($property->details)->property_title, 30) }}</a>
                @endauth
            </div>

            <div class="col-12 d-none">
                <span class="title price float-end">{{ config('basic.currency_symbol') . $property->property_value }}</span>
            </div>

            <div class="col-12">
                <!-- <i class="fal fa-map-marker save1" aria-hidden="true"></i>&nbsp; -->
                @lang(optional($property->getAddress->details)->title)
            </div>
        </div>

        <div class="row" style="margin-bottom: 15px;">
            <div class="col-12 text-end">
                <!-- 100% Sold -->
                {{ getAmount(@$investment_total / @$property->total_investment_amount * 100, config('basic.fraction_number'))  }}% cards purchased
            </div>
            <div class="col-12">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ @$investment_total / @$property->total_investment_amount  * 100  }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ @$investment_total / @$property->total_investment_amount  * 100  }}%; background-color: #189ad3 !important;">
                    </div>
                </div>
            </div>
        </div>

        <!--<p class="address">
            <i class="fas fa-map-marker-alt"></i>
            @lang(optional($property->getAddress->details)->title)
        </p>-->

        <style>
            table {
                border-collapse: separate;
                border-spacing: 0;
            }

            tr {}

            td {
                padding: 10px 30px;
                background-color: #0f2034;
                color: #000;
            }

            tr:first-child td:first-child {
                border-top-left-radius: 10px;
            }

            tr:last-child td:first-child {
                border-bottom-left-radius: 10px;
            }

            tr:first-child td:last-child {
                border-top-right-radius: 10px;
            }

            tr:last-child td:last-child {
                border-bottom-right-radius: 10px;
            }

            .css-1dvsx2h {
                display: flex;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                background-image: url(https://getstake.com/assets/properties/locked-property.png);
                width: 100%;
            }

            .css-e0mz0m {
                display: flex;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                flex-direction: column;
                height: 200px;
            }

            .css-1epo3gp {
                width: 40px;
                height: 60px;
                display: inline-block;
                line-height: 1em;
                flex-shrink: 0;
                color: inherit;
                vertical-align: middle;
            }

            .css-e0mz0m> :not(style)~ :not(style) {
                margin-top: 0.5rem;
                margin-inline: 0px;
                margin-bottom: 0px;
            }

            .css-84ytiu {
                text-align: center;
                padding-top: var(--chakra-space-6);
                font-weight: var(--chakra-fontWeights-extrabold);
            }
        </style>

        @guest
        <div class="row">
            <div class="css-1dvsx2h">
                <div class="chakra-stack css-e0mz0m">
                    <svg viewBox="0 0 24 24" focusable="false" class="chakra-icon css-1epo3gp" aria-label="lock">
                        <g fill="none" fill-rule="nonzero" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <g>
                                <path d="M8 10V7V7C8 4.791 9.791 3 12 3V3C14.209 3 16 4.791 16 7V7V10 M12 14V17"></path>
                                <path d="M17 21H7C5.895 21 5 20.105 5 19V12C5 10.895 5.895 10 7 10H17C18.105 10 19 10.895 19 12V19C19 20.105 18.105 21 17 21Z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <p class="chakra-text css-84ytiu" style="font-size:20px;font-weight: bold;">
                        <a class="chakra-text css-196mlf6" href="{{ route('login') }}">Sign up or login</a> to view <br />the property
                    </p>
                </div>
            </div>
        </div>
        @endguest

        @auth
        <div class="row">
            <!-- <div class="col-6">
                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">Deal Type: {{ ucwords($property->type_of_deal) }}</span>
                </div>

                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">Issued: {{ $property->card_issued > $property->card_remain ? $property->card_issued - $property->card_remain : '' }}</span>
                </div>

                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">Sold: {{ $property->card_issued > $property->card_remain ? $property->card_issued - $property->card_remain : '' }}</span>
                </div>

                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">Price: {{ config('basic.currency_symbol') }}{{ $property->total_investment_amount }}</span>
                </div>

                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">ROI: {{ config('basic.currency_symbol') }}{{ $property->profit }}</span>
                </div>
            </div>
            <div class="col-6">
                <div class="aminities" style="flex-direction: column;">
                    @foreach($property->limitamenity as $key => $amenity)
                    <span style="margin-bottom:10px;"><i class="{{ $amenity->icon }}"></i>{{ optional($amenity->details)->title  }}</span>
                    @endforeach
                </div>

                <div class="aminities" style="flex-direction: column;">

                    @foreach($property->limitfacility as $key => $facility)
                    <span style="margin-bottom:10px;"><i class="fas fa-info"></i>{{ $facility->title }}</span>
                    @endforeach

                </div>
            </div> -->

            <div class="col-6">
                <p class="float-start">Deal Type</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold">{{ $property->propertydeal->name }}</p>
            </div>

            <div class="col-6">
                <p class="float-start">Card Price</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold">
                    {{-- config('basic.currency_symbol') --}}{{-- $property->available_funding --}}

                    @if($property->fixed_amount > $property->available_funding && $property->available_funding > 0)
                    {{ config('basic.currency_symbol') }}{{ $property->available_funding }}
                    @else
                    @if($property->available_funding < $property->minimum_amount && $property->available_funding !=0)
                        {{ config('basic.currency_symbol') }}{{ $property->minimum_amount }}
                        @else
                        {{ $property->investmentAmount }}
                        @endif
                        @endif
                </p>
            </div>

            <div class="col-6">
                <p class="float-start">Est. Gross Yield P.A.</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold">{{ $property->property_yield  }}%</p>
            </div>

            <div class="col-6">
                <p class="float-start">Est. Property Appreciation</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold">{{ $property->capital_appreciation  }}%</p>
            </div>

            <div class="col-6">
                <p class="float-start">Return on Investment</p>
            </div>
            <div class="col-6">
                <!-- <p class="float-end fw-bold">{{ $property->profit_type == 1 ? (int)$property->profit.'%' : config('basic.currency_symbol').$property->profit }}</p> -->
                <p class="float-end fw-bold">{{ round($property->profit, 2) }}%</p>
            </div>
        </div>

        <div class="invest-btns d-flex justify-content-between" style="border-bottom: 0px;">
            <!--extra-->
            @guest
            <a href="{{ route('login') }}" role="button">@lang('Invest Now')</a>
            @endguest
            @auth

            @if($investment_now)
            <button type="button" class="investNowExtra" data-route="{{route('user.invest-property', $property->id)}}" data-property="{{ $property }}" data-expired="{{ dateTime($property->expire_date) }}" data-symbol="{{ $basic->currency_symbol }}" data-currency="{{ $basic->currency }}">
                @lang('Added')
            </button>
            @else
                @if($investment_limit)
                <button type="button" disabled>
                    @lang('Invested')
                </button>
                @else
                <button type="button" class="investNowExtra" data-route="{{route('user.invest-property', $property->id)}}" data-property="{{ $property }}" data-expired="{{ dateTime($property->expire_date) }}" data-symbol="{{ $basic->currency_symbol }}" data-currency="{{ $basic->currency }}">
                    @lang('Add To Cart')
                </button>
                @endif
            @endif

            <!-- <button type="button" class="reserveNowExtra" data-route="{{route('user.reserve-property', $property->id)}}" data-property="{{ $property }}" data-expired="{{ dateTime($property->expire_date) }}" data-symbol="{{ $basic->currency_symbol }}" data-currency="{{ $basic->currency }}">
                @lang('Reserve Now')
            </button> -->
            @endauth
        </div>
        @endauth
    </div>
</div>