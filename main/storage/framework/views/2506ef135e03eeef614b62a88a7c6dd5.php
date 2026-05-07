<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">External Database Sync Connection Status</h5>
                    </div>
                    <div class="card-body">
                        <?php if(!empty($connectionStatus) && is_array($connectionStatus)): ?>
                            <?php if(isset($connectionStatus['success']) && $connectionStatus['success']): ?>
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> <strong>✓ Connected</strong>
                                    <br><?php echo e($connectionStatus['message'] ?? 'Connection successful'); ?>

                                </div>
                            <?php else: ?>
                                <div class="alert alert-danger">
                                    <i class="fas fa-times-circle"></i> <strong>✗ Not Connected</strong>
                                    <br><?php echo e($connectionStatus['message'] ?? 'Connection failed'); ?>

                                </div>
                            <?php endif; ?>
                        <?php elseif($enabled): ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-info-circle"></i> <strong>⊝ Not Configured</strong>
                                <br>External sync is enabled but credentials are missing. Set DZM_COATAA_DB_* variables in .env
                            </div>
                        <?php else: ?>
                            <div class="alert alert-secondary">
                                <i class="fas fa-ban"></i> <strong>○ Disabled</strong>
                                <br>External sync is disabled. Set REZGO_EXTERNAL_SYNC_ENABLED=true in .env to enable
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make(BaseHelper::getAdminMasterLayoutTemplate(), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/admin/external-sync-settings.blade.php ENDPATH**/ ?>