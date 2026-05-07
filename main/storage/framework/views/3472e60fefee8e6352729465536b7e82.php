<?php if(EcommerceHelper::isReviewEnabled()): ?>
    <?php
        $version = get_cms_version();

        Theme::asset()->add('lightgallery-css', 'vendor/core/plugins/ecommerce/libraries/lightgallery/css/lightgallery.min.css', version: $version);
        Theme::asset()->add('front-ecommerce-css', 'vendor/core/plugins/ecommerce/css/front-ecommerce.css', version: $version);
        Theme::asset()->add('front-review-css', 'vendor/core/plugins/ecommerce/css/front-review.css', version: $version);
        Theme::asset()->container('footer')->add('lightgallery-js', 'vendor/core/plugins/ecommerce/libraries/lightgallery/js/lightgallery.min.js', ['jquery'], version: $version);
        Theme::asset()->container('footer')->add('lg-thumbnail-js', 'vendor/core/plugins/ecommerce/libraries/lightgallery/plugins/lg-thumbnail.min.js', ['lightgallery-js'], version: $version);
        Theme::asset()->container('footer')->add('review-js', 'vendor/core/plugins/ecommerce/js/front-review.js', ['lightgallery-js', 'lg-thumbnail-js'], version: $version);

        $showAvgRating ??= $product->reviews->isNotEmpty();
    ?>

    <div class="d-flex flex-column gap-5 product-review-container">
        <div class="row g-3">
            <?php if($showAvgRating): ?>
                <div class="col-12 col-md-4">
                    <div class="product-review-number">
                        <h3 class="product-review-number-title"><?php echo e(__('Customer reviews')); ?></h3>

                        <div class="product-review-summary">
                            <div class="product-review-summary-value">
                                <span>
                                    <?php echo e(number_format($product->reviews_avg ?: 0, 2)); ?>

                                </span>
                            </div>
                            <div class="product-review-summary-rating">
                                <?php echo $__env->make(EcommerceHelper::viewPath('includes.rating-star'), ['avg' => $product->reviews_avg, 'size' => 80], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <p>
                                    <?php if($product->reviews_count === 1): ?>
                                        (<?php echo e(__('1 Review')); ?>)
                                    <?php else: ?>
                                        (<?php echo e(__(':count Reviews', ['count' => number_format($product->reviews_count)])); ?>)
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>

                        <div class="product-review-progress">
                            <?php $__currentLoopData = EcommerceHelper::getReviewsGroupedByProductId($product->id, $product->reviews_count); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['product-review-progress-bar', 'disabled' => ! $item['count']]); ?>">
                                    <span class="product-review-progress-bar-title">
                                        <?php if($item['star'] == 1): ?>
                                            <?php echo e(__(':number Star', ['number' => $item['star']])); ?>

                                        <?php else: ?>
                                            <?php echo e(__(':number Stars', ['number' => $item['star']])); ?>

                                        <?php endif; ?>
                                    </span>
                                    <div class="progress product-review-progress-bar-value">
                                        <div
                                            class="progress-bar"
                                            role="progressbar"
                                            aria-valuenow="<?php echo e($item['percent']); ?>"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                            style="width: <?php echo e($item['percent']); ?>%"
                                        ></div>
                                    </div>
                                    <span class="product-review-progress-bar-percent">
                                        <?php echo e($item['percent']); ?>%
                                    </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php echo $__env->make($reviewFormView ?? EcommerceHelper::viewPath('includes.review-form'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <?php if(($reviewImagesCount = count($product->review_images)) > 0): ?>
            <div class="review-images-container">
                <h4 class="mb-3"><?php echo e(__('Images from customer (:count)', ['count' => number_format($reviewImagesCount)])); ?></h4>

                <div class="row g-1 review-images">
                    <?php $__currentLoopData = $product->review_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(RvMedia::getImageUrl($image)); ?>" class="col-3 col-md-2 col-xl-1 position-relative" style="<?php echo \Illuminate\Support\Arr::toCssStyles(['display: none !important' => $loop->iteration > 12]) ?>">
                            <img src="<?php echo e(RvMedia::getImageUrl($image, 'thumb')); ?>" alt="<?php echo e($product->name); ?>" class="img-thumbnail">
                            <?php if($loop->iteration === 12): ?>
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75 rounded"></div>
                                <div class="position-absolute top-50 start-50 translate-middle text-white">
                                    <span class="badge bg-dark">+<?php echo e(__(':count more', ['count' => number_format($reviewImagesCount - 12)])); ?></span>
                                </div>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if($product->reviews->isNotEmpty()): ?>
            <div class="position-relative review-list-container" data-ajax-url="<?php echo e(route('public.ajax.reviews', $product->id)); ?>">
                <h4 class="mb-3"><?php echo e(__(':total review(s) for ":product"', ['total' => number_format($product->reviews_count), 'product' => $product->name])); ?></h4>

                <div class="review-list"></div>
            </div>
        <?php else: ?>
            <p class="text-muted text-center"><?php echo e(__('Looks like there are no reviews yet.')); ?> </p>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/includes/reviews.blade.php ENDPATH**/ ?>