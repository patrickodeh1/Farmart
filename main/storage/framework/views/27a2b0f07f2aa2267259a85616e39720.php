<?php $__env->startSection('content'); ?>
<div class="container-xl">
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title"><?php echo e(__('Activity Logs')); ?></h2>
                    </div>
                    <div class="col-auto">
                        <div class="btn-group" role="group">
                            <a href="<?php echo e(route('rezgo.index')); ?>" class="btn btn-link"><?php echo e(__('Settings')); ?></a>
                            <a href="<?php echo e(route('rezgo.product-mappings.index')); ?>" class="btn btn-link"><?php echo e(__('Product Mappings')); ?></a>
                            <a href="<?php echo e(route('rezgo.submit-order.form')); ?>" class="btn btn-link"><?php echo e(__('Submit Order')); ?></a>
                            <a href="<?php echo e(route('rezgo.submissions.index')); ?>" class="btn btn-link"><?php echo e(__('Submissions')); ?></a>
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
                                <table class="table table-vcenter table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Time')); ?></th>
                                            <th><?php echo e(__('Type')); ?></th>
                                            <th><?php echo e(__('Operation')); ?></th>
                                            <th><?php echo e(__('Message')); ?></th>
                                            <th><?php echo e(__('Related ID')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <small class="text-muted"><?php echo e($log->created_at->format('M d, H:i:s')); ?></small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-<?php echo e($log->log_type === 'error' ? 'danger' : ($log->log_type === 'warning' ? 'warning' : 'success')); ?> text-white">
                                                        <?php echo e(strtoupper($log->log_type)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <code><?php echo e($log->operation); ?></code>
                                                </td>
                                                <td>
                                                    <?php echo e($log->message); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($log->related_id ?? '—'); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">
                                                    <?php echo e(__('No logs found')); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if($logs->hasPages()): ?>
                                <div class="card-footer d-flex align-items-center">
                                    <?php echo e($logs->links()); ?>

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

<?php echo $__env->make('core/base::layouts/master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/admin/logs.blade.php ENDPATH**/ ?>