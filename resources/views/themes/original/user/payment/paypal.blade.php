@extends($theme.'layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection
@section('content')

    <section class="transaction-history mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h2>{{ 'Pay with '.optional($order->gateway)->name ?? '' }}</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card secbg br-4 bg-light">
                        <div class="card-body text-center br-4">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script src="https://www.paypal.com/sdk/js?client-id={{ $data->cleint_id }}&currency=GBP">
        </script>
        <script>
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [
                            {
                                description: "{{ $data->description }}",
                                custom_id: "{{ $data->custom_id }}",
                                amount: {
                                    currency_code: "{{ $data->currency }}",
                                    value: "{{ $data->amount }}",
                                    breakdown: {
                                        item_total: {
                                            currency_code: "{{ $data->currency }}",
                                            value: "{{ $data->amount }}"
                                        }
                                    }
                                }
                            }
                        ]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        var trx = "{{ $data->custom_id }}";
                        window.location = '{{ url('payment/paypal')}}/' + trx + '/' + details.id
                    });
                }
            }).render('#paypal-button-container');
        </script>
    @endpush
@endsection
