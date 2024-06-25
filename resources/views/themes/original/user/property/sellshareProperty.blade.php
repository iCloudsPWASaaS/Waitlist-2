@if(count($myProperties) > 0)
    <div class="col-lg-12">
        <div class="row g-4 mb-5">
            @foreach($myProperties as $key => $myProperty)
                <div class="col-md-4 col-lg-4">
                    @include($theme.'partials.propertyBox2', ['page' => $page_tab])
                </div>
            @endforeach
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{ $myProperties->appends($_GET)->links() }}
            </ul>
        </nav>
    </div>
@else
    <div class="custom-not-found mt-5">
        <img src="{{ asset($themeTrue.'img/no_data_found.png') }}" alt="@lang('not found')" class="img-fluid">
    </div>
@endif

@push('loadModal')
    {{--  Direct Buy share modal --}}
    <div class="modal fade" id="directBuyShareModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <form action="" method="post" id="invest-form"
                  class="login-form direct_share_payment_form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">@lang('Buy Share')</h5>
                        <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card">
                            <div class="m-3 mb-0 payment-method-details property_title font-weight-bold">
                            </div>

                            <div class="card-body">
                                <div class="row g-3 investModalPaymentForm">
                                    <div class="input-box col-12">
                                        <label for="">@lang('Property Owner')</label>
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                class="form-control property_owner"
                                                name="property_owner" id="property_owner"
                                                value=""
                                                autocomplete="off"
                                                readonly>
                                        </div>
                                    </div>

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
                                        <label for="">@lang('Payable Amount')</label>
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                class="invest-amount payable_amount form-control @error('amount') is-invalid @enderror"
                                                name="amount" id="payable_amount"
                                                value="{{old('amount')}}"
                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                autocomplete="off"
                                                placeholder="@lang('Enter amount')" required readonly>
                                            <button class="show-currency" type="button"></button>
                                        </div>
                                        @error('amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-custom btn2 btn-secondary close_invest_modal close__btn"
                                data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn-custom">@lang('Pay Now')</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endpush

@push('script')
    <script>
        'use strict'
        $(document).on('click', '.directBuyShare', function () {
            var directBuyShare = new bootstrap.Modal(document.getElementById('directBuyShareModal'))
            directBuyShare.show();

            let dataRoute = $(this).data('route');
            console.log(dataRoute);
            let payableAmount = $(this).data('payableamount');
            let dataPropertyOwner = $(this).data('propertyowner');
            let dataProperty = $(this).data('property');

            $('.payable_amount').val(payableAmount);
            $('.property_owner').val(dataPropertyOwner);
            $('.property_title').text(`Property: ${dataProperty}`);
            $('.direct_share_payment_form').attr('action', dataRoute);
            $('.show-currency').text("{{config('basic.currency')}}");
        });
    </script>
@endpush