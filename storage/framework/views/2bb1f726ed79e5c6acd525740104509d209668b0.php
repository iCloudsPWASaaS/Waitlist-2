<?php
    use Pam\CookieConsent\ViewModels\CookieConsentViewModel;
    /** @var CookieConsentViewModel $model */
 ?>

<link href="<?php echo e(asset('cookie-consent/css/app.css')); ?>" rel="stylesheet" />

<div id="<?php echo e($model->ihmIds['cookieConsentPopupContainerId']); ?>" class="cookie-consent-popup-container <?php echo e($model->positionClass); ?> cookie-consent-popup-hider <?php echo e(!empty($model->customClass) ? $model->customClass : ''); ?>">
    <span class="title"><?php echo e(trans('cookie-consent::global.title')); ?></span>

    <?php if($model->hasConsented): ?>
        <button id="<?php echo e($model->ihmIds['closeButtonId']); ?>" class="cookie-consent-close-btn">X</button>
    <?php endif; ?>

    <div class="cookie-consent-popup-content">
        <?php echo $__env->make('cookie-consent::popup-notice', ['model' => $model], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('cookie-consent::popup-preferences', ['model' => $model], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <?php echo $__env->make('cookie-consent::popup-actions', ['model' => $model], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<script type="text/javascript">
    authorizeAllButtonId = "<?php echo e($model->ihmIds['authorizeAllButtonId']); ?>";
    backButtonId = "<?php echo e($model->ihmIds['backButtonId']); ?>";
    closeButtonId = "<?php echo e($model->ihmIds['closeButtonId']); ?>";
    cookieConsentPopupContainerId = "<?php echo e($model->ihmIds['cookieConsentPopupContainerId']); ?>";
    hasConsented = <?php echo json_encode($model->hasConsented, 15, 512) ?>;
    openPreferencesLinkId = "<?php echo e($model->ihmIds['openPreferencesLinkId']); ?>";
    popupNoticeId = "<?php echo e($model->ihmIds['popupNoticeId']); ?>";
    popupPreferencesId = "<?php echo e($model->ihmIds['popupPreferencesId']); ?>";
    refuseAllButtonId = "<?php echo e($model->ihmIds['refuseAllButtonId']); ?>";
    savePreferencesButtonId = "<?php echo e($model->ihmIds['savePreferencesButtonId']); ?>";
    updatePreferencesButtonIds = <?php echo json_encode($model->updatePreferencesButtonIds, 15, 512) ?>;
</script>
<script src="<?php echo e(asset('cookie-consent/js/app.js')); ?>"></script><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/vendor/cookie-consent/popup-container.blade.php ENDPATH**/ ?>