<?php if(isset($templates['how-it-work'][0]) && $aboutUs = $templates['how-it-work'][0]): ?>
<!-- about section -->

<?php if(request()->route()->getName() == "howitwork"): ?>
<section class="about-section mb-0" style="margin-top: 100px;">
    <div class="container">
        <div class="row gy-5 g-lg-5">

            <div class="row">
                <div class="col-lg-12 pt-4 pt-lg-0">
                    <h2>How it Works!</h2>
                    <br />
                    <div class="row">
                        <div class="col-md-7">
                            <p>Investing in real estate can be a long and complicated process. Even for those with the knowledge and skills, property investment demands large amounts of time and resources.</p>

                            <p>At MyProperTree, we set out to simplify the investment process and lower the barriers to entry - making property accessible to everyone.
                            </p>
                            <br />
                            <h3><b>The Traditional Way to Buy Rental Properties</b></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <img src="<?php echo e(getFile(config('location.content.path').$aboutUs->templateMedia()->image1)); ?>" style="height: 540px; width: 500px">
                        </div>
                        <div class="col-md-2">
                            <p>Rental property investors have the responsibility of handling the entire investment process, from sourcing properties, right through to handling tenants and dealing with complex accounting, one small mistake here could make or break a deal. Let's not forget dealing with tradesmen, finding quality workers who will complete jobs on time is a challenge in itself. Whilst many dream of passive income, the old way to invest in property is anything but passive. There are a lot of steps involved.
                            </p>
                        </div>

                        <div class="col-md-12 mt-4 mb-2">
                            <h3><b>Investing in Rental Properties with MyProperTree</b></h3>
                        </div>
                        <div class="col-md-7">
                            <p>MyProperTree handle the entire process from start to finish which means that you can invest in a variety of pre-vetted rental properties without all of the headaches. In a matter of minutes you can have a hand-tailored real estate portfolio by just following three simple steps.
                            </p>
                        </div>

                        <div class="col-md-5"></div>

                        <div class="col-md-4">

                            <p><b>Explore Properties:</b> Browse through a selection of pre-vetted properties</p>

                            <p><b>Invest:</b> Choose a property and invest your desired amount</p>

                            <p><b>Earn:</b> Start earning, enjoy returns and value appreciation</p>

                        </div>

                        <div class="col-md-8">
                            <img src="<?php echo e(getFile(config('location.content.path').$aboutUs->templateMedia()->image2)); ?>" style="height: 400px; width: 300px">
                        </div>


                        <!-- <div class="col-md-6">
                            <a class="btn btn-custom btn text-white" href="<?php echo e(route('howitwork')); ?>"><?php echo app('translator')->get('Discover More'); ?></a>
                        </div> -->

                        <div class="col-md-12">
                            <p><b>Still have questions? Check out our <a href="<?php echo e(route('faq')); ?>">FAQ's</a></b></p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
</section>
<?php else: ?>
<section class="about-section mb-0  mt-0 pt-0">
    <div class="container">
        <div class="row gy-5 g-lg-5">
            <div class="col-md-12">
                <h2>How it Works!</h2>
            </div>

            <div class="col-md-6">
                <div class="img-wrapper">
                    <div class="img-box">
                        <img src="https://test.mypropertree.co.uk/assets/uploads/content/2.jpg" alt="" />
                    </div>
                    <div class="img-box img-2">
                        <img src="https://test.mypropertree.co.uk/assets/uploads/content/1.jpg" alt="" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <p><span><b>Explore Properties:</b> Browse through a selection of pre-vetted properties</span></p>
                <p><b>Invest:</b>&nbsp;Choose a property and invest your desired amount<span><br></span></p>
                <p><b>Hands-Free Management</b>: Our team handles everything from building, renovations, maintenance to tenant management.</p>
                <p><span><b>Earn Rental Income:</b>&nbsp;Start earning, enjoy returns and value appreciation with reduced risk.</span><br></p>
                <p><span></span><br></p>

                <a class="btn btn-custom btn text-white" href="<?php echo e(route('howitwork')); ?>"><?php echo app('translator')->get('Discover More'); ?></a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>




<?php endif; ?><?php /**PATH /home/myprexnd/join.mypropertree.co.uk/resources/views/themes/original/sections/how-it-work.blade.php ENDPATH**/ ?>