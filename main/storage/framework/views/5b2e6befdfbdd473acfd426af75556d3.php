<?php
    Theme::layout('full-width');
    Theme::set('bodyClass', 'rezgo-tours-page');
?>

<div class="bg-light py-md-5 px-lg-3 px-2">
    <div class="container-xxxl">

        <div class="row align-items-center mb-4">
            <div class="col">
                <h1 class="fs-4 fw-bold mb-0"><?php echo e(__('Available Tours & Tickets')); ?></h1>
            </div>
        </div>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php if(empty($tours)): ?>
            <div class="alert alert-info">No tours available at this time.</div>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <?php if($tour['image']): ?>
                                <img src="<?php echo e($tour['image']); ?>" class="card-img-top" alt="<?php echo e($tour['title']); ?>" style="height:200px; object-fit:cover;">
                            <?php else: ?>
                                <div class="bg-secondary" style="height:200px;"></div>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fs-6 fw-bold"><?php echo e($tour['title']); ?></h5>
                                <?php if($tour['location']): ?>
                                    <p class="text-muted small mb-2">
                                        <i class="ti ti-map-pin"></i> <?php echo e($tour['location']); ?>

                                    </p>
                                <?php endif; ?>
                                <div class="mt-auto">
                                    <?php if($tour['starting'] > 0): ?>
                                        <p class="fw-bold text-primary mb-2">From $<?php echo e(number_format($tour['starting'], 2)); ?></p>
                                    <?php else: ?>
                                        <p class="fw-bold text-primary mb-2">Price varies by date</p>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('rezgo.storefront.tour', $tour['uid'])); ?>"
                                       class="btn btn-primary w-100">
                                        <?php echo e(__('View & Book')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/themes/tours.blade.php ENDPATH**/ ?>