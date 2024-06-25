@extends($theme.'layouts.user')
@section('title')
{{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection

@section('content')
<section class="transaction-history mt-4">
    <div class="container">
        <div class="row">
            <div class="col ms-2">
                <div class="header-text-full">
                    <h3 class="dashboard_breadcurmb_heading">{{ 'Pay with '.optional($order->gateway)->name ?? '' }}</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="row ">
                    <div class="col-md-12">
                        <!-- <h4 class="title text-center">{{trans('Please follow the instruction below')}}</h4>
                                <p class="text-center mt-2 ">{{trans('You have requested to deposit')}} <b class="text--base">{{getAmount($order->amount)}}
                                        {{$basic->currency}}</b> , {{trans('Please pay')}}
                                    <b class="text--base">{{getAmount($order->final_amount)}} {{$order->gateway_currency}}</b> {{trans('for successful payment')}}
                                </p> -->

                        <!-- <p class="mt-2 ">
                                    <?php echo optional($order->gateway)->note; ?>
                                </p> -->

                        <form action="{{ route('user.addFund.fromSubmit')}}" method="post" enctype="multipart/form-data" class="form-row  preview-form">
                            @csrf

                            @foreach($order->investments_id as $key=> $id)
                            <input type="hidden" name="investments_id[]" value="{{$id}}">
                            <input type="hidden" name="investments_amount[]" value="{{$order->investments_amount[$key]}}">
                            <input type="hidden" name="investments_card_quantity[]" value="{{$order->investments_card_quantity[$key]}}">
                            @endforeach

                            <input type="hidden" name="order[final_amount]" value="{{$order->final_amount}}">
                            <input type="hidden" name="code" value="{{optional($order->gateway)->code}}">
                            <input type="hidden" name="trx" value="{{$order->transaction}}">

                            <div class="row ">
                                <div class="col-md-12 ">
                                    <p class=" form-group mb-10" style="font-size: 1.25rem;">
                                        Please copy the details below into your online banking transfer section to complete the purchase. Once you have sent the transaction please click the button at the bottom of the section to confirm
                                    </p>
                                </div>

                                <div class="col-2">
                                    <p class="float-start">Company name</p>
                                </div>

                                <div class="col-10">
                                    <p class="float-start"><b class="text--base">{{config('basic.site_title')}}</b></p>
                                </div>

                                <div class="col-2">
                                    <p class="float-start">Account number</p>
                                </div>

                                <div class="col-10">
                                    <p class="float-start"><b class="text--base">645789645</b></p>
                                </div>

                                <div class="col-2">
                                    <p class="float-start">Sort Code</p>
                                </div>

                                <div class="col-10">
                                    <p class="float-start"><b class="text--base">58-98-68</b></p>
                                </div>

                                <div class="col-2">
                                    <p class="float-start">SWIFT/BIC</p>
                                </div>

                                <div class="col-10">
                                    <p class="float-start"><b class="text--base">LOYDGB2L</b></p>
                                </div>

                                <div class="col-2">
                                    <p class="float-start">Bank name</p>
                                </div>

                                <div class="col-10">
                                    <p class="float-start"><b class="text--base">Lloyds Bank</b></p>
                                </div>

                                <div class="col-2">
                                    <p class="float-start">Bank address</p>
                                </div>

                                <div class="col-10">
                                    <p class="float-start"><b class="text--base">110 High Street, Leeds, LS1 1SN</b></p>
                                </div>

                                <div class="col-2">
                                    <p class="float-start">Transaction reference</p>
                                </div>

                                <div class="col-10">
                                    <p class="float-start"><b class="text--base">{{$order->transaction}}</b></p>
                                </div>

                                <div class="col-2">
                                    <p class="float-start">Transaction amount</p>
                                </div>

                                <div class="col-10">
                                    <p class="float-start"><b class="text--base">{{getAmount($order->final_amount)}} {{$order->gateway_currency}}</b></p>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class=" form-group">
                                    <button type="submit" class="btn-custom w-100 mt-3">
                                        <span>@lang('Payment Sent')</span>
                                    </button>

                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <p class=" form-group" style="font-size: 12px; font-style: italic;">
                                    Note that bank transfers are not an instant payment method. Your property card will not be visible in your Portfolio section until we have received your payment and the purchase has been approved. For instant purchase please pay by <a href="{{ route('user.invest-property-cart')}}">Paypal or Credit/Debit card</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


@push('css-lib')
<link rel="stylesheet" href="{{asset($themeTrue.'css/bootstrap-fileinput.css')}}">
@endpush

@push('extra-js')
<script src="{{asset($themeTrue.'js/bootstrap-fileinput.js')}}"></script>
@endpush
@endsection