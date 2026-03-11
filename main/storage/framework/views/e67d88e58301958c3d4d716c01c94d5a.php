<?php
    $title = theme_option('newsletter_popup_title');
    $image = theme_option('newsletter_popup_image');
?>

<link rel="stylesheet" href="<?php echo e(asset('vendor/core/plugins/newsletter/css/newsletter.css')); ?>?v=1.2.8">

<div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['modal-dialog', 'modal-lg' => $image]); ?>">
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['modal-content border-0', 'd-flex flex-md-col flex-lg-row' => $image]); ?>">
        <?php if($image): ?>
            <div class="d-none d-md-block col-6 newsletter-popup-bg">
                <?php echo RvMedia::image($image, $title, attributes: ['loading' => 'eager']); ?>

            </div>
        <?php endif; ?>

        <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>

        <div class="newsletter-popup-content">
            <div class="modal-header flex-column align-items-start border-0 p-0">
                <?php if($subtitle = theme_option('newsletter_popup_subtitle')): ?>
                    <span class="modal-subtitle"><?php echo BaseHelper::clean($subtitle); ?></span>
                <?php endif; ?>

                <?php if($title): ?>
                    <h5 class="modal-title fs-2" id="newsletterPopupModalLabel"><?php echo BaseHelper::clean($title); ?></h5>
                <?php endif; ?>

                <?php if($description = theme_option('newsletter_popup_description')): ?>
                    <p class="modal-text text-muted"><?php echo BaseHelper::clean($description); ?></p>
                <?php endif; ?>
            </div>
            <div class="modal-body p-0">
                <?php echo $newsletterForm->setFormOption('class', 'bb-newsletter-popup-form')->renderForm(); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/platform/plugins/newsletter/resources/views/partials/popup.blade.php ENDPATH**/ ?>