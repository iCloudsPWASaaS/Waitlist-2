<?php
    use Pam\CookieConsent\ViewModels\CookieViewModel;
    /** @var CookieViewModel $cookieModel */
    /** @var bool $isGroupDisplayMode */
    /** @var bool $isGroupValidationMode */
?>

<div class="cookie-consent-cookie-item <?php echo e($cookieModel->isGroup ? 'cookie-consent-cookie-group' : ''); ?>">
    <div class="cookie-consent-cookie-item-title"><?php echo e(trans('cookie-consent::cookies.' . $cookieModel->titleKey)); ?></div>
    <div class="cookie-consent-cookie-item-detail">
        <div class="cookie-consent-cookie-item-description"><?php echo e(trans('cookie-consent::cookies.' . $cookieModel->descriptionKey)); ?></div>
        <?php if(!$isGroupDisplayMode || ($isGroupValidationMode && $cookieModel->isGroup) || (!$isGroupValidationMode && !$cookieModel->isGroup)): ?>
            <input id="<?php echo e($cookieModel->key); ?>" name="<?php echo e($cookieModel->key); ?>" type="checkbox" class="cookie-consent-checkbox" <?php if($cookieModel->isLocked || $cookieModel->isAllowed): ?>checked="checked"<?php endif; ?> <?php if($cookieModel->isLocked): ?>disabled="disabled"<?php endif; ?>/>
            <label class="cookie-consent-switchbox" for="<?php echo e($cookieModel->key); ?>"></label>
        <?php endif; ?>
    </div>
    <?php if(!$cookieModel->cookies->isEmpty()): ?>
        <?php $__currentLoopData = $cookieModel->cookies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('cookie-consent::_cookie-row', [
                    'cookieModel' => $child,
                    'isGroupDisplayMode' => $isGroupDisplayMode,
                    'isGroupValidationMode' => $isGroupValidationMode
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div><?php /**PATH /home/myprexnd/join.mypropertree.co.uk/resources/views/vendor/cookie-consent/_cookie-row.blade.php ENDPATH**/ ?>