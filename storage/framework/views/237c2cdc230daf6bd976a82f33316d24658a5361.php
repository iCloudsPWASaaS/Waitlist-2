<?php
    $investment = \App\Models\Investment::with('property.details')
            ->groupBy('property_id')
            ->where('property_id', $myProperty->property->id)
            ->where('user_id', auth()->id())
            ->selectRaw('*, SUM(amount * card_quantity) AS total_amount, SUM(card_quantity) AS card_quantity')
            ->first();
    $investment_total = $investment?$investment->total_amount:'0.00';
    $investment_total_qty = $investment?$investment->card_quantity:'0';
    ?>
<div class="property-box">
    <div class="img-box">
        <!--<div class="badges" style="z-index: 999;">
            <button class="save wishList" type="button" id="<?php echo e($key); ?>" data-property="<?php echo e($myProperty->property->id); ?>">
                <?php if($myProperty->property->get_favourite_count > 0): ?>
                    <i class="fas fa-heart save<?php echo e($key); ?>"></i>
                <?php else: ?>
                    <i class="fal fa-heart save<?php echo e($key); ?>"></i>
                <?php endif; ?>
            </button>
        </div>-->

        <div class="badges" style="left: 0; text-align: center; z-index: 999; background-size: cover; background-position: center;height: 70px; width: 80px; padding: 25px 0px; color: white; background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KCiAgCiAgPHJlY3QgeD0iNDAiIHk9IjY1IiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjE1MCIgcng9IjUiIHJ5PSI1IiBmaWxsPSIjN2FkMmY2Ij48L3JlY3Q+CiAgCiAgCiAgPHJlY3QgeD0iNTAiIHk9Ijc1IiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjE1MCIgcng9IjUiIHJ5PSI1IiBmaWxsPSIjM2ZiY2YwIj48L3JlY3Q+CiAgCiAgCiAgPHJlY3QgeD0iNjAiIHk9Ijg1IiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjE1MCIgcng9IjUiIHJ5PSI1IiBmaWxsPSIjMTg5YWQzIj48L3JlY3Q+CiAgCjwvc3ZnPg==);">
           <p style="font-size:14px"><?php echo e(str_pad($investment_total_qty, 2, "0", STR_PAD_LEFT)); ?></p> 
            <!-- <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KCiAgCiAgPHJlY3QgeD0iNDAiIHk9IjY1IiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjE1MCIgcng9IjUiIHJ5PSI1IiBmaWxsPSIjN2FkMmY2Ij48L3JlY3Q+CiAgCiAgCiAgPHJlY3QgeD0iNTAiIHk9Ijc1IiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjE1MCIgcng9IjUiIHJ5PSI1IiBmaWxsPSIjM2ZiY2YwIj48L3JlY3Q+CiAgCiAgCiAgPHJlY3QgeD0iNjAiIHk9Ijg1IiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjE1MCIgcng9IjUiIHJ5PSI1IiBmaWxsPSIjMTg5YWQzIj48L3JlY3Q+CiAgCjwvc3ZnPg==" alt="" style="height: 70px; width: 50px;"/> -->
        </div>

        <div id="myCarousel_<?php echo e($page?$page:''); ?>_<?php echo e($key); ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-inner" role="listbox">
                    <?php $__currentLoopData = $myProperty->property->image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->first): ?>
                    <div class="carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                        <img class="img-fluid" src="<?php echo e(getFile(config('location.property.path').$img->image)); ?>" />
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel_<?php echo e($page?$page:''); ?>_<?php echo e($key); ?>" data-bs-slide="prev">
                <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel_<?php echo e($page?$page:''); ?>_<?php echo e($key); ?>" data-bs-slide="next">
                <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="text-box" style="background: #ffffff;">
        <?php
        $myProperty->property_tags = explode(",", $myProperty->property->property_tags);
        ?>

        <?php if($myProperty->property->property_tags): ?>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-8">
                <?php $__currentLoopData = $myProperty->property_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myProperty->property_tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="badge"><?php echo e($myProperty->property_tag); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="row" style="margin-bottom: 5px;">
            <div class="col-12">
                <?php if(auth()->guard()->guest()): ?>
                <a class="title" href="<?php echo e(route('login')); ?>"><?php echo e(\Str::limit(optional($myProperty->property->details)->property_title, 30)); ?></a>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                <a class="title" href="<?php echo e(route('user.propertyDetails',[slug(optional($myProperty->property->details)->property_title), $myProperty->property->id])); ?>"><?php echo e(\Str::limit(optional($myProperty->property->details)->property_title, 30)); ?></a>
                <?php endif; ?>
            </div>

            <div class="col-12 d-none">
                <span class="title price float-end"><?php echo e(config('basic.currency_symbol') . $myProperty->property->property_value); ?></span>
            </div>

            <div class="col-12">
                <!-- <i class="fal fa-map-marker save1" aria-hidden="true"></i>&nbsp; -->
                <?php echo app('translator')->get(optional($myProperty->property->getAddress->details)->title); ?>
            </div>

        </div>

        <div class="row" style="margin-bottom: 15px;">
            <div class="col-12 text-end">
                <!-- 100% Sold -->
                <?php echo e(getAmount(@$investment_total / @$myProperty->property->total_investment_amount  * 100, config('basic.fraction_number'))); ?>% cards purchased
            </div>
            <div class="col-12">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e(@$investment_total / @$myProperty->property->total_investment_amount  * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(@$investment_total / @$myProperty->property->total_investment_amount * 100); ?>%; background-color: #189ad3 !important;">
                    </div>
                </div>
            </div>
        </div>



        <style>
            table {
                border-collapse: separate;
                border-spacing: 0;
            }

            tr {}

            td {
                padding: 10px 30px;
                background-color: #0f2034;
                color: #FFF;
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
        </style>

        <div class="row">
            <div class="col-6">
                <p class="float-start">Deal Type</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold"><?php echo e($myProperty->property->propertydeal->name); ?></p>
            </div>

            <div class="col-6">
                <p class="float-start">Purchased</p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold">
                    

                    <?php if($myProperty->property->fixed_amount > $myProperty->property->available_funding && $myProperty->property->available_funding > 0): ?>
                    <?php echo e(config('basic.currency_symbol')); ?><?php echo e($myProperty->property->available_funding); ?>

                    <?php else: ?>
                    <?php if($myProperty->property->available_funding < $myProperty->property->minimum_amount && $myProperty->property->available_funding !=0): ?>
                        <?php echo e(config('basic.currency_symbol')); ?><?php echo e($myProperty->property->minimum_amount); ?>

                        <?php else: ?>
                        <?php echo e($myProperty->property->investmentAmount); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                </p>
            </div>

            <div class="col-6">
                <p class="float-start">Est. Gross Yield P.A. <i class="fa fa-info-circle tooltip_info_pbox" rel="tooltip" data-html="true" title="" aria-hidden="true" data-bs-original-title="The annual income generated from the property, expressed as a percentage of its purchase price, before expenses." style="color: #ddd;"></i></p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold"><?php echo e($myProperty->property->property_yield); ?>%</p>
            </div>

            <div class="col-6">
                <p class="float-start">Est. Property Appreciation <i class="fa fa-info-circle tooltip_info_pbox" rel="tooltip" data-html="true" title="" aria-hidden="true" data-bs-original-title="The projected increase in the property's value over time, based on market trends and conditions." style="color: #ddd;"></i></p>
            </div>
            <div class="col-6">
                <p class="float-end fw-bold"><?php echo e($myProperty->property->capital_appreciation); ?>%</p>
            </div>

            <div class="col-6">
                <p class="float-start">Return on Investment <i class="fa fa-info-circle tooltip_info_pbox" rel="tooltip" data-html="true" title="" aria-hidden="true" data-bs-original-title="A measure of the profitability of your investment, calculated as the net profit divided by the total investment cost." style="color: #ddd;"></i></p>
            </div>
            <div class="col-6">
                <!-- <p class="float-end fw-bold"><?php echo e($myProperty->property->profit_type == 1 ? (int)$myProperty->property->profit.'%' : config('basic.currency_symbol').$myProperty->property->profit); ?></p> -->
                <p class="float-end fw-bold"><?php echo e(round($myProperty->property->profit, 2)); ?>%</p>
            </div>
        </div>



        <div class="invest-btns justify-content-between" style="border-bottom: 0px;"> <!--extra-->
            <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('login')); ?>" role="button"><?php echo app('translator')->get('Invest Now'); ?></a>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
            <!--<button type="button" class="btn buyShare directBuyShare <?php echo e(optional($myProperty->user)->id == Auth::id() ? 'disabled' : ''); ?>"
                    data-route="<?php echo e(route('user.directBuyShare', $myProperty->id)); ?>"
                    data-payableamount="<?php echo e($myProperty->amount); ?>"
                    data-propertyowner="<?php echo e(optional($myProperty->user)->fullname); ?>"
                    data-property="<?php echo e(optional(optional($myProperty->property)->details)->property_title); ?>">
                <?php echo app('translator')->get('Direct Buy Share'); ?>
            </button>-->

            <?php
            $type2 = isset($type) ? $type : '';
            ?>
            <?php if($type2 === "reserve-properties"): ?>
            <button type="button" class="investNowExtra" data-route="<?php echo e(route('user.invest-property', $myProperty->id)); ?>" data-property="<?php echo e($myProperty); ?>" data-expired="<?php echo e(dateTime($myProperty->expire_date)); ?>" data-symbol="<?php echo e($basic->currency_symbol); ?>" data-currency="<?php echo e($basic->currency); ?>">
                <?php echo app('translator')->get('Add To Cart'); ?>
            </button>
            <?php endif; ?>


            <!-- <?php if($myProperty->propertyShare): ?>
            <button type="button" class="btn sendOffer" disabled data-route="<?php echo e(route('user.propertyShareUpdate', $myProperty->propertyShare->id)); ?>" data-payableamount="<?php echo e($myProperty->amount); ?>" data-propertyowner="<?php echo e(optional($myProperty->user)->fullname); ?>" data-property="<?php echo e(optional(optional($myProperty->property)->details)->property_title); ?>">
                <?php echo app('translator')->get('Update Share'); ?>
            </button>

            <?php else: ?>

            <button type="button" class="btn sendOffer" disabled data-route="<?php echo e(route('user.propertyShareStore', $myProperty->id)); ?>" data-payableamount="<?php echo e($myProperty->amount); ?>" data-propertyowner="<?php echo e(optional($myProperty->user)->fullname); ?>" data-property="<?php echo e(optional(optional($myProperty->property)->details)->property_title); ?>">
                <?php echo app('translator')->get('Sell Share'); ?>
            </button>
            <?php endif; ?> -->

            <?php endif; ?>

            <!--<a href="<?php echo e(route('contact')); ?>">
                                    <?php echo app('translator')->get('Contact Us'); ?>
                                </a>-->
        </div>
    </div>
</div>

<?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/themes/original/partials/propertyBox2.blade.php ENDPATH**/ ?>