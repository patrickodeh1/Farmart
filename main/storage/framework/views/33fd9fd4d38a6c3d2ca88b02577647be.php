<div class="table">
    <table>
        <tr>
            <th style="text-align: left">
                <?php echo e(trans('plugins/ecommerce::products.product_image')); ?>

            </th>
            <th style="text-align: left">
                <?php echo e(trans('plugins/ecommerce::products.product_name')); ?>

            </th>
            <th style="text-align: left">
                <?php echo e(trans('plugins/ecommerce::products.download')); ?>

            </th>
        </tr>

        <?php $__currentLoopData = $order->digitalProducts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <img
                        src="<?php echo e(RvMedia::getImageUrl($orderProduct->product_image, 'thumb')); ?>"
                        alt="<?php echo e($orderProduct->product_image); ?>"
                        width="50"
                    >
                </td>
                <td>
                    <span><?php echo e($orderProduct->product_name); ?></span>
                    <?php if($attributes = Arr::get($orderProduct->options, 'attributes')): ?>
                        <span class="bb-text-muted"><?php echo e($attributes); ?></span>
                    <?php endif; ?>

                    <?php if($orderProduct->product_options_implode): ?>
                        <span class="bb-text-muted"><?php echo e($orderProduct->product_options_implode); ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($orderProduct->product_file_internal_count): ?>
                        <div>
                            <a href="<?php echo e($orderProduct->download_hash_url); ?>"><?php echo e(__('All files')); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if($orderProduct->product_file_external_count): ?>
                        <div>
                            <a href="<?php echo e($orderProduct->download_external_url); ?>"><?php echo e(__('External link downloads')); ?></a>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table><br>
</div>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/emails/partials/digital-product-list.blade.php ENDPATH**/ ?>