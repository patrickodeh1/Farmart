<?php if(! (bool) get_ecommerce_setting('disable_shipping_options', false)): ?>
    <?php if(! empty($shipping)): ?>
        <div class="payment-checkout-form">
            <input
                name="shipping_option"
                type="hidden"
                value="<?php echo e(BaseHelper::stringify(old('shipping_option', $defaultShippingOption))); ?>"
            >

            <ul class="list-group list_payment_method">
                <?php $__currentLoopData = $shipping; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shippingKey => $shippingItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $shippingItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shippingOption => $shippingItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make(
                            'plugins/ecommerce::orders.partials.shipping-option',
                            [
                                'shippingItem' => $shippingItem,
                                'attributes' => [
                                    'id' => "shipping-method-$shippingKey-$shippingOption",
                                    'name' => 'shipping_method',
                                    'class' => 'magic-radio shipping_method_input',
                                    'checked' => old('shipping_method', $defaultShippingMethod) == $shippingKey && old('shipping_option', $defaultShippingOption) == $shippingOption,
                                    'disabled' => Arr::get($shippingItem, 'disabled'),
                                    'data-option' => $shippingOption,
                                ],
                            ]
                        , array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php else: ?>
        <?php
            $sessionCheckoutData = $sessionCheckoutData ?? OrderHelper::getOrderSessionData();
        ?>

        <?php if($sessionCheckoutData && Arr::get($sessionCheckoutData, 'country')): ?>
            <p class="text-muted"><?php echo e(__('No shipping methods were found with your provided shipping information!')); ?></p>
        <?php else: ?>
            <p class="text-muted"><?php echo e(__('Please fill out all shipping information to view available shipping methods!')); ?></p>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/orders/partials/shipping-methods.blade.php ENDPATH**/ ?>