<div class="property-box">
    <?php
    $investment = \App\Models\Investment::with('property.details')
            ->groupBy('property_id')
            ->where('property_id', $property->id)
            ->selectRaw('*, SUM(amount * card_quantity) AS total_amount')
            ->first();
    $investment_total = $investment?$investment->total_amount:'0.00';
    $investment_now = \App\Models\Investment::with('property.details')->where('user_id', Auth::id())->where('is_active', 0)->where('invest_status', '!=', 4)->where('deleted_at', NULL)->where('property_id', $property->id)->exists();
    $investment_limit = \App\Models\Investment::with('property.details')->where('user_id', Auth::id())->where('card_quantity', '=', $property->	user_card_limit)->where('deleted_at', NULL)->where('property_id', $property->id)->exists();
    ?>

    <div class="img-box">
        <div class="badges" style="z-index: 999;">
            <button class="save wishList" type="button" id="<?php echo e($key); ?>" data-property="<?php echo e($property->id); ?>">
                <?php if($property->get_favourite_count > 0): ?>
                <i class="fas fa-heart save<?php echo e($key); ?>"></i>
                <?php else: ?>
                <i class="fal fa-heart save<?php echo e($key); ?>"></i>
                <?php endif; ?>
            </button>
        </div>
        <div id="myCarousel<?php echo e($key); ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-inner" role="listbox">
                    <?php $__currentLoopData = $property->image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                        <img class="img-fluid" src="<?php echo e(getFile(config('location.property.path').$img->image)); ?>" />

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel<?php echo e($key); ?>" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel<?php echo e($key); ?>" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="text-box" style="background: #ffffff;">
        <!--extra-->
        <!--<div class="review">
            <?php echo $__env->make($theme.'partials.propertyReview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>-->

        <?php
        $property_tags = explode(",", $property->property_tags);
        ?>

        <?php if($property->property_tags): ?>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-8">
                <?php $__currentLoopData = $property_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="badge"><?php echo e($property_tag); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="row" style="margin-bottom: 5px;">
            <div class="col-12">
                <?php if(auth()->guard()->guest()): ?>
                <a class="title" href="<?php echo e(route('login')); ?>"><?php echo e(\Str::limit(optional($property->details)->property_title, 30)); ?></a>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                <a class="title" href="<?php echo e(route('user.propertyDetails',[slug(optional($property->details)->property_title), $property->id])); ?>"><?php echo e(\Str::limit(optional($property->details)->property_title, 30)); ?></a>
                <?php endif; ?>
            </div>

            <div class="col-12 d-none">
                <span class="title price float-end"><?php echo e(config('basic.currency_symbol') . $property->property_value); ?></span>
            </div>

            <div class="col-12">
                <!-- <i class="fal fa-map-marker save1" aria-hidden="true"></i>&nbsp; -->
                <?php echo app('translator')->get(optional($property->getAddress->details)->title); ?>
            </div>
        </div>

        <div class="row" style="margin-bottom: 15px;">
            <div class="col-12 text-end">
                <!-- 100% Sold -->
                <?php echo e(getAmount(@$investment_total / @$property->total_investment_amount * 100, config('basic.fraction_number'))); ?>% cards purchased
            </div>
            <div class="col-12">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e(@$investment_total / @$property->total_investment_amount  * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(@$investment_total / @$property->total_investment_amount  * 100); ?>%; background-color: #189ad3 !important;">
                    </div>
                </div>
            </div>
        </div>

        <!--<p class="address">
            <i class="fas fa-map-marker-alt"></i>
            <?php echo app('translator')->get(optional($property->getAddress->details)->title); ?>
        </p>-->

        <style>
            table {
                border-collapse: separate;
                border-spacing: 0;
            }

            tr {}

            td {
                padding: 10px 30px;
                background-color: #0f2034;
                color: #000;
            }

            tr:first-child td:first-child {
                border-top-left-radius: 10px;
            }

            tr:last-child td:first-child {
                border-bottom-left-radius: 10px;
            }

            tr:first-child td:last-child {
                border-top-right-radius: 10px;
            }

            tr:last-child td:last-child {
                border-bottom-right-radius: 10px;
            }

            .css-1dvsx2h {
                display: flex;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                background-image: url(https://getstake.com/assets/properties/locked-property.png);
                width: 100%;
            }

            .css-e0mz0m {
                display: flex;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                flex-direction: column;
                height: 200px;
            }

            .css-1epo3gp {
                width: 40px;
                height: 60px;
                display: inline-block;
                line-height: 1em;
                flex-shrink: 0;
                color: inherit;
                vertical-align: middle;
            }

            .css-e0mz0m> :not(style)~ :not(style) {
                margin-top: 0.5rem;
                margin-inline: 0px;
                margin-bottom: 0px;
            }

            .css-84ytiu {
                text-align: center;
                padding-top: var(--chakra-space-6);
                font-weight: var(--chakra-fontWeights-extrabold);
            }
        </style>

        <?php if(auth()->guard()->guest()): ?>
        <div class="row">
            <div class="css-1dvsx2h">
                <div class="chakra-stack css-e0mz0m">
                    <svg viewBox="0 0 24 24" focusable="false" class="chakra-icon css-1epo3gp" aria-label="lock">
                        <g fill="none" fill-rule="nonzero" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <g>
                                <path d="M8 10V7V7C8 4.791 9.791 3 12 3V3C14.209 3 16 4.791 16 7V7V10 M12 14V17"></path>
                                <path d="M17 21H7C5.895 21 5 20.105 5 19V12C5 10.895 5.895 10 7 10H17C18.105 10 19 10.895 19 12V19C19 20.105 18.105 21 17 21Z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <p class="chakra-text css-84ytiu" style="font-size:20px;font-weight: bold;">
                        <a class="chakra-text css-196mlf6" href="<?php echo e(route('login')); ?>">Sign up or login</a> to view <br />the property
                    </p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
        <div class="row">
            <!-- <div class="col-6">
                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">Deal Type: <?php echo e(ucwords($property->type_of_deal)); ?></span>
                </div>

                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">Issued: <?php echo e($property->card_issued > $property->card_remain ? $property->card_issued - $property->card_remain : ''); ?></span>
                </div>

                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">Sold: <?php echo e($property->card_issued > $property->card_remain ? $property->card_issued - $property->card_remain : ''); ?></span>
                </div>

                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">Price: <?php echo e(config('basic.currency_symbol')); ?><?php echo e($property->total_investment_amount); ?></span>
                </div>

                <div class="aminities" style="flex-direction: column;">
                    <span style="margin-bottom:10px;">ROI: <?php echo e(config('basic.currency_symbol')); ?><?php echo e($property->profit); ?></span>
                </div>
            </div>
            <div class="col-6">
                <div class="aminities" style="flex-direction: column;">
                    <?php $__currentLoopData = $property->limitamenity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span style="margin-bottom:10px;"><i class="<?php echo e($amenity->icon); ?>"></i><?php echo e(optional($amenity->details)->title); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="aminities" style="flex-direction: column;">

                    <?php $__currentLoopData = $property->limitfacility; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span style="margin-bottom:10px;"><i class="fas fa-info"></i><?php echo e($facility->title); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div> -->

            <div class="col-6">
                <p class="float-start">Deal Type</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold"><?php echo e($property->propertydeal->name); ?></p>
            </div>

            <div class="col-6">
                <p class="float-start">Card Price</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold">
                    

                    <?php if($property->fixed_amount > $property->available_funding && $property->available_funding > 0): ?>
                    <?php echo e(config('basic.currency_symbol')); ?><?php echo e($property->available_funding); ?>

                    <?php else: ?>
                    <?php if($property->available_funding < $property->minimum_amount && $property->available_funding !=0): ?>
                        <?php echo e(config('basic.currency_symbol')); ?><?php echo e($property->minimum_amount); ?>

                        <?php else: ?>
                        <?php echo e($property->investmentAmount); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                </p>
            </div>

            <div class="col-6">
                <p class="float-start">Est. Gross Yield P.A.</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold"><?php echo e($property->property_yield); ?>%</p>
            </div>

            <div class="col-6">
                <p class="float-start">Est. Property Appreciation</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold"><?php echo e($property->capital_appreciation); ?>%</p>
            </div>

            <div class="col-6">
                <p class="float-start">Return on Investment</p>
            </div>
            <div class="col-6">
                <!-- <p class="float-end fw-bold"><?php echo e($property->profit_type == 1 ? (int)$property->profit.'%' : config('basic.currency_symbol').$property->profit); ?></p> -->
                <p class="float-end fw-bold"><?php echo e(round($property->profit, 2)); ?>%</p>
            </div>
        </div>

        <div class="invest-btns d-flex justify-content-between" style="border-bottom: 0px;">
            <!--extra-->
            <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('login')); ?>" role="button"><?php echo app('translator')->get('Invest Now'); ?></a>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>

            <?php if($investment_now): ?>
            <button type="button" class="investNowExtra" data-route="<?php echo e(route('user.invest-property', $property->id)); ?>" data-property="<?php echo e($property); ?>" data-expired="<?php echo e(dateTime($property->expire_date)); ?>" data-symbol="<?php echo e($basic->currency_symbol); ?>" data-currency="<?php echo e($basic->currency); ?>">
                <?php echo app('translator')->get('Added'); ?>
            </button>
            <?php else: ?>
                <?php if($investment_limit): ?>
                <button type="button" disabled>
                    <?php echo app('translator')->get('Invested'); ?>
                </button>
                <?php else: ?>
                <button type="button" class="investNowExtra" data-route="<?php echo e(route('user.invest-property', $property->id)); ?>" data-property="<?php echo e($property); ?>" data-expired="<?php echo e(dateTime($property->expire_date)); ?>" data-symbol="<?php echo e($basic->currency_symbol); ?>" data-currency="<?php echo e($basic->currency); ?>">
                    <?php echo app('translator')->get('Add To Cart'); ?>
                </button>
                <?php endif; ?>
            <?php endif; ?>

            <!-- <button type="button" class="reserveNowExtra" data-route="<?php echo e(route('user.reserve-property', $property->id)); ?>" data-property="<?php echo e($property); ?>" data-expired="<?php echo e(dateTime($property->expire_date)); ?>" data-symbol="<?php echo e($basic->currency_symbol); ?>" data-currency="<?php echo e($basic->currency); ?>">
                <?php echo app('translator')->get('Reserve Now'); ?>
            </button> -->
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH /home/myprexnd/join.mypropertree.co.uk/resources/views/themes/original/partials/propertyBox.blade.php ENDPATH**/ ?>