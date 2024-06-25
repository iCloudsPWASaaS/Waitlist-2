<?php $__env->startSection('title',trans('Dashboard')); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startPush('style'); ?>

<!-- <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/bootstrap-datepicker.css')); ?>" /> --> <!-- extra -->

<style>
    .balance-box {
        background: linear-gradient(to right, {
                {
                hex2rgba(config('basic.base_color'))
            }
        }

        , {
            {
            hex2rgba(config('basic.secondary_color'))
        }
    });
    }


    /* extra */
    .text-black {
        margin: 15px 0px;
    }




    .slide-container {
        /* max-width: 1120px; */
        width: 100%;
        padding: 40px 0;
    }

    .slide-content {
        margin: 0 40px;
        /* overflow: hidden; */
        border-radius: 0px;
    }

    .card {
        border-radius: 0px;
        background-color: #FFF;
    }

    .image-content,
    .card-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px 14px;
    }



    .swiper-navBtn {
        color: #6E93f7;
        transition: color 0.3s ease;
    }

    .swiper-navBtn:hover {
        color: #4070F4;
    }

    .swiper-navBtn::before,
    .swiper-navBtn::after {
        font-size: 35px;
    }

    .swiper-button-next {
        right: 0;
    }

    .swiper-button-prev {
        left: 0;
    }

    .swiper-pagination-bullet {
        background-color: #6E93f7;
        opacity: 1;
    }

    .swiper-pagination-bullet-active {
        background-color: #4070F4;
    }

    @media  screen and (max-width: 768px) {
        .slide-content {
            margin: 0 10px;
        }

        .swiper-navBtn {
            display: none;
        }
    }

    /* extra */

    /* Add your custom CSS styles here */
    .master-table {
        border-collapse: collapse;
        width: 100%;
    }

    .master-table th,
    .master-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .detail-table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
        /* Adjust spacing as needed */
    }

    .detail-table th,
    .detail-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .toggle-icon {
        cursor: pointer;
        font-size: 28px;
    }

    .group {
        cursor: pointer;
    }

    .group-content {
        display: none;
    }

    .collapsed-icon::before {
        content: "+";
    }

    .expanded-icon::before {
        content: "-";
    }

    /* extra tooltip */
    #content .dashboard-box .tooltip_info {
        font-size: 28px;
        position: absolute;
        right: 10px;
        top: 20%;
        transform: translateY(-50%);
        margin: auto;
    }
</style>
<?php $__env->stopPush(); ?>
<!-- Balance Box -->
<div class="container-fluid">
    <div class="main row">
        <div class="col-12">
            <div class="row g-3">
                <div class="col-xl-12">
                    <div class="row g-3">
                        <div class="col-12 d-none">
                            <div class="dashboard-box">
                                <!-- <a href="<?php echo e(route('user.subscription.index')); ?>" target="_blank">Upgrade Section</a> -->
                                <a class=" btn-custom" style="background-color: #fff; width: 250px !important; color: black;border-radius: 15px;border: 1px solid #ddd;" href="#">Become a Premium Member</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 box">
                    <div class="dashboard-box">
                        <div class="row">
                            <div class="col-7">
                                <span><?php echo app('translator')->get('Total Money Invested'); ?></span>
                            </div>

                            <div class="col-12">
                                <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(getAmount($investment['runningInvestAmount'], 2)); ?></span></h3>
                            </div>
                            <div class="col-12 mb-4">
                                <span>&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 box">
                    <div class="dashboard-box">
                        <div class="row">
                            <div class="col-7">
                                <span><?php echo app('translator')->get('Value of Portfolio'); ?></span> 
                                <i class="fa fa-info-circle tooltip_info" rel="tooltip" data-html="true" title="" aria-hidden="true" data-bs-original-title="The sum of all property cards that you own with any value appreciation applied.
