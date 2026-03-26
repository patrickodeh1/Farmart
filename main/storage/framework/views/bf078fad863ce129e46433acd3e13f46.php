<?php $__env->startSection('title', __('Order successfully at :site_title', ['site_title' => Theme::getSiteTitle()])); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-7 col-md-6 col-12">
            <?php echo $__env->make('plugins/ecommerce::orders.partials.logo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="thank-you">
                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-circle-check-filled'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>

                <div class="d-inline-block">
                    <h3 class="thank-you-sentence">
                        <?php echo e(__('Your order is successfully placed')); ?>

                    </h3>
                    <p><?php echo e(__('Thank you for purchasing our products!')); ?></p>
                </div>
            </div>

            <?php echo $__env->make('plugins/ecommerce::orders.thank-you.customer-info', [
                'order' => $orders,
                'isShowShipping' => false,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <a
                class="btn payment-checkout-btn"
                href="<?php echo e(BaseHelper::getHomepageUrl()); ?>"
            > <?php echo e(__('Continue shopping')); ?> </a>
        </div>

        <div class="col-lg-5 col-md-6 mt-5 mt-md-0 mb-5">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-light p-3 pt-0">
                    <?php echo $__env->make('plugins/ecommerce::orders.thank-you.order-info', ['isShowTotalInfo' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <?php if(! $loop->last): ?>
                    <hr class="border-dark-subtle" />
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if(count($orders) > 1): ?>
                <hr class="border-dark-subtle" />
                <!-- total info -->
                <div class="bg-light p-3">
                    <div class="row total-price">
                        <div class="col-6">
                            <p><?php echo e(__('Sub amount')); ?>:</p>
                        </div>
                        <div class="col-6">
                            <p class="text-end"><?php echo e(format_price($orders->sum('sub_total'))); ?></p>
                        </div>
                    </div>

                    <?php if($orders->filter(fn ($order) => $order->shipment->id)->count()): ?>
                        <div class="row total-price">
                            <div class="col-6">
                                <p><?php echo e(__('Shipping fee')); ?>:</p>
                            </div>
                            <div class="col-6">
                                <p class="text-end"><?php echo e(format_price($orders->sum('shipping_amount'))); ?> </p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($orders->sum('discount_amount')): ?>
                        <div class="row total-price">
                            <div class="col-6">
                                <p><?php echo e(__('Discount')); ?>:</p>
                            </div>
                            <div class="col-6">
                                <p class="text-end"><?php echo e(format_price($orders->sum('discount_amount'))); ?> </p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(EcommerceHelper::isTaxEnabled()): ?>
                        <div class="row total-price">
                            <div class="col-6">
                                <p><?php echo e(__('Tax')); ?>:</p>
                            </div>
                            <div class="col-6">
                                <p class="text-end"><?php echo e(format_price($orders->sum('tax_amount'))); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row total-price">
                        <div class="col-6">
                            <p><?php echo e(__('Total amount')); ?>:</p>
                        </div>
                        <div class="col-6">
                            <p class="total-text raw-total-text text-end">
                                <?php echo e(format_price($orders->sum('amount'))); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plugins/ecommerce::orders.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/platform/plugins/marketplace/resources/views/orders/thank-you.blade.php ENDPATH**/ ?>