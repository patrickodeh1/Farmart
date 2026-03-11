<section class="order-tracking">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php echo $form->renderForm(); ?>


            <?php echo $__env->make(EcommerceHelper::viewPath('includes.order-tracking-detail'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
</section>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/order-tracking.blade.php ENDPATH**/ ?>