<div class="modal fade" id="investNowModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form action="" method="post" id="invest-form" class="login-form invest_now_modal">
            <input type="hidden" class="property-id" value="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title investHeading" id="staticBackdropLabel"></h5>
                    <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="fal fa-times"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="payment-form">
                        <div
                            class="payment-method-details property-title primary_color mb-2 fw-bold">
                        </div>

                        <div class="">
                            <div class="estimation-box">
                                <div class="details_list">
                                    <ul>

                                        <li class="d-flex justify-content-between"><span>@lang('Invest')</span>
                                            <span class="data_invest"></span></li>
                                        <li class="d-flex justify-content-between"><span>@lang('Profit')</span>
                                            <span class="data_profit"></span></li>

                                    </ul>
                                </div>
                            </div>
                            @auth
                                <div class="row g-3 investModalPaymentForm">
                                    <!-- <div class="input-box col-12">
                                        <label for="">@lang('Select Payment Method')</label>
                                        <select name="method_id" class="form-control" id="method_id">
                                            <option value="">@lang('Choose items')</option>
                                            @if (isset($methods) )
                                            @foreach($methods as $method)
                                                <option
                                                    value="{{ $method->id }}" {{ old('method_id') == $method->id ? 'selected' : '' }}
                                                    data-id = "{{ $method->id }}"
                                                    data-name="{{$method->name}}"
                                                    data-currency="{{$method->currency}}"
                                                    data-gateway="{{$method->code}}"
                                                    data-min_amount="{{getAmount($method->min_amount, $basic->fraction_number)}}"
                                                    data-max_amount="{{getAmount($method->max_amount,$basic->fraction_number)}}"
                                                    data-percent_charge="{{getAmount($method->percentage_charge,$basic->fraction_number)}}"
                                                    data-fix_charge="{{getAmount($method->fixed_charge, $basic->fraction_number)}}"
                                                    >{{ $method->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div> -->

                                    <div class="input-box col-12">
                                        <label for="">@lang('Select Wallet')</label>
                                        <select class="form-control form-select" id="exampleFormControlSelect1"
                                                name="balance_type">
                                            @auth
                                                <option
                                                    value="balance">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                                <option
                                                    value="interest_balance">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                            @endauth
                                        </select>
                                    </div>

                                    <div class="input-box col-12">
                                        <label for="">@lang('Amount')</label>
                                        <div class="input-group">
                                            <input
                                                type="text" class="invest-amount form-control" name="amount"
                                                id="amount"
                                                value="{{old('amount')}}"
                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                autocomplete="off"
                                                placeholder="@lang('Enter amount')">
                                            <button class="show-currency"></button>
                                        </div>
                                    </div>

                                    <pre class="text-danger errors"></pre>
                                </div>
                            @endauth
                        </div>
                    </div>

                    <div class="payment-info text-center">
                        <img id="loading" src="{{asset('assets/admin/images/loading.gif')}}" alt="@lang('loader')" class="w-15"/>
                    </div>
                </div>

                <div
                    class="modal-footer {{ \Auth::check() == true ? '' : 'd-block' }}">
                    @auth
                        <button type="button"
                                class="btn-custom btn2 btn-secondary close_invest_modal close__btn"
                                data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn-custom investModalSubmitBtn">@lang('Invest')</button>
                        <!-- <button type="button" class="btn-custom checkCalc">@lang('Next')</button> -->
                    @else

                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="text-center font-weight-bold">@lang('First Log In To Your Account For Invest')</h6>
                                    <div class="tree">
                                        <div class="d-flex justify-content-center">
                                            <div class="branch branch-1">@lang('Sign In / Sign Up')</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="branch branch-2"><a href="{{ route('login') }}"
                                                                            class="text-decoration-underline">@lang('Login')</a>
                                            </div>
                                            <div class="branch branch-3"><a href="{{ route('register') }}"
                                                                            class="text-decoration-underline">@lang('Register')</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </form>
    </div>
</div>


@push('script')
<script>
    $('#loading').hide();
    "use strict";
    var id, minAmount, maxAmount, baseSymbol, fixCharge, percentCharge, currency, amount, gateway, propertyId;

    $(document).ready(function () {

            $("#method_id").on("change",function(){
                //var dataid = $("#method_id option:selected").attr('data-id');
                //alert($("#method_id option:selected").attr('data-gateway'))

                id = $("#method_id option:selected").attr('data-id');
                gateway = $("#method_id option:selected").attr('data-gateway');
                minAmount = $("#method_id option:selected").attr('data-min_amount');
                maxAmount = $("#method_id option:selected").attr('data-max_amount');
                baseSymbol = "{{config('basic.currency_symbol')}}";
                fixCharge = $("#method_id option:selected").attr('data-gateway');
                percentCharge = $("#method_id option:selected").attr('data-fix_charge');
                currency = $("#method_id option:selected").attr('data-currency');
            });

            $(".checkCalc").on('click', function () {
                $('.payment-form').addClass('d-none');

                $('#loading').show();
                $('.modal-backdrop.fade').addClass('show');
                amount = $('#amount').val();
                propertyId = $('.property-id').val();

                $.ajax({
                    url: "{{route('user.addFund.request')}}",
                    type: 'POST',
                    data: {
                        amount,
                        gateway,
                        propertyId
                    },
                    success(data) {

                        $('.payment-form').addClass('d-none');
                        $('.checkCalc').closest('.modal-footer').addClass('d-none');

                        var htmlData = `
                         <ul class="list-group text-center">
                            <li class="list-group-item bg-transparent list-text customborder">
                                <img src="${data.gateway_image}"
                                    style="max-width:100px; max-height:100px; margin:0 auto;"/>
                            </li>
                            <li class="list-group-item bg-transparent list-text customborder">
                                @lang('Amount'):
                                <strong>${data.amount} </strong>
                            </li>
                            <li class="list-group-item bg-transparent list-text customborder">@lang('Charge'):
                                    <strong>${data.charge}</strong>
                            </li>
                            <li class="list-group-item bg-transparent list-text customborder">
                                @lang('Payable'): <strong> ${data.payable}</strong>
                            </li>
                            <li class="list-group-item bg-transparent list-text customborder">
                                @lang('Conversion Rate'): <strong>${data.conversion_rate}</strong>
                            </li>
                            <li class="list-group-item bg-transparent list-text customborder">
                                <strong>${data.in}</strong>
                            </li>

                            ${(data.isCrypto == true) ? `
                            <li class="list-group-item bg-transparent list-text customborder">
                                ${data.conversion_with}
                            </li>
                            ` : ``}

                            <li class="list-group-item bg-transparent">
                            <a href="${data.payment_url}" class="btn btn-custom addFund text-white">@lang('Pay Now')</a>
                            </li>
                            </ul>`;

                        $('.payment-info').html(htmlData)
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                    error(err) {
                        var errors = err.responseJSON;
                        for (var obj in errors) {
                            $('.errors').text(`${errors[obj]}`)
                        }

                        $('.payment-form').removeClass('d-none');
                    }
                });
            });
        });
</script>
@endpush

<!--extra-->