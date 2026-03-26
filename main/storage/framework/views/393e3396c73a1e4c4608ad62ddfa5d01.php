<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(! $review->is_approved && auth('customer')->id() != $review->customer_id) continue; ?>

    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['row pb-3 mb-3 review-item', 'border-bottom' => ! $loop->last, 'opacity-50' => ! $review->is_approved]); ?>">
        <div class="col-auto">
            <img class="rounded-circle" src="<?php echo e($review->customer_avatar_url); ?>" alt="<?php echo e($review->user->name ?: $review->customer_name); ?>" width="60">
        </div>
        <div class="col">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-2 review-item__header">
                <div class="fw-medium">
                    <?php
                        $customerName = $review->user->name ?: $review->customer_name;

                        if (! get_ecommerce_setting('show_customer_full_name', true)) {
                            $customerNameCharCount = strlen($customerName);

                            if ($customerNameCharCount > 7) {
                                $customerName = Str::mask($customerName, '*', $customerNameCharCount - 5, 5);
                            } elseif ($customerNameCharCount > 3) {
                                $customerName = Str::mask($customerName, '*', $customerNameCharCount - 3, 3);
                            } else {
                                $customerName = Str::mask($customerName, '*', 1, -1);
                            }
                        }
                    ?>

                    <?php echo e($customerName); ?>

                </div>
                <time class="text-muted small" datetime="<?php echo e($review->created_at->translatedFormat('Y-m-d\TH:i:sP')); ?>">
                    <?php echo e($review->created_at->diffForHumans()); ?>

                </time>
                <?php if($review->order_created_at): ?>
                    <div class="small text-muted"><?php echo e(__('✅ Purchased :time', ['time' => $review->order_created_at->diffForHumans()])); ?></div>
                <?php endif; ?>
                <?php if(! $review->is_approved): ?>
                    <div class="small text-warning"><?php echo e(__('Waiting for approval')); ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-2 review-item__rating">
                <?php echo $__env->make(EcommerceHelper::viewPath('includes.rating-star'), ['avg' => $review->star, 'size' => 80], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <div class="review-item__body">
                <?php echo e($review->comment); ?>

            </div>

            <?php if($review->images): ?>
                <div class="review-item__images mt-3">
                    <div class="row g-1 review-images">
                        <?php $__currentLoopData = $review->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(RvMedia::getImageUrl($image)); ?>" class="col-3 col-md-2 col-xl-1 position-relative">
                                <img src="<?php echo e(RvMedia::getImageUrl($image, 'thumb')); ?>" alt="<?php echo e($review->comment); ?>" class="img-thumbnail">
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if($review->reply): ?>
            <div class="review-item__reply mt-4">
                <div class="position-relative row py-3 rounded bg-light">
                    <div class="col-auto">
                        <img class="rounded-circle" src="<?php echo e($review->reply->user->avatar_url); ?>" alt="<?php echo e($review->reply->user->name); ?>" width="50">
                    </div>
                    <div class="col">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2 review-item__header">
                            <div class="fw-medium">
                                <?php echo e($review->reply->user->name); ?>

                            </div>
                            <span class="badge bg-primary">
                                <?php echo e(__('Admin')); ?>

                            </span>
                            <time class="text-muted small" datetime="<?php echo e($review->reply->created_at->translatedFormat('Y-m-d\TH:i:sP')); ?>">
                                <?php echo e($review->reply->created_at->diffForHumans()); ?>

                            </time>
                        </div>

                        <div class="review-item__body">
                            <?php echo e($review->reply->message); ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo e($reviews->links()); ?>

<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/includes/review-list.blade.php ENDPATH**/ ?>