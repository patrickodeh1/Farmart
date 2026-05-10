<li class="mini-cart-item row g-0">
    <div class="col-3">
        <div class="product-image">
            <a
                class="img-fluid-eq"
                href="<?php echo e($product->original_product->url); ?>"
            >
                <div class="img-fluid-eq__dummy"></div>
                <div class="img-fluid-eq__wrap">
                    <img
                        class="lazyload"
                        data-src="<?php echo e(RvMedia::getImageUrl(Arr::get($cartItem->options, 'image', $product->original_product->image), 'thumb', false, RvMedia::getDefaultImage())); ?>"
                        alt="<?php echo e($product->original_product->name); ?>"
                    >
                </div>
            </a>
        </div>
    </div>
    <div class="col-7">
        <div class="product-content">
            <div class="product-name">
                <a href="<?php echo e($product->original_product->url); ?>"><?php echo e($product->original_product->name); ?></a>
            </div>
            <?php if(is_plugin_active('marketplace') && $product->original_product->store->id): ?>
                <div class="product-vendor">
                    <a
                        class="text-primary ms-1"
                        href="<?php echo e($product->original_product->store->url); ?>"
                    >
                        <?php echo e($product->original_product->store->name); ?>

                    </a>
                </div>
            <?php endif; ?>
            <span class="quantity">
                <span class="price-amount amount">
                    <bdi><?php echo e(format_price($cartItem->price)); ?> <?php if($product->front_sale_price != $product->price): ?>
                            <small><del><?php echo e(format_price($product->price)); ?></del></small>
                        <?php endif; ?>
                    </bdi>
                </span>
                (<?php echo e(__('x:quantity', ['quantity' => $cartItem->qty])); ?>)
            </span>
            <p class="mb-0">
                <small><?php echo e(Arr::get($cartItem->options, 'attributes', '')); ?></small>
            </p>
            <?php if(EcommerceHelper::isEnabledProductOptions() && !empty($cartItem->options['options'])): ?>
                <?php echo render_product_options_html($cartItem->options['options'], $product->front_sale_price_with_taxes); ?>

            <?php endif; ?>

            <?php echo $__env->make(
                EcommerceHelper::viewPath('includes.cart-item-options-extras'),
                ['options' => $cartItem->options]
            , array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
    <div class="col-2">
        <a
            class="btn remove-cart-item"
            data-url="<?php echo e(route('public.cart.remove', $cartItem->rowId)); ?>"
            href="#"
            aria-label="<?php echo e(__('Remove this item')); ?>"
        >
            <span class="svg-icon">
                <svg>
                    <use
                        href="#svg-icon-trash"
                        xlink:href="#svg-icon-trash"
                    ></use>
                </svg>
            </span>
        </a>
    </div>
</li>
<?php /**PATH /var/www/html/platform/themes/farmart/partials/cart-mini/item.blade.php ENDPATH**/ ?>