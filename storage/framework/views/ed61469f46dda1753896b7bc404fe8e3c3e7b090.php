<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        .embed-responsive-16by9 {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
        }

        .embed-responsive-16by9 iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        @media (min-width: 992px) {
            .embed-responsive-16by9 {
                max-width: 900px;
                margin: 0 auto;
            }
        }

        /* @media (max-width: 767.98px) {
                .feature-section {
                    margin-bottom: 2rem;
                }
            } */
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <title>MyProperTree Waitlist</title>
</head>

<body>
    <!-- Navbar  -->
    <div class="container col-xxl-8 px-4">
        <img src="<?php echo e(url('assets/join/Logo.png')); ?>" alt="" class="" />
        <h2 class="d-inline" style="font-family: Jost, sans-serif">MyProperTree</h2>
    </div>
    <!-- Form and Card -->
    <div class="col-xxl-8 px-4 d-flex container py-4">
        <div class="row flex-lg-row">
            <div class="col-lg-7">
                <h1 class="display-2 fw-bold text-body-emphasis lh-1 mb-3">
                    Build your <br />property <span style="color: #2596be">portfolio</span>
                </h1>
                <p class="lead fs-3">Invest and benefit from appreciation and rental revenue, and let MyProperTree handle the rest.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <!-- <form action="<?php echo e(route('form.submit')); ?>" method="POST" class="w-75 fs-5 pb-5" id="waitlistForm2"> -->
                    <form action="<?php echo e(route('form.submit')); ?>" method="POST" class="w-75 fs-5 pb-5" id="waitlistForm2">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="phone_code" value="+44"">
                        <input type="hidden" name="phone" value="0123456789">
                        <input type="hidden" name="lastname" value="">
                        <input type="hidden" name="terms_conditions" value="1">
                        <input type="hidden" name="username" value="<?php echo e(strRandom(6)); ?>">
                        <input type="hidden" name="country_code" value="">

                        <input type="hidden" name="password" value="MyPropertree" />
                        <input type="hidden" name="password_confirmation" value="MyPropertree" />

                        <div>
                            <label for="fullname">Full Name *</label>
                            <input type="text" id="firstname" name="firstname" required class="w-100 mb-4 px-2 rounded-2" />
                        </div>
                        <div>
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required class="w-100 mb-4 px-2 rounded-2" />
                        </div>

                        <!-- <div>
                            <label for="email">Password *</label>
                            <input type="password" id="password" name="password" required class="w-100 mb-4 px-2 rounded-2" />
                        </div>

                        <div>
                            <label for="email">Confirm Password *</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required class="w-100 mb-4 px-2 rounded-2" />
                        </div> -->

                        <div style="display: none">
                            <!-- Hidden input field for referral code -->
                            <input type="text" id="referral" name="referral" value="DefaultReferralCode" />
                        </div>
                        <button class="w-100 btn rounded-pill" style="background-color: #2596be; color: white" type="submit">Register</button>
                    </form>
                </div>
            </div>
            <div class="col-10 col-sm-8 col-lg-5">
                <img src="<?php echo e(url('assets/join/Card.png')); ?>" class="d-block mx-lg-auto img-fluid shadow-lg rounded-3" alt="Bootstrap Themes" width="500" loading="lazy" />
            </div>
        </div>
    </div>

    <!-- Banner -->
    <div class="container col-xxl-8 py-5 py-sm-2">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 pb-2 pb-lg-0">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#2596be" width="100px" style="margin-right: 1rem">
                        <!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M64 64C28.7 64 0 92.7 0 128v64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320v64c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V320c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6V128c0-35.3-28.7-64-64-64H64zm64 112l0 160c0 8.8 7.2 16 16 16H432c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H144c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32H448c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V160z" />
                    </svg>

                    <div class="col-6">
                        <b>Register Now</b>
                        <p>Free prize draw entry to win a property card.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 pb-2 pb-lg-0">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="#2596be" width="100px" style="margin-right: 1rem">
                        <!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                    </svg>

                    <div class="col-6">
                        <b>Refer friends</b>
                        <p>Receive 5000 loyalty points.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#2596be" width="100px" style="margin-right: 1rem">
                        <!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                    </svg>

                    <div class="col-6">
                        <b>Cash in</b>
                        <p>Earn credit from your referrals' investments.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container col-xxl-6 px-4 pt-5">
        <!-- Video and TrustPilot -->
        <div class="mb-4 embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Y09lEno3zRM?si=qvpDMFmXkqSUZHeX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="d-flex justify-content-center align-items-center mb-4  d-none">
            <img src="<?php echo e(url('assets/join/Trustpilot.png')); ?>" alt="" width="200" />
        </div>
    </div>

    <!-- <div class="container d-flex py-4">
            <div class="col"><img src="coins-solid.svg" alt="" /></div>
            <div class="col"><img src="coins-solid.svg" alt="" /></div>
            <div class="col"><img src="coins-solid.svg" alt="" /></div>
            <div class="col"><img src="coins-solid.svg" alt="" /></div>
            <div class="col"><img src="coins-solid.svg" alt="" /></div>
        </div> -->

    <!-- Footer -->
    <div class="container mt-20">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 border-top">
            <div class="col mb-3">
                <img src="<?php echo e(url('assets/join/Logo.png')); ?>" alt="" class="" />
                <p class="text-body-secondary">© 2024</p>
            </div>

            <div class="col mb-3"></div>

            <div class="col mb-3">
                <h5>Contact</h5>
                <p class="mb-1">+44 7584296843</p>
                <p>info@mypropertree.co.uk</p>
            </div>

            <div class="col mb-3">
                <h5>Address</h5>
                <ul class="nav flex-column">
                    <p class="mb-1">Barlby House,</p>
                    <p class="mb-1">2 Barlby Road,</p>
                    <p>Yorkshire YO8</p>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>Social</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Facebook</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">LinkedIn</a></li>
                </ul>
            </div>
        </footer>
    </div>

    <script>
        // Function to get query parameters from URL
        function getQueryParams() {
            const params = {};
            window.location.search
                .substring(1)
                .split('&')
                .forEach((pair) => {
                    const [key, value] = pair.split('=');
                    params[decodeURIComponent(key)] = decodeURIComponent(value);
                });
            return params;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve the referral code from URL parameters
            const params = getQueryParams();
            const referralCode = params.referral || '';

            // Set the referral code in the hidden input field
            if (referralCode) {
                document.getElementById('referral').value = referralCode;
                console.log('Referral code set:', referralCode); // For debugging
            }
        });

        document.getElementById('waitlistForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Simulate form submission success
            console.log('Form submitted successfully!');

            // Generate a unique referral code
            const generatedReferralCode = 'ref-' + Math.random().toString(36).substr(2, 9);

            // Redirect to the Thank You page with the generated referral code in the URL
            window.location.href = `submitted.html?referral=${generatedReferralCode}`;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html><?php /**PATH /home/myprexnd/join.mypropertree.co.uk/resources/views/join/join.blade.php ENDPATH**/ ?>