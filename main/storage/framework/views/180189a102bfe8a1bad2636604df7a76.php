<?php Theme::set('withTitle', false); ?>

<div class="row mt-5">
    <div class="col-md-9">
        <h1 class="h2"><?php echo e($post->name); ?></h1>
        <div class="post-item__inner pb-4 my-3 border-bottom">
            <div class="entry-meta">
                <?php if($post->author && theme_option('blog_show_author_name', 'yes') == 'yes'): ?>
                    <div class="entry-meta-author">
                        <span><?php echo e(__('By :name', ['name' => $post->author->name])); ?></span>
                    </div>
                <?php endif; ?>
                <?php if($post->categories->isNotEmpty()): ?>
                    <div class="entry-meta-categories">
                        <span><?php echo e(($post->author && theme_option('blog_show_author_name', 'yes') == 'yes') ? __('in') : ucfirst(__('in'))); ?></span>
                        <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($category->url); ?>"><?php echo e($category->name); ?></a><?php if(!$loop->last): ?>, <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <div class="entry-meta-date">
                    <span><?php echo e(__('on')); ?></span>
                    <time><?php echo e(Theme::formatDate($post->created_at)); ?></time>
                </div>
            </div>
        </div>
        <div class="mt-5 pt-3 post-detail__content">
            <div class="ck-content"><?php echo BaseHelper::clean($post->content); ?></div>

            <?php if($post->tags->isNotEmpty()): ?>
                <div class="entry-meta-tags">
                    <strong><?php echo e(__('Tags')); ?>:</strong>
                    <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a
                            class="text-link"
                            href="<?php echo e($tag->url); ?>"
                        ><?php echo e($tag->name); ?></a><?php if(!$loop->last): ?>, <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if(theme_option('social_share_enabled', 'yes') == 'yes'): ?>
                <div class="mt-3">
                    <p><strong><?php echo e(__('Share')); ?>:</strong></p>

                    <?php echo Theme::partial('share-socials', ['product' => $post]); ?>

                </div>
            <?php endif; ?>

            <?php echo apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $post); ?>

        </div>
        <?php $relatedPosts = get_related_posts($post->id, 4); ?>

        <?php if($relatedPosts->isNotEmpty()): ?>
            <div class="related-posts mt-5 pt-3">
                <div class="heading">
                    <h3><?php echo e(__('Related Posts')); ?></h3>
                </div>
                <div class="list-post--wrapper">
                    <div
                        class="slick-slides-carousel"
                        data-slick="<?php echo e(json_encode([
                            'slidesToShow' => 3,
                            'slidesToScroll' => 1,
                            'arrows' => true,
                            'dots' => true,
                            'infinite' => false,
                            'responsive' => [
                                [
                                    'breakpoint' => 1200,
                                    'settings' => [
                                        'slidesToShow' => 2,
                                        'slidesToScroll' => 1,
                                    ],
                                ],
                                [
                                    'breakpoint' => 480,
                                    'settings' => [
                                        'slidesToShow' => 1,
                                        'slidesToScroll' => 1,
                                    ],
                                ],
                            ],
                        ])); ?>"
                    >
                        <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo Theme::partial('post-item', ['post' => $item]); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-3">
        <div class="primary-sidebar">
            <aside
                class="widget-area"
                id="primary-sidebar"
            >
                <?php echo dynamic_sidebar('primary_sidebar'); ?>

            </aside>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/platform/themes/farmart/views/post.blade.php ENDPATH**/ ?>