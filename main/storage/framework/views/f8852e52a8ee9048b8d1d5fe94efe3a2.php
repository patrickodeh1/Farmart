<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="list-group-item px-0 px-md-2">
        <input
            type="hidden"
            name="cross_sale_products[<?php echo e($product->id); ?>][id]"
            value="<?php echo e($product->id); ?>"
        />
        <input
            type="hidden"
            name="cross_sale_products[<?php echo e($product->id); ?>][is_variant]"
            value="0"
        />
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <span
                    class="avatar"
                    style="background-image: url('<?php echo e(RvMedia::getImageUrl($product->image, 'thumb', false, RvMedia::getDefaultImage())); ?>')"
                ></span>
            </div>
            <div class="col text-truncate">
                <div class="d-flex align-items-center gap-2">
                    <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="text-body d-block text-truncate" target="_blank"><?php echo e($product->name); ?></a>
                    <?php if($includeVariation && $product->variationInfo->id): ?>
                        - <div class="text-secondary text-truncate">
                            <?php $__currentLoopData = $product->variationInfo->variationItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <div>
                    <span class="fw-semibold"><?php echo e(format_price($product->front_sale_price)); ?></span>
                    <?php if($product->isOnSale()): ?>
                        /
                        <span class="text-danger text-decoration-line-through"><?php echo e(format_price($product->price)); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-auto">
                <a
                    href="javascript:void(0)"
                    class="text-decoration-none list-group-item-actions"
                    data-bb-toggle="product-delete-item"
                    data-bb-target="<?php echo e($product->id); ?>"
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

        <div class="row">
            <div class="col">
                <?php if (isset($component)) { $__componentOriginala5b2ce8ea835a1a6ed10854da20fa051 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala5b2ce8ea835a1a6ed10854da20fa051 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.text-input','data' => ['label' => trans('plugins/ecommerce::products.price'),'value' => $product->pivot->price,'name' => 'cross_sale_products['.e($product->id).'][price]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('plugins/ecommerce::products.price')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->pivot->price),'name' => 'cross_sale_products['.e($product->id).'][price]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala5b2ce8ea835a1a6ed10854da20fa051)): ?>
<?php $attributes = $__attributesOriginala5b2ce8ea835a1a6ed10854da20fa051; ?>
<?php unset($__attributesOriginala5b2ce8ea835a1a6ed10854da20fa051); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala5b2ce8ea835a1a6ed10854da20fa051)): ?>
<?php $component = $__componentOriginala5b2ce8ea835a1a6ed10854da20fa051; ?>
<?php unset($__componentOriginala5b2ce8ea835a1a6ed10854da20fa051); ?>
<?php endif; ?>
            </div>
            <div class="col">
                <?php if (isset($component)) { $__componentOriginald8f3cab0e02bd6920e9589a31228d9ca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.select','data' => ['label' => trans('plugins/ecommerce::products.cross_sell_price_type.title'),'options' => \Botble\Ecommerce\Enums\CrossSellPriceType::labels(),'value' => $product->pivot->price_type,'name' => 'cross_sale_products['.e($product->id).'][price_type]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('plugins/ecommerce::products.cross_sell_price_type.title')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Botble\Ecommerce\Enums\CrossSellPriceType::labels()),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->pivot->price_type),'name' => 'cross_sale_products['.e($product->id).'][price_type]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca)): ?>
