<?php $__env->startSection('content'); ?>
<div class="container-xl">
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title"><?php echo e(__('Rezgo Connector Settings')); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="alert-title"><?php echo e(__('Error')); ?></div>
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                <?php endif; ?>

                <div class="row row-cards">
                    <!-- Statistics Cards -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-sm font-semibold"><?php echo e(__('Total Submissions')); ?></div>
                                <div class="text-lg font-bold"><?php echo e($submissionsCount); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-sm font-semibold"><?php echo e(__('Successful')); ?></div>
                                <div class="text-lg font-bold text-success"><?php echo e($successCount); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-sm font-semibold"><?php echo e(__('Failed')); ?></div>
                                <div class="text-lg font-bold text-danger"><?php echo e($failedCount); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-sm font-semibold"><?php echo e(__('Product Mappings')); ?></div>
                                <div class="text-lg font-bold text-primary"><?php echo e($mappingsCount); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Form -->
                <div class="row row-cards mt-4">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo e(__('API Configuration')); ?></h3>
                            </div>
                            <form action="<?php echo e(route('rezgo.settings.update')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('Rezgo CID')); ?></label>
                                        <input 
                                            type="text" 
                                            class="form-control <?php $__errorArgs = ['rezgo_cid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="rezgo_cid"
                                            value="<?php echo e(old('rezgo_cid', $decrypted_cid ?? '')); ?>"
                                            placeholder="Enter your Rezgo CID"
                                        >
                                        <?php $__errorArgs = ['rezgo_cid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('Rezgo API Key')); ?></label>
                                        <input 
                                            type="text" 
                                            class="form-control <?php $__errorArgs = ['rezgo_api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="rezgo_api_key"
                                            value="<?php echo e(old('rezgo_api_key', $decrypted_api_key ?? '')); ?>"
                                            placeholder="Enter your Rezgo API Key"
                                        >
                                        <?php $__errorArgs = ['rezgo_api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small class="text-muted"><?php echo e(__('Your API key is encrypted and stored securely')); ?></small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('Default Passenger Type')); ?></label>
                                        <select class="form-control <?php $__errorArgs = ['default_passenger_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="default_passenger_type">
                                            <option value="adult" <?php echo e(old('default_passenger_type', $settings['default_passenger_type'] ?? 'adult') === 'adult' ? 'selected' : ''); ?>><?php echo e(__('Adult')); ?></option>
                                            <option value="child" <?php echo e(old('default_passenger_type', $settings['default_passenger_type'] ?? 'adult') === 'child' ? 'selected' : ''); ?>><?php echo e(__('Child')); ?></option>
                                            <option value="senior" <?php echo e(old('default_passenger_type', $settings['default_passenger_type'] ?? 'adult') === 'senior' ? 'selected' : ''); ?>><?php echo e(__('Senior')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['default_passenger_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(__('Booking Date Offset (Days)')); ?></label>
                                        <input 
                                            type="number" 
                                            class="form-control <?php $__errorArgs = ['booking_date_offset'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="booking_date_offset"
                                            value="<?php echo e(old('booking_date_offset', $settings['booking_date_offset'] ?? 1)); ?>"
                                            min="0"
                                            max="365"
                                        >
                                        <small class="text-muted"><?php echo e(__('Days from today to book inventory')); ?></small>
                                        <?php $__errorArgs = ['booking_date_offset'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" name="sync_enabled" value="1" <?php echo e(old('sync_enabled', $settings['sync_enabled'] ?? false) ? 'checked' : ''); ?>>
                                            <span class="form-check-label"><?php echo e(__('Enable Order Synchronization')); ?></span>
                                        </label>
                                        <small class="text-muted d-block"><?php echo e(__('Enable automatic order submission to Rezgo')); ?></small>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <a href="<?php echo e(route('rezgo.test-connection')); ?>" class="btn btn-link"><?php echo e(__('Test Connection')); ?></a>
                                    <button type="submit" class="btn btn-primary"><?php echo e(__('Save Settings')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo e(__('Quick Navigation')); ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-transparent">
                                    <a href="<?php echo e(route('rezgo.product-mappings.index')); ?>" class="list-group-item list-group-item-action">
                                        <?php echo e(__('Product Mappings')); ?>

                                        <span class="badge bg-primary text-white float-end"><?php echo e($mappingsCount); ?></span>
                                    </a>
                                    <a href="<?php echo e(route('rezgo.submit-order.form')); ?>" class="list-group-item list-group-item-action">
                                        <?php echo e(__('Submit Order')); ?>

                                    </a>
                                    <a href="<?php echo e(route('rezgo.submissions.index')); ?>" class="list-group-item list-group-item-action">
                                        <?php echo e(__('Submissions')); ?>

                                        <span class="badge bg-info text-white float-end"><?php echo e($submissionsCount); ?></span>
                                    </a>
                                    <a href="<?php echo e(route('rezgo.logs.index')); ?>" class="list-group-item list-group-item-action">
                                        <?php echo e(__('Activity Logs')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Logs -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo e(__('Recent Activity')); ?></h3>
                            </div>
                            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                <?php $__empty_1 = true; $__currentLoopData = $recentLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="mb-2 pb-2 border-bottom">
                                        <small class="text-muted"><?php echo e($log->created_at->diffForHumans()); ?></small>
                                        <div class="small">
                                            <span class="badge bg-<?php echo e($log->log_type === 'error' ? 'danger' : ($log->log_type === 'warning' ? 'warning' : 'success')); ?> text-white">
                                                <?php echo e(strtoupper($log->log_type)); ?>

                                            </span>
                                            <?php echo e($log->message); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-muted small"><?php echo e(__('No recent activity')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core/base::layouts/master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/admin/settings.blade.php ENDPATH**/ ?>