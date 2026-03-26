<?php if($products->isNotEmpty()): ?>
    <div class="bb-quick-search-content">
        <div class="bb-quick-search-list">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="bb-quick-search-item" href="<?php echo e($product->url); ?>">
                    <div class="bb-quick-search-item-image">
                        <?php echo e(RvMedia::image($product->image, $product->name, 'thumb', useDefaultImage: true, attributes: ['loading' => false])); ?>

                    </div>
                    <div class="bb-quick-search-item-info">
                        <div class="bb-quick-search-item-name">
                            <?php echo e($product->name); ?>

                        </div>

                        <?php if(EcommerceHelper::isReviewEnabled()): ?>
                            <div class="bb-quick-search-item-rating">
                                <?php echo $__env->make(EcommerceHelper::viewPath('includes.rating-star'), ['avg' => $product->reviews_avg], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <span>(<?php echo e($product->reviews_count); ?>)</span>
                            </div>
                        <?php endif; ?>

                        <?php echo $__env->make(EcommerceHelper::viewPath('includes.product-price'), [
                            'priceWrapperClassName' => 'bb-quick-search-item-price',
                            'priceClassName' => 'new-price',
                            'priceOriginalWrapperClassName' => '',
                            'priceOriginalClassName' => 'old-price',
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="bb-quick-search-view-all">
        <a href="#" onclick="event.preventDefault(); this.closest('.bb-form-quick-search').submit();"><?php echo e(__('View all results')); ?></a>
    </div>
<?php else: ?>
    <div class="bb-quick-search-empty">
        <?php echo e(__('No results found!')); ?>

    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/includes/ajax-search-results.blade.php ENDPATH**/ ?>