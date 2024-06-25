<?php $__env->startSection('title',__('Login')); ?>

<?php $__env->startSection('content'); ?>

<style>
    .sign-up-page {
        overflow-x: hidden;
    }

    .sign-up-right-content {
        align-items: center;
        display: flex;
    }

    .sign-up-left-content,
    .sign-up-right-content {
        min-height: 100vh;
        height: 100%;
    }

    .sign-up-right-content form {
        width: 479px;
        margin: 0 auto;
    }

    .bg-white {
        --bs-bg-opacity: 1;
        background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)) !important;
    }


    .sign-up-left-content,
    .sign-up-right-content {
        min-height: 100vh;
        height: 100%;
    }

    .sign-up-left-content {
        background-color: var(--bgLight2);
        padding: 30px 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        color: white;
    }
</style>
<!-- login section -->
<section class="login-section sign-up-page bg-white">
    <div class="container-fluid p-0">
        <div class="row h-100 justify-content-center">
            <div class="col-md-6">
                <div class="sign-up-right-content bg-white">
                    <form action="<?php echo e(route('login')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row g-4">
                        <div class="col-12" align="center">
                                <a href="<?php echo e(url('/')); ?>">
                                    <img src="<?php echo e(getFile(config('location.logoIcon.path').'logo.png')); ?>" alt="<?php echo e(config('basic.site_title')); ?>" />
                                    <h3><?php echo e(config('basic.site_title')); ?></h3>
                                </a>
                            </div>
                            <div class="col-12" align="center">
                                <h4><?php echo app('translator')->get('Login To Your Account'); ?></h4>
                            </div>
                            <div class="input-box col-12">
                                <input type="text" name="username" class="form-control" placeholder="<?php echo app('translator')->get('Email Or Username'); ?>" />
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger float-left"><?php echo app('translator')->get($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger float-left"><?php echo app('translator')->get($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="input-box col-12">
                                <input type="hidden" name="timezone" class="form-control timezone" placeholder="<?php echo app('translator')->get('timezone'); ?>" />
                            </div>

                            <!-- <div class="input-box col-12">
                                <input type="password" name="password" class="form-control" placeholder="<?php echo app('translator')->get('Password'); ?>" />
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div> -->

                            <div class="box" style="margin-top:0px;">
                                <div class="input-box input-group col-12">
                                    <input type="password" name="password" id="password" class="form-control password" placeholder="<?php echo app('translator')->get('Password'); ?>" />
                                    <span class="input-group-text">
                                        <i class="far fa-eye-slash" id="togglePassword" style="cursor: pointer"></i>
                                    </span>
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <?php if(basicControl()->reCaptcha_status_login): ?>
                            <div class="box mb-4 form-group">
                                <?php echo NoCaptcha::renderJs(session()->get('trans')); ?>

                                <?php echo NoCaptcha::display($basic->theme == 'original' ? ['data-theme' => 'dark'] : []); ?>

                                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <?php endif; ?>


                            <div class="col-12">
                                <div class="links">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> id="flexCheckDefault" />
                                        <label class="form-check-label" for="flexCheckDefault" style="color: black;"> <?php echo app('translator')->get('Remember me'); ?> </label>
                                    </div>
                                    <a href="<?php echo e(route('password.request')); ?>" style="color: black;"><?php echo app('translator')->get('Forget password?'); ?></a>
                                </div>
                            </div>
                        </div>
                        <button class="btn-custom" type="submit"><?php echo app('translator')->get('Sign in'); ?></button>
                        <div class="bottom" style="color: black;">
                            <?php echo app('translator')->get("Don't have an account?"); ?>

                            <a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->get('Create account'); ?></a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="sign-up-left-content position-relative">
                    <div style="margin: 60px; display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start; gap: 50px;">
                        <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start; gap: 20px;">
                            <div style="align-self: stretch; position: relative; font-size: 20px; line-height: 34px;">
                            <h3 style="color: white;">Join the future of real estate investing today</h3> <p>Start building your financial portfolio with confidence</p>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start; gap: 20px; font-size: 20px;">
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Diverse Investment Options</div>
                            </div>
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Expert Guidance</div>
                            </div>
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Risk Mitigation</div>
                            </div>
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Transparent Transactions</div>
                            </div>
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Flexible Financing</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
    'use strict'
    $(document).ready(function() {
        $('.timezone').val(Intl.DateTimeFormat().resolvedOptions().timeZone);
    });

    $("#togglePassword").click(function(e) {
        e.preventDefault();
        var type = $(this).parent().parent().find(".password").attr("type");
        console.log(type);
        if (type == "password") {
            $(this).removeClass("fa-eye-slash");
            $(this).addClass("fa-eye");
            $(this).parent().parent().find(".password").attr("type", "text");
        } else if (type == "text") {
            $(this).removeClass("fa-eye");
            $(this).addClass("fa-eye-slash");
            $(this).parent().parent().find(".password").attr("type", "password");
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/themes/original/auth/login.blade.php ENDPATH**/ ?>