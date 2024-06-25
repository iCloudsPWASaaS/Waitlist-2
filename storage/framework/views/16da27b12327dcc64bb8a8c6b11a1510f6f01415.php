<div class="modal fade" id="investNowModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form action="" method="post" id="invest-form" class="login-form invest_now_modal">
            <input type="hidden" class="property-id" value="">
            <?php echo csrf_field(); ?>
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

                                        <li class="d-flex justify-content-between"><span><?php echo app('translator')->get('Invest'); ?></span>
                                            <span class="data_invest"></span></li>
                                        <li class="d-flex justify-content-between"><span><?php echo app('translator')->get('Profit'); ?></span>
                                            <span class="data_profit"></span></li>

                                    </ul>
                                </div>
                            </div>
                            <?php if(auth()->guard()->check()): ?>
                                <div class="row g-3 investModalPaymentForm">
                                    <!-- <div class="input-box col-12">
                                        <label for=""><?php echo app('translator')->get('Select Payment Method'); ?></label>
                                        <select name="method_id" class="form-control" id="method_id">
                                            <option value=""><?php echo app('translator')->get('Choose items'); ?></option>
                                            <?php if(isset($methods) ): ?>
                                            <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    value="<?php echo e($method->id); ?>" <?php echo e(old('method_id') == $method->id ? 'selected' : ''); ?>

                                                    data-id = "<?php echo e($method->id); ?>"
                                                    data-name="<?php echo e($method->name); ?>"
                                                    data-currency="<?php echo e($method->currency); ?>"
                                                    data-gateway="<?php echo e($method->code); ?>"
                                                    data-min_amount="<?php echo e(getAmount($method->min_amount, $basic->fraction_number)); ?>"
                                                    data-max_amount="<?php echo e(getAmount($method->max_amount,$basic->fraction_number)); ?>"
                                                    data-percent_charge="<?php echo e(getAmount($method->percentage_charge,$basic->fraction_number)); ?>"
                                                    data-fix_charge="<?php echo e(getAmount($method->fixed_charge, $basic->fraction_number)); ?>"
                                                    ><?php echo e($method->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div> -->

                                    <div class="input-box col-12">
                                        <label for=""><?php echo app('translator')->get('Select Wallet'); ?></label>
                                        <select class="form-control form-select" id="exampleFormControlSelect1"
                                                name="balance_type">
                                            <?php if(auth()->guard()->check()): ?>
                                                <option
                                                    value="balance"><?php echo app('translator')->get('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance)); ?></option>
                                                <option
                                                    value="interest_balance"><?php echo app('translator')->get('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance)); ?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <div class="input-box col-12">
                                        <label for=""><?php echo app('translator')->get('Amount'); ?></label>
                                        <div class="input-group">
                                            <input
                                                type="text" class="invest-amount form-control" name="amount"
                                                id="amount"
                                                value="<?php echo e(old('amount')); ?>"
                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                autocomplete="off"
                                                placeholder="<?php echo app('translator')->get('Enter amount'); ?>">
                                            <button class="show-currency"></button>
                                        </div>
                                    </div>

                                    <pre class="text-danger errors"></pre>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="payment-info text-center">
                        <img id="loading" src="<?php echo e(asset('assets/admin/images/loading.gif')); ?>" alt="<?php echo app('translator')->get('loader'); ?>" class="w-15"/>
                    </div>
                </div>

                <div
                    class="modal-footer <?php echo e(\Auth::check() == true ? '' : 'd-block'); ?>">
                    <?php if(auth()->guard()->check()): ?>
                        <button type="button"
                                class="btn-custom btn2 btn-secondary close_invest_modal close__btn"
                                data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn-custom investModalSubmitBtn"><?php echo app('translator')->get('Invest'); ?></button>
                        <!-- <button type="button" class="btn-custom checkCalc"><?php echo app('translator')->get('Next'); ?></button> -->
                    <?php else: ?>

                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="text-center font-weight-bold"><?php echo app('translator')->get('First Log In To Your Account For Invest'); ?></h6>
                                    <div class="tree">
                                        <div class="d-flex justify-content-center">
                                            <div class="branch branch-1"><?php echo app('translator')->get('Sign In / Sign Up'); ?></div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="branch branch-2"><a href="<?php echo e(route('login')); ?>"
                                                                            class="text-decoration-underline"><?php echo app('translator')->get('Login'); ?></a>
                                            </div>
                                            <div class="branch branch-3"><a href="<?php echo e(route('register')); ?>"
                                                                            class="text-decoration-underline"><?php echo app('translator')->get('Register'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>


<?php $__env->startPush('script'); ?>
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
                baseSymbol = "<?php echo e(config('basic.currency_symbol')); ?>";
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
                    url: "<?php echo e(route('user.addFund.request')); ?>",
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
                                <?php echo app('translator')->get('Amount'); ?>:
                                <strong>${data.amount} </strong>
                            </li>
                            <li class="list-group-item bg-transparent list-text customborder"><?php echo app('translator')->get('Charge'); ?>:
                                    <strong>${data.charge}</strong>
                            </li>
                            <li class="list-group-item bg-transparent list-text customborder">
                                <?php echo app('translator')->get('Payable'); ?>: <strong> ${data.payable}</strong>
                            </li>
                            <li class="list-group-item bg-transparent list-text customborder">
                                <?php echo app('translator')->get('Conversion Rate'); ?>: <strong>${data.conversion_rate}</strong>
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
                            <a href="${data.payment_url}" class="btn btn-custom addFund text-white"><?php echo app('translator')->get('Pay Now'); ?></a>
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
<?php $__env->stopPush(); ?>

<!--extra--><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/themes/original/partials/investNowModal.blade.php ENDPATH**/ ?>