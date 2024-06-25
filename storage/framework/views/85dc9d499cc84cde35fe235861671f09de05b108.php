<?php if(count($properties) > 0): ?>
<div class="col-lg-12">

    <!-- search area -->
    <div class="search-bar mt-3 p-0 d-none">
        <form action="" method="get" enctype="multipart/form-data" id="searchPropertyForm">
            <div class="row g-3 align-items-end">
                <div class="input-box col-lg-2">
                    <label for=""><?php echo app('translator')->get('Property'); ?></label>
                    <input type="text" class="form-control" name="name"
                                               value="<?php echo e(old('name', request()->name)); ?>" autocomplete="off"
                                               placeholder="<?php echo app('translator')->get('Search property'); ?>"/>
                </div>

                <div class="input-box col-lg-2">
                    <label for=""><?php echo app('translator')->get('Location'); ?></label>
                    <select class="form-select" name="location">
                        <option selected disabled><?php echo app('translator')->get('Select Location'); ?></option>
                        <option value="">All</option>
                        <?php $__currentLoopData = $allAddress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($address->id); ?>"
                                                        <?php if(request()->location == $address->id): ?> selected <?php endif; ?>><?php echo app('translator')->get(optional($address->details)->title); ?></option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="input-box col-lg-2">
                        <label for=""><?php echo app('translator')->get('Filter By Available Funding'); ?></label>
                        <div class="input-box mb-2">
                            <input type="text" class="js-range-slider" name="my_range" value="" />
                        </div>
                </div>

                <div class="input-box col-lg-2">
                    <label for="from_date"><?php echo app('translator')->get('Publish Date'); ?></label>
                    <input type="text" class="form-control datepicker from_date" name="from_date" value="<?php echo e(old('from_date',request()->from_date)); ?>" placeholder="<?php echo app('translator')->get('From date'); ?>" autocomplete="off" readonly />
                </div>

                <div class="input-box col-lg-2">
                    <label for=""><?php echo app('translator')->get('Amenities'); ?></label>
                    <select class="form-select" name="location">
                        <option selected disabled><?php echo app('translator')->get('Select Amenities'); ?></option>
                        <option value="">All</option>
                        <?php $__currentLoopData = $allAmenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($amenity->id); ?>"><?php echo app('translator')->get(optional($amenity->details)->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="input-box col-lg-2">
                    <button id="searchProperty" class="btn-custom w-100" type="submit"><?php echo app('translator')->get('Search'); ?></button>
                </div>
            </div>
        </form>
    </div>



    <div class="row g-4 mb-5">
        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 col-lg-4">
            <?php echo $__env->make($theme.'partials.propertyBox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php echo e($properties->appends($_GET)->links()); ?>

        </ul>
    </nav>
</div>
<?php else: ?>
<div class="custom-not-found mt-5">
    <img src="<?php echo e(asset($themeTrue.'img/no_data_found.png')); ?>" alt="<?php echo app('translator')->get('not found'); ?>" class="img-fluid">
</div>
<?php endif; ?>


<?php $__env->startPush('loadModal'); ?>
<?php echo $__env->make($theme.'partials.investNowModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>


<!--extra-->
<?php $__env->startPush('css-lib'); ?>
<link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/owl.carousel.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/owl.theme.default.min.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('extra-js'); ?>
<!-- fancybox slider -->
<script src="<?php echo e(asset($themeTrue.'js/fancybox.umd.js')); ?>"></script>
<?php $__env->stopPush(); ?>



<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset($themeTrue.'js/investNow.js')); ?>"></script>

<!--extra-->
<script src="<?php echo e(asset($themeTrue.'js/carousel.js?v=1')); ?>"></script>
<script>
    "use strict";
    var min = '<?php echo e($min); ?>'
    var max = '<?php echo e($max); ?>'
    var minRange = '<?php echo e($minRange); ?>'
    var maxRange = '<?php echo e($maxRange); ?>'

    $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: min,
        max: max,
        from: minRange,
        to: maxRange,
        grid: true,
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/themes/original/user/property/allProperty.blade.php ENDPATH**/ ?>