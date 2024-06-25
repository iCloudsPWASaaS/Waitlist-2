<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
			crossorigin="anonymous"
		/>
		<title>Document</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	</head>
	<body style="color: white">
		<div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center" style="max-width: 700px">
			<div style="background-color: #2596be; padding: 50px" class="rounded-4">
				<h1>You're on the waitlist!</h1>
				<hr />
				<p>
					Thank you for registering with MyProperTree. We're so excited to be able to share our platform with you soon. Please check your
					emails for more information.
				</p>
				<h2 class="mb-4">Earn loyalty points and bonus credit by referring friends.</h2>
				<div class="border rounded-2 d-inline-flex align-items-center gap-4 p-2 copyReferalLink" style="background-color: #69b2cc; cursor: pointer">
					<!-- <input type="text" value="<?php echo e(route('register.sponsor',[Auth::user()->username])); ?>" class="form-control" id="sponsorURL" readonly /> -->
					<!-- <p class="fw-bold mb-0">Join.MyProperTree.co.uk?<span id="referralCode"></span></p> -->
					<p class="fw-bold mb-0" id="referralCode"><?php echo e(route('join.sponsor',[Auth::user()->username])); ?></p>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 25px" fill="white" class="">
						<!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
						<path
							d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z"
						/>
					</svg>
				</div>
				<ul style="list-style: none" class="pt-4">
					<li>After referring 3 friends you'll receive an additional 1000 loyalty points.</li>
					<li>Also receive 1% in bonus credit on each of your referrals' first investment.</li>
				</ul>
			</div>
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

			// Retrieve the referral code from URL parameters
			const params = getQueryParams();
			const referralCode = params.referral || 'No referral code found';

			// Display the referral code
			//document.getElementById('referralCode').innerText = referralCode;

			//extra	
			$(document).ready(function() {	
			$(document).on('click', '.copyReferalLink', function() {
            var _this = $(this)[0];
            var copyText = $("#referralCode").text();
			navigator.clipboard.writeText(copyText).then(function() {
                    alert('Text copied to clipboard');
                }).catch(function(err) {
                    console.error('Could not copy text: ', err);
                });
			console.log(copyText);
        });
		});
		</script>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
			crossorigin="anonymous"
		></script>
	</body>
</html>
<?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/join/submitted.blade.php ENDPATH**/ ?>