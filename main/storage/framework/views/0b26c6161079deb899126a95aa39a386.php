<!DOCTYPE html>
<html>

<head>
    <title><?php echo e($channel['title']); ?></title>
</head>

<body>
    <h1><a href="<?php echo e($channel['link']); ?>"><?php echo e($channel['title']); ?></a></h1>
    <ul>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e($item['loc']); ?>"><?php echo e(empty($item['title']) ? $item['loc'] : $item['title']); ?></a>
                <small>(last updated: <?php echo e(date('Y-m-d\TH:i:sP', strtotime($item['lastmod']))); ?>)</small>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</body>

</html>
<?php /**PATH /var/www/html/platform/packages/sitemap/resources/views/html.blade.php ENDPATH**/ ?>