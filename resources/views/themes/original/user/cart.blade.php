{{--dd(session()->get('cart'));--}}

@extends($theme.'layouts.user')
@section('title')
{{ 'Cart' }}
@endsection


@section('content')

<script src="https://js.stripe.com/v3/"></script>
<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

    /* extra */
    .questions input[type="radio"] {
        display: none;
    }

    .questions label:before {
        content: attr(data-question-number);
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid;
        text-align: center;
        line-height: 30px;
        margin-right: 20px;
    }

    /* Applying styles when checking the buttons */
    .questions input[type="radio"]:checked~label {
        background-color: var(--bgLight2);
        border-color: var(--bgLight);
        color: white;
    }

    .questions input[type="radio"]:checked~label:before {
        background-color: var(--bgLight2);
        border-color: var(--bgLight);
        color: white;
    }

    .questions label {
        display: block;
        cursor: pointer;

        padding: 10px;
        margin-bottom: 10px;
        background-color: white;
        border: 2px solid white;
        border-radius: 15px;
    }

    .questions {
        padding: 0px;
    }


    .questions2 input[type="radio"] {
        display: none;
    }

    /* .questions2 label:before {
        content: attr(data-question2-number);
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid;
        text-align: center;
        line-height: 30px;
        margin-right: 20px;
    } */

    /* Applying styles when checking the buttons */
    .questions2 input[type="radio"]:checked~label {
        background-color: var(--bgLight2);
        border-color: var(--bgLight);
        color: white;
    }

    .questions2 input[type="radio"]:checked~label:before {
        background-color: var(--bgLight2);
        border-color: var(--bgLight);
        color: white;
    }

    .questions2 label {
        display: block;
        cursor: pointer;

        padding: 10px;
        margin-bottom: 10px;
        background-color: white;
        border: 2px solid white;
        border-radius: 15px;
    }

    .questions2 {
        padding: 0px;
    }
</style>

