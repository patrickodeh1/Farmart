<div class="row">
    <div class="col-auto">
        <?php if($history->user->id): ?>
            <img
                src="<?php echo e($history->user->avatar_url); ?>"
                class="avatar"
                alt="<?php echo e($history->user->name); ?>"
            />
        <?php else: ?>
            <img
                src="<?php echo e(setting('admin_favicon') ? RvMedia::getImageUrl(setting('admin_favicon')) : asset(RvMedia::getDefaultImage())); ?>"
                class="avatar"
                alt="<?php echo e(trans('plugins/audit-log::history.system')); ?>"
            />
        <?php endif; ?>
    </div>
    <div class="col">
        <div class="text-truncate">
            <strong>
                <?php if($history->user->id): ?>
                    <a href="<?php echo e(Auth::guard()->user()->url); ?>"><?php echo e($history->user->name); ?></a>
                <?php else: ?>
                    <?php echo e(trans('plugins/audit-log::history.system')); ?>

                <?php endif; ?>
            </strong>

            <?php if(Lang::has("plugins/audit-log::history.$history->action")): ?>
                <?php echo e(trans("plugins/audit-log::history.$history->action")); ?>

            <?php else: ?>
                <?php echo e($history->action); ?>

            <?php endif; ?>

            <?php if($history->module != 'user' || empty($history->user) || $history->user->id != Auth::guard()->id()): ?>
                <?php if(Lang::has("plugins/audit-log::history.$history->module")): ?>
                    <?php echo e(trans("plugins/audit-log::history.$history->module")); ?>

                <?php else: ?>
                    <?php echo e($history->module); ?>

                <?php endif; ?>
            <?php endif; ?>

            <?php if($history->reference_name && (empty($history->user) || $history->user->name != $history->reference_name)): ?>
                <span title="<?php echo e($history->reference_name); ?>">"<?php echo e(Str::limit($history->reference_name, 40)); ?>"</span>
            <?php endif; ?>
        </div>
        <div class="text-muted">
            <?php echo e($history->created_at->diffForHumans()); ?>

            (<a
                href="https://ipinfo.io/<?php echo e($history->ip_address); ?>"
                target="_blank"
                title="<?php echo e($history->ip_address); ?>"
                rel="nofollow"
            ><?php echo e($history->ip_address); ?></a>)
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/platform/plugins/audit-log/resources/views/activity-line.blade.php ENDPATH**/ ?>