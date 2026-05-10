<?php if(($extras = Arr::get($options, 'extras', [])) && is_array($extras)): ?>
    <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!empty($extra['key']) && !empty($extra['value'])): ?>
            <p class="mb-0">
                <small><?php echo e($extra['key']); ?>: <strong> <?php echo e($extra['value']); ?></strong></small>
            </p>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/includes/cart-item-options-extras.blade.php ENDPATH**/ ?>