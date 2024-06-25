<?php if(isset($templates['hero'][0]) && $hero = $templates['hero'][0]): ?>

<style>
    .home_bg {
        margin-top: 120px;
        /* height: 700px; */
        position: relative;
        background-color: #efefed;
        border-radius: 20px;
        padding-top: 40px;
    }

    .hero_img {
        position: relative;
        z-index: 9;
        bottom: 50;
    }

    .about_me_content {
        /* padding-top: 150px; */
        position: relative;
        margin-left: 50px;
    }

    .commission-section {
        margin-top: 100px;
        margin-bottom: 0px;
        background-color: #efefed;
    }

    @media (max-width: 600px) {
        .home_bg {
            padding-top: 50px;
            margin-top: 10px;
            height: auto;
        }

        .commission-section {
            padding: 40px 0;
            margin-top: 0px;
            margin-bottom: 0px;
        }
    }


    .ex_bg {
        margin-top: 40px;
        background: #fff;
        padding: 30px 20px;
        box-shadow: 0px 10px 40px rgba(0, 0, 0, 0.06);
        border-radius: 30px 30px 30px 30px;
        border: 1px solid #ededed;
    }

    .single_ex {
        text-align: center;
        background: #f7f9fC;
        padding: 30px;
        border-radius: 10px;
        position: relative;
    }

    .ex_count {
        margin-bottom: 10px;
        font-weight: 600;
        color: #000;
    }

    .single_feature_one {
        height: 270px;
        background: #fff;
        margin-bottom: 0px;
        padding: 20px 10px 0px 40px;
        border-radius: 10px;
        position: relative;
        box-shadow: 0px 0px 150px 0px rgba(78, 67, 250, 0.06);
        border: 1px solid #ededed;
        z-index: 2;
        -webkit-transition: 0.3s;
        -webkit-transition: 0.2s;
        -o-transition: 0.3s;
        transition: 0.3s;
    }

    .sf_top {
        overflow: hidden;
        margin-bottom: 20px;
    }

    .single_feature_one span {
        border-radius: 100px;
        float: left;
        color: #fff;
        font-size: 30px;
        width: 65px;
        height: 65px;
        line-height: 65px;
        text-align: center;
        margin-right: 20px;
    }

    .ss_one {
        background: #2eca7f;
    }
</style>

<!-- home section -->
<section class="home-section" style="overflow: visible; height: auto;">
    <div class="overlay h-100">
        <div class="container h-100">
            <section id="home" class="home_bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="about_me_content">
                                <h2>Bringing Property Investment to Your Fingertips</h2>
                                <h3> Buy shares of rental properties, earn monthly income, and watch your money grow. </h3>
                            </div>
                            <!-- <button type="button" class="btn btn-primary btn-lg" style="background-color: #189ad3; margin-left: 50px;padding: 20px 50px 20px 50px;">Start Exploring </button> -->
                            <!-- <button type="button" class="btn-custom btn-lg mt-4 mb-4 ms-5">Start Exploring </button> -->
                            <a class="btn btn-custom btn text-white mt-4 mb-4 ms-5" href="<?php echo e(route('about')); ?>"><?php echo app('translator')->get('Start Exploring'); ?></a>
                        </div>
                        <!-- END COL-->
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="hero_img">
                                <img class="img-fluid" alt="" src="./public/imageremovebgpreview-2@2x.png" />
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <section class="expert_area" style="margin: 35px;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="row ex_bg">
                                                <div class="col-lg-3 col-sm-3 col-xs-12">
                                                    <div class="single_ex">
                                                        <h3 class="ex_count">3978+</h3>
                                                        <span> Members </span>
                                                    </div>
                                                </div>
                                                <!-- END COL -->
                                                <div class="col-lg-3 col-sm-3 col-xs-12">
                                                    <div class="single_ex">
                                                        <h3 class="ex_count">3000+</h3>
                                                        <span>Proud owners </span>
                                                    </div>
                                                </div>
                                                <!-- END COL -->
                                                <div class="col-lg-3 col-sm-3 col-xs-12">
                                                    <div class="single_ex">
                                                        <h3 class="ex_count">35+</h3>
                                                        <span>Years Experience</span>
                                                    </div>
                                                </div>
                                                <!-- END COL -->
                                                <div class="col-lg-3 col-sm-3 col-xs-12">
                                                    <div class="single_ex">
                                                        <h3 class="ex_count">28.4%</h3>
                                                        <span>Returns up to</span>
                                                    </div>
                                                </div>
                                                <!-- END COL -->
                                            </div>
                                        </div>
                                        <!-- END COL -->
                                    </div>
                                    <!-- END ROW -->
                                </div>
                                <!-- END CONTAINER -->
                            </section>
                        </div>

                    </div>

                </div>
            </section>

        </div>
    </div>
</section>
<?php endif; ?>



<section class="commission-section" style="padding: 50px 0;">
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-4 col-sm-4 col-xs-12 d-flex align-items-center">
                <div class="row">
                    <div class="col-12">
                        <h3>Discover The Benefits<br /> of Our Real Estate <br />Investments</h3>
                    </div>
                    <div class="col-12">
                        <p>Investing in property has never been easier. MyProperTree offers a
                            hassle-free way to invest in properties around the United Kingdom.
                            Our platform helps you secure your financial future with
                            stress-free investing. Let us help you get started today</p>
                    </div>
                    <div class="col-12">
                        <a class="btn btn-custom btn text-white mt-4 mb-4" href="<?php echo e(route('about')); ?>"><?php echo app('translator')->get('Learn more'); ?></a>
                    </div>
                </div>
            </div>

            <div class="col-1">
            </div>

            <div class="col-lg-7 col-sm-8 col-xs-12">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="single_feature_one" style="margin-bottom: 20px; margin-top: 50px">
                            <div class="sf_top">
                                <img style="position: relative; width: 50px; height: 50px" alt="" src="./public/dollar.svg">
                            </div>
                            <h4>Passive Income</h4>
                            <p>Earn true passive income</p>
                        </div>
                        <div class="single_feature_one" style="margin-bottom: 20px;">
                            <div class="sf_top">
                                <img style="position: relative; width: 50px; height: 50px" alt="" src="./public/dollar1.svg">
                            </div>
                            <h4>Affordable & Accessible</h4>
                            <p>Easily consult the full documentation for each property.</p>
                        </div>
                    </div><!-- END COL -->

                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="single_feature_one">
                            <div class="sf_top">
                                <img style="position: relative; width: 50px; height: 50px" alt="" src="./public/dollar2.svg">
                            </div>
                            <h4>Secure Investment</h4>
                            <p>All property cards are secured with a contract</p>
                        </div>

                        <div class="single_feature_one"  style="margin-top: 20px">
                            <div class="sf_top">
                                <img style="position: relative; width: 50px; height: 50px" alt="" src="./public/dollar3.svg">
                            </div>
                            <h4>Future Proofing</h4>
                            <p>Grow your wealth easily</p>
                        </div>
                    </div><!-- END COL -->
                </div>

            </div>
        </div>
    </div>
</section><?php /**PATH /home/myprexnd/join.mypropertree.co.uk/resources/views/themes/original/partials/heroBanner.blade.php ENDPATH**/ ?>