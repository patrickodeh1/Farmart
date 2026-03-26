<?php if(EcommerceHelper::isValidToProcessCheckout()): ?>
    <button
        class="btn payment-checkout-btn payment-checkout-btn-step float-end"
        data-processing-text="<?php echo e(__('Processing. Please wait...')); ?>"
        data-error-header="<?php echo e(__('Error')); ?>"
        type="submit"
    >
        <?php echo e(__('Checkout')); ?>

    </button>
<?php else: ?>
    <span class="btn payment-checkout-btn-step float-end disabled">
        <?php echo e(__('Checkout')); ?>

    </span>
<?php endif; ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/orders/partials/checkout-button.blade.php ENDPATH**/ ?>