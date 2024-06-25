 <!--extra-->
<?php $__env->startSection('title', trans($title)); ?>

<?php $__env->startSection('content'); ?>
<?php if(count($allBlogs) > 0): ?>
<!-- blog section  -->
<section class="blog-page blog-details mt-5 overlay w-100" id="content">
    <div class="container">
        <div class="row g-lg-5">
            <div class="col-lg-12">
                <ul class="nav nav-pills my-3" id="pills-tab" role="tablist">
                    <li>
                        <a class="nav-link nav-pill-custom <?php echo e(($slug == 'all') ? 'active':''); ?>" href="<?php echo e(route('blog')); ?>">All</a>
                    </li>
                    <?php $__currentLoopData = $blogCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class="nav-link nav-pill-custom <?php echo e(($slug == slug(@$category->details->name)) ? 'active':''); ?>" href="<?php echo e(route('CategoryWiseBlog', [slug(@$category->details->name), $category->id])); ?>"><?php echo app('translator')->get(optional(@$category->details)->name); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-1">
                        <?php echo e($allBlogs->links()); ?>

                    </ul>
                </nav>
            </div>

        </div>

        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $allBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-4">
                <div class="blog-box">
                    <div class="img-box">
                        <img src="<?php echo e(getFile(config('location.blog.path'). @$blog->image)); ?>" class="img-fluid" alt="<?php echo app('translator')->get('blog image'); ?>" />
                    </div>
                    <div class="text-box p-3">
                        <div class="date-author">
                            <span><i class="fal fa-clock"></i> <?php echo e(dateTime(@$blog->created_at, 'M d, Y')); ?> </span>
                            <span><i class="fal fa-user-circle"></i> <?php echo app('translator')->get(optional(@$blog->details)->author); ?> </span>
                        </div>
                        <a href="<?php echo e(route('blogDetails',[slug(@$blog->details->title), $blog->id])); ?>" class="title"><?php echo e(\Illuminate\Support\Str::limit(optional(@$blog->details)->title, 100)); ?></a>
                        <!-- <p>
                            <?php echo e(Illuminate\Support\Str::limit(strip_tags(optional(@$blog->details)->details),500)); ?>

                        </p> -->
                        <!-- <a href="<?php echo e(route('blogDetails',[slug(@$blog->details->title), $blog->id])); ?>" class="btn-custom mt-3"><?php echo app('translator')->get('Read more'); ?></a> -->
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php else: ?>
<div class="custom-not-found">
    <img src="<?php echo e(asset($themeTrue.'img/no_data_found.png')); ?>" alt="not found" class="img-fluid">
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/themes/original/blog.blade.php ENDPATH**/ ?>