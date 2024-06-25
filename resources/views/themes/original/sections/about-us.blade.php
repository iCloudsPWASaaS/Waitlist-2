@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
<!-- about section -->

<style>
    .imgshadow {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
</style>

<section class="about-section mb-0" style="margin-top: 100px;">
    <div class="container">
        <div class="row gy-5 g-lg-5">

            <div class="row">
                <div class="col-lg-12 pt-4 pt-lg-0">
                    <h2>About Us</h2>
                </div>
            </div>

            <!-- <img class="img-box imgshadow me-3" src="{{getFile(config('location.content.path').$aboutUs->templateMedia()->image2)}}" alt="" /> -->

            <!-- <div class="text-box">
                        <h4>@lang(optional($aboutUs->description)->short_title)</h4>
                        <p>
                            @lang(optional($aboutUs->description)->short_description)
                        </p>
                    </div> -->
            <div class="row">
                <div class="col-md-8">
                    <h4>Our mission is to allow you to build wealth and safeguard your financial future through modern real estate investments.</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <p>"With many people worried about their retirement and the wealth gap growing ever bigger. I knew I had to do something about it."</p>
                </div>
                <div class="col-md-6" style="font-size: 20px;">
                    <p>Real estate has proven to be one of the most solid investments available. With returns similar to stock markets but without the volatility and an asset that is tangible, no wonder it has been the investment of choice for many of the worlds wealthiest.</p>
                </div>
            </div>

            <div class="text-center mb-5">
                <h2>MyProperTree make it easy and accessible to everyone.</h2>
                <p>At MyProperTree, we believe that real estate investment has been reserved for high net worth individuals for far too long. Aside from the financial barriers to entry, the sheer amount of knowledge and work involved in making secure and profitable investments put many people off. We're here to change that.</p>
            </div>

            <div class="text-center mb-5">
                <h3>Our team brings years of experience in real estate, operations, finance, and technology.</h3>
                <div class="row">
                    <div class="col-md-3">
                        <img src="path/to/team_member_1.jpg" alt="Team Member 1" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                    </div>
                    <div class="col-md-3">
                        <img src="path/to/team_member_2.jpg" alt="Team Member 2" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                    </div>
                    <div class="col-md-3">
                        <img src="path/to/team_member_3.jpg" alt="Team Member 3" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                    </div>
                    <div class="col-md-3">
                        <img src="path/to/team_member_4.jpg" alt="Team Member 4" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endif