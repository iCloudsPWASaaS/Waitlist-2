<?php if(isset($templates['faq'][0]) && $faq = $templates['faq'][0]): ?>
    <?php if(0 < count($contentDetails['faq'])): ?>
        <section class="faq-section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header-text text-center">
                            <h5><?php echo app('translator')->get(optional($faq->description)->title); ?></h5>
                            <h2><?php echo app('translator')->get(optional($faq->description)->sub_title); ?></h2>
                            <p class="mx-auto"><?php echo app('translator')->get(optional($faq->description)->short_details); ?></p>
                        </div>
                    </div>
                </div>

                <?php if(isset($contentDetails['faq'])): ?>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample">
                                <?php $__currentLoopData = $contentDetails['faq']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="accordion-item mb-4">
                                        <h4 class="accordion-header mb-0 <?php echo e((session()->get('rtl') == 1) ? 'isRtl': ''); ?>"
                                            id="heading<?php echo e($k); ?>">
                                            <button
                                                class="accordion-button <?php echo e(($k != 0) ? 'collapsed': ''); ?>"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?php echo e($k); ?>"
                                                aria-expanded="<?php echo e(($k == 0) ? 'true' : 'false'); ?>"
                                                aria-controls="collapse<?php echo e($k); ?>"
                                            >
                                                <?php echo app('translator')->get(optional($data->description)->title); ?>
                                            </button>
                                        </h4>
                                        <div id="collapse<?php echo e($k); ?>"
                                             class="accordion-collapse collapse <?php echo e(($k == 0) ? 'show' : ''); ?>"
                                             aria-labelledby="heading<?php echo e($k); ?>"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>
                                                    <?php echo app('translator')->get(optional($data->description)->description); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/themes/original/sections/faq.blade.php ENDPATH**/ ?>