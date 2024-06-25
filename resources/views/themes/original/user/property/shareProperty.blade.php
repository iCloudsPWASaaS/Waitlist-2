@if(count($sharedProperties) > 0)
    <div class="col-lg-12">
        <div class="row g-4 mb-5">
            @foreach($sharedProperties as $key => $shareProperty)
                <div class="col-md-4 col-lg-4">
                    <div class="property-box">
                        <div class="img-box">
                            <img class="img-fluid"
                                 src="{{ getFile(config('location.propertyThumbnail.path').$shareProperty->property->thumbnail) }}"
                                 alt="@lang('property thumbnail')"/>
                            <div class="content">
                                <div class="tag">@lang(optional($shareProperty->property->getAddress->details)->title)</div>

                                <div class="badges">
                                    <button class="save wishList" type="button" id="{{$key}}" data-property="{{ $shareProperty->property->id }}">
                                        @if($shareProperty->property->get_favourite_count > 0)
                                            <i class="fas fa-heart save{{$key}}"></i>
                                        @else
                                            <i class="fal fa-heart save{{$key}}"></i>
                                        @endif
                                    </button>
                                </div>

                                <!--<h4 class="price">{{ $shareProperty->property->investmentAmount }}</h4>-->
                                <h4 class="price">{{ config('basic.currency_symbol') }}{{ (int)$shareProperty->amount }}</h4>
                            </div>
                        </div>

                        <div class="text-box">
                            @php
                            $shareProperty->property_tags = explode(",",  $shareProperty->property->property_tags);
                            @endphp

                            @if ($shareProperty->property->property_tags)
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-8">
                                @foreach ($shareProperty->property_tags as $shareProperty->property_tag)
                                   <span class="badge">{{ $shareProperty->property_tag }}</span>
                                @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-8">
                                @guest
                                <a class="title" href="{{ route('login') }}">{{ \Str::limit(optional($shareProperty->property->details)->property_title, 30)  }}</a>
                                @endguest
                                @auth
                                <a class="title" href="{{ route('propertyDetails',[slug(optional($shareProperty->property->details)->property_title), $shareProperty->property->id]) }}">{{ \Str::limit(optional($shareProperty->property->details)->property_title, 30)  }}</a>
                                @endauth
                                </div>
                            </div>



                            <style>
                            table{
                                border-collapse: separate;
                                border-spacing: 0;
                            }
                            tr{

                            }
                            td{
                                padding: 10px 30px;
                                background-color: #0f2034;
                                color: #FFF;
                            }
                            tr:first-child td:first-child{
                                border-top-left-radius: 10px;
                            }
                            tr:last-child td:first-child{
                                border-bottom-left-radius: 10px;
                            }
                            tr:first-child td:last-child{
                                border-top-right-radius: 10px;
                            }
                            tr:last-child td:last-child{
                                border-bottom-right-radius: 10px;
                            }
                            </style>

                            <div class="row">
                                <div class="col-8">
                                        <!--<table>
                                            <tr>
                                                <td>Deal Type</td>
                                                <td>{{ ucwords($shareProperty->property->type_of_deal) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Issued</td>
                                                <td>{{ $shareProperty->property->card_issued }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sold</td>
                                                <td>{{ $shareProperty->property->card_issued }}</td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td>{{ config('basic.currency_symbol') }}{{ $shareProperty->property->total_investment_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td>ROI</td>
                                                <td>{{ config('basic.currency_symbol') }}{{ $shareProperty->property->profit }}</td>
                                            </tr>
                                        </table>-->
                                        <div class="aminities" style="flex-direction: column; color: white;">
                                            <span style="margin-bottom:10px;">Deal Type: {{ ucwords($shareProperty->property->type_of_deal) }}</span>
                                        </div>

                                        <div class="aminities" style="flex-direction: column; color: white;">
                                            <span style="margin-bottom:10px;">Issued: {{ $shareProperty->property->card_issued > $shareProperty->property->card_remain ? $shareProperty->property->card_issued - $shareProperty->property->card_remain : '' }}</span>
                                        </div>

                                        <div class="aminities" style="flex-direction: column; color: white;">
                                            <span style="margin-bottom:10px;">Sold: {{ $shareProperty->property->card_issued > $shareProperty->property->card_remain ? $shareProperty->property->card_issued - $shareProperty->property->card_remain : '' }}</span>
                                        </div>

                                        <div class="aminities" style="flex-direction: column; color: white;">
                                            <span style="margin-bottom:10px;">Price: {{ config('basic.currency_symbol') }}{{ $shareProperty->property->total_investment_amount }}</span>
                                        </div>

                                        <div class="aminities" style="flex-direction: column; color: white;">
                                            <span style="margin-bottom:10px;">ROI: {{ config('basic.currency_symbol') }}{{ $shareProperty->property->profit }}</span>
                                        </div>
                                </div>
                                <div class="col-4">
                                    <div class="aminities" style="flex-direction: column; color: white;">
                                        @foreach($shareProperty->property->limitamenity as $key => $amenity)
                                            <span style="margin-bottom:10px;"><i class="{{ $amenity->icon }}"></i>{{ optional($amenity->details)->title  }}</span>
                                        @endforeach
                                    </div>

                                    <div class="aminities" style="flex-direction: column; color: white;">

                                        @foreach($shareProperty->property->limitfacility as $key => $facility)
                                            <span style="margin-bottom:10px;"><i class="fas fa-info"></i>{{ $facility->title }}</span>
                                        @endforeach

                                    </div>
                                </div>
                            </div>



                            <div class="invest-btns d-flex justify-content-between" style="border-bottom: 0px;"> <!--extra-->
                                @guest
                                <a href="{{ route('login') }}" role="button">@lang('Invest Now')</a>
                                @endguest
                                @auth
                                <button type="button" class="btn buyShare directBuyShare {{ optional($shareProperty->user)->id == Auth::id() ? 'disabled' : '' }}"
                                        data-route="{{route('user.directBuyShare', $shareProperty->id)}}"
                                        data-payableamount="{{ $shareProperty->amount }}"
                                        data-propertyowner="{{ optional($shareProperty->user)->fullname }}"
                                        data-property="{{ optional(optional($shareProperty->property)->details)->property_title }}">
                                    @lang('Direct Buy Share')
                                </button>
                                @endauth

                                <!--<a href="{{ route('contact') }}">
                                    @lang('Contact Us')
                                </a>-->
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{ $sharedProperties->appends($_GET)->links() }}
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

                                    <!--extra-->
                                    <!--<div class="input-box col-12">
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
                                    </div>-->

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