<?php
    Theme::layout('full-width');
    Theme::set('bodyClass', 'rezgo-checkout-page');
?>

<div class="bg-light py-md-5 px-lg-3 px-2">
    <div class="container-xxxl">

        <h1 class="fs-4 fw-bold mb-4"><?php echo e(__('Checkout')); ?></h1>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-3">Contact Details</h5>
                    <form action="<?php echo e(route('rezgo.storefront.checkout.process')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name *</label>
                                <input type="text" name="first_name" class="form-control"
                                       value="<?php echo e(old('first_name', $customer->first_name ?? '')); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name *</label>
                                <input type="text" name="last_name" class="form-control"
                                       value="<?php echo e(old('last_name', $customer->last_name ?? '')); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control"
                                   value="<?php echo e(old('email', $customer->email ?? '')); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control"
                                   value="<?php echo e(old('phone', $customer->phone ?? '')); ?>">
                        </div>

                        <?php if(auth()->guard('customer')->guest()): ?>
                            <div class="alert alert-info small">
                                <a href="<?php echo e(route('customer.login')); ?>">Login</a> or
                                <a href="<?php echo e(route('customer.register')); ?>">Register</a>
                                to save your booking history. Or continue as guest.
                            </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary w-100 btn-lg mt-2">
                            <i class="ti ti-check me-1"></i> Confirm Booking
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-3">Order Summary</h5>
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="fw-bold small"><?php echo e($item['title']); ?></div>
                            <div class="text-muted small"><?php echo e($item['date']); ?></div>
                            <?php if($item['qty_adult'] > 0): ?>
                                <div class="small"><?php echo e($item['qty_adult']); ?>x Adult — $<?php echo e(number_format($item['price_adult'], 2)); ?></div>
                            <?php endif; ?>
                            <?php if($item['qty_child'] > 0): ?>
                                <div class="small"><?php echo e($item['qty_child']); ?>x Child — $<?php echo e(number_format($item['price_child'], 2)); ?></div>
                            <?php endif; ?>
                            <div class="fw-bold mt-1">$<?php echo e(number_format($item['total'], 2)); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span class="text-primary">$<?php echo e(number_format($cartTotal, 2)); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/themes/checkout.blade.php ENDPATH**/ ?>