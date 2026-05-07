<?php
    Arr::set($selectAttributes, 'class', Arr::get($selectAttributes, 'class') . ' form-select');
    $choices = $list ?? $choices;

    if ($optionsAttributes && ! is_array($optionsAttributes)) {
        $optionsAttributes = [];
    }

    $selectAttributes['id'] = Arr::get($selectAttributes, 'id', $name . '-select-' . rand(10000, 99999));
?>

<?php echo Form::select(
    $name,
    $choices,
    $selected,
    $selectAttributes,
    $optionsAttributes,
    $optgroupsAttributes,
); ?>

<?php /**PATH /var/www/html/platform/core/base/resources/views/forms/partials/custom-select.blade.php ENDPATH**/ ?>