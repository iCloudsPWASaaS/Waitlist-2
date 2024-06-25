

<?php $__env->startSection('content'); ?>
<!-- Right Content Start -->
<style>
  .div {
    margin-top: 15px;
  }

  @media (max-width: 991px) {
    .div {
      max-width: 100%;
    }
  }

  .div-2 {
    gap: 20px;
    display: flex;
  }

  @media (max-width: 991px) {
    .div-2 {
      flex-direction: column;
      align-items: stretch;
      gap: 0px;
    }
  }

  .column {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 100%;
    margin-left: 0px;
  }

  @media (max-width: 991px) {
    .column {
      width: 100%;
    }
  }

  .div-3 {
    border-radius: 16px;
    background-color: #fff;
    display: flex;
    flex-grow: 1;
    align-items: end;
    gap: 20px;
    text-transform: capitalize;
    width: 100%;
    justify-content: space-between;
    padding: 19px 80px 19px 35px;
  }

  @media (max-width: 991px) {
    .div-3 {
      margin-top: 9px;
      flex-wrap: wrap;
      padding: 0 20px;
    }
  }

  .div-4 {
    align-self: stretch;
    display: flex;
    flex-direction: column;
  }

  .div-5 {
    color: #000;
    font: 600 18px Open Sans, sans-serif;
  }

  .div-6 {
    align-self: end;
    display: flex;
    margin-top: 12px;
    gap: 20px;
    font-size: 14px;
    font-weight: 500;
  }

  .div-7 {
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .div-8 {
    stroke-width: 1px;
    border-color: rgba(24, 154, 211, 1);
    border-style: solid;
    border-width: 1px;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    color: #fff;
    white-space: nowrap;
    justify-content: center;
    padding: 7px;
  }

  @media (max-width: 991px) {
    .div-8 {
      white-space: initial;
    }
  }

  .div-9 {
    font-family: Open Sans, sans-serif;
    background-color: #189ad3;
    border-radius: 50%;
    align-items: center;
    width: 34px;
    justify-content: center;
    height: 34px;
    padding: 9px;
  }

  @media (max-width: 991px) {
    .div-9 {
      white-space: initial;
    }
  }

  .div-10 {
    color: #676b77;
    font-family: Open Sans, sans-serif;
    margin-top: 9px;
  }



  .column-2 {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 57%;
    margin-left: 0px;
  }

  @media (max-width: 991px) {
    .column-2 {
      width: 100%;
    }
  }

  .div-35 {
    border-radius: 20px;
    background-color: #fff;
    display: flex;
    flex-grow: 1;
    flex-direction: column;
    justify-content: center;
    width: 100%;
  }

  @media (max-width: 991px) {
    .div-35 {
      max-width: 100%;
      margin-top: 9px;
    }
  }

  .div-36 {
    disply: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
    display: flex;
    min-height: 137px;
    align-items: end;
    gap: 11px;
    padding: 17px 35px;
  }

  @media (max-width: 991px) {
    .div-36 {
      flex-wrap: wrap;
      padding: 0 20px;
    }
  }

  .img {
    position: absolute;
    inset: 0;
    height: 100%;
    width: 100%;
    object-fit: cover;
    object-position: center;
  }

  .div-37 {
    position: relative;
    align-self: stretch;
    display: flex;
    flex-direction: column;
  }

  .div-38 {
    color: #000;
    text-transform: capitalize;
    font: 600 18px Open Sans, sans-serif;
  }

  .div-39 {
    display: flex;
    margin-top: 11px;
    gap: 11px;
  }

  .div-40 {
    background-color: rgba(217, 217, 217, 0.51);
    width: 74px;
    height: 74px;
  }

  .div-41 {
    background-color: rgba(217, 217, 217, 0.51);
    width: 74px;
    height: 74px;
  }

  .div-42 {
    background-color: rgba(217, 217, 217, 0.51);
    width: 74px;
    height: 74px;
  }
</style>


<div class="container-fluid">

  <!-- Page Content Wrapper Start -->
  <div class="main row">

    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0"><?php echo app('translator')->get('Referral'); ?></h3>
      </div>
    </div>

    <div class="col-md-6 mb-2">
      <div class="flex flex-col w-[43%] max-md:ml-0 max-md:w-full">
        <div class="flex flex-col grow pt-7 pb-10 w-full bg-white rounded-2xl max-md:mt-2.5 max-md:max-w-full">
          <div class="flex flex-col px-8 max-md:px-5 max-md:max-w-full">
            <div class="text-lg font-semibold text-black capitalize max-md:max-w-full">
              Refer a friend
            </div>
            <div class="mt-4 mr-6 text-base leading-6 text-zinc-500 max-md:mr-2.5 max-md:max-w-full">
              Share your referrals code to your friends via social media post or
              email.
            </div>
            <div class="flex gap-2.5 mt-6 max-md:flex-wrap max-md:max-w-full">
              <div class="row g-3 align-items-end">
                <div class="input-box col-8">
                  <label for=""><?php echo app('translator')->get('Enter email address'); ?></label>
                  <div class="input-group mt-2">
                    <input type="text" value="" class="form-control p-2" id="sponsorURL" readonly />
                  </div>
                </div>
                <div class="input-box col-4">
                  <button class="justify-center self-center mt-3.5 font-bold text-white whitespace-nowrap rounded-md max-md:px-5 btn-custom">
                    Send Email
                  </button>
                </div>
              </div>
            </div>
            <div class="self-center mt-7 text-base leading-6 text-center text-slate-400">
              OR
            </div>
          </div>
          <div class="flex flex-col px-8 mt-1 text-base leading-6 text-zinc-500 max-md:px-5 max-md:max-w-full">
            <div class="max-md:max-w-full">
              Share your referrals code to your friends via social media post.
            </div>
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/54c4bff17ed05dac0d506663b8612d46f75cb2582e1c41a691815e85421c77ce?" class="mt-4 max-w-full aspect-[7.69] w-[410px]" />
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="flex flex-col w-[57%] max-md:ml-0 max-md:w-full">
        <div class="grow py-7 pr-20 pl-9 w-full bg-white rounded-2xl max-md:px-5 max-md:mt-2.5 max-md:max-w-full">
          <div class="flex gap-5 max-md:flex-col max-md:gap-0">
            <div class="flex flex-col w-[33%] max-md:ml-0 max-md:w-full">
              <div class="flex flex-col grow text-xl capitalize max-md:mt-10">
                <div class="flex flex-col px-14 pt-16 pb-8 font-semibold bg-sky-50 rounded-3xl border-2 border-sky-500 border-solid max-md:px-5">
                  <div class="text-black">Loyalty Leaf</div>
                  <div class="mt-4 text-6xl font-bold text-center text-sky-500 max-md:text-4xl">
                    300
                  </div>
                  <div class="self-center mt-5 text-zinc-500">Points</div>
                </div>
                <button class="justify-center self-center mt-3.5 font-bold text-white whitespace-nowrap rounded-md max-md:px-5 btn-custom">
                  Exchange
                </button>
              </div>
            </div>
            <div class="flex flex-col ml-5 w-[33%] max-md:ml-0 max-md:w-full">
              <div class="flex justify-center items-center self-stretch px-12 py-20 my-auto w-full bg-sky-50 rounded-3xl border-2 border-sky-500 border-solid max-md:px-5 max-md:mt-10">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/f7b5f86bf8b0d437e6dd783b1a7a1513e8b6352ea9599cb32db696dcdb12fa87?" class="mt-4 w-14 aspect-[0.8] fill-sky-500" />
              </div>
            </div>
            <div class="flex flex-col ml-5 w-[33%] max-md:ml-0 max-md:w-full">
              <div class="flex justify-center items-center self-stretch px-12 py-20 my-auto w-full bg-sky-50 rounded-3xl border-2 border-sky-500 border-solid max-md:px-5 max-md:mt-10">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/f7b5f86bf8b0d437e6dd783b1a7a1513e8b6352ea9599cb32db696dcdb12fa87?" class="mt-4 w-14 aspect-[0.8] fill-sky-500" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="col-md-6 mt-4">
      <div class="column">
        <div class="div-3">
          <div class="div-4">
            <div class="div-5">Weekly Checkin</div>
            <div class="div-6">
              <div class="div-7">
                <div class="div-8">
                  <div class="div-9">+5</div>
                </div>
                <div class="div-10">1 Day</div>
              </div>
              <div class="div-7">
                <div class="div-8">
                  <div class="div-9">+5</div>
                </div>
                <div class="div-10">2 Day</div>
              </div>
              <div class="div-7">
                <div class="div-8">
                  <div class="div-9">+5</div>
                </div>
                <div class="div-10">3 Day</div>
              </div>
              <div class="div-7">
                <div class="div-8">
                  <div class="div-9">+5</div>
                </div>
                <div class="div-10">4 Day</div>
              </div>
              <div class="div-7">
                <div class="div-8">
                  <div class="div-9">+5</div>
                </div>
                <div class="div-10">5 Day</div>
              </div>
              <div class="div-7">
                <div class="div-8">
                  <div class="div-9">+5</div>
                </div>
                <div class="div-10">6 Day</div>
              </div>
              <div class="div-7">
                <div class="div-8">
                  <div class="div-9">+5</div>
                </div>
                <div class="div-10">7 Day</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 mt-4">
    <div class="col-7">
      <div class="column-2">
        <div class="div-35">
          <div class="div-36">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/dc1ac1e28501c310d1d4088e0dccd61ceb141af421cd904fb33ea7d59fb4744b?" class="img" />
            <div class="div-37">
              <div class="div-38">challenges:</div>
              <div class="div-39">
                <div class="div-40"></div>
                <div class="div-41"></div>
                <div class="div-42"></div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    </div>

  </div>

  
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="https://office.applebyproperty.co.uk/assets/js/iconify.min.js"></script> <!-- extra -->
<script src="<?php echo e(asset('assets/libs/subscription/common.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/subscription/owner-subscription.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($theme.'layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/themes/original/user/referral/index.blade.php ENDPATH**/ ?>