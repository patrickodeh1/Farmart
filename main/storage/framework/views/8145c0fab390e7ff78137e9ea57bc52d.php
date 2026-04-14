<?php $__env->startSection('content'); ?>
<div class="container-xl">
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title"><?php echo e(__('Product Mappings')); ?></h2>
                    </div>
                    <div class="col-auto">
                        <div class="btn-group" role="group">
                            <a href="<?php echo e(route('rezgo.index')); ?>" class="btn btn-link"><?php echo e(__('Settings')); ?></a>
                            <a href="<?php echo e(route('rezgo.submit-order.form')); ?>" class="btn btn-link"><?php echo e(__('Submit Order')); ?></a>
                            <a href="<?php echo e(route('rezgo.submissions.index')); ?>" class="btn btn-link"><?php echo e(__('Submissions')); ?></a>
                            <a href="<?php echo e(route('rezgo.logs.index')); ?>" class="btn btn-link"><?php echo e(__('Logs')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                <?php endif; ?>

                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Product')); ?></th>
                                            <th style="width: 40%;"><?php echo e(__('Rezgo Inventory')); ?></th>
                                            <th><?php echo e(__('Passenger Type')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <th style="width: 150px;"><?php echo e(__('Actions')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $mappings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <strong><?php echo e($mapping->product->name ?? 'N/A'); ?></strong>
                                                </td>
                                                <td style="word-break: break-word;">
                                                    <small><?php echo e($mapping->rezgo_title ?? '—'); ?></small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info"><?php echo e(ucfirst($mapping->passenger_type)); ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-<?php echo e($mapping->is_active ? 'success' : 'secondary'); ?>">
                                                        <?php echo e($mapping->is_active ? __('Active') : __('Inactive')); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group gap-1" role="group">
                                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#mapModal" onclick="setMappingData(<?php echo e($mapping->id); ?>, <?php echo e($mapping->product_id); ?>, '<?php echo e($mapping->rezgo_uid); ?>', '<?php echo e($mapping->rezgo_title); ?>', '<?php echo e($mapping->passenger_type); ?>')" title="<?php echo e(__('Edit mapping')); ?>">
                                                            ✏️
                                                        </button>
                                                        <form action="<?php echo e(route('rezgo.product-mappings.delete', $mapping->id)); ?>" method="POST" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-sm btn-ghost-danger" onclick="return confirm('<?php echo e(__('Are you sure?')); ?>')" title="<?php echo e(__('Delete mapping')); ?>">
                                                                🗑️
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">
                                                    <?php echo e(__('No product mappings configured')); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if($mappings->hasPages()): ?>
                                <div class="card-footer d-flex align-items-center">
                                    <?php echo e($mappings->links()); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Available Rezgo Inventory -->
                    <?php if($rezgoTours): ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo e(__('Available Rezgo Inventory')); ?></h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Inventory Name')); ?></th>
                                                <th><?php echo e(__('UID')); ?></th>
                                                <th><?php echo e(__('Actions')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $rezgoTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <strong><?php echo e($tour['name'] ?? $tour['item'] ?? 'N/A'); ?></strong>
                                                        <?php if(isset($tour['option']) && $tour['option']): ?>
                                                            <br><small class="text-muted"><?php echo e($tour['option']); ?></small>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <code><?php echo e($tour['uid'] ?? '—'); ?></code>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#mapModal" onclick="setTourData('<?php echo e($tour['uid'] ?? ''); ?>', '<?php echo e($tour['name'] ?? $tour['item'] ?? ''); ?>', '<?php echo e($tour['option'] ?? ''); ?>')">
                                                            <?php echo e(__('Map Product')); ?>

                                                        </button>
                                                        <a href="<?php echo e(route('rezgo.import-as-draft', ['rezgo_uid' => $tour['uid'] ?? '', 'rezgo_title' => $tour['name'] ?? $tour['item'] ?? ''])); ?>" class="btn btn-sm btn-success">
                                                            <?php echo e(__('Import as Draft')); ?>

                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Modal -->
<div class="modal modal-blur fade" id="mapModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(__('Map Product to Rezgo Inventory')); ?></h5>
            </div>
            <form action="<?php echo e(route('rezgo.product-mappings.save')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" id="mappingId" name="mapping_id" value="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('Product')); ?></label>
                        <select class="form-control" id="productSelect" name="product_id" required>
                            <option value=""><?php echo e(__('Select a product')); ?></option>
                            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option disabled><?php echo e(__('No products available')); ?></option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('Rezgo Inventory UID')); ?></label>
                        <input type="text" class="form-control" name="rezgo_uid" id="rezgoUid">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('Rezgo Inventory Title')); ?></label>
                        <input type="text" class="form-control" name="rezgo_title" id="rezgoTitle">
                    </div>

                    <input type="hidden" id="rezgoOption" name="rezgo_option">

                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('Passenger Type')); ?></label>
                        <select class="form-control" id="passengerType" name="passenger_type" required>
                            <option value="adult"><?php echo e(__('Adult')); ?></option>
                            <option value="child"><?php echo e(__('Child')); ?></option>
                            <option value="senior"><?php echo e(__('Senior')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></a>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Save Mapping')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function setTourData(uid, title, option = '') {
    // New mapping mode - populate fields when modal opens
    const mapModal = document.getElementById('mapModal');
    if (mapModal) {
        const bsModal = bootstrap.Modal.getInstance(mapModal) || new bootstrap.Modal(mapModal);
        
        mapModal.addEventListener('shown.bs.modal', function populateNewMapping() {
            document.getElementById('mappingId').value = '';
            document.getElementById('productSelect').value = '';
            document.getElementById('rezgoUid').value = uid || '';
            document.getElementById('rezgoTitle').value = (title || '') + (option ? ' — ' + option : '');
            document.getElementById('rezgoOption').value = option || '';
            document.getElementById('passengerType').value = 'adult';
            mapModal.removeEventListener('shown.bs.modal', populateNewMapping);
        }, { once: true });
    }
}

function setMappingData(mappingId, productId, uid, title, passengerType) {
    // Edit mapping mode - populate fields when modal opens
    const mapModal = document.getElementById('mapModal');
    if (mapModal) {
        const bsModal = bootstrap.Modal.getInstance(mapModal) || new bootstrap.Modal(mapModal);
        
        mapModal.addEventListener('shown.bs.modal', function populateEditMapping() {
            document.getElementById('mappingId').value = mappingId || '';
            document.getElementById('productSelect').value = productId || '';
            document.getElementById('rezgoUid').value = uid || '';
            document.getElementById('rezgoTitle').value = title || '';
            document.getElementById('rezgoOption').value = '';
            document.getElementById('passengerType').value = passengerType || 'adult';
            mapModal.removeEventListener('shown.bs.modal', populateEditMapping);
        }, { once: true });
    }
}

// Reset form when modal is closed
document.addEventListener('DOMContentLoaded', function() {
    const mapModal = document.getElementById('mapModal');
    if (mapModal) {
        mapModal.addEventListener('hidden.bs.modal', function() {
            document.getElementById('mappingId').value = '';
        });
    }
});
</script>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core/base::layouts/master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/admin/product-mappings.blade.php ENDPATH**/ ?>