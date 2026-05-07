<?php
    Theme::asset()->add('faqs-css', 'vendor/core/plugins/ecommerce/css/front-faq.css', version: get_cms_version());
?>

<div class="product-faqs-accordion accordion" id="faqs-accordion">
    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(['accordion-button', 'collapsed' => ! $loop->first]); ?>"
                    type="button"
                    data-toggle="collapse"
                    data-target="#collapse-<?php echo e($loop->index); ?>" aria-expanded="true"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse-<?php echo e($loop->index); ?>" aria-expanded="true"
                    aria-controls="collapse-<?php echo e($loop->index); ?>"
                >
                    <?php echo BaseHelper::clean($faq[0]['value']); ?>

                </button>
            </h2>
            <div id="collapse-<?php echo e($loop->index); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['accordion-collapse collapse', 'show' => $loop->first]); ?>" data-bs-parent="#faqs-accordion">
                <div class="accordion-body">
                    <?php echo BaseHelper::clean($faq[1]['value']); ?>

                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/themes/includes/product-faqs.blade.php ENDPATH**/ ?>