<?php $__env->startSection('content'); ?>
<div class="container-xl">
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title"><?php echo e(__('Submit Order to Rezgo')); ?></h2>
                    </div>
                    <div class="col-auto d-flex gap-2">
                        <a href="<?php echo e(route('rezgo.submissions.index')); ?>" class="btn btn-info"><?php echo e(__('View Submissions')); ?></a>
                        <a href="<?php echo e(route('rezgo.index')); ?>" class="btn btn-link"><?php echo e(__('Back to Settings')); ?></a>
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
                    <!-- Available Orders List -->
                    <?php if($orders && count($orders) > 0): ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Order ID')); ?></th>
                                            <th><?php echo e(__('Customer')); ?></th>
                                            <th><?php echo e(__('Products')); ?></th>
                                            <th><?php echo e(__('Total')); ?></th>
                                            <th><?php echo e(__('Date')); ?></th>
                                            <th><?php echo e(__('Tour Date')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <strong>#<?php echo e($order['id']); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo e($order['customer_name']); ?>

                                            </td>
                                            <td>
                                                <div class="small">
                                                    <?php $__currentLoopData = $order['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $availability = isset($tourAvailability[$product['rezgo_tour']]) 
                                                                ? $tourAvailability[$product['rezgo_tour']]['availability'] 
                                                                : 'Unknown';
                                                            $hasAvailability = is_numeric($availability) && $availability > 0;
                                                        ?>
                                                        <div>
                                                            <span class="badge bg-<?php echo e($product['mapped'] ? 'success' : 'warning'); ?>">
                                                                <?php echo e($product['product_name']); ?> (x<?php echo e($product['quantity']); ?>)
                                                            </span>
                                                            <?php if($product['mapped']): ?>
                                                                <br><small class="text-muted">
                                                                    → <?php echo e($product['rezgo_title']); ?>

                                                                    <?php if(is_numeric($availability)): ?>
                                                                        <span class="badge bg-<?php echo e($hasAvailability ? 'info' : 'danger'); ?> ms-1">
                                                                            Avail: <?php echo e($availability); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <br><small class="text-danger">⚠ No mapping</small>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </td>
                                            <td>
                                                $<?php echo e(number_format($order['total'], 2)); ?>

                                            </td>
                                            <td>
                                                <?php echo e(\Carbon\Carbon::parse($order['created_at'])->format('M d, Y')); ?>

                                            </td>
                                            <td>
                                                <form action="<?php echo e(route('rezgo.submit-order')); ?>" method="POST" style="display: inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="order_id" value="<?php echo e($order['id']); ?>">
                                                    <input type="date" name="tour_date" class="form-control form-control-sm" value="<?php echo e(\Carbon\Carbon::now()->addDay()->format('Y-m-d')); ?>" min="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d')); ?>" required style="max-width: 150px; display: inline-block;">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <?php echo e(__('Submit')); ?>

                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <?php echo e(__('No orders available for submission.')); ?>

                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Instructions -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo e(__('Instructions')); ?></h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li><strong>Product Status:</strong> 
                                        <span class="badge bg-success">Green</span> = Mapped to Rezgo tour | 
                                        <span class="badge bg-warning">Yellow</span> = No mapping configured
                                    </li>
                                    <li><strong>Availability:</strong>
                                        <span class="badge bg-info">Avail: N</span> = How many spots available (shown next to tour name)
                                        <span class="badge bg-danger">Avail: 0</span> = No availability - choose different tour or date
                                    </li>
                                    <li><?php echo e(__('Only submit orders where all products have Rezgo mappings')); ?></li>
                                    <li><strong>Tour Date:</strong> Select a date when the tour has availability (see Avail count)</li>
                                    <li><?php echo e(__('Click "Submit" to send the order to Rezgo API')); ?></li>
                                    <li><?php echo e(__('Check the "View Submissions" page to see results and any error messages')); ?></li>
                                    <li><strong>Price:</strong> Pricing is managed in Rezgo; $0 in submissions means the booking was recorded without local pricing data</li>
                                </ul>
                                <div class="alert alert-info mt-3">
                                    <strong>Troubleshooting:</strong>
                                    If you get "Availability Error", the tour has no spots available on that date. Try a different date or different product with a tour that has availability.
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

<?php echo $__env->make('core/base::layouts/master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/platform/plugins/rezgo-connector/src/Providers/../../resources/views/admin/submit-order.blade.php ENDPATH**/ ?>