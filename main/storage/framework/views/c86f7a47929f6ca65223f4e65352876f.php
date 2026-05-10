<div class="row cart-page-content py-5 mt-3">
    <div class="col-12">
        <form
            class="form--shopping-cart cart-form"
            method="post"
            action="<?php echo e(route('public.cart.update')); ?>"
        >
            <?php echo csrf_field(); ?>
            <?php if(count($products) > 0): ?>
                <table
                    class="table cart-form__contents"
                    cellspacing="0"
                >
                    <thead>
                        <tr>
                            <th class="product-thumbnail"></th>
                            <th class="product-name"><?php echo e(__('Product')); ?></th>
                            <th class="product-price product-md d-md-table-cell d-none"><?php echo e(__('Price')); ?></th>
                            <th class="product-quantity product-md d-md-table-cell d-none"><?php echo e(__('Quantity')); ?></th>
                            <th class="product-subtotal product-md d-md-table-cell d-none"><?php echo e(__('Total')); ?></th>
                            <th class="product-remove"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = Cart::instance('cart')->content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $product = $products->find($cartItem->id);
                            ?>

                            <?php if(!empty($product)): ?>
                                <tr class="cart-form__cart-item cart_item">
                                    <td class="product-thumbnail">
                                        <input
                                            name="items[<?php echo e($key); ?>][rowId]"
                                            type="hidden"
                                            value="<?php echo e($cartItem->rowId); ?>"
                                        >

                                        <a
                                            href="<?php echo e($product->original_product->url); ?>"
                                            style="max-width: 74px; display: inline-block;"
                                        >
                                            <img
                                                class="lazyload"
                                                data-src="<?php echo e(RvMedia::getImageUrl($cartItem->options->image, 'thumb', false, RvMedia::getDefaultImage())); ?>"
                                                src="<?php echo e(image_placeholder(RvMedia::getImageUrl($cartItem->options->image, 'thumb', false, RvMedia::getDefaultImage()))); ?>"
                                                alt="<?php echo e($product->original_product->name); ?>"
                                            >
                                        </a>
                                    </td>
                                    <td
                                        class="product-name d-md-table-cell d-block"
                                        data-title="<?php echo e(__('Product')); ?>"
                                    >
                                        <a
                                            href="<?php echo e($product->original_product->url); ?>"><?php echo e($product->original_product->name); ?></a>
                                        <?php if(is_plugin_active('marketplace') && $product->original_product->store->id): ?>
                                            <div class="variation-group">
                                                <span class="text-secondary"><?php echo e(__('Vendor')); ?>: </span>
                                                <span class="text-primary ms-1">
                                                    <a
                                                        href="<?php echo e($product->original_product->store->url); ?>"><?php echo e($product->original_product->store->name); ?></a>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if($rezgoData = Arr::get($cartItem->options, 'rezgo')): ?>
                                            <div class="rezgo-booking-info mt-2 p-2 bg-light rounded">
                                                <p class="mb-1">
                                                    <small class="text-muted"><?php echo e(__('Booking Date')); ?>: </small>
                                                    <small class="fw-bold"><?php echo e($rezgoData['date'] ?? 'N/A'); ?></small>
                                                </p>
                                                <p class="mb-0">
                                                    <small class="text-muted"><?php echo e(__('Booking Price')); ?>: </small>
                                                    <small class="fw-bold"><?php echo e(format_price($rezgoData['price'] ?? 0)); ?></small>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if($attributes = Arr::get($cartItem->options, 'attributes')): ?>
                                            <p class="mb-0">
                                                <small><?php echo e($attributes); ?></small>
                                            </p>
                                        <?php endif; ?>
                                        <?php if(EcommerceHelper::isEnabledProductOptions() && !empty($cartItem->options['options'])): ?>
                                            <?php echo render_product_options_html($cartItem->options['options'], $product->front_sale_price_with_taxes); ?>

                                        <?php endif; ?>

                                        <?php echo $__env->make(
                                            EcommerceHelper::viewPath('includes.cart-item-options-extras'),
                                            ['options' => $cartItem->options]
                                        , array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </td>
                                    <td
                                        class="product-price product-md d-md-table-cell d-block"
                                        data-title="Price"
                                    >
                                        <div class="box-price">
                                            <span class="d-md-none title-price"><?php echo e(__('Price')); ?>: </span>
                                            <span class="quantity">
                                                <span class="price-amount amount">
                                                    <bdi>
                                                        <?php
                                                            // Use Rezgo price if available, otherwise use cart item price
                                                            $rezgoPrice = Arr::get($cartItem->options, 'rezgo.price');
                                                            $displayPrice = $rezgoPrice ? (float)$rezgoPrice : $cartItem->price;
                                                        ?>
                                                        <?php echo e(format_price($displayPrice)); ?> 
                                                        <?php if($product->front_sale_price != $product->price): ?>
                                                            <small><del><?php echo e(format_price($product->price)); ?></del></small>
                                                        <?php endif; ?>
                                                    </bdi>
                                                </span>
                                            </span>
                                        </div>
                                    </td>
                                    <td
                                        class="product-quantity product-md d-md-table-cell d-block"
                                        data-title="<?php echo e(__('Quantity')); ?>"
                                    >
                                        <div class="product-button">
                                            <?php echo Theme::partial(
                                                'ecommerce.product-quantity',
                                                compact('product') + [
                                                    'name' => 'items[' . $key . '][values][qty]',
                                                    'value' => $cartItem->qty,
                                                ],
                                            ); ?>

                                        </div>
                                    </td>
                                    <td
                                        class="product-subtotal product-md d-md-table-cell d-block"
                                        data-title="<?php echo e(__('Total')); ?>"
                                    >
                                        <div class="box-price">
                                            <span class="d-md-none title-price"><?php echo e(__('Total')); ?>: </span>
                                            <span class="fw-bold amount">
                                                <span class="price-current">
                                                    <?php
                                                        // Use Rezgo price if available, otherwise use cart item price
                                                        $rezgoPrice = Arr::get($cartItem->options, 'rezgo.price');
                                                        $itemPrice = $rezgoPrice ? (float)$rezgoPrice : $cartItem->price;
                                                        $itemTotal = $itemPrice * $cartItem->qty;
                                                    ?>
                                                    <?php echo e(format_price($itemTotal)); ?>

                                                </span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="product-remove">
                                        <a
                                            class="fs-4 remove btn remove-cart-item"
                                            data-url="<?php echo e(route('public.cart.remove', $cartItem->rowId)); ?>"
                                            href="#"
                                            aria-label="Remove this item"
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
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center"><?php echo e(__('Your cart is empty!')); ?></p>
            <?php endif; ?>
            <?php if(count($products) > 0): ?>
                <div class="actions my-4 pb-4 border-bottom">
                    <div class="actions__button-wrapper row justify-content-between">
                        <div class="col-md-9">
                            <div class="actions__left d-grid d-md-block">
                                <a
                                    class="btn btn-secondary mb-2"
                                    href="<?php echo e(route('public.products')); ?>"
                                >
                                    <span class="svg-icon">
                                        <svg>
                                            <use
                                                href="#svg-icon-arrow-left"
                                                xlink:href="#svg-icon-arrow-left"
                                            ></use>
                                        </svg>
                                    </span> <?php echo e(__('Continue Shopping')); ?>

                                </a>
                                <a
                                    class="btn btn-secondary mb-2 ms-md-2"
                                    href="<?php echo e(BaseHelper::getHomepageUrl()); ?>"
                                >
                                    <span class="svg-icon">
                                        <svg>
                                            <use
                                                href="#svg-icon-home"
                                                xlink:href="#svg-icon-home"
                                            ></use>
                                        </svg>
                                    </span> <?php echo e(__('Back to Home')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-5 col-coupon form-coupon-wrapper">
                        <div class="coupon">
                            <label class="form-label" for="coupon_code">
                                <h4><?php echo e(__('Using A Promo Code?')); ?></h4>
                            </label>
                            <div class="coupon-input input-group my-3">
                                <input
                                    class="form-control coupon-code"
                                    name="coupon_code"
                                    type="text"
                                    value="<?php echo e(old('coupon_code')); ?>"
                                    placeholder="<?php echo e(__('Enter coupon code')); ?>"
                                >
                                <button
                                    class="btn btn-primary lh-1 btn-apply-coupon-code"
                                    data-url="<?php echo e(route('public.coupon.apply')); ?>"
                                    type="button"
                                ><?php echo e(__('Apply')); ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-2"></div>
                    <div class="col-lg-4 col-md-5">
                        <div class="cart_totals bg-light p-4 rounded">
                            <h5 class="mb-3"><?php echo e(__('Cart totals')); ?></h5>
                            <div class="cart_totals-table">
                                <div class="cart-subtotal d-flex justify-content-between border-bottom pb-3 mb-3">
                                    <span class="title fw-bold"><?php echo e(__('Subtotal')); ?>:</span>
                                    <span class="amount fw-bold">
                                        <span
                                            class="price-current"><?php echo e(format_price(Cart::instance('cart')->rawSubTotal())); ?></span>
                                    </span>
                                </div>
                                <?php if(EcommerceHelper::isTaxEnabled()): ?>
                                    <div class="cart-subtotal d-flex justify-content-between border-bottom pb-3 mb-3">
                                        <span class="title fw-bold"><?php echo e(__('Tax')); ?>:</span>
                                        <span class="amount fw-bold">
                                            <span
                                                class="price-current"><?php echo e(format_price(Cart::instance('cart')->rawTax())); ?></span>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if($couponDiscountAmount > 0 && session('applied_coupon_code')): ?>
                                    <div class="cart-subtotal d-flex justify-content-between border-bottom pb-3 mb-3">
                                        <span class="title">
                                            <span
                                                class="fw-bold"><?php echo e(__('Coupon code: :code', ['code' => session('applied_coupon_code')])); ?></span>
                                            (<small>
                                                <a
                                                    class="btn-remove-coupon-code text-danger"
                                                    data-url="<?php echo e(route('public.coupon.remove')); ?>"
                                                    data-processing-text="<?php echo e(__('Removing...')); ?>"
                                                    href="#"
                                                ><?php echo e(__('Remove')); ?></a>
                                            </small>)
                                        </span>

                                        <span class="amount fw-bold"><?php echo e(format_price($couponDiscountAmount)); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($promotionDiscountAmount): ?>
                                    <div class="cart-subtotal d-flex justify-content-between border-bottom pb-3 mb-3">
                                        <span class="title">
                                            <span class="fw-bold"><?php echo e(__('Discount promotion')); ?>:</span>
                                        </span>

                                        <span
                                            class="amount fw-bold"><?php echo e(format_price($promotionDiscountAmount)); ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="order-total d-flex justify-content-between pb-3 mb-3">
                                    <span class="title">
                                        <h6 class="mb-0"><?php echo e(__('Total')); ?></h6>
                                        <small><?php echo e(__('(Shipping fees not included)')); ?></small>
                                    </span>
                                    <span class="amount fw-bold fs-6 text-green">
                                        <span
                                            class="price-current"><?php echo e($promotionDiscountAmount + $couponDiscountAmount > Cart::instance('cart')->rawTotal() ? format_price(0) : format_price(Cart::instance('cart')->rawTotal() - $promotionDiscountAmount - $couponDiscountAmount)); ?></span>
                                    </span>
                                </div>
                            </div>
                            <?php if(session('tracked_start_checkout')): ?>
                                <div class="proceed-to-checkout">
                                    <div class="d-grid gap-2">
                                        <a
                                            class="checkout-button btn btn-primary"
                                            href="<?php echo e(route('public.checkout.information', session('tracked_start_checkout'))); ?>"
                                        ><?php echo e(__('Proceed to checkout')); ?></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </form>

        <?php if($crossSellProducts->isNotEmpty()): ?>
            <div class="row align-items-center mb-2 widget-header">
                <h2 class="col-auto mb-0 py-2"><?php echo e(__('Customers who bought this item also bought')); ?></h2>
            </div>
            <div class="row row-cols-lg-6 row-cols-md-4 row-cols-3 g-0 products-with-border">
                <?php $__currentLoopData = $crossSellProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crossSellProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="product-inner">
                            <?php echo Theme::partial('ecommerce.product-item', ['product' => $crossSellProduct]); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php /**PATH /var/www/html/platform/themes/farmart/views/ecommerce/cart.blade.php ENDPATH**/ ?>