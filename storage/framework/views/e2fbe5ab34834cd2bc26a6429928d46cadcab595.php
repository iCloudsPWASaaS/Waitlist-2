<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Default Template'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">


            <div class="table-responsive">
                <table id="zero_config"
                       class="table table-striped table-bordered no-wrap">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('No.'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Subject'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Template Key'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <?php if(adminAccessRoute(config('role.website_controls.access.edit'))): ?>
                        <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $emailTemplate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <?php echo e($loop->iteration); ?> </td>
                            <td><?php echo e($template->name); ?></td>
                            <td><?php echo e($template->subject); ?></td>
                            <td><?php echo e($template->template_key); ?></td>
                            <td>
                                <span class="custom-badge badge-pill bg-<?php echo e(($template->mail_status == 1) ?'success' : 'danger'); ?>"><?php echo e(($template->mail_status == 1) ?trans('Active') : trans('Deactive')); ?></span>
                            </td>
                            <?php if(adminAccessRoute(config('role.website_controls.access.edit'))): ?>
                            <td>
                                <a  href="<?php echo e(route('admin.email-template.edit',$template->id)); ?>" class="btn btn-sm btn-outline-primary btn-rounded" title="<?php echo app('translator')->get('Edit'); ?>"><i class="fas fa-edit" aria-hidden="true"></i></a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/admin/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/admin/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/datatable-basic.init.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/myprexnd/test.mypropertree.co.uk/resources/views/admin/email-template/show.blade.php ENDPATH**/ ?>