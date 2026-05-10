<li class="list-group-item">
    <?php echo Form::radio(Arr::get($attributes, 'name'), $shippingKey, Arr::get($attributes, 'checked'), $attributes); ?>

    <label for="<?php echo e(Arr::get($attributes, 'id')); ?>">
        <div>
            <?php if($image = Arr::get($shippingItem, 'image')): ?>
                <img
                    src="<?php echo e($image); ?>"
                    alt="<?php echo e($shippingItem['name']); ?>"
                    style="max-height: 40px; max-width: 55px"
                >
            <?php endif; ?>
            <span>
                <?php echo e($shippingItem['name']); ?> -
                <?php if($shippingItem['price'] > 0): ?>
                    <?php echo e(format_price($shippingItem['price'])); ?>

                <?php else: ?>
                    <strong><?php echo e(__('Free shipping')); ?></strong>
                <?php endif; ?>
            </span>
        </div>
        <div>
            <?php if($description = Arr::get($shippingItem, 'description')): ?>
                <small class="text-secondary"><?php echo BaseHelper::clean($description); ?></small>
            <?php endif; ?>
            <?php if($errorMessage = Arr::get($shippingItem, 'error_message')): ?>
                <small class="text-danger"><?php echo BaseHelper::clean($errorMessage); ?></small>
            <?php endif; ?>
        </div>
    </label>
</li>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/orders/partials/shipping-option.blade.php ENDPATH**/ ?>