<section class="transaction-history m-5">

    <div class="row">
        <div class="col">
            <div class="header-text-full">
                <h4>Cart</h4>
            </div>
        </div>
    </div>

    <!--extra-->
    <style>
        .card {
            border: 0px solid rgba(0, 0, 0, .125);
            border-radius: 0.5rem;
        }

        #content form {
            margin-bottom: 0px;
            -webkit-box-shadow: 0 0px 0px rgba(0, 0, 0, 0.2) !important;
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0.2) !important;
            background: var(--white);
            border-radius: 0px;
            padding: 0px;
        }
    </style>
    <div class="row">
        <div class="col-md-8 col-xs-12">
            @php
            $sum = 0
            @endphp

            @forelse($investments as $key => $invest)

            @php
            $user_card_quantity = 0;
            $card_quantity = \App\Models\Investment::select(
            'property_id',
            'user_id',
            'is_active',
            DB::raw('SUM(card_quantity) as card_quantity'),
            )
            ->where('property_id', '=', $invest->property_id)
            ->where('user_id', Auth::id())
            ->where('is_active', 1)
            ->groupBy('property_id')

            ->get();

            if (!$card_quantity->isEmpty()) {
            $user_card_quantity = $card_quantity[0]->card_quantity;
            }
            @endphp

            @php
            $sum = $sum + $invest->property->available_funding
            @endphp
            <div class="card secbg br-4 bg-white  mb-3 cart">
                <div class="card-body br-4">
                    <div class="row align-items-start">
                        <div class="col-md-2">
                            <img src="{{getFile(config('location.propertyThumbnail.path').optional($invest->property)->thumbnail)}}" class="card-img-top gateway-img br-4" alt="..">
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                        @lang(\Str::limit(optional($invest->property->details)->property_title, 30))
                                    </h5>
                                    <p>@lang(\Str::limit(optional($invest->property->details)->details, 200))</p>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <a class=" btn btn-secondary remove-from-cart" myindex="{{$key}}" invest_id="{{$invest->id}}" trx_id="{{$invest->trx}}" style="background-color: #fff; color: black; border: 1px solid #ddd;" href="#">Remove</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="cost-total-hidden" id="cost-total-hidden-{{$key}}" value="{{ $invest->property->available_funding }}" style="display: none;">                                   
                                    @if($invest->property->is_invest_type == 1)
                                    <input type="text" class="invest-amount form-control amount" name="amount" value="" placeholder="{{ $invest->property->investmentAmount }}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" autocomplete="off">
                                    @else
                                    <a class=" btn btn-primary" style="background-color: #fff; color: black; width: 100%; border-radius: 15px;border: 1px solid #ddd;" href="#">
                                        <span>{{ config('basic.currency_symbol') }}{{ $invest->property->available_funding }}</span>
                                    </a>                       
                                    @endif
                                </div>

                                @if($invest->property->is_invest_type == 1)
                                <div class="col-md-12">
                                    <div class="form-row  mt-4" style="display: flex;">
                                        <button class="btn btn-outline-secondary quantity-minus-variable" myindex="{{$key}}"  style="border: 1px solid #ddd;">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text" class="form-control w-100 mx-2 quantity" unitprice="{{$invest->property->available_funding}}" user_card_limit="{{$invest->property->user_card_limit}}" user_card_quantity="{{$user_card_quantity}}" value="1" min="1" style="text-align: center;">
                                        <button class="btn btn-outline-secondary quantity-plus-variable" myindex="{{$key}}"  style="border: 1px solid #ddd;">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    <div class="row mt-2">
                                        <label for="">@lang('Enter amount between '){{ config('basic.currency_symbol') }}<span id="min_label">{{$invest->property->minimum_amount}}</span>-{{ config('basic.currency_symbol') }}<span id="max_label">{{$invest->property->maximum_amount}}</span></label>
                                        <!-- <div class="col-6 mt-2">
                                            <input type="text" class="invest-amount form-control amount" name="amount" value="" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" autocomplete="off">
                                        </div> -->
                                        <div class="col-12 mt-2">
                                            <button type="button" class="btn-custom w-100 cartOkBtn" myindex="{{$key}}" min="{{$invest->property->minimum_amount}}" max="{{$invest->property->maximum_amount}}">@lang('Update')</button>
                                        </div>
                                        <pre class="text-danger errors" style="overflow-x: hidden;"></pre>
                                    </div>

                                    <!-- <button type="button" class="btn btn-secondary mt-3 enterAmount" myindex="{{$key}}" min="{{$invest->property->minimum_amount}}" max="{{$invest->property->maximum_amount}}">
                                        @lang('Enter Amount')
                                    </button> -->
                                </div>
                                @else
                                <div class="col-md-12">
                                    <div class="form-row  mt-4" style="display: flex;">
                                        <button class="btn btn-outline-secondary quantity-minus" myindex="{{$key}}" style="border: 1px solid #ddd;">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text" class="form-control w-100 mx-2 quantity" unitprice="{{$invest->property->available_funding}}" user_card_limit="{{$invest->property->user_card_limit}}" user_card_quantity="{{$user_card_quantity}}" value="1" min="1" style="text-align: center;">
                                        <button class="btn btn-outline-secondary quantity-plus" myindex="{{$key}}"  style="border: 1px solid #ddd;">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="card secbg br-4 bg-white">
                <div class="card-body br-4">
                    <div class="row align-items-start">
                        <div class="col-md-12">
                            {{trans('Your cart is empty')}}
                        </div>

                    </div>

                </div>
            </div>
            @endforelse
        </div>


        <div class="col-md-4 col-xs-12 mb-5">
            <div class="card secbg br-4 bg-white property-details pt-0 pb-0">
                <div class="card-body br-4 side-bar">
                    <!-- <form action="{{route('user.invest-property-cart-submit')}}" method="post"> -->
                    <form id="myForm" action="{{ route('user.addFund.confirms')}}" method="post" enctype="multipart/form-data">
                        <input type="text" name="amount" id="cart-cost-total-hidden" value="{{ $sum }}" style="display: none;">

                        @csrf
                        <div class="row p-4">
                            <div class="col-md-12">

                                <div class="row  mb-4">
                                    <div class="col-5"><b>Property</b></div>
                                    <div class="col-4"><b>Qty X Cost</b></div>
                                    <div class="col-3"><b>Total</b></div>
                                </div>
                                @forelse($investments as $key => $invest)
                                <input type="hidden" name="investments_id[]" id="item-in-cart-id-input-{{$key}}" value="{{ $invest->id }}">
                                <input type="hidden" name="investments_amount[]" id="item-in-cart-price-input-{{$key}}" value="{{ $invest->amount }}">
                                <input type="hidden" name="investments_card_quantity[]" id="item-in-cart-qty-input-{{$key}}" value="1">

                                <div class="row  mb-4" id="cart-item-{{$key}}">
                                    <div class="col-5">@lang(\Str::limit(optional($invest->property->details)->property_title, 30))</div>
                                    <div class="col-4">
                                        <span id="item-in-cart-qty-{{$key}}">
                                            1
                                        </span>
                                        X <span>{{ config('basic.currency_symbol') }}</span>
                                        <span id="item-in-cart-price-{{$key}}">
                                            {{ $invest->property->available_funding }}
                                        </span>
                                    </div>
                                    <div class="col-3">{{ config('basic.currency_symbol') }}<span id="item-in-cart-price2-{{$key}}">{{ $invest->property->available_funding }}</span></div>
                                </div>
                                @empty
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-6">{{trans('Your cart is empty')}}</div>
                                    <div class="col-3"></div>
                                </div>
                                @endforelse
                                <div class="row  mb-4">
                                    <div class="col-5"><b>@lang('Total')</b></div>
                                    <div class="col-4"></div>
                                    <div class="col-3"><b>{{ config('basic.currency_symbol') }}<span class="cost-total">{{ $sum }}</span></b></div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12 p-4">

                            <div class="row align-items-center">
                                <!-- <div class="input-box col-12">
                                        <label for="" class="mb-1">@lang('Select Wallet')</label>
                                        <select class="form-control form-select mb-4" id="exampleFormControlSelect1" name="balance_type">
                                            @auth
                                            <option value="balance">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                            <option value="interest_balance">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                            @endauth
                                        </select>
                                </div> -->

                                <!-- <div class="col-12">
                                    <label for="" class="mb-1">@lang('Select Wallet')</label>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="questions">
                                        <div class="questions__question">
                                            <input type="radio" name="balance_type" id="answer-1" value="balance" checked>
                                            <label for="answer-1" data-question-number="1">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</label>
                                        </div>
                                        <div class="questions__question">
                                            <input type="radio" name="balance_type" id="answer-2" value="interest_balance">
                                            <label for="answer-2" data-question-number="2">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</label>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <label for="" class="mb-1">@lang('Select Payment Method')</label>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="questions2">
                                            @foreach($gateways as $key => $gateway)
                                            <div class="questions__question">
                                                <input type="radio" name="gateway" id="answer2-{{$key}}" value="{{$gateway->id}}" {{$gateway->id == 2 ? 'checked' : ''}}>
                                                <label for="answer2-{{$key}}" data-question2-number="{{$key+1}}">
                                                    <i class="@if ($key == 0) fas fa-credit-card @endif @if ($key == 1) fa-brands fa-paypal @endif @if ($key == 2) fa fa-money-bill-transfer @endif me-2"></i>
                                                    {{$gateway->name}}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center mt-2">
                                <div class="col-md-12 ms-auto">
                                    <!-- <a class="btn-custom mt-4 btn text-white" style="color: white; background-image:none" href="#">Complete</a> -->
                                    <!-- <button type="button" onclick="submitForm()" class="btn-custom investModalSubmitBtn">Complete</button> -->
                                    <button type="submit" class="btn-custom investModalSubmitBtn w-50"><span>Pay Now</span></button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>

            </div>
        </div>
    </div>
    </div>

