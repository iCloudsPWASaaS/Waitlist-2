@foreach ($plans as $plan)
    <div class="col-md-6 col-lg-4 mb-25">
        <div class="price-card-item h-100 p-30">
            <form class="ajax" action="{{ route('user.subscription.order') }}" method="post"
                enctype="multipart/form-data" data-handler="setPaymentModal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $plan->id }}">
                <input type="hidden" class="plan_type" name="duration_type" value="1">
                <h4 class="font-medium">{{ $plan->name }}</h4>
                <p class="font-13 pb-1 pt-1">{{ $plan->description }}</p>
                <hr>
                <h2 class="price-title price-monthly">{{ $plan->monthly_price }}</h2>
                <h4 class="font-18 font-medium mt-2">{{ __('What’s included') }}</h4>
                <ul class="pricing-features">

                    <li class="d-flex align-items-center mb-3">
                        <span
                            class="price-check-icon d-inline-flex align-items-center justify-content-center status-btn-purple radius-50 me-2">
                            <span class="iconify font-16" data-icon="material-symbols:check-small-rounded"></span>
                        </span>
                        <span class="font-13">{{ __('Manage') }} {{ $plan->max_property }}
                            {{ __('Property') }}</span>
                    </li>
                    {{-- <li class="d-flex align-items-center mb-3">
                        <span
                            class="price-check-icon d-inline-flex align-items-center justify-content-center status-btn-purple radius-50 me-2">
                            <span class="iconify font-16" data-icon="material-symbols:check-small-rounded"></span>
                        </span>
                        <span class="font-13">{{ __('Add') }} {{ $plan->max_unit }}
                            {{ __('Unit') }}</span>
                    </li> --}}
                    <li class="d-flex align-items-center mb-3">
                        <span
                            class="price-check-icon d-inline-flex align-items-center justify-content-center status-btn-purple radius-50 me-2">
                            <span class="iconify font-16" data-icon="material-symbols:check-small-rounded"></span>
                        </span>
                        <span class="font-13">{{ __('Add') }} {{ $plan->max_tenant }}
                            {{ __('Tenant') }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <span
                            class="price-check-icon d-inline-flex align-items-center justify-content-center status-btn-purple radius-50 me-2">
                            <span class="iconify font-16" data-icon="material-symbols:check-small-rounded"></span>
                        </span>
                        <span class="font-13">{{ __('Add') }} {{ $plan->max_maintainer }}
                            {{ __('Maintainer') }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <span
                            class="price-check-icon d-inline-flex align-items-center justify-content-center status-btn-purple radius-50 me-2">
                            <span class="iconify font-16" data-icon="material-symbols:check-small-rounded"></span>
                        </span>
                        <span class="font-13">{{ $plan->max_invoice }} {{ __(' Invoice Ganareate') }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <span
                            class="price-check-icon d-inline-flex align-items-center justify-content-center status-btn-purple radius-50 me-2">
                            <span class="iconify font-16" data-icon="material-symbols:check-small-rounded"></span>
                        </span>
                        <span class="font-13">{{ $plan->max_auto_invoice }} {{ __('Auto Invoice Ganareate') }}</span>
                    </li>
                    @if ($plan->ticket_support == 1)
                        <li class="d-flex align-items-center mb-3">
                            <span
                                class="price-check-icon d-inline-flex align-items-center justify-content-center status-btn-purple radius-50 me-2">
                                <span class="iconify font-16" data-icon="material-symbols:check-small-rounded"></span>
                            </span>
                            <span class="font-13">{{ __('Ticket Support') }}</span>
                        </li>
                    @endif
                    @if ($plan->notice_support == 1)
                        <li class="d-flex align-items-center mb-3">
                            <span
                                class="price-check-icon d-inline-flex align-items-center justify-content-center status-btn-purple radius-50 me-2">
                                <span class="iconify font-16" data-icon="material-symbols:check-small-rounded"></span>
                            </span>
                            <span class="font-13">{{ __('Notice Support') }}</span>
                        </li>
                    @endif

                </ul>
                @if ($plan->id == $currentPlan?->package_id)
                    <button type="button" class="btn-custom current-plan-button mt-15 payment-gateway-1"
                        disabled="disabled" title="{{ __('Current Plan') }}">
                        {{ __('Current Plan') }}
                    </button>
                @else
                    <button type="submit" class="btn-custom mt-15" title="{{ __('Subscribe Now') }}">
                        {{ __('Subscribe Now') }}
                    </button>
                @endif
            </form>
        </div>
    </div>
@endforeach
