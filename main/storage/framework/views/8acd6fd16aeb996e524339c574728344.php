<div class="bg-light py-2">
    <p class="font-weight-bold mb-0"><?php echo e(__('Product(s)')); ?>:</p>
</div>

<div class="checkout-products-marketplace shipping-method-wrapper">
    <?php $__currentLoopData = $groupedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grouped): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $cartItems = $grouped['products']->pluck('cartItem');
            $store = $grouped['store'];
            if (! $store->exists) {
                $store->id = 0;
                $store->name = get_ecommerce_setting('company_name_for_invoicing', get_ecommerce_setting('store_name')) ?: Theme::getSiteTitle();
                $store->logo = theme_option('favicon') ?: Theme::getLogo();
            }
            $storeId = $store->id;
            $sessionData = Arr::get($sessionCheckoutData, 'marketplace.' . $storeId, []);
            $shipping = Arr::get($sessionData, 'shipping', []);
            $defaultShippingOption = Arr::get($sessionData, 'shipping_option');
            $defaultShippingMethod = Arr::get($sessionData, 'shipping_method');
            $promotionDiscountAmount = Arr::get($sessionData, 'promotion_discount_amount', 0);
            $couponDiscountAmount = Arr::get($sessionData, 'coupon_discount_amount', 0);
            $shippingAmount = Arr::get($sessionData, 'shipping_amount', 0);
            $isFreeShipping = Arr::get($sessionData, 'is_free_shipping', 0);
            $rawTotal = Cart::rawTotalByItems($cartItems);
            $shippingCurrent = Arr::get($shipping, $defaultShippingMethod . '.' . $defaultShippingOption, []);
            $isAvailableShipping = Arr::get($sessionData, 'is_available_shipping', true) && ! (bool) get_ecommerce_setting('disable_shipping_options', false);

            $orderAmount = max($rawTotal - $promotionDiscountAmount - $couponDiscountAmount, 0);
            $orderAmount += (float) $shippingAmount;
        ?>
        <div class="mt-3 bg-light mb-3">
            <div class="p-2" style="background: antiquewhite;">
                <img
                    class="img-fluid rounded"
                    src="<?php echo e(RvMedia::getImageUrl($store->logo_square ?: $store->logo, null, false, RvMedia::getDefaultImage())); ?>"
                    alt="<?php echo e($store->name); ?>"
                    style="max-width: 30px; margin-inline-end: 3px;"
                >
                <span class="font-weight-bold"><?php echo BaseHelper::clean($store->name); ?></span>
                <?php if($store->id && EcommerceHelper::isReviewEnabled()): ?>
                    <div class="d-flex align-items-center gap-2">
                        <?php echo $__env->make(EcommerceHelper::viewPath('includes.rating-star'), ['avg' => $store->reviews()->avg('star')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <span class="small text-muted">
                            <?php if(($reviewsCount = $store->reviews()->count()) === 1): ?>
                                (<?php echo e(__('1 Review')); ?>)
                            <?php else: ?>
                                (<?php echo e(__(':count Reviews', ['count' => number_format($reviewsCount)])); ?>)
                            <?php endif; ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="py-3">
                <?php $__currentLoopData = $grouped['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('plugins/ecommerce::orders.checkout.product', [
                        'product' => $product,
                        'cartItem' => $product->cartItem,
                        'key' => $product->cartItem->rowId,
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($isAvailableShipping): ?>
                <div class="shipping-method-wrapper py-3">
                    <?php if(!empty($shipping)): ?>
                        <div class="payment-checkout-form">
                            <h6><?php echo e(__('Shipping method')); ?>:</h6>

                            <input
                                name="shipping_option[<?php echo e($storeId); ?>]"
                                type="hidden"
                                value="<?php echo e(old("shipping_option.$storeId", $defaultShippingOption ?: array_key_first(Arr::first($shipping)))); ?>"
                            >

                            <div id="shipping-method-<?php echo e($storeId); ?>">
                                <ul class="list-group list_payment_method">
                                    <?php $__currentLoopData = $shipping; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shippingKey => $shippingItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $shippingItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shippingOption => $shippingItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo $__env->make('plugins/ecommerce::orders.partials.shipping-option', [
                                                'shippingItem' => $shippingItem,
                                                'attributes' => [
                                                    'id' => "shipping-method-$storeId-$shippingKey-$shippingOption",
                                                    'name' => "shipping_method[$storeId]",
                                                    'class' => 'magic-radio shipping_method_input',
                                                    'checked' => old("shipping_method.$storeId", $defaultShippingMethod) == $shippingKey && old("shipping_option.$storeId", $defaultShippingOption) == $shippingOption,
                                                    'disabled' => Arr::get($shippingItem, 'disabled'),
                                                    'data-id' => $storeId,
                                                    'data-option' => $shippingOption,
                                                ],
                                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php else: ?>
                        <p><?php echo e(__('No shipping methods available!')); ?></p>
                    <?php endif; ?>

                    <div class="payment-info-loading loading-spinner" style="display: none;"></div>
                </div>
            <?php endif; ?>

            <hr class="border-dark-subtle" />
            <?php if(count($groupedProducts) > 1 && MarketplaceHelper::getSetting('display_order_total_info_for_each_store', false)): ?>
                <div class="p-3">
                    <div class="row">
                        <div class="col-6">
                            <p><?php echo e(__('Subtotal')); ?>:</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="price-text sub-total-text text-end">
                                <?php echo e(format_price(Cart::rawSubTotalByItems($cartItems))); ?> </p>
                        </div>
                    </div>
                    <?php if(EcommerceHelper::isTaxEnabled()): ?>
                        <div class="row">
                            <div class="col-6">
                                <p><?php echo e(__('Tax')); ?>:</p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="price-text tax-price-text">
                                    <?php echo e(format_price(Cart::rawTaxByItems($cartItems))); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($couponDiscountAmount): ?>
                        <div class="row">
                            <div class="col-6">
                                <p><?php echo e(__('Discount amount')); ?>:</p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="price-text coupon-price-text"><?php echo e(format_price($couponDiscountAmount)); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($isAvailableShipping): ?>
                        <div class="row">
                            <div class="col-6">
                                <p><?php echo e(__('Shipping fee')); ?>:</p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="price-text">
                                    <?php if(Arr::get($shippingCurrent, 'price') && $isFreeShipping): ?>
                                        <span class="font-italic" style="text-decoration-line: line-through;">
                                            <?php echo e(format_price(Arr::get($shippingCurrent, 'price'))); ?>

                                        </span>
                                        <span class="font-weight-bold"><?php echo e(__('Free shipping')); ?></span>
                                    <?php else: ?>
                                        <span class="font-weight-bold">
                                            <?php echo e(format_price(Arr::get($shippingCurrent, 'price'))); ?>

                                        </span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-6">
                            <p><?php echo e(__('Total')); ?>:</p>
                        </div>
                        <div class="col-6 float-end">
                            <p class="total-text raw-total-text mb-0" data-price="<?php echo e($rawTotal); ?>">
                                <?php echo e(format_price($orderAmount)); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /var/www/html/platform/plugins/marketplace/resources/views/orders/checkout/products.blade.php ENDPATH**/ ?>