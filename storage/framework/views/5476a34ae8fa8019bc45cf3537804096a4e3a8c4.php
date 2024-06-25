<style>
    /* extra */
    .nav-logo {
        display: flex;
        align-items: center;
    }

    @media (max-width: 600px) {
        .navbar .nav-item-button {
            margin-top: 20px;
        }
    }

    .navbar .nav-item .nav-link.active, .navbar .nav-item .nav-link:hover {
        color: #000;
    }
</style>

<!-- navbar -->
<!-- <nav class="navbar navbar-expand-lg fixed-top"> -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-white">
    <div class="container">

        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <div class="nav-logo">
                <img src="<?php echo e(getFile(config('location.logoIcon.path').'logo.png')); ?>" alt="<?php echo e(config('basic.site_title')); ?>" />
                <h3><?php echo e(config('basic.site_title')); ?></h3>
            </div>
        </a>

        <button class="navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="flex-grow: 0; gap: 60px;">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('howitwork') ? 'active' : ''); ?>" href="<?php echo e(route('howitwork')); ?>"><?php echo app('translator')->get('How it Works'); ?></a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('property') ? 'active' : ''); ?>" href="<?php echo e(route('property')); ?>"><?php echo app('translator')->get('Marketplace'); ?></a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('blog') ? 'active' : ''); ?>" href="<?php echo e(route('blog')); ?>">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('faq') ? 'active' : ''); ?>" href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('FAQ'); ?></a>
                </li>

                <!--extra-->
                <!--
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('contact') ? 'active' : ''); ?>" href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a>
                </li>-->

                <?php if(auth()->guard()->guest()): ?>
                <li class="nav-item nav-item-button">
                    <a class="btn-custom" style="background-color: #fff; width: 100px !important; color: black;border-radius: 15px;border: 1px solid #ddd;" href="<?php echo e(route('login')); ?>"><?php echo app('translator')->get('Login'); ?></a>
                </li>
                <?php else: ?>
                <li class="nav-item nav-item-button">
                    <a class="btn-custom" style="background-color: #fff; width: 100px !important; color: black;border-radius: 15px;border: 1px solid #ddd;" href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?></a>
                </li>
                <?php endif; ?>

                <?php if(auth()->guard()->guest()): ?>
                <li class="nav-item nav-item-button">
                
                <a class="btn-custom mb-2" style="background-color: #189ad3; width: 140px !important; color: white" href="<?php echo e(route('register')); ?>">Get Started</a>
                     
                </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</nav><?php /**PATH /home/myprexnd/join.mypropertree.co.uk/resources/views/themes/original/partials/topbar.blade.php ENDPATH**/ ?>