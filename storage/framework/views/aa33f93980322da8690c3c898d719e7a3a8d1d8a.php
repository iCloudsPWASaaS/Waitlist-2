<?php $__env->startSection('title', trans('Referral Commission')); ?>
<?php $__env->startSection('content'); ?>
    <div class=" m-0 m-md-4 my-4 m-md-0">
        <div class="row justify-content-between ">
            <div class="col-md-7">
                <div class="card card-primary shadow">
                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('admin.referral-commission.action')); ?>"
                              class="form-row align-items-center justify-content-between">
                            <?php echo csrf_field(); ?>
                            <!--<div class="form-group col-md-4">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Deposit Bonus'); ?></label>

                                <div class="custom-switch-btn ">
                                    <input type='hidden' value='1' name='deposit_commission'>
                                    <input type="checkbox" name="deposit_commission"
                                           class="custom-switch-checkbox "
                                           id="deposit_commission"
                                           value="0" <?php if ($control->deposit_commission == 0):echo 'checked'; endif ?> >
                                    <label class="custom-switch-checkbox-label" for="deposit_commission">
                                        <span class="custom-switch-checkbox-inner"></span>
                                        <span class="custom-switch-checkbox-switch"></span>
                                    </label>
                                </div>
                            </div>-->

                            <div class="form-group col-md-4">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Investment Commission'); ?></label>
                                <div class="custom-switch-btn">
                                    <input type='hidden' value='1' name='investment_commission'>
                                    <input type="checkbox" name="investment_commission" class="custom-switch-checkbox"
                                           id="investment_commission"
                                           value="0" <?php if ($control->investment_commission == 0):echo 'checked'; endif ?> >
                                    <label class="custom-switch-checkbox-label" for="investment_commission">
                                        <span class="custom-switch-checkbox-inner"></span>
                                        <span class="custom-switch-checkbox-switch"></span>
                                    </label>
                                </div>
                            </div>

                            <!--<div class="form-group col-md-4">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Profit Commission'); ?></label>

                                <div class="custom-switch-btn ">
                                    <input type='hidden' value='1' name='profit_commission'>
                                    <input type="checkbox" name="profit_commission"
                                           class="custom-switch-checkbox "
                                           id="profit_commission"
                                           value="0" <?php if ($control->profit_commission == 0):echo 'checked'; endif ?> >
                                    <label class="custom-switch-checkbox-label" for="profit_commission">
                                        <span class="custom-switch-checkbox-inner"></span>
                                        <span class="custom-switch-checkbox-switch"></span>
                                    </label>
                                </div>
                            </div>-->

                            <div class="form-group  col-md-12">
                                <button type="submit"
                                        class="btn btn-primary btn-block btn-rounded  mt-4 mx-2">
                                    <span><?php echo app('translator')->get('Save Changes'); ?></span></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">

                <div class="card card-primary shadow">

                    <div class="card-body">

                        <div class="row formFiled justify-content-between">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="font-weight-bold"><?php echo app('translator')->get('Select Bonus Type'); ?></label>
                                    <select name="type" class="form-control type">
                                        <option value="" disabled><?php echo app('translator')->get('Select Type'); ?></option>
                                        <!--<option value="deposit"><?php echo app('translator')->get('Deposit Bonus'); ?></option>-->
                                        <option value="invest"><?php echo app('translator')->get('Investment Bonus'); ?></option>
                                       <!-- <option value="profit_commission"><?php echo app('translator')->get('Profit Commission'); ?></option>-->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold"><?php echo app('translator')->get('Set Level'); ?></label>
                                    <input type="number" name="level" placeholder="<?php echo app('translator')->get('Number Of Level'); ?>"
                                           class="form-control  numberOfLevel">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-primary btn-rounded btn-block makeForm ">
                                        <i class="fa fa-spinner"></i> <?php echo app('translator')->get('GENERATE'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <form action="" method="post" class="form-row">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="commission_type" value="">
                            <div class="col-md-12 newFormContainer">

                            </div>

                            <div class="col-md-12">
                                <button type="submit"
                                        class="btn btn-primary btn-rounded btn-block mt-3 submit-btn"><?php echo app('translator')->get('Submit'); ?></button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-body">
                        <div class="row">
                            <!--<div class="col-md-4">
                                <h5 class="card-title"><?php echo app('translator')->get('Deposit/Funding Bonus'); ?></h5>
                                <div class="table-responsive">
                                    <table class="categories-show-table table table-hover table-striped table-bordered"
                                           id="zero_config">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col"><?php echo app('translator')->get('Level'); ?></th>
                                            <th scope="col"><?php echo app('translator')->get('Bonus'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $referrals->where('commission_type','deposit'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td data-label="Level"><?php echo app('translator')->get('LEVEL'); ?># <?php echo e($item->level); ?></td>
                                                <td data-label="<?php echo app('translator')->get('Bonus'); ?>">
                                                    <?php echo e($item->percent); ?> %
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="100%"
                                                    class="text-center text-na"><?php echo app('translator')->get('No Data Found'); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>-->
                            <div class="col-md-4">
                                <h5 class="card-title"><?php echo app('translator')->get('Investment Commission'); ?></h5>
                                <div class="table-responsive">
                                    <table class="categories-show-table table table-hover table-striped table-bordered"
                                           id="zero_config">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col"><?php echo app('translator')->get('Level'); ?></th>
                                            <th scope="col"><?php echo app('translator')->get('Bonus'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $referrals->where('commission_type','invest'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td data-label="Level"><?php echo app('translator')->get('LEVEL'); ?># <?php echo e($item->level); ?></td>

                                                <td data-label="<?php echo app('translator')->get('Bonus'); ?>">
                                                    <?php echo e($item->percent); ?> %
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="100%"
                                                    class="text-center text-na"><?php echo app('translator')->get('No Data Found'); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--<div class="col-md-4">
                                <h5 class="card-title"><?php echo app('translator')->get('Profit Commission'); ?></h5>
                                <div class="table-responsive">
                                    <table class="categories-show-table table table-hover table-striped table-bordered"
                                           id="zero_config">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col"><?php echo app('translator')->get('Level'); ?></th>
                                            <th scope="col"><?php echo app('translator')->get('Bonus'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $referrals->where('commission_type','profit_commission'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td data-label="Level"><?php echo app('translator')->get('LEVEL'); ?># <?php echo e($item->level); ?></td>
                                                <td data-label="<?php echo app('translator')->get('Bonus'); ?>">
                                                    <?php echo e($item->percent); ?> %
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="100%"
                                                    class="text-center text-na"><?php echo app('translator')->get('No Data Found'); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('style-lib'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>

    <?php if($errors->any()): ?>
        <?php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        ?>
        <script>
            "use strict";
            <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Notiflix.Notify.Failure("<?php echo e(trans($error)); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>
    <?php endif; ?>

    <script>
        "use strict";
        $(document).ready(function () {

            $('.submit-btn').addClass('d-none');

            $(".makeForm").on('click', function () {

                var levelGenerate = $(this).parents('.formFiled').find('.numberOfLevel').val();
                var selectType = $('.type :selected').val();
                if (selectType == '') {
                    Notiflix.Notify.Failure("<?php echo e(trans('Please Select a type')); ?>");
                    return 0
                }

                $('input[name=commission_type]').val(selectType)
                var value = 1;
                var viewHtml = '';
                if (levelGenerate !== '' && levelGenerate > 0) {
                    for (var i = 0; i < parseInt(levelGenerate); i++) {
                        viewHtml += `<div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text no-right-border">LEVEL</span>
                            </div>
                            <input name="level[]" class="form-control" type="number" readonly value="${value++}" required placeholder="<?php echo app('translator')->get('Level'); ?>">
                            <input name="percent[]" class="form-control" type="text" required placeholder="<?php echo app('translator')->get("Level Bonus (%)"); ?>">
                            <span class="input-group-btn">
                            <button class="btn btn-danger removeForm" type="button"><i class='fa fa-trash'></i></button></span>
                            </div>`;
                    }

                    $('.newFormContainer').html(viewHtml);
                    $('.submit-btn').addClass('d-block');
                    $('.submit-btn').removeClass('d-none');

                } else {

                    $('.submit-btn').addClass('d-none');
                    $('.submit-btn').removeClass('d-block');
                    $('.newFormContainer').html(``);
                    Notiflix.Notify.Failure("<?php echo e(trans('Please Set number of level')); ?>");
                }
            });

            $(document).on('click', '.removeForm', function () {
                $(this).closest('.input-group').remove();
            });


            $('select').select2({
                selectOnClose: true
            });

        });

    </script>
<?php $__env->stopPush(); ?>

<!--extra-->

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/admin/property/referral-commission.blade.php ENDPATH**/ ?>