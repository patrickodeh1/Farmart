<?php if (! $__env->hasRenderedOnce('ecec74d6-a55e-4f97-bc99-80864dab90bf')): $__env->markAsRenderedOnce('ecec74d6-a55e-4f97-bc99-80864dab90bf'); ?>
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