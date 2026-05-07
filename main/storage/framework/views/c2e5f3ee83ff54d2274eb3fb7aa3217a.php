<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="list-group-item px-0 px-md-2">
        <div class="row align-items-center">
            <div class="col-auto">
                <span
                    class="avatar"
                    style="background-image: url('<?php echo e(RvMedia::getImageUrl($relatedProduct->image, 'thumb', false, RvMedia::getDefaultImage())); ?>')"
                ></span>
            </div>
            <div class="col text-truncate">
                <a href="<?php echo e(route('products.edit', $relatedProduct->id)); ?>" class="text-body d-block" target="_blank"><?php echo e($relatedProduct->name); ?></a>
                <?php if($includeVariation && $relatedProduct->variationInfo->id): ?>
                    <div class="text-secondary text-truncate">
                        <?php $__currentLoopData = $relatedProduct->variationInfo->variationItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span>
                                <?php echo e($variationItem->attribute->title); ?>

                                <?php if(!$loop->last): ?>
                                    <span> / </span>
                                <?php endif; ?>
                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-auto">
                <a
                    href="javascript:void(0)"
                    class="text-decoration-none list-group-item-actions"
                    data-bb-toggle="product-delete-item"
                    data-bb-target="<?php echo e($relatedProduct->id); ?>"
                    title="<?php echo e(trans('plugins/ecommerce::products.delete')); ?>"
                >
                    <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-x'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-secondary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
                </a>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/products/partials/selected-products-list.blade.php ENDPATH**/ ?>