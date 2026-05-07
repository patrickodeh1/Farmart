<?php
    $priceClassName ??= null;
    $priceWrapperClassName ??= null;
?>

<span class="<?php echo e($priceWrapperClassName === null ? 'bb-product-price-text-old' : $priceWrapperClassName); ?>">
    <small>
        <del
            class="<?php echo e($priceClassName === null ? 'text-muted' : $priceClassName); ?>"
            data-bb-value="product-original-price"
        ><?php echo e($product->price()->displayPriceOriginalAsText()); ?></del>
    </small>
</span>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/includes/product-prices/original.blade.php ENDPATH**/ ?>