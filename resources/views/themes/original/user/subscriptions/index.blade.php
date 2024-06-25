@extends($theme.'layouts.user')

@section('content')
<!-- Right Content Start -->

<style>
    /* extra */
    .price-toggle {
        margin-bottom: 4rem;
    }

    .price-toggle .nav-tabs {
        border: 1px solid #dee2e6;
        padding: 0.25rem;
        border-radius: 2rem;
    }

    .price-toggle .nav-tabs .nav-link {
        height: 2rem;
        line-height: 2rem;
        padding: 0 0.75rem;
        border-radius: 2rem;
        border: 0;
        font-size: 0.875rem;
        color: #6c757d;
    }

    .price-toggle .nav-tabs .nav-link.active {
        color: #fff;
        background-color: #0d6efd;
    }

    .package {
        position: relative;
        padding: 2rem;
        max-width: 400px;
        height: 100%;
        width: 400px;
    }

    .package .badge--popular {
        position: absolute;
        top: 0;
        left: 50%;
        color: #fff;
        width: 10rem;
        height: 2rem;
        line-height: 2rem;
        margin-left: -5rem;
        margin-top: -1rem;
        padding: 0;
        background-color: #0dcaf0;
    }

    .package__title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .package__shortdesc {
        color: #495057;
        font-size: 0.95rem;
        margin-bottom: 1.25rem;
        line-height: 1.5rem;
        min-height: 3rem;
    }

    .package__price--normal {
        margin-bottom: 0.75rem;
    }

    .package__price--normal p {
        color: #6c757d;
        line-height: 1;
        margin-bottom: 0;
    }

    .package__price--normal .badge {
        margin-left: 0.25rem;
        padding: 0.5rem 0.75rem;
    }

    .package__price--sale {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .package__price--sale span {
        display: inline-block;
        font-size: 1rem;
        font-weight: 400;
    }

    .package__cta .btn {
        margin-bottom: 0.5rem;
    }

    .package__cta p {
        color: #6c757d;
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    .package__features {
        margin-top: 2rem;
    }

    .package__features h4,
    .package__features .h4 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .package__features ul {
        margin-bottom: 0;
        padding-left: 1.5rem;
    }

    .package__features ul.icon-list {
        padding-left: 0;
        list-style-type: none;
    }

    .package__features ul.icon-list li {
        position: relative;
        padding-left: 1.5rem;
    }

    .package__features ul.icon-list i {
        position: absolute;
        left: 0;
        top: 0;
        margin-right: 0.5rem;
    }

    .package__features ul li {
        color: #6c757d;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        font-weight: 400;
    }

    .package__features ul li.disabled,
    .package__features ul li.disabled span {
        color: #adb5bd;
    }

    .package__features ul li:last-child {
        margin-bottom: 0;
    }

    .package__features ul li span {
        color: #495057;
        font-weight: 600;
    }

    [data-bs-theme=dark] .package__title {
        color: #fff;
    }

    [data-bs-theme=dark] .package__shortdesc {
        color: #ced4da;
    }

    [data-bs-theme=dark] .package__price--normal p {
        color: #adb5bd;
    }

    [data-bs-theme=dark] .package__price--sale {
        color: #fff;
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    [data-bs-theme=dark] .package__price--sale span {
        display: inline-block;
        font-size: 1rem;
        font-weight: 400;
    }

    [data-bs-theme=dark] .package__cta p {
        color: #adb5bd;
    }

    [data-bs-theme=dark] .package__features h4,
    [data-bs-theme=dark] .package__features .h4 {
        color: #fff;
    }

    [data-bs-theme=dark] .package__features ul li {
        color: #adb5bd;
    }

    [data-bs-theme=dark] .package__features ul li.disabled,
    [data-bs-theme=dark] .package__features ul li.disabled span {
        color: #495057;
    }

    [data-bs-theme=dark] .package__features ul li span {
        color: #ced4da;
    }


    .rounded-4 {
        border-radius: 15px !important;
    }
</style>

<div class="container-fluid">

    <!-- Page Content Wrapper Start -->
    <div class="main row">
        <div class="col-12">
            <div class="col-md-12">
                <!-- Choose a plan content Start -->
                <div class="choose-plan-area">
                    <div class="pricing-plan-area">
                        <div class="row price-table-wrap">
                            @foreach ($packages as $package)
                            <div class="col-lg-3 d-flex justify-content-center">

                                <div class="package border border-body rounded-4 dashboard-box">
                                    <div class="text-center">
                                        <h3 class="package__title">{{ $package->name }}</h3>
                                        <!-- <p class="package__shortdesc">{{ $package->title }}</p> -->
                                        <!-- <div class="package__price package__price--normal d-inline-flex align-items-center">
                                            <p>$11.99</p><span class="badge rounded-pill text-bg-primary">SAVE 75%</span>
                                        </div> -->
                                        <p class="package__price package__price--sale mb-0">£ {{ $package->monthly_price }}</p>
                                        @if($package->id == 5)
                                        <p style="font-size: 14px;" class="mb-0">&nbsp;</p>                                      
                                        @endif

                                        @if ($package->id == 3)
                                        <p style="font-size: 14px;" class="mb-0">Lifetime Benefits</p>
                                        @else
                                        <p style="font-size: 14px;" class="mb-0">Monthly</p>
                                        @endif
                                    </div>
                                    <div class="package__cta text-center">
                                        @if($package->id != 6)
                                        <a href="#" class="btn btn-lg btn-custom">Buy plan</a>
                                        @else
                                        <a href="#" class="btn btn-lg btn-custom" style="background-color: #ddd;">Current Plan</a>
                                        @endif
                                    </div>
                                    <div class="package__features">
                                        <ul>
                                            @if(isset($package->app_features))
                                            @foreach ($package->app_features as $app_feature)
                                            <li class="d-flex align-items-center mb-3">
                                                <span class="price-check-icon flex-shrink-0 d-inline-flex align-items-center justify-content-center status-btn-blue radius-50 me-2">
                                                    <span class="iconify font-16" data-icon="material-symbols:check-small-rounded"></span>
                                                </span>
                                                <span class="flex-grow-1">{{ $app_feature['name'] }}
                                                </span>
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                </div>

                            </div>


                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Choose a plan content End -->
            </div>



        </div>


        @if (!is_null($userPlan))
        <div class="card">
            <div class="card-body">
                <form action="{{ route('owner.subscription.cancel') }}" method="post">
                    @csrf
                    <button type="button" class="theme-btn-red subscriptionCancel" title="Cancel your subscription">{{ __('Cancel your subscription') }}</button>
                </form>
            </div>
            <p class="mt-3">
                {{ __('Please be aware that cancelling your subscription will cause you to lose all your saved content and earned words on your subscription.') }}
            </p>
        </div>
        @endif

    </div>
</div>
</div>
<!-- End Page-content -->

<!-- Right Content End -->
@if (!is_null(request()->id))
<input type="hidden" id="requestPlanId" value="{{ request()->id }}">
<input type="text" id="gatewayResponse" value="{{ $gateways }}">
@endif
<input type="hidden" id="requestCurrentPlan" value="{{ request()->current_plan }}">



<!-- Choose a plan Modal Start -->




<div class="modal fade big-modal" id="choosePlanModal" tabindex="-1" aria-hidden="true">
    <input type="hidden" id="chooseAPanRoute" value="{{ route('user.subscription.get_plan') }}">
    <input type="hidden" id="getCurrencyByGatewayRoute" value="{{ route('user.subscription.get.currency') }}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h4 class="modal-title" id="editModalLabel">@lang('Choose A Plan')</h4>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Choose a plan content Start -->
                <div class="choose-plan-area">

                    <div class="pricing-plan-area px-5">
                        <div class="row price-table-wrap" id="planListBlock">
                        </div>
                    </div>
                </div>
                <!-- Choose a plan content End -->
            </div>
        </div>
    </div>
</div>
<!-- Choose a plan Modal End -->

<!-- Payment Method Modal Start -->
<div class="modal fade big-modal" id="paymentMethodModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h4 class="modal-title" id="editModalLabel">@lang('Select Payment Method')</h4>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Choose a plan content Start -->
                <div class="payment-method-area">
                    <div class="payment-method-wrap px-5">
                        <form class="" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="plan_id" name="package_id" value="">
                            <input type="hidden" id="selectGateway" name="gateway">
                            <input type="hidden" id="selectCurrency" name="currency">
                            <input type="hidden" id="duration_type" name="duration_type">
                            <div class="row" id="gatewayListBlock">
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn-custom mb-1 w-75" id="payBtn">{{ __('Pay Now') }}
                                        <span class="ms-1" id="gatewayCurrencyAmount"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Choose a plan content End -->
            </div>
        </div>
    </div>
</div>
<!-- Payment Method Modal End -->
@endsection

@push('script')
<script src="https://office.applebyproperty.co.uk/assets/js/iconify.min.js"></script> <!-- extra -->
<script src="{{ asset('assets/libs/subscription/common.js') }}"></script>
<script src="{{ asset('assets/libs/subscription/owner-subscription.js') }}"></script>
@endpush