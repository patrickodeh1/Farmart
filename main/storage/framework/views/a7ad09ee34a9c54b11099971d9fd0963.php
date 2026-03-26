<div
    class="address-item <?php if($address->is_default): ?> is-default <?php endif; ?>"
    data-id="<?php echo e($address->id); ?>"
>
    <p class="name"><?php echo e($address->name); ?></p>
    <p
        class="address"
        title="<?php echo e($address->address); ?>, <?php echo e($address->city_name); ?>, <?php echo e($address->state_name); ?><?php if(EcommerceHelper::isUsingInMultipleCountries()): ?> , <?php echo e($address->country_name); ?> <?php endif; ?> <?php if(EcommerceHelper::isZipCodeEnabled() && $address->zip_code): ?> , <?php echo e($address->zip_code); ?> <?php endif; ?>"
    >
        <?php echo e($address->address); ?>, <?php echo e($address->city_name); ?>, <?php echo e($address->state_name); ?><?php if(EcommerceHelper::isUsingInMultipleCountries()): ?>
            , <?php echo e($address->country_name); ?>

            <?php endif; ?> <?php if(EcommerceHelper::isZipCodeEnabled() && $address->zip_code): ?>
                , <?php echo e($address->zip_code); ?>

            <?php endif; ?>
    </p>
    <p class="phone"><?php echo e(__('Phone')); ?>: <?php echo e($address->phone); ?></p>
    <?php if($address->email): ?>
        <p class="email"><?php echo e(__('Email')); ?>: <?php echo e($address->email); ?></p>
    <?php endif; ?>
    <?php if($address->is_default): ?>
        <span class="default"><?php echo e(__('Default')); ?></span>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/orders/partials/address-item.blade.php ENDPATH**/ ?>