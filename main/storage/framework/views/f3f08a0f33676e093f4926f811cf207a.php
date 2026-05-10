<?php echo apply_filters(RENDER_PRODUCTS_IN_CHECKOUT_PAGE, $products); ?>


<div class="mt-2 p-2">
    <div class="row">
        <div class="col-6">
            <p><?php echo e(__('Subtotal')); ?>:</p>
        </div>
        <div class="col-6">
            <p class="price-text sub-total-text text-end">
                <?php echo e(format_price(Cart::instance('cart')->rawSubTotal())); ?>

            </p>
        </div>
    </div>
    <?php if(EcommerceHelper::isTaxEnabled()): ?>
        <div class="row">
            <div class="col-6">
                <p><?php echo e(__('Tax')); ?> <?php if(Cart::instance('cart')->rawTax()): ?>
                    (<small><?php echo e(Cart::instance('cart')->taxClassesName()); ?></small>)
                <?php endif; ?></p>
            </div>
            <div class="col-6 float-end">
                <p class="price-text tax-price-text">
                    <?php echo e(format_price(Cart::instance('cart')->rawTax())); ?>

                </p>
            </div>
        </div>
    <?php endif; ?>
    <?php if(session('applied_coupon_code')): ?>
        <div class="row coupon-information">
            <div class="col-6">
                <p><?php echo e(__('Coupon code')); ?>:</p>
            </div>
            <div class="col-6">
                <p class="price-text coupon-code-text">
                    <?php echo e(session('applied_coupon_code')); ?>

                </p>
            </div>
        </div>
    <?php endif; ?>
    <?php if($couponDiscountAmount > 0): ?>
        <div class="row price discount-amount">
            <div class="col-6">
                <p><?php echo e(__('Coupon code discount amount')); ?>:</p>
            </div>
            <div class="col-6">
                <p class="price-text total-discount-amount-text">
                    <?php echo e(format_price($couponDiscountAmount)); ?>

                </p>
            </div>
        </div>
    <?php endif; ?>
    <?php if($promotionDiscountAmount > 0): ?>
        <div class="row">
            <div class="col-6">
                <p><?php echo e(__('Promotion discount amount')); ?>:</p>
            </div>
            <div class="col-6">
                <p class="price-text">
                    <?php echo e(format_price($promotionDiscountAmount)); ?>

                </p>
            </div>
        </div>
    <?php endif; ?>
    <?php if(!empty($shipping) && Arr::get($sessionCheckoutData, 'is_available_shipping', true)): ?>
        <div class="row">
            <div class="col-6">
                <p><?php echo e(__('Shipping fee')); ?>:</p>
            </div>
            <div class="col-6 float-end">
                <p class="price-text shipping-price-text"><?php echo e(format_price($shippingAmount)); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-6">
            <p><strong><?php echo e(__('Total')); ?></strong>:</p>
        </div>
        <div class="col-6 float-end">
            <p class="total-text raw-total-text" data-price="<?php echo e(format_price($rawTotal, null, true)); ?>">
                <?php echo e(format_price($orderAmount)); ?>

            </p>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/orders/partials/amount.blade.php ENDPATH**/ ?>