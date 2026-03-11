<?php if($order): ?>
    <div class="card">
        <div class="card-body">
            <div class="customer-order-detail">
                <div class="row">
                    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['col-12' => ! $order->address->name, 'col-md-6' => $order->address->name]); ?>">
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Order number')); ?>: </span>
                            <strong><?php echo e($order->code); ?></strong>
                        </p>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Time')); ?>: </span>
                            <strong><?php echo e($order->created_at->translatedFormat('d M Y H:i:s')); ?></strong>
                        </p>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Order status')); ?>: </span>
                            <strong class="text-info"><?php echo e($order->status->label()); ?></strong>
                        </p>
                        <?php if($order->cancellation_reason): ?>
                            <p>
                                <span class="d-inline-block me-1"><?php echo e(__('Cancellation Reason')); ?>: </span>
                                <strong class="text-warning"><?php echo e($order->cancellation_reason_message); ?></strong>
                            </p>
                        <?php endif; ?>
                        <?php if(is_plugin_active('payment') && $order->payment->id): ?>
                            <p>
                                <span class="d-inline-block me-1"><?php echo e(__('Payment method')); ?>: </span>
                                <strong class="text-info"><?php echo e($order->payment->payment_channel->label()); ?></strong>
                            </p>
                            <p>
                                <span class="d-inline-block me-1"><?php echo e(__('Payment status')); ?>: </span>
                                <strong class="text-info"><?php echo e($order->payment->status->label()); ?></strong>
                            </p>
                        <?php endif; ?>
                        <?php if($order->description): ?>
                            <p>
                                <span class="d-inline-block me-1"><?php echo e(__('Note')); ?>: </span>
                                <strong class="text-warning"><i><?php echo e($order->description); ?></i></strong>
                            </p>
                        <?php endif; ?>
                    </div>
                    <?php if($order->address->name): ?>
                        <div class="col-md-6">
                            <p>
                                <span class="d-inline-block me-1"><?php echo e(__('Full Name')); ?>: </span>
                                <strong><?php echo e($order->address->name); ?></strong>
                            </p>
                            <p>
                                <span class="d-inline-block me-1"><?php echo e(__('Phone')); ?>: </span>
                                <strong><?php echo e($order->address->phone); ?></strong>
                            </p>
                            <p>
                                <span class="d-inline-block me-1"><?php echo e(__('Address')); ?>: </span>
                                <strong> <?php echo e($order->address->full_address); ?></strong>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>
                <h5 class="mb-3"><?php echo e(__('Products')); ?></h5>
                <div>
                    <div class="table-responsive mb-3">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center"><?php echo e(__('Image')); ?></th>
                                    <th><?php echo e(__('Product')); ?></th>
                                    <th class="text-center"><?php echo e(__('Amount')); ?></th>
                                    <th class="text-end" style="width: 100px"><?php echo e(__('Quantity')); ?></th>
                                    <th class="price text-end"><?php echo e(__('Total')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $product = get_products([
                                            'condition' => [
                                                'ec_products.id' => $orderProduct->product_id,
                                            ],
                                            'take' => 1,
                                            'select' => ['ec_products.id', 'ec_products.images', 'ec_products.name', 'ec_products.price', 'ec_products.sale_price', 'ec_products.sale_type', 'ec_products.start_date', 'ec_products.end_date', 'ec_products.sku', 'ec_products.is_variation', 'ec_products.status', 'ec_products.order', 'ec_products.created_at'],
                                        ]);
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                        <td class="text-center">
                                            <img src="<?php echo e(RvMedia::getImageUrl($orderProduct->product_image, 'thumb', false, RvMedia::getDefaultImage())); ?>"
                                                alt="<?php echo e($orderProduct->product_name); ?>" width="50">
                                        </td>
                                        <td>
                                            <?php if($product && $product->original_product?->url): ?>
                                                <a href="<?php echo e($product->original_product->url); ?>"><?php echo BaseHelper::clean($orderProduct->product_name); ?></a>
                                            <?php else: ?>
                                                <?php echo BaseHelper::clean($orderProduct->product_name); ?>

                                            <?php endif; ?>
                                            <?php if($sku = Arr::get($orderProduct->options, 'sku')): ?>
                                                (<?php echo e($sku); ?>)
                                            <?php endif; ?>

                                            <?php if($attributes = Arr::get($orderProduct->options, 'attributes')): ?>
                                                <p class="mb-0">
                                                    <small><?php echo e($attributes); ?></small>
                                                </p>
                                            <?php elseif($product && $product->is_variation): ?>
                                                <p>
                                                    <small>
                                                        <?php if($attributes = get_product_attributes($product->getKey())): ?>
                                                            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php echo e($attribute->attribute_set_title); ?>: <?php echo e($attribute->title); ?>

                                                                <?php if(!$loop->last): ?>
                                                                    ,
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </small>
                                                </p>
                                            <?php endif; ?>

                                            <?php echo $__env->make(
                                                EcommerceHelper::viewPath('includes.cart-item-options-extras'),
                                                ['options' => $orderProduct->options]
                                            , array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                            <?php if(!empty($orderProduct->product_options) && is_array($orderProduct->product_options)): ?>
                                                <?php echo render_product_options_html($orderProduct->product_options, $orderProduct->price); ?>

                                            <?php endif; ?>

                                            <?php if(is_plugin_active('marketplace') && ($product = $orderProduct->product) && $product->original_product->store->id): ?>
                                                <p class="d-block mb-0 sold-by">
                                                    <small><?php echo e(__('Sold by')); ?>: <a
                                                            href="<?php echo e($product->original_product->store->url); ?>"
                                                            class="text-primary"><?php echo e($product->original_product->store->name); ?></a>
                                                    </small>
                                                </p>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?php echo e($orderProduct->amount_format); ?></td>
                                        <td class="text-center"><?php echo e($orderProduct->qty); ?></td>
                                        <td class="money text-end">
                                            <strong>
                                                <?php echo e($orderProduct->total_format); ?>

                                            </strong>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if(EcommerceHelper::isTaxEnabled() && (float)$order->tax_amount): ?>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Tax')); ?>:</span>
                            <strong class="order-detail-value"> <?php echo e(format_price($order->tax_amount)); ?> </strong>
                        </p>
                    <?php endif; ?>

                    <?php if((float)$order->discount_amount): ?>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Discount')); ?>:</span>
                            <strong class="order-detail-value"> <?php echo e(format_price($order->discount_amount)); ?>

                                <?php if($order->discount_amount): ?>
                                    <?php if($order->coupon_code): ?>
                                        (<?php echo BaseHelper::html(__('Coupon code: ":code"', ['code' => Html::tag('strong', $order->coupon_code)->toHtml()])); ?>)
                                    <?php elseif($order->discount_description): ?>
                                        (<?php echo e($order->discount_description); ?>)
                                    <?php endif; ?>
                                <?php endif; ?>
                            </strong>
                        </p>
                    <?php endif; ?>

                    <?php if((float)$order->shipping_amount && EcommerceHelper::countDigitalProducts($order->products) != $order->products->count()): ?>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Shipping fee')); ?>: </span>
                            <strong><?php echo e(format_price($order->shipping_amount)); ?></strong>
                        </p>
                    <?php endif; ?>

                    <p>
                        <span class="d-inline-block me-1"><?php echo e(__('Total Amount')); ?>: </span>
                        <strong><?php echo e(format_price($order->amount)); ?></strong>
                    </p>
                </div>

                <?php if(! EcommerceHelper::isDisabledPhysicalProduct() && $order->shipment->id): ?>
                    <br>
                    <h5 class="mb-3"><?php echo e(__('Shipping Information')); ?>: </h5>
                    <p>
                        <span class="d-inline-block me-1"><?php echo e(__('Shipping Status')); ?>: </span>
                        <strong class="d-inline-block text-info"><?php echo BaseHelper::clean($order->shipment->status->toHtml()); ?></strong>
                    </p>
                    <?php if($order->shipment->shipping_company_name): ?>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Shipping Company Name')); ?>: </span>
                            <strong class="d-inline-block"><?php echo e($order->shipment->shipping_company_name); ?></strong>
                        </p>
                    <?php endif; ?>
                    <?php if($order->shipment->tracking_id): ?>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Tracking ID')); ?>: </span>
                            <strong class="d-inline-block"><?php echo e($order->shipment->tracking_id); ?></strong>
                        </p>
                    <?php endif; ?>
                    <?php if($order->shipment->tracking_link): ?>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Tracking Link')); ?>: </span>
                            <strong class="d-inline-block">
                                <a href="<?php echo e($order->shipment->tracking_link); ?>"
                                    target="_blank"><?php echo e($order->shipment->tracking_link); ?></a>
                            </strong>
                        </p>
                    <?php endif; ?>
                    <?php if($order->shipment->note): ?>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Delivery Notes')); ?>: </span>
                            <strong class="d-inline-block"><?php echo e($order->shipment->note); ?></strong>
                        </p>
                    <?php endif; ?>
                    <?php if($order->shipment->estimate_date_shipped): ?>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Estimate Date Shipped')); ?>: </span>
                            <strong class="d-inline-block"><?php echo e($order->shipment->estimate_date_shipped); ?></strong>
                        </p>
                    <?php endif; ?>
                    <?php if($order->shipment->date_shipped): ?>
                        <p>
                            <span class="d-inline-block me-1"><?php echo e(__('Date Shipped')); ?>: </span>
                            <strong class="d-inline-block"><?php echo e($order->shipment->date_shipped); ?></strong>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php elseif(request()->input('order_id') || request()->input('email')): ?>
    <div role="alert" class="alert alert-danger mt-3">
        <div class="d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 9v4"></path>
                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                <path d="M12 16h.01"></path>
            </svg>

            <?php echo e(__('The order could not be found. Please try again or contact us if you need assistance.')); ?>

        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/includes/order-tracking-detail.blade.php ENDPATH**/ ?>