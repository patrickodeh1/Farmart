<?php
    Theme::layout('full-width');
    Theme::set('bodyClass', 'rezgo-cart-page');
?>

<div class="bg-light py-md-5 px-lg-3 px-2">
    <div class="container-xxxl">

        <h1 class="fs-4 fw-bold mb-4"><?php echo e(__('Your Cart')); ?></h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php if(empty($cart)): ?>
            <div class="alert alert-info">
                Your cart is empty.
                <a href="<?php echo e(route('rezgo.storefront.tours')); ?>" class="alert-link">Browse tours</a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tour</th>
                                        <th>Date</th>
                                        <th>Tickets</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php if($item['image']): ?>
                                                    <img src="<?php echo e($item['image']); ?>" class="rounded me-2"
                                                         style="width:50px;height:50px;object-fit:cover;" alt="">
                                                <?php endif; ?>
                                                <span class="fw-bold"><?php echo e($item['title']); ?></span>
                                            </td>
                                            <td><?php echo e($item['date']); ?></td>
                                            <td>
                                                <?php if($item['qty_adult'] > 0): ?>
                                                    <div><?php echo e($item['qty_adult']); ?>x Adult ($<?php echo e(number_format($item['price_adult'], 2)); ?>)</div>
                                                <?php endif; ?>
                                                <?php if($item['qty_child'] > 0): ?>
                                                    <div><?php echo e($item['qty_child']); ?>x Child ($<?php echo e(number_format($item['price_child'], 2)); ?>)</div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="fw-bold">$<?php echo e(number_format($item['total'], 2)); ?></td>
                                            <td>
                                                <form action="<?php echo e(route('rezgo.storefront.cart.remove')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="index" value="<?php echo e($index); ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="<?php echo e(route('rezgo.storefront.tours')); ?>" class="btn btn-outline-secondary">
                            &larr; Continue Browsing
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-sm p-4">
                        <h5 class="fw-bold mb-3">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span><?php echo e(count($cart)); ?> item(s)</span>
                            <span>$<?php echo e(number_format($cartTotal, 2)); ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                            <span>Total</span>
                            <span class="text-primary">$<?php echo e(number_format($cartTotal, 2)); ?></span>
                        </div>
                        <a href="<?php echo e(route('rezgo.storefront.checkout')); ?>" class="btn btn-primary w-100 btn-lg">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/themes/cart.blade.php ENDPATH**/ ?>