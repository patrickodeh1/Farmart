<?php $__env->startSection('content'); ?>
<div class="container-xl">
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title"><?php echo e(__('Rezgo Submissions')); ?></h2>
                    </div>
                    <div class="col-auto">
                        <div class="btn-group" role="group">
                            <a href="<?php echo e(route('rezgo.index')); ?>" class="btn btn-link"><?php echo e(__('Settings')); ?></a>
                            <a href="<?php echo e(route('rezgo.product-mappings.index')); ?>" class="btn btn-link"><?php echo e(__('Product Mappings')); ?></a>
                            <a href="<?php echo e(route('rezgo.submit-order.form')); ?>" class="btn btn-link"><?php echo e(__('Submit Order')); ?></a>
                            <a href="<?php echo e(route('rezgo.logs.index')); ?>" class="btn btn-link"><?php echo e(__('Logs')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Order ID')); ?></th>
                                            <th><?php echo e(__('Rezgo Booking ID')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <th><?php echo e(__('HTTP Status')); ?></th>
                                            <th><?php echo e(__('Submitted')); ?></th>
                                            <th><?php echo e(__('Actions')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <strong>#<?php echo e($submission->order_id); ?></strong>
                                                </td>
                                                <td>
                                                    <?php echo e($submission->rezgo_booking_id ?? '—'); ?>

                                                </td>
                                                <td>
                                                    <span class="badge bg-<?php echo e($submission->status === 'success' ? 'success' : 'danger'); ?> text-white">
                                                        <?php echo e(ucfirst($submission->status)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if($submission->http_status): ?>
                                                        <span class="badge bg-<?php echo e($submission->http_status >= 200 && $submission->http_status < 300 ? 'success' : 'danger'); ?> text-white">
                                                            <?php echo e($submission->http_status); ?>

                                                        </span>
                                                    <?php else: ?>
                                                        —
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php echo e($submission->created_at->format('M d, H:i')); ?>

                                                </td>
                                                <td>
                                                    <a href="<?php echo e(route('rezgo.submissions.detail', $submission->id)); ?>" class="btn btn-sm btn-ghost-primary">
                                                        <?php echo e(__('View')); ?>

                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    <?php echo e(__('No submissions found')); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if($submissions->hasPages()): ?>
                                <div class="card-footer d-flex align-items-center">
                                    <?php echo e($submissions->links()); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core/base::layouts/master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/admin/submissions.blade.php ENDPATH**/ ?>