<?php $attributes = $__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca; ?>
<?php unset($__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8f3cab0e02bd6920e9589a31228d9ca)): ?>
<?php $component = $__componentOriginald8f3cab0e02bd6920e9589a31228d9ca; ?>
<?php unset($__componentOriginald8f3cab0e02bd6920e9589a31228d9ca); ?>
<?php endif; ?>
            </div>
        </div>

        <?php if($product->variations->isNotEmpty()): ?>
            <?php if (isset($component)) { $__componentOriginal88fb2b6bd120f5ac7fade6b8e409403f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal88fb2b6bd120f5ac7fade6b8e409403f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.on-off.checkbox','data' => ['label' => trans('plugins/ecommerce::products.apply_for_all_variations'),'name' => 'cross_sale_products['.e($product->id).'][apply_to_all_variations]','checked' => $product->pivot->apply_to_all_variations,'dataBbToggle' => 'collapse','dataBbTarget' => '#product-variations-'.e($product->id).'','dataBbReverse' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.on-off.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('plugins/ecommerce::products.apply_for_all_variations')),'name' => 'cross_sale_products['.e($product->id).'][apply_to_all_variations]','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->pivot->apply_to_all_variations),'data-bb-toggle' => 'collapse','data-bb-target' => '#product-variations-'.e($product->id).'','data-bb-reverse' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal88fb2b6bd120f5ac7fade6b8e409403f)): ?>
<?php $attributes = $__attributesOriginal88fb2b6bd120f5ac7fade6b8e409403f; ?>
<?php unset($__attributesOriginal88fb2b6bd120f5ac7fade6b8e409403f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal88fb2b6bd120f5ac7fade6b8e409403f)): ?>
<?php $component = $__componentOriginal88fb2b6bd120f5ac7fade6b8e409403f; ?>
<?php unset($__componentOriginal88fb2b6bd120f5ac7fade6b8e409403f); ?>
<?php endif; ?>

            <div class="list-group" id="product-variations-<?php echo e($product->id); ?>" style="<?php echo \Illuminate\Support\Arr::toCssStyles(['display: none' => $product->pivot->apply_to_all_variations]) ?>">
                <?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php ($variationProduct->product->pivot = $crossSaleProducts->find($variationProduct->product->id)?->pivot); ?>

                    <input
                        type="hidden"
                        name="cross_sale_products[<?php echo e($variationProduct->product->id); ?>][id]"
                        value="<?php echo e($variationProduct->product->id); ?>"
                    />
                    <input
                        type="hidden"
                        name="cross_sale_products[<?php echo e($variationProduct->product->id); ?>][parent_id]"
                        value="<?php echo e($product->id); ?>"
                    />
                    <input
                        type="hidden"
                        name="cross_sale_products[<?php echo e($variationProduct->product->id); ?>][is_variant]"
                        value="1"
                    />
                    <div class="list-group-item">
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                <span
                                    class="avatar"
                                    style="background-image: url('<?php echo e(RvMedia::getImageUrl($variationProduct->image, 'thumb', false, RvMedia::getDefaultImage())); ?>')"
                                ></span>
                            </div>

                            <div class="col text-truncate">
                                <div class="d-flex align-items-center gap-2">
                                    <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="text-body" target="_blank"><?php echo e($variationProduct->product->name); ?></a>

                                    <?php if($variationProduct->product->variationInfo->id): ?>
                                        - <div class="text-secondary text-truncate">
                                            <?php $__currentLoopData = $variationProduct->product->variationInfo->variationItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                <div>
                                    <span class="fw-semibold"><?php echo e(format_price($variationProduct->product->front_sale_price)); ?></span>
                                    <?php if($variationProduct->product->isOnSale()): ?>
                                        /
                                        <span class="text-danger text-decoration-line-through"><?php echo e(format_price($variationProduct->product->price)); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <?php if (isset($component)) { $__componentOriginala5b2ce8ea835a1a6ed10854da20fa051 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala5b2ce8ea835a1a6ed10854da20fa051 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.text-input','data' => ['label' => trans('plugins/ecommerce::products.price'),'value' => $variationProduct->product?->pivot?->price,'name' => 'cross_sale_products['.e($variationProduct->product->id).'][price]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('plugins/ecommerce::products.price')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variationProduct->product?->pivot?->price),'name' => 'cross_sale_products['.e($variationProduct->product->id).'][price]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala5b2ce8ea835a1a6ed10854da20fa051)): ?>
<?php $attributes = $__attributesOriginala5b2ce8ea835a1a6ed10854da20fa051; ?>
<?php unset($__attributesOriginala5b2ce8ea835a1a6ed10854da20fa051); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala5b2ce8ea835a1a6ed10854da20fa051)): ?>
<?php $component = $__componentOriginala5b2ce8ea835a1a6ed10854da20fa051; ?>
<?php unset($__componentOriginala5b2ce8ea835a1a6ed10854da20fa051); ?>
<?php endif; ?>
                            </div>

                            <div class="col">
                                <?php if (isset($component)) { $__componentOriginald8f3cab0e02bd6920e9589a31228d9ca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.select','data' => ['label' => trans('plugins/ecommerce::products.cross_sell_price_type.title'),'options' => \Botble\Ecommerce\Enums\CrossSellPriceType::labels(),'value' => $variationProduct->product?->pivot?->price_type,'name' => 'cross_sale_products['.e($variationProduct->product->id).'][price_type]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('plugins/ecommerce::products.cross_sell_price_type.title')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Botble\Ecommerce\Enums\CrossSellPriceType::labels()),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variationProduct->product?->pivot?->price_type),'name' => 'cross_sale_products['.e($variationProduct->product->id).'][price_type]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca)): ?>
<?php $attributes = $__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca; ?>
<?php unset($__attributesOriginald8f3cab0e02bd6920e9589a31228d9ca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8f3cab0e02bd6920e9589a31228d9ca)): ?>
<?php $component = $__componentOriginald8f3cab0e02bd6920e9589a31228d9ca; ?>
<?php unset($__componentOriginald8f3cab0e02bd6920e9589a31228d9ca); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/products/partials/selected-cross-sell-products.blade.php ENDPATH**/ ?>