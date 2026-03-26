<?php if(!$order->dont_show_order_info_in_product_list): ?>
    <a
        class="button button-blue"
        href="<?php echo e(route('public.orders.tracking', ['order_id' => $order->code, 'email' => $order->user->email ?: $order->address->email])); ?>"
    ><?php echo e(trans('plugins/ecommerce::email.view_order')); ?></a>
    <?php echo trans('plugins/ecommerce::email.link_go_to_our_shop', ['link' => BaseHelper::getHomepageUrl()]); ?>


    <br />
<?php endif; ?>

<table class="bb-table" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th colspan="2"></th>
            <th><?php echo e(trans('plugins/ecommerce::products.form.quantity')); ?></th>
            <th class="bb-text-right"><?php echo e(trans('plugins/ecommerce::products.form.price')); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php $__currentLoopData = $products ?? $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="bb-pr-0">
                <a href="">
                    <img src="<?php echo e(RvMedia::getImageUrl($orderProduct->product_image, 'thumb')); ?>" class=" bb-rounded" width="64" height="64" alt="" />
                </a>
            </td>
            <td class="bb-pl-md bb-w-100p">
                <strong><?php echo e($orderProduct->product_name); ?></strong><br />
                <?php if($attributes = Arr::get($orderProduct->options, 'attributes')): ?>
                    <span class="bb-text-muted"><?php echo e($attributes); ?></span>
                <?php endif; ?>

                <?php if($orderProduct->product_options_implode): ?>
                    <span class="bb-text-muted"><?php echo e($orderProduct->product_options_implode); ?></span>
                <?php endif; ?>
            </td>
            <td class="bb-text-center">x <?php echo e($orderProduct->qty); ?></td>
            <td class="bb-text-right"><?php echo e(format_price($orderProduct->price)); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(!$order->dont_show_order_info_in_product_list): ?>
            <?php if($order->sub_total != $order->amount): ?>
                <tr>
                    <td colspan="2" class="bb-border-top bb-text-right"><?php echo e(trans('plugins/ecommerce::products.form.sub_total')); ?></td>
                    <td colspan="2" class="bb-border-top bb-text-right"><?php echo e(format_price($order->sub_total)); ?></td>
                </tr>
            <?php endif; ?>

            <?php if((float)$order->shipping_amount): ?>
                <tr>
                    <td colspan="2" class="bb-text-right"><?php echo e(trans('plugins/ecommerce::products.form.shipping_fee')); ?></td>
                    <td colspan="2" class="bb-text-right"><?php echo e(format_price($order->shipping_amount)); ?></td>
                </tr>
            <?php endif; ?>

            <?php if((float)$order->tax_amount): ?>
                <tr>
                    <td colspan="2" class="bb-text-right"><?php echo e(trans('plugins/ecommerce::products.form.tax')); ?></td>
                    <td colspan="2" class="bb-text-right"><?php echo e(format_price($order->tax_amount)); ?></td>
                </tr>
            <?php endif; ?>

            <?php if((float)$order->discount_amount): ?>
                <tr>
                    <td colspan="2" class="bb-text-right"><?php echo e(trans('plugins/ecommerce::products.form.discount')); ?></td>
                    <td colspan="2" class="bb-text-right"><?php echo e(format_price($order->discount_amount)); ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="2" class="bb-text-right bb-font-strong bb-h3 bb-m-0"><?php echo e(trans('plugins/ecommerce::products.form.total')); ?></td>
                <td colspan="2" class="bb-font-strong bb-h3 bb-m-0 bb-text-right"><?php echo e(format_price($order->amount)); ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/emails/partials/order-detail.blade.php ENDPATH**/ ?>