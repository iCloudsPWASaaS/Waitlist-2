<?php
    use Pam\CookieConsent\ViewModels\CookieConsentViewModel;
    /** @var CookieConsentViewModel $model */
?>

<div class="cookie-consent-popup-actions">
    <button id="<?php echo e($model->ihmIds['openPreferencesLinkId']); ?>" class="cookie-consent-manage-preferences-btn cookie-consent-popup-hider"><?php echo e(trans('cookie-consent::global.managePreferences')); ?></button>

    <div class="action-buttons">
        <?php if(!$model->hasConsented): ?>
            <button id="<?php echo e($model->ihmIds['backButtonId']); ?>" type="button" class="cookie-consent-btn cookie-consent-back-btn cookie-consent-popup-hider"><?php echo e(trans('cookie-consent::global.backButton')); ?></button>
        <?php endif; ?>

        <form class="cookie-consent-popup-hider" action="<?php echo e(url(config('cookie-consent.routes.refuseAll'))); ?>" method="POST">
            <button id="<?php echo e($model->ihmIds['refuseAllButtonId']); ?>" class="cookie-consent-btn" type="submit"><?php echo e(trans('cookie-consent::global.refuseAll')); ?></button>
        </form>

        <form class="cookie-consent-popup-hider" action="<?php echo e(url(config('cookie-consent.routes.acceptAll'))); ?>" method="POST">
            <button id="<?php echo e($model->ihmIds['authorizeAllButtonId']); ?>" class="cookie-consent-btn" type="submit"><?php echo e(trans('cookie-consent::global.acceptAll')); ?></button>
        </form>

        <button id="<?php echo e($model->ihmIds['savePreferencesButtonId']); ?>" class="cookie-consent-btn cookie-consent-popup-hider"><?php echo e(trans('cookie-consent::global.savePreferences')); ?></button>
    </div>
</div><?php /**PATH /home/myprexnd/join.mypropertree.co.uk/resources/views/vendor/cookie-consent/popup-actions.blade.php ENDPATH**/ ?>