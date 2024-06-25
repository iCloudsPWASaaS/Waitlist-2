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
                    <!--<h2>{{ 'Pay with '.optional($order->gateway)->name ?? '' }}</h2>-->
                    <h4>Cart</h4>
                </div>
            </div>
        </div>

        <!--extra-->
        @include($theme.'user.payment.common')
    </div>
 </section>

    @push('script')
        <script>
            $(document).ready(function () {
                $('button[type="submit"]').removeClass("stripe-button-el").addClass("btn btn-bg btn-custom text-white").find('span').css('min-height', 'initial');
            })
        </script>
    @endpush

@endsection



