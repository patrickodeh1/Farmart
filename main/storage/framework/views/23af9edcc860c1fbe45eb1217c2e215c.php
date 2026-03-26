<div class="row cart-item">
    <div class="col-3">
        <div class="checkout-product-img-wrapper">
            <img
                class="item-thumb img-thumbnail img-rounded"
                src="<?php echo e(RvMedia::getImageUrl(Arr::get($cartItem->options, 'image'), 'thumb', default: RvMedia::getDefaultImage())); ?>"
                alt="<?php echo e($product->original_product->name); ?>"
            >
            <span class="checkout-quantity"><?php echo e($cartItem->qty); ?></span>
        </div>
    </div>
    <div class="col">

        <?php echo apply_filters('ecommerce_cart_before_item_content', null, $cartItem); ?>


        <p class="mb-0">
            <?php echo e($product->original_product->name); ?>

            <?php if($product->isOutOfStock()): ?>
                <span class="stock-status-label">(<?php echo BaseHelper::clean($product->stock_status_html); ?>)</span>
            <?php endif; ?>
        </p>
        <?php if($product->variation_attributes): ?>
            <p class="mb-0">
                <small><?php echo e($product->variation_attributes); ?></small>
            </p>
        <?php endif; ?>

        <?php if(get_ecommerce_setting('checkout_product_quantity_editable', true)): ?>
            <div
                class="ec-checkout-quantity"
                data-url="<?php echo e(route('public.cart.update')); ?>"
                data-row-id="<?php echo e($cartItem->rowId); ?>"
            >
                <button type="button" class="ec-checkout-quantity-control ec-checkout-quantity-minus" data-bb-toggle="decrease-qty">
                    <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-minus'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
                </button>
                <input
                    type="number"
                    name="items[<?php echo e($key); ?>][values][qty]"
                    value="<?php echo e($cartItem->qty); ?>"
                    min="1"
                    max="<?php echo e($product->with_storehouse_management ? $product->quantity : 1000); ?>"
                    data-bb-toggle="update-cart"
                    readonly
                />
                <button type="button" class="ec-checkout-quantity-control ec-checkout-quantity-plus" data-bb-toggle="increase-qty">
                    <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-plus'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
                </button>
            </div>
        <?php endif; ?>

        <?php echo $__env->make(EcommerceHelper::viewPath('includes.cart-item-options-extras'), [
            'options' => $cartItem->options,
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php if(!empty($cartItem->options['options'])): ?>
            <?php echo render_product_options_html($cartItem->options['options'], $product->original_price); ?>

        <?php endif; ?>

        <?php echo apply_filters('ecommerce_cart_after_item_content', null, $cartItem); ?>

    </div>
    <div class="col-auto text-end">
        <p><?php echo e(format_price($cartItem->price)); ?></p>
    </div>
</div>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/orders/checkout/product.blade.php ENDPATH**/ ?>