</section>
@endsection


@push('script')
<script>
    "use strict";

    $(".item-in-cart-count").html($(".cost-total-hidden").length);

    $('.quantity-plus').on('click', function() {
        let q = $(this).siblings(".quantity").val();
        let p = $(this).siblings(".quantity").attr("unitPrice");
        let newQ = Number(q) + 1;
        let newCost = p * newQ;

        if (q >= Number($(this).siblings(".quantity").attr("user_card_limit"))) {
            Swal.fire({
                text: "Card limit exceeded",
                icon: "error"
            });
            return false;
        }

        /* if (q >= Number($(this).siblings(".quantity").attr("user_card_limit")) - Number($(this).siblings(".quantity").attr("user_card_quantity"))) {
            Swal.fire({
                text: "You have invested your maximum card limit",
                icon: "error"
            });
            return false;
        } */

        $(this).siblings(".quantity").val(newQ);
        $(this).parent().parent().parent().find(".cost-total-hidden").val(newCost.toFixed(2));
        cartTotal()

        $('#item-in-cart-qty-' + $(this).attr("myindex")).html(newQ);
        $('#item-in-cart-qty-input-' + $(this).attr("myindex")).val(newQ);

        //$('#item-in-cart-price-' + $(this).attr("myindex")).html(newCost.toFixed(2));
        $('#item-in-cart-price2-' + $(this).attr("myindex")).html(newCost.toFixed(2));
    });

    $('.quantity-minus').on('click', function() {
        let q = $(this).siblings(".quantity").val();
        let p = $(this).siblings(".quantity").attr("unitPrice");
        if (q > 1) {
            let newQ = Number(q) - 1;
            let newCost = p * newQ;
            $(this).siblings(".quantity").val(newQ);
            $(this).parent().parent().parent().find(".cost-total-hidden").val(newCost.toFixed(2));
            cartTotal();

            $('#item-in-cart-qty-' + $(this).attr("myindex")).html(newQ);
            $('#item-in-cart-qty-input-' + $(this).attr("myindex")).val(newQ);

            //$('#item-in-cart-price-' + $(this).attr("myindex")).html(newCost.toFixed(2));
            $('#item-in-cart-price2-' + $(this).attr("myindex")).html(newCost.toFixed(2));
        }
    });

    $('.quantity-plus-variable').on('click', function() {
        let q = $(this).siblings(".quantity").val();
        let newQ = Number(q) + 1;

        if (q >= Number($(this).siblings(".quantity").attr("user_card_limit"))) {
            Swal.fire({
                text: "Card limit exceeded",
                icon: "error"
            });
            return false;
        }

        /* if (q >= Number($(this).siblings(".quantity").attr("user_card_limit")) - Number($(this).siblings(".quantity").attr("user_card_quantity"))) {
            Swal.fire({
                text: "You have invested your maximum card limit",
                icon: "error"
            });
            return false;
        } */

        $(this).siblings(".quantity").val(newQ);
    });

    $('.quantity-minus-variable').on('click', function() {
        let q = $(this).siblings(".quantity").val();

        if (q > 1) {
            let newQ = Number(q) - 1;
            $(this).siblings(".quantity").val(newQ);
        }
    });

    function cartTotal() {
        let count = $(".cost-total-hidden").length;

        if (count > 0) {
            let totalCost = $(".cost-total-hidden").toArray().map(el => el.value).reduce((x, y) => Number(x) + Number(y));
            console.log("totalCost", totalCost);
            $(".cost-total").html(Number(totalCost).toFixed(2))
            $("#cart-cost-total-hidden").attr('value', Number(totalCost).toFixed(2));
        } else {
            $(".cost-total").html("0.00")
            $("#cart-cost-total-hidden").attr('value', "0.00");
        }
    }

    $('.remove-from-cart').on('click', function() {
        console.log($(this).attr("invest_id"))
        axios.post("{{ route('user.invest-property-cart-remove') }}", {
                invest_id: $(this).attr("invest_id")
            })
            .then(function(response) {
                console.log(response)
                $(".item-in-cart-count").html($(".cost-total-hidden").length);
            })
            .catch(function(error) {
                console.log(error)
            });

        $(this).parentsUntil(".cart").remove();

        $('#item-in-cart-id-input-' + $(this).attr("myindex")).remove();
        $('#item-in-cart-price-input-' + $(this).attr("myindex")).remove();
        $('#item-in-cart-qty-input-' + $(this).attr("myindex")).remove();

        $('#cart-item-' + $(this).attr("myindex")).remove();
        cartTotal();
    });



    $('.cartOkBtn').on('click', function() {

        if ($(this).parent().parent().parent().parent().find(".amount").val().length == 0) {
            $(this).parent().parent().find(".errors").text("field should not be empty");
            return false;
        }

        if ($(this).parent().parent().parent().parent().find(".amount").val() < Number($(this).attr("min"))) {
            $(this).parent().parent().find(".errors").text("Please enter amount in range");
            return false;
        }

        if ($(this).parent().parent().parent().parent().find(".amount").val() > Number($(this).attr("max"))) {
            $(this).parent().parent().find(".errors").text("Please enter amount in range");
            return false;
        }

        let q = $(this).parent().parent().parent().find(".quantity").val();
        let p = $(this).parent().parent().parent().parent().find(".amount").val();
        console.log(p);
        let newQ = Number(q);
        let newCost = p * newQ;

        $('#item-in-cart-qty-' + $(this).attr("myindex")).html(newQ);
        $('#item-in-cart-qty-input-' + $(this).attr("myindex")).val(newQ);
        $('#item-in-cart-price-' + $(this).attr("myindex")).html($(this).parent().parent().parent().parent().find(".amount").val());
        $('#item-in-cart-price2-' + $(this).attr("myindex")).html($(this).parent().parent().parent().find(".quantity").val() * $(this).parent().parent().parent().parent().find(".amount").val());
        $('#item-in-cart-price-input-' + $(this).attr("myindex")).attr('value', $(this).parent().parent().parent().parent().find(".amount").val());

        $(this).parent().parent().parent().parent().find(".cost-total-hidden").attr('value', newCost.toFixed(2));
        //console.log($(this).parent().parent().parent().parent().find(".cost-total-hidden").val())
        cartTotal();

        $(this).parent().parent().parent().parent().find(".amount").val('')
        $(this).parent().parent().find(".errors").text("");
    });
</script>
@endpush