<?php if($discounts->isNotEmpty()): ?>
    <div class="checkout__coupon-section">
        <div class="checkout__coupon-heading">
            <img width="32" height="32" src="<?php echo e(asset('vendor/core/plugins/ecommerce/images/coupon-code.gif')); ?>" alt="coupon code icon">
            <?php echo e(__('Coupon codes (:count)', ['count' => $discounts->count()])); ?>

        </div>

        <div class="checkout__coupon-list">
            <?php $__currentLoopData = $discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(['checkout__coupon-item', 'active' => session()->has('applied_coupon_code') && session()->get('applied_coupon_code') === $discount->code]); ?>"
                >
                    <div class="checkout__coupon-item-icon"></div>
                    <div class="checkout__coupon-item-content">
                        <?php echo apply_filters('checkout_discount_item_before', null, $discount); ?>


                        <div class="checkout__coupon-item-title">
                            <?php if($discount->type_option !== 'shipping'): ?>
                                <h4><?php echo e($discount->type_option == 'percentage' ? $discount->value . '%' : format_price($discount->value)); ?></h4>
                            <?php endif; ?>

                            <?php if($discount->quantity > 0): ?>
                                <span class="checkout__coupon-item-count">
                                    (<?php echo e(__('Left :left', ['left' => $discount->left_quantity])); ?>)
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="checkout__coupon-item-description">
                            <?php echo BaseHelper::clean($discount->description ?: get_discount_description($discount)); ?>

                        </div>
                        <div class="checkout__coupon-item-code">
                            <span><?php echo e($discount->code); ?></span>
                            <?php if(!session()->has('applied_coupon_code') || session()->get('applied_coupon_code') !== $discount->code): ?>
                                <button type="button" data-bb-toggle="apply-coupon-code" data-discount-code="<?php echo e($discount->code); ?>">
                                    <?php echo e(__('Apply')); ?>

                                </button>
                            <?php else: ?>
                                <button type="button" class="remove-coupon-code" data-url="<?php echo e(route('public.coupon.remove')); ?>">
                                    <?php echo e(__('Remove')); ?>

                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>

<div
    class="checkout-discount-section"
    <?php if(session()->has('applied_coupon_code')): ?> style="display: none;" <?php endif; ?>
>
    <a class="btn-open-coupon-form" href="#">
        <?php echo e(__('You have a coupon code?')); ?>

    </a>
</div>
<div
    class="coupon-wrapper mt-2"
    <?php if(!session()->has('applied_coupon_code')): ?> style="display: none;" <?php endif; ?>
>
    <?php if(!session()->has('applied_coupon_code')): ?>
        <?php echo $__env->make(EcommerceHelper::viewPath('discounts.partials.apply-coupon'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make(EcommerceHelper::viewPath('discounts.partials.remove-coupon'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
</div>
<div class="clearfix"></div>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/discounts/partials/form.blade.php ENDPATH**/ ?>