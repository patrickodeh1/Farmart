<!DOCTYPE html>
<html <?php echo Theme::htmlAttributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta
        name="csrf-token"
        content="<?php echo e(csrf_token()); ?>"
    >
    <title> <?php echo $__env->yieldContent('title', __('Checkout')); ?> </title>

    <?php if($favicon = Theme::getFavicon()): ?>
        <link
            href="<?php echo e(RvMedia::getImageUrl($favicon)); ?>"
            rel="shortcut icon"
        >
    <?php endif; ?>

    <?php echo Theme::typography()->renderCssVariables(); ?>


    <style>
        :root {
            --primary-color: <?php echo e($primaryColor = theme_option('primary_color', '#58b3f0')); ?>;
            --primary-color-rgb: <?php echo e(implode(',', BaseHelper::hexToRgb($primaryColor))); ?>;
        }
    </style>

    <?php echo Html::style('vendor/core/core/base/libraries/font-awesome/css/fontawesome.min.css?v=' . ($assetsVersion = EcommerceHelper::getAssetVersion())); ?>

    <?php echo Html::style('vendor/core/core/base/libraries/ckeditor/content-styles.css?v=' . $assetsVersion); ?>

    <?php if(BaseHelper::isRtlEnabled()): ?>
        <?php echo Html::style('vendor/core/plugins/ecommerce/libraries/bootstrap/bootstrap.rtl.min.css?v=' . $assetsVersion); ?>

    <?php else: ?>
        <?php echo Html::style('vendor/core/plugins/ecommerce/libraries/bootstrap/bootstrap.min.css?v=' . $assetsVersion); ?>

    <?php endif; ?>

    <?php echo Html::style('vendor/core/plugins/ecommerce/css/front-theme.css?v=' . $assetsVersion); ?>


    <?php if(BaseHelper::isRtlEnabled()): ?>
        <?php echo Html::style('vendor/core/plugins/ecommerce/css/front-theme-rtl.css?v=' . $assetsVersion); ?>

    <?php endif; ?>

    <?php echo Html::style('vendor/core/core/base/libraries/toastr/toastr.min.css?v=' . $assetsVersion); ?>


    <?php echo Html::script('vendor/core/plugins/ecommerce/js/checkout.js?v=' . $assetsVersion); ?>


    <?php if(EcommerceHelper::loadCountriesStatesCitiesFromPluginLocation()): ?>
        <link
            href="<?php echo e(asset('vendor/core/core/base/libraries/select2/css/select2.min.css?v=' . $assetsVersion)); ?>"
            rel="stylesheet"
        >
        <script src="<?php echo e(asset('vendor/core/core/base/libraries/select2/js/select2.min.js?v=' . $assetsVersion)); ?>"></script>
        <script src="<?php echo e(asset('vendor/core/plugins/location/js/location.js?v=' . $assetsVersion)); ?>"></script>
    <?php endif; ?>

    <?php echo apply_filters('ecommerce_checkout_header', null); ?>


    <?php echo $__env->yieldPushContent('header'); ?>
</head>

<?php
    Theme::addBodyAttributes([
        'class' => 'checkout-page',
    ]);
?>

<body<?php echo Theme::bodyAttributes(); ?>>
    <?php echo apply_filters('ecommerce_checkout_body', null); ?>

    <div class="container my-0 my-md-3 my-lg-5 checkout-content-wrap">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->yieldPushContent('footer'); ?>

    <?php echo Html::script('vendor/core/plugins/ecommerce/js/utilities.js?v=' . $assetsVersion); ?>

    <?php echo Html::script('vendor/core/core/base/libraries/toastr/toastr.min.js?v=' . $assetsVersion); ?>


    <script type="text/javascript">
        window.messages = {
            error_header: '<?php echo e(__('Error')); ?>',
            success_header: '<?php echo e(__('Success')); ?>',
        }
    </script>

    <?php if(session()->has('success_msg') || session()->has('error_msg') || isset($errors)): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                <?php if(session()->has('success_msg') && session('success_msg')): ?>
                    MainCheckout.showNotice('success', '<?php echo e(session('success_msg')); ?>');
                <?php endif; ?>
                <?php if(session()->has('error_msg')): ?>
                    MainCheckout.showNotice('error', '<?php echo e(session('error_msg')); ?>');
                <?php endif; ?>
                <?php if(isset($errors) && $errors->count()): ?>
                    MainCheckout.showNotice('error', '<?php echo e($errors->first()); ?>');
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>

    <?php echo apply_filters('ecommerce_checkout_footer', null); ?>


</body>
</html>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/orders/master.blade.php ENDPATH**/ ?>