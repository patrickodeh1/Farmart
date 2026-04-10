<select class="form-select" name="specification_table_id" id="specification_table_id">
    <option value=""><?php echo e(trans('plugins/ecommerce::product-specification.product.specification_table.select_none')); ?></option>
    <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($value); ?>" <?php if($model->specification_table_id === $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/products/partials/specification-table/header.blade.php ENDPATH**/ ?>