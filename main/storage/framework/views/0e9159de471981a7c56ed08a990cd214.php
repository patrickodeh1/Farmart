<?php if (! $__env->hasRenderedOnce('c92d8ded-e9d2-4353-bc2d-bc714cf3d75b')): $__env->markAsRenderedOnce('c92d8ded-e9d2-4353-bc2d-bc714cf3d75b'); ?>
    <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="notification-sidebar"
        aria-labelledby="notification-sidebar-label"
        data-url="<?php echo e(route('notifications.index')); ?>"
        data-count-url="<?php echo e(route('notifications.count-unread')); ?>"
    >
        <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
        ></button>

        <div class="notification-content"></div>
    </div>

    <script src="<?php echo e(asset('vendor/core/core/base/js/notification.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH /var/www/html/platform/core/base/resources/views/notification/notification.blade.php ENDPATH**/ ?>