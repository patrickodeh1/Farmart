<?php if (! $__env->hasRenderedOnce('2bc31724-d91f-4217-850b-b4b5ea13b4e0')): $__env->markAsRenderedOnce('2bc31724-d91f-4217-850b-b4b5ea13b4e0'); ?>
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