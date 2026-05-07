<input <?php echo e($attributes->merge([
    'type' => 'search',
    'name' => 'q',
    'placeholder' => __('Search for Products...'),
    'value' => BaseHelper::stringify(request()->query('q')),
    'autocomplete' => 'off',
])); ?>>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/components/fronts/ajax-search/input.blade.php ENDPATH**/ ?>