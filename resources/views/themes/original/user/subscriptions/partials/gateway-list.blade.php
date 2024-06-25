<div class="col-md-5">
    <div class="tenant-portal-invoice-details-leftside bg-off-white theme-border p-20 radius-4 mb-25">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between mb-25">
                    <h4 class="mb-0">{{ __('Invoice Details') }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table theme-border p-20">
                        <tbody>
                            <tr>
                                <td>{{ __('Name') }}</td>
                                <td>
                                    <h6 class="tenant-invoice-tbl-right-text text-end">
                                        {{ $plan->name }}
                                    </h6>
                                </td>
                            </tr>

                            <tr>
                                <td>{{ __('Amount') }}</td>
                                <td>
                                    <h6 class="tenant-invoice-tbl-right-text text-end">
                                        <input type="hidden" id="planAmount" value="{{ $plan->monthly_price }}">
                                        {{ $plan->monthly_price }}
                                    </h6>
                                </td>
                            </tr>


                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-7">
    <div class="row justify-content-center" id="gatewaySection">
        @foreach ($gateways as $gateway)
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-25">
            <div class="payment-method-item text-center h-100 theme-border radius-10">
                <div class="payment-method-item-title bg-light">
                    <h6 class="font-11 font-semi-bold text-center">{{ $gateway->title }}</h6>
                </div>
                <div class="payment-method-img">
                    <img src="{{ asset($gateway->image) }}" alt="" class="img-fluid">
                </div>
                <button type="button" data-gateway={{ $gateway->slug }} data-id={{ $gateway->id }} data-plan_id={{ $plan->id }} class="theme-btn-outline w-100 mt-25 select-payment-gateway paymentGateway">{{ __('Select') }}</button>
            </div>
        </div>
        @endforeach
    </div>
</div>