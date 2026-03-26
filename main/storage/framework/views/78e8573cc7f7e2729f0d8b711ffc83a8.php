<?php
    $orders = $order;

    if ($orders instanceof \Illuminate\Support\Collection) {
        $order = $orders->where('is_finished', true)->first();

        if (! $order) {
            $order = $orders->first();
        }
    }

    $userInfo = $order->address->id ? $order->address : $order->user;
?>

<div class="order-customer-info">
    <h3> <?php echo e(__('Customer information')); ?></h3>
    <?php if($userInfo->id): ?>
        <?php if($userInfo->name): ?>
            <p>
                <span class="d-inline-block"><?php echo e(__('Full name')); ?>:</span>
                <span class="order-customer-info-meta"><?php echo e($userInfo->name); ?></span>
            </p>
        <?php endif; ?>

        <?php if($userInfo->phone): ?>
            <p>
                <span class="d-inline-block"><?php echo e(__('Phone')); ?>:</span>
                <span class="order-customer-info-meta"><?php echo e($userInfo->phone); ?></span>
            </p>
        <?php endif; ?>

        <?php if($userInfo->email): ?>
            <p>
                <span class="d-inline-block"><?php echo e(__('Email')); ?>:</span>
                <span class="order-customer-info-meta"><?php echo e($userInfo->email); ?></span>
            </p>
        <?php endif; ?>

        <?php if($order->full_address && in_array('address', EcommerceHelper::getHiddenFieldsAtCheckout()) && ! empty($isShowShipping)): ?>
            <p>
                <span class="d-inline-block"><?php echo e(__('Address')); ?>:</span>
                <span class="order-customer-info-meta"><?php echo e($order->full_address); ?></span>
            </p>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(!empty($isShowShipping)): ?>
        <p>
            <span class="d-inline-block"><?php echo e(__('Shipping method')); ?>:</span>
            <span class="order-customer-info-meta"><?php echo e($order->shipping_method_name); ?> -
                <?php echo e(format_price($order->shipping_amount)); ?></span>
        </p>
    <?php endif; ?>

    <?php if(is_plugin_active('payment') && $order->payment->id): ?>
        <p>
            <span class="d-inline-block"><?php echo e(__('Payment method')); ?>:</span>
            <span class="order-customer-info-meta"><?php echo e($order->payment->payment_channel->label()); ?></span>
        </p>
        <p>
            <span class="d-inline-block"><?php echo e(__('Payment status')); ?>:</span>
            <span
                class="order-customer-info-meta"
                style="text-transform: uppercase"
                data-bb-target="ecommerce-order-payment-status"
            ><?php echo BaseHelper::clean($order->payment->status->toHtml()); ?></span>
        </p>

        <?php if(setting('payment_bank_transfer_display_bank_info_at_the_checkout_success_page', false) &&
                ($bankInfo = OrderHelper::getOrderBankInfo($orders))): ?>
            <?php echo $bankInfo; ?>

        <?php endif; ?>
    <?php endif; ?>

    <?php echo apply_filters('ecommerce_thank_you_customer_info', null, $order); ?>

</div>

<?php if($tax = $order->taxInformation): ?>
    <div class="order-customer-info">
        <h3> <?php echo e(__('Tax information')); ?></h3>
        <p>
            <span class="d-inline-block"><?php echo e(__('Company name')); ?>:</span>
            <span class="order-customer-info-meta"><?php echo e($tax->company_name); ?></span>
        </p>

        <p>
            <span class="d-inline-block"><?php echo e(__('Company tax code')); ?>:</span>
            <span class="order-customer-info-meta"><?php echo e($tax->company_tax_code); ?></span>
        </p>

        <p>
            <span class="d-inline-block"><?php echo e(__('Company email')); ?>:</span>
            <span class="order-customer-info-meta"><?php echo e($tax->company_email); ?></span>
        </p>

        <p>
            <span class="d-inline-block"><?php echo e(__('Company address')); ?>:</span>
            <span class="order-customer-info-meta"><?php echo e($tax->company_address); ?></span>
        </p>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/orders/thank-you/customer-info.blade.php ENDPATH**/ ?>