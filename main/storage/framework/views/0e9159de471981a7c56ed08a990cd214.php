<?php if (! $__env->hasRenderedOnce('f06c839d-3bf0-4f4c-9327-1f925aa16201')): $__env->markAsRenderedOnce('f06c839d-3bf0-4f4c-9327-1f925aa16201'); ?>
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