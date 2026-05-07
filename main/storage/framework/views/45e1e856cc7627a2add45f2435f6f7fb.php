<?php if(! EcommerceHelper::hideProductPrice() || EcommerceHelper::isCartEnabled()): ?>
    <?php
        $isDisplayPriceOriginal ??= true;
        $priceWrapperClassName ??= null;
        $priceClassName ??= null;
        $priceOriginalClassName ??= null;
        $priceOriginalWrapperClassName ??= null;
    ?>

    <div class="<?php echo e($priceWrapperClassName === null ? 'bb-product-price mb-3' : $priceWrapperClassName); ?>">
        <span
            class="<?php echo e($priceClassName === null ? 'bb-product-price-text fw-bold' : $priceClassName); ?>"
            data-bb-value="product-price"
        ><?php echo e($priceFormatted ?? $product->price()->displayAsText()); ?></span>

        <?php if($isDisplayPriceOriginal && $product->isOnSale()): ?>
            <?php echo $__env->make(EcommerceHelper::viewPath('includes.product-prices.original'), [
                'priceWrapperClassName' => $priceOriginalWrapperClassName,
                'priceClassName' => $priceOriginalClassName,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/includes/product-price.blade.php ENDPATH**/ ?>