" style="color: #ddd;"></i>
                            </div>

                            <div class="col-12">
                                <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(getAmount($investment['runningInvestAmount'], 2)); ?></span></h3>
                            </div>
                            <div class="col-12 mb-4">
                                <span>&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 box">
                    <div class="dashboard-box">
                        <div class="row">
                            <div class="col-7">
                                <span>Annual investment limit</span>
                            </div>

                            <div class="col-5 d-none">
                                <?php if(auth()->user()->premium_user==0): ?>
                                <a class=" btn btn-primary" id="premium_user" style="background-color: #fff; color: black; font-size: .9rem;" href="#">Upgrade Plan</a>
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                                <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(getAmount($configure->annual_investment_limit, 2)); ?></span></h3>
                            </div>
                            <div class="col-12 mb-4">
                                <span>Free user limit</span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-12 d-sm-block">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="dashboard-box">
                                <!-- <div class="row g-3">
                                    <div class="col-4">
                                        <h5 class="text-black"><?php echo app('translator')->get('Total Money Invested'); ?></h5>
                                        <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(getAmount($investment['runningInvestAmount'])); ?></span></h3>
                                    </div>

                                    <div class="col-4">
                                        <h5 class="text-black"><?php echo app('translator')->get('Value of Portfolio'); ?></h5>
                                        <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(getAmount($investment['runningInvestAmount'])); ?></span></h3>
                                    </div>
                                </div> -->

                                <!--<i class="far fa-funnel-dollar text-white"></i>-->

                                <div class="slide-container swiper shop-section">
                                    <div class="slide-content">
                                        <div class="card-wrapper swiper-wrapper">
                                            <?php $__currentLoopData = $myPropertiesInvested; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $myProperty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="card swiper-slide">
                                                <?php echo $__env->make($theme.'partials.propertyBox2', ['page' => 'dashboard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>

                                    <div class="swiper-button-next swiper-navBtn"></div>
                                    <div class="swiper-button-prev swiper-navBtn"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!--<div class="col-xl-12 col-6 box">
                                <div class="dashboard-box gr-bg-4">
                                    <h5 class="text-white"><?php echo app('translator')->get('Running Invest'); ?></h5>
                                    <h3 class="text-white"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span> <?php echo e(getAmount($investment['runningInvestAmount'])); ?></span></h3>
                                    <i class="far fa-funnel-dollar text-white"></i>
                                </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- main -->
<div class="container-fluid">
    <div class="main row">
        <div class="col-12">
            <div class="dashboard-box-wrapper d-lg-block">
                <div style="background-color: var(--none);box-shadow: var(--none);">
                    <h5 class="text-black"><?php echo app('translator')->get('Key Financials'); ?></h5>
                    <div class="row g-3 mb-4">
                        <div class="col-xl-4 col-md-6 box">
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-6">
                                        <img style="
                                        position: relative;
                                        width: 32px;
                                        height: 32px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="<?php echo e(url('./public/dashboard/poundsterling-1.svg')); ?>">
                                    </div>
                                    <div class="col-6">
                                        <i class="fa fa-info-circle tooltip_info" rel="tooltip" data-html="true" title="" aria-hidden="true" data-bs-original-title="The sum of the expected rent from all property cards that you own." style="color: #ddd;"></i>
                                    </div>
                                    <div class="col-12">
                                        <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e(getAmount($monthlyInvestmentProfitExtra?->total_profit ?? 0, 2)); ?></span></h3>
                                        <!-- <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span>59.92</span></h3> -->
                                    </div>
                                    <div class="col-7">
                                        <p><?php echo app('translator')->get('Monthly Est. Income'); ?></p>
                                    </div>
                                    <div class="col-5">
                                        as of <?php echo e(\Carbon\Carbon::now()->format('M Y')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 box">
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-6">
                                        <img style="
                                        position: relative;
                                        width: 32px;
                                        height: 32px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="<?php echo e(url('./public/dashboard/coins-1-1.svg')); ?>">
                                    </div>
                                    <div class="col-6">
                                        <i class="fa fa-info-circle tooltip_info" rel="tooltip" data-html="true" title="" aria-hidden="true" data-bs-original-title="The average return of your property cards." style="color: #ddd;"></i>
                                    </div>
                                    <div class="col-12">
                                        <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e($monthlyInvestmentProfitExtra ? getAmount($monthlyInvestmentProfitExtra?->total_profit/$monthlyInvestmentProfitExtra?->card_quantity, 2) : 0.00); ?></span></h3>
                                        <!-- <h3 class="text-black"><span>18.77</span> %</h3> -->
                                    </div>
                                    <div class="col-7">
                                        <p><?php echo app('translator')->get('Average Portfolio Return'); ?></p>
                                    </div>
                                    <div class="col-5">
                                        as of <?php echo e(\Carbon\Carbon::now()->format('M Y')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 box">
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-6">
                                        <img style="
                                        position: relative;
                                        width: 32px;
                                        height: 32px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="<?php echo e(url('./public/dashboard/increasegraph-1.svg')); ?>">
                                    </div>
                                    <div class="col-6">
                                        <i class="fa fa-info-circle tooltip_info" rel="tooltip" data-html="true" title="" aria-hidden="true" data-bs-original-title="The expected value of your portfolio in one year’s time based on the value appreciation of your assets." style="color: #ddd;"></i>
                                    </div>
                                    <div class="col-12">
                                        <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e($monthlyInvestmentProfitExtra ? getAmount(((($monthlyInvestmentProfitExtra?->capital_appreciation/$monthlyInvestmentProfitExtra?->card_quantity) / 100) + 1) * $monthlyInvestmentProfitExtra?->total_amount, 2) : 0.00); ?></span></h3>
                                        <!-- <h3 class="text-black"><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span>107.02</span></h3> -->
                                    </div>
                                    <div class="col-7">
                                        <p><?php echo app('translator')->get('Est. Portfolio Appreciation'); ?></p>
                                    </div>
                                    <div class="col-5">
                                        by  Apr 2025
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background-color: var(--none);box-shadow: var(--none);">
                    <h5 class="text-black"><?php echo app('translator')->get('Portfolio Insights'); ?></h5>
                    <div class="row g-3 mb-4">
                        <div class="col-xl-4 col-md-6 box">
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-12">
                                        <img style="
                                        position: relative;
                                        width: 32px;
                                        height: 32px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="<?php echo e(url('./public/dashboard/home-1.svg')); ?>">
                                    </div>
                                    <div class="col-12">
                                        <h3 class="text-black"><?php echo e($investment['runningInvestment']); ?></h3>
                                    </div>
                                    <div class="col-12">
                                        <p><?php echo app('translator')->get('Property cards owned'); ?></p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 box">
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-12">
                                        <img style="
                                        position: relative;
                                        width: 32px;
                                        height: 32px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="<?php echo e(url('/public/dashboard/increasegraph-1.svg')); ?>">
                                    </div>
                                    <div class="col-12">
                                        <!-- <h3 class="text-black"><?php echo e(getAmount($monthlyInvestmentExtra->total_profit ?? 0)); ?> %</h3> -->
                                        <h3 class="text-black"><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup> 0.00 </h3>
                                    </div>
                                    <div class="col-12">
                                        <p><?php echo app('translator')->get('Total Returned'); ?></p> 
                                        <i class="fa fa-info-circle tooltip_info" rel="tooltip" data-html="true" title="" aria-hidden="true" data-bs-original-title="The sum of all money already received across your portfolio" style="color: #ddd;"></i>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 box">
                            <div class="dashboard-box">
                                <div class="row">
                                    <div class="col-12">
                                        <img style="
                                        position: relative;
                                        width: 32px;
                                        height: 32px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="<?php echo e(url('./public/dashboard/increasegraph-1.svg')); ?>">
                                    </div>
                                    <div class="col-12">
                                        <h3 class="text-black"><?php echo e($monthlyInvestmentProfitExtra ? getAmount($monthlyInvestmentProfitExtra?->property_yield/$monthlyInvestmentProfitExtra?->card_quantity, 2) : 0.00); ?> %</h3>
                                        <!-- <h3 class="text-black">10.15 %</h3> -->
                                    </div>
                                    <div class="col-12">
                                        <p><?php echo app('translator')->get('Average rental yield'); ?></p>
                                        <i class="fa fa-info-circle tooltip_info" rel="tooltip" data-html="true" title="" aria-hidden="true" data-bs-original-title="The average yield of your property cards." style="color: #ddd;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div style="background-color: var(--none);box-shadow: var(--none);">
                    <!-- <h5 class="text-black"><?php echo app('translator')->get('Owned Cards'); ?> <?php echo e(count($myPropertiesInvested)); ?></h5> -->
                    <h5 class="text-black"><?php echo app('translator')->get('Owned Cards'); ?> <?php echo e($investment['runningInvestment']); ?></h5>

                    <!-- search area -->
                    <div class="search-bar mt-3 p-0 d-none">
                        <form action="" method="get" enctype="multipart/form-data" id="searchPropertyForm">
                            <div class="row g-3 align-items-end">
                                <div class="input-box col-lg-2">
                                    <label for=""><?php echo app('translator')->get('Property'); ?></label>
                                    <input type="text" name="property" value="<?php echo e(@request()->property); ?>" class="form-control" placeholder="<?php echo app('translator')->get('Search property'); ?>" />
                                </div>

                                <!-- <div class="input-box col-lg-2">
                                    <label for=""><?php echo app('translator')->get('Invest Status'); ?></label>
                                    <select class="form-select" name="invest_status" aria-label="Default select example">
                                        <option value=""><?php echo app('translator')->get('All Invest'); ?></option>
                                        <option value="1" <?php if(@request()->invest_status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Complete'); ?></option>
                                        <option value="0" <?php if(@request()->invest_status == '0'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Due'); ?></option>
                                    </select>
                                </div>

                                <div class="input-box col-lg-2">
                                    <label for=""><?php echo app('translator')->get('Return Status'); ?></label>
                                    <select class="form-select" name="return_status" aria-label="Default select example">
                                        <option value=""><?php echo app('translator')->get('All'); ?></option>
                                        <option value="0" <?php if(@request()->return_status == '0'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Running'); ?></option>
                                        <option value="1" <?php if(@request()->return_status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Completed'); ?></option>
                                    </select>
                                </div> -->

                                <div class="input-box col-lg-2">
                                    <label for=""><?php echo app('translator')->get('Location'); ?></label>
                                    <select class="form-select" name="location">
                                        <option selected disabled><?php echo app('translator')->get('Select Location'); ?></option>
                                        <option value="">All</option>
                                        <?php $__currentLoopData = $allAddress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($address->id); ?>"><?php echo app('translator')->get(optional($address->details)->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="input-box col-lg-2">
                                    <label for=""><?php echo app('translator')->get('Earned Income'); ?></label>
                                    <input type="text" name="earned_income" value="<?php echo e(@request()->earned_income); ?>" class="form-control" placeholder="<?php echo app('translator')->get('Earned Income'); ?>" />
                                </div>

                                <div class="input-box col-lg-2">
                                    <label for=""><?php echo app('translator')->get('Investment value'); ?></label>
                                    <input type="text" name="investment_value" value="<?php echo e(@request()->investment_value); ?>" class="form-control" placeholder="<?php echo app('translator')->get('Investment value'); ?>" />
                                </div>

                                <!-- <div class="input-box col-lg-2">
                                    <label for="from_date"><?php echo app('translator')->get('From Date'); ?></label>
                                    <input type="text" class="form-control datepicker from_date" name="from_date" value="<?php echo e(old('from_date',request()->from_date)); ?>" placeholder="<?php echo app('translator')->get('From date'); ?>" autocomplete="off" readonly />
                                </div>
                                <div class="input-box col-lg-2">
                                    <label for="to_date"><?php echo app('translator')->get('To Date'); ?></label>
                                    <input type="text" class="form-control datepicker to_date" name="to_date" value="<?php echo e(old('to_date',request()->to_date)); ?>" placeholder="<?php echo app('translator')->get('To date'); ?>" autocomplete="off" readonly disabled="true" />
                                </div> -->

                                <div class="input-box col-lg-2">
                                    <button id="searchProperty" class="btn-custom w-100" type="button"><?php echo app('translator')->get('Search'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-parent table-responsive mt-2">
                        <table class="table table-striped master-table" id="searchPropertyTable">
                            <thead>
                                <tr>
                                    <th scope="col">Property</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Investment value</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Rental Income</th>
                                    <th scope="col">Reference</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="background-color: var(--none);box-shadow: var(--none);" class="d-none">
                    <h5 class="text-black"><?php echo app('translator')->get('Pending investments'); ?> 0</h5>
                    <div class="table-parent table-responsive me-2 ms-2 mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Property</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Investment value</th>
                                    <th scope="col">Activity</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr class="text-center">
                                    <td colspan="100%" class="text-danger text-center"><?php echo e(trans('No Data Found!')); ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



            <!--<div class="d-lg-none mb-4">
                    <div class="card-box-wrapper owl-carousel card-boxes">
                        <div class="dashboard-box gr-bg-1">
                            <h5 class="text-white"><?php echo app('translator')->get('Main Balance'); ?></h5>
                            <h3 class="text-white">
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($walletBalance, config('basic.fraction_number'))); ?>

                            </h3>
                            <i class="fal fa-funnel-dollar text-white"></i>
                        </div>
                        <div class="dashboard-box gr-bg-2">
                            <h5 class="text-white"><?php echo app('translator')->get('Interest Balance'); ?></h5>
                            <h3 class="text-white">
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($interestBalance, config('basic.fraction_number'))); ?>

                            </h3>
                            <i class="fal fa-hand-holding-usd text-white"></i>
                        </div>
                        <div class="dashboard-box gr-bg-3">
                            <h5 class="text-white"><?php echo app('translator')->get('Total Deposit'); ?></h5>
                            <h3 class="text-white">
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($totalDeposit, config('basic.fraction_number'))); ?>

                            </h3>
                            <i class="fal fa-box-usd text-white"></i>
                        </div>
                        <div class="dashboard-box gr-bg-5">
                            <h5 class="text-white"><?php echo app('translator')->get('Total Invest'); ?></h5>
                            <h3 class="text-white">
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($investment['totalInvestAmount'])); ?>

                            </h3>
                            <i class="fal fa-search-dollar text-white"></i>
                        </div>
                        <div class="dashboard-box gr-bg-5">
                            <h5 class="text-white"><?php echo app('translator')->get('Running Invest'); ?></h5>
                            <h3 class="text-white">
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($investment['runningInvestAmount'])); ?>

                            </h3>
                            <i class="fal fa-search-dollar text-white"></i>
                        </div>
                        <div class="dashboard-box gr-bg-4">
                            <h5 class="text-white"><?php echo app('translator')->get('Total Earn'); ?></h5>
                            <h3 class="text-white">
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($totalInterestProfit, config('basic.fraction_number'))); ?>

                            </h3>
                            <i class="fal fa-badge-dollar text-white"></i>
                        </div>
                        <div class="dashboard-box gr-bg-6">
                            <h5 class="text-white"><?php echo app('translator')->get('Total Payout'); ?></h5>
                            <h3 class="text-white">
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($totalPayout)); ?>

                            </h3>
                            <i class="fal fa-usd-circle text-white"></i>
                        </div>
                        <div class="dashboard-box gr-bg-7">
                            <h5 class="text-white"><?php echo app('translator')->get('Total Referral Bonus'); ?></h5>
                            <h3 class="text-white">
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($depositBonus + $investBonus)); ?>

                            </h3>
                            <i class="fal fa-lightbulb-dollar text-white"></i>
                        </div>

                        <div class="dashboard-box gr-bg-8">
                            <h5 class="text-white"><?php echo app('translator')->get('Last Referral Bonus'); ?></h5>
                            <h3 class="text-white">
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($lastBonus, config('basic.fraction_number'))); ?>

                            </h3>
                            <i class="fal fa-box-open text-white"></i>
                        </div>

                        <div class="dashboard-box gr-bg-9">
                            <h5 class="text-white"><?php echo app('translator')->get('Total Ticket'); ?></h5>
                            <h3 class="text-white"><?php echo e($ticket); ?></h3>
                            <i class="fal fa-ticket text-white"></i>
                        </div>
                    </div>
                </div>-->

            <!---- charts ----->
            <!--<div class="chart-information d-none d-lg-block">--> <!--extra-->
            <div class="chart-information d-none">
                <div class="row justify-content-center">
                    <div class="row">
                        <!--<div class="col-lg-6 mb-4 mb-lg-0">
                                <div class="progress-wrapper">
                                    <div id="container" class="apexcharts-canvas"></div>
                                </div>
                            </div>-->

                        <div class="col-lg-6 col-md-6">
                            <div class="progress-wrapper2">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 box mb-3">
                                        <div class="badge-dashboard-box2" id="custom_badge_dashboad_box2">
                                            <h5 class="mb-0"><?php echo app('translator')->get('Current Level'); ?></h5>
                                            <div>

                                                <div class="level-box">
                                                    <h6 class="m-0">
                                                        <?php if($lastInvestorBadge == null): ?>
                                                        <i class="fa fa-times"></i>
                                                        <?php else: ?>
                                                        <?php echo app('translator')->get(optional($investorBadge->details)->rank_level); ?>
                                                        <?php endif; ?>
                                                    </h6>
                                                    <?php if($lastInvestorBadge != null && optional($investorBadge->details)->rank_level != null): ?>
                                                    <img src="<?php echo e(getFile(config('location.badge.path').$lastInvestorBadge->badge_icon)); ?>" alt="" class="level-badge" />
                                                    <?php endif; ?>
                                                </div>

                                                <?php if($lastInvestorBadge != null): ?>
                                                <p class="custom__p <?php echo e(optional($investorBadge->details)->rank_level == null ? 'opacity-0' : ''); ?>"> <?php echo e(optional($investorBadge->details)->rank_level == null ? '...' : trans(optional($investorBadge->details)->rank_name)); ?></p>
                                                <?php else: ?>
                                                <p class="opacity-0"><?php echo app('translator')->get('no level'); ?></p>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 box mb-3">
                                        <div class="badge-dashboard-box1">
                                            <h5><?php echo app('translator')->get('Level Bonus'); ?></h5>
                                            <h3><small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><span><?php echo e($totalBadgeBonus); ?></span></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div>
                                            <div class="badge-dashboard-box2">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5><?php echo app('translator')->get('All Badges'); ?></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php $__currentLoopData = $allBadges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-xl-3 col-md-6 box">
                                                        <div class="badge-box badge-box-two <?php echo e(Auth::user()->ranking($badge->id) == 'true' ? '' : 'locked'); ?>" id="badge-box-two">
                                                            <img src="<?php echo e(getFile(config('location.badge.path').$badge->badge_icon)); ?>" alt="" />
                                                            <p class="mb-3 text-center m-auto"><?php echo app('translator')->get(optional($badge->details)->rank_name); ?></p>
                                                            <div class="lock-icon">
                                                                <i class="far fa-lock-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- refferal-information -->
            <div class="search-bar refferal-link  g-4 mt-4 mb-4 coin-box-wrapper d-none"> <!--extra-->
                <form class="mb-3">
                    <div class="row g-3 align-items-end">
                        <div class="input-box col-lg-12">
                            <label for=""><?php echo app('translator')->get('Referral Link'); ?></label>
                            <div class="input-group mt-0">
                                <input type="text" value="<?php echo e(route('register.sponsor',[Auth::user()->username])); ?>" class="form-control" id="sponsorURL" readonly />
                                <button class="gold-btn copyReferalLink" type="button"><i class="fal fa-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset($themeTrue.'js/apexcharts.js')); ?>"></script>

<!-- extra 0 -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- <script src="<?php echo e(asset('assets/global/js/bootstrap-datepicker.js')); ?>"></script> -->

<link href="<?php echo e(asset('assets/admin/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('assets/admin/js/jquery.dataTables.min.js')); ?>"></script>

<script>
    var swiper = new Swiper(".slide-content", {
        slidesPerView: 3,
        spaceBetween: 25,
        loop: false,
        centerSlide: 'true',
        fade: 'true',
        grabCursor: 'true',
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            520: {
                slidesPerView: 2,
            },
            950: {
                slidesPerView: 3,
            }
        },
    });


    $(document).ready(function() {
        /* $(".datepicker").datepicker({
            autoclose: true,
            clearBtn: true
        }); */

        $('.from_date').on('change', function() {
            $('.to_date').removeAttr('disabled');
        });

        //$("#searchProperty").trigger('click');
    });

    $(document).on('click', '#premium_user', function() {
        if (confirm("Are you sure you want to upgrade your plan?")) {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("user.premium_user")); ?>',
                data: {
                    premium_user: 1
                },
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    //if (response.data.status == 'success') {
                    Notiflix.Notify.Success(response.success);
                    //}

                    location.reload();
                },
                error: function(error) {
                    console.log(error.responseJSON.error)
                    Notiflix.Notify.Failure(error.responseJSON.error);
                }
            });
        } else {
            return false;
        }

    });

    $('#searchProperty').on('click', function() {
        //event.preventDefault();
        var formData = $('#searchPropertyForm').serialize();

        $.ajax({
            type: 'POST',
            url: '<?php echo e(route("user.search-property-dashboard")); ?>',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                console.log(response.data.data)
                table_post_row(response.data);

            },
            error: function(error) {
                console.log(error.responseJSON.error)
            }
        });
    });

    function table_post_row(res) {
        let htmlView = '';
        if (res.data.length <= 0) {
            htmlView += `
       <tr>
          <td colspan="4">No data.</td>
      </tr>`;
        }
        for (let i = 0; i < res.data.length; i++) {
            htmlView += `
        <tr data-id="` + res.data[i].property.id + `">
            <td class="toggle-icon"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;<a href="property-details/` + res.data[i].property.details.property_title + `/` + res.data[i].property.id + `" target="_blank">` + res.data[i].property.details.property_title + `</a></td>
            <td>` + res.data[i].property.get_address.details.title + `</td>
            <td> <?php echo e(trans($basic->currency_symbol)); ?>` + (res.data[i].amount * res.data[i].card_quantity).toFixed(2) + `</td>
            <td>` + res.data[i].property.profit + `</td>
            <td>` + res.data[i].property_reference + `</td>
        </tr>`;
        }
        //console.log(htmlView)
        $('#searchPropertyTable').find('tbody').html(htmlView);
    }

    $(document).ready(function() {
        var $table = $('#searchPropertyTable');
        var $tbody = $table.find('tbody');
        var groupSums = {};
        var groupSums2 = {};
        var groupSums3 = {};
        let htmlView = '';

        // Load data via AJAX
        $.ajax({
            url: '<?php echo e(route("user.search-property-dashboard")); ?>',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            dataType: 'json',
            success: function(data) {
                // Group rows based on the content of the first column (index 0)
                var groups = {};
                
                $.each(data.data.data, function(index, row) {
                    var group = row.property_id; // Assuming the first element contains the grouping data
                    console.log(row.card_quantity)
                    var sum = parseFloat(row.amount) * parseFloat(row.card_quantity);
                    var sumQty = parseInt(row.card_quantity); 
                    var sumProfit = parseFloat(row.profit) * parseFloat(row.card_quantity);;
                    if (!groups[group]) {
                        groups[group] = [];
                        groupSums[group] = 0;
                        groupSums2[group] = 0;
                        groupSums3[group] = 0;
                    }
                    groups[group].push(row);
                    groupSums[group] += sum;
                    groupSums2[group] += sumQty;
                    groupSums3[group] += sumProfit;
                });

                // Clear table body
                $tbody.empty();

                //console.log(groups);

                // Add grouped rows back to the table
                for (var group in groups) {
                    htmlView = '';
                    var groupRows = groups[group];
                    console.log(groupRows)
                    var groupSum = groupSums[group].toFixed(2); // Format sum to 2 decimal places
                    var groupQtySums = groupSums2[group];
                    var groupProfitSums = groupSums3[group].toFixed(2);
                    $tbody.append('<tr class="group-header group"><td><span class="toggle-icon collapsed-icon"></span>&nbsp;&nbsp;&nbsp;' + groupRows[0].property.details.property_title + '</td><td>' + groupRows[0].property.get_address.details.title +  '</td><td>' + ' Total: £' + groupSum + '</td><td>' + ' Total: ' + groupQtySums + '</td><td>' + ' Total: £' + groupProfitSums + '</td></tr>');

                    $.each(groupRows, function(index, rowData) {
                        htmlView = `
                            <tr data-id="` + rowData.property.id + `" class="group-content">
                                <td><a href="property-details/` + rowData.property.details.property_title + `/` + rowData.property.id + `" target="_blank">` + rowData.property.details.property_title + `</a></td>
                                <td>` + rowData.property.get_address.details.title + `</td>
                                <td> <?php echo e(trans($basic->currency_symbol)); ?>` + rowData.amount + `</td>
                                <td> ` + rowData.card_quantity + `</td>
                                <td>` + rowData.property.profit + `</td>
                                <td>` + rowData.property_reference + `</td>
                            </tr>`;

                        
                        $tbody.append(htmlView);
                    });                   
                }

                /* $('.group').click(function() {
                    // Toggle visibility of group content
                    $(this).nextUntil('.group').toggle();
                    
                    // Toggle icon
                    var icon = $(this).find('.toggle-icon');
                    icon.text(icon.text() == '+' ? '-' : '+');
                }); */

                // Add click event listener to group headers for accordion behavior
                $('.group-header').click(function() {
                    var $icon = $(this).find('.toggle-icon');
                    var isCollapsed = $icon.hasClass('collapsed-icon');

                    // Close all other groups
                    $('.group-content').hide();
                    $('.toggle-icon').removeClass('expanded-icon').addClass('collapsed-icon');

                    // If the clicked group is already expanded, just collapse it
                    if (!isCollapsed) {
                        $icon.removeClass('expanded-icon').addClass('collapsed-icon');
                    } else {
                        // Expand the clicked group
                        $icon.removeClass('collapsed-icon').addClass('expanded-icon');
                        $(this).nextUntil('.group-header').show();
                    }
                });

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        $('.tooltip_info').tooltip();
        $('.tooltip_info_pbox').tooltip();
        
    });

    /* var table = $('#searchPropertyTable').DataTable({
        ajax: '<?php echo e(route("user.search-property-dashboard")); ?>',
        columns: [
            { data: 'id' },
            { data: 'name' }
        ]
    }); */
</script>
<!-- extra 1 -->

<script>
    "use strict";



    $(document).on('click', '#details', function() {
        var title = $(this).data('servicetitle');
        var description = $(this).data('description');
        $('#title').text(title);
        $('#servicedescription').text(description);
    });

    $(document).ready(function() {
        let isActiveCronNotification = '<?php echo e($basic->is_active_cron_notification); ?>';
        if (isActiveCronNotification == 1)
            $('#cron-info').modal('show');
        $(document).on('click', '.copy-btn', function() {
            var _this = $(this)[0];
            var copyText = $(this).parents('.input-group-append').siblings('input');
            $(copyText).prop('disabled', false);
            copyText.select();
            document.execCommand("copy");
            $(copyText).prop('disabled', true);
            $(this).text('Coppied');
            setTimeout(function() {
                $(_this).text('');
                $(_this).html('<i class="fas fa-copy"></i>');
            }, 500)
        });


        $(document).on('click', '.loginAccount', function() {
            var route = $(this).data('route');
            $('.loginAccountAction').attr('action', route)
        });

        $(document).on('click', '.copyReferalLink', function() {
            var _this = $(this)[0];
            var copyText = $(this).siblings('input');
            $(copyText).prop('disabled', false);
            copyText.select();
            document.execCommand("copy");
            $(copyText).prop('disabled', true);
            $(this).text('Copied');
            setTimeout(function() {
                $(_this).text('');
                $(_this).html('<i class="fal fa-copy"></i>');
            }, 500)
        });
    })
</script>

<?php $__env->stopPush(); ?>




<!--extra-->
<?php echo $__env->make($theme.'layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/themes/original/user/dashboard.blade.php ENDPATH**/ ?>