@extends($theme.'layouts.user')
@section('title')
{{ 'Pay with '.optional($order->gateway)->name ?? '' }}
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
</style>




<section class="transaction-history mt-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h2>{{ 'Pay with '.optional($order->gateway)->name ?? '' }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">

                <div class="row align-items-center">
                    <!-- <div class="col-md-3">
                        <img src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}" class="card-img-top gateway-img br-4" alt="..">
                    </div> -->

                    <div class="col-md-12">
                        <!-- <h4>@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                @if(!$order->property_id)
                                <h4 class="my-3">@lang('To Get') {{getAmount($order->amount)}} {{$basic->currency}}</h4>
                                @endif -->
                        <!-- <form action="{{$data->url}}" method="{{$data->method}}">
                                    <script
                                        src="{{$data->src}}"
                                        class="stripe-button"
                                        @foreach($data->val as $key=> $value)
                                        data-{{$key}}="{{$value}}"
                                        @endforeach>
                                    </script>
                        </form> -->


                        <form action="{{$data->url}}" method="{{$data->method}}" id="payment-form">
                            {{ csrf_field() }}

                            @foreach($order->investments_id as $key=> $id)
                            <input type="hidden" name="investments_id[]" value="{{$id}}">
                            <input type="hidden" name="investments_amount[]" value="{{$order->investments_amount[$key]}}">
                            <input type="hidden" name="investments_card_quantity[]" value="{{$order->investments_card_quantity[$key]}}">
                            @endforeach

                            <input type="hidden" name="order[final_amount]" value="{{$order->final_amount}}">

                            <div class="row">
                                <div class="col-3">
                                    <p class="float-start">Transaction reference</p>
                                </div>

                                <div class="col-9">
                                    <p class="float-start"><b class="text--base">{{$order->transaction}}</b></p>
                                </div>

                                <div class="col-3">
                                    <p class="float-start">Transaction amount</p>
                                </div>

                                <div class="col-9">
                                    <p class="float-start"><b class="text--base">{{getAmount($order->final_amount)}} {{$order->gateway_currency}}</b></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email">
                            </div>

                            <div class="form-group">
                                <label for="name_on_card">Name on Card</label>
                                <input type="text" class="form-control" id="name_on_card" name="name_on_card">
                            </div>


                            <div class="form-group">
                                <label for="card-element">Credit Card</label>
                                <div id="card-element">
                                    <!-- a Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>

                            <div class="spacer"></div>

                            <button type="submit" class="btn btn-success mt-2">Submit Payment</button>
                        </form>


                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

@push('script')
<script>
    (function() {
        // Create a Stripe client
        var stripe = Stripe('{{ $data->val->key }}');

        // Create an instance of Elements
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Raleway", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });

        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var options = {
                name: document.getElementById('name_on_card').value,
            }

            stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    })();
</script>

<!-- <script>
            $(document).ready(function () {
                $('button[type="submit"]').removeClass("stripe-button-el").addClass("btn btn-bg btn-custom text-white").find('span').css('min-height', 'initial');
            })
</script> -->

<script> /* extra */
$('form#payment-form').submit(function(e){
    $(this).children('input[type=submit]').attr('disabled', 'disabled');
    e.preventDefault(); 
    return false;
});

</script>
@endpush

@endsection