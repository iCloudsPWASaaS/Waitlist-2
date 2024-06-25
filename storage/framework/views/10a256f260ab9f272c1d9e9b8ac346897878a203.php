<?php
    use Pam\CookieConsent\ViewModels\CookieConsentViewModel;
    /** @var CookieConsentViewModel $model */
?>

<div id="<?php echo e($model->ihmIds['popupPreferencesId']); ?>" class="cookie-consent-popup-preferences cookie-consent-popup-tab cookie-consent-popup-hider">
    <form action="<?php echo e(url(config('cookie-consent.routes.savePreferences'))); ?>" method="POST">
        <div class="cookie-consent-display-preferences">
            <?php $__currentLoopData = $model->cookies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cookie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('cookie-consent::_cookie-row', [
                    'cookieModel' => $cookie,
                    'isGroupDisplayMode' => $model->isGroupDisplayMode,
                    'isGroupValidationMode' => $model->isGroupValidationMode
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </form>
</div><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/vendor/cookie-consent/popup-preferences.blade.php ENDPATH**/ ?>