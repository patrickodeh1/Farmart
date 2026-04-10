<?php if (! $__env->hasRenderedOnce('e54d4382-6576-4272-bd3d-16fdf83d650e')): $__env->markAsRenderedOnce('e54d4382-6576-4272-bd3d-16fdf83d650e'); ?>
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