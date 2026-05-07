<div class="faq-schema-items">
    <?php echo Form::repeater('faq_schema_config', $value, [
        [
            'type' => 'textarea',
            'label' => trans('plugins/faq::faq.question'),
            'required' => true,
            'attributes' => [
                'name' => 'question',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 1000,
                    'rows' => 1,
                ],
            ],
        ],
        [
            'type' => 'textarea',
            'label' => trans('plugins/faq::faq.answer'),
            'required' => true,
            'attributes' => [
                'name' => 'answer',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 1000,
                    'rows' => 1,
                ],
            ],
        ],
    ]); ?>

</div>

<div class="d-inline">
    <span><?php echo e(trans('plugins/faq::faq.or')); ?></span>
    <a href="javascript:void(0)" data-bb-toggle="select-from-existing">
        <?php echo e(trans('plugins/faq::faq.select_from_existing')); ?>

    </a>
</div>

<div class="existing-faq-schema-items mt-2" style="<?php echo \Illuminate\Support\Arr::toCssStyles(['display: none' => empty($selectedFaqs) || ! $faqs]) ?>">
    <?php if($faqs): ?>
        <?php echo e(Form::multiChecklist('selected_existing_faqs[]', $selectedFaqs, $faqs, [], false, false, true)); ?>

    <?php else: ?>
        <p class="text-muted mb-0">
            <?php echo BaseHelper::clean(trans(
                'plugins/faq::faq.no_existing',
                ['link' => Html::link(route('faq.create'), trans('plugins/faq::faq.faqs_menu_name'), ['target' => '_blank'])])
            ); ?>

        </p>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/platform/plugins/faq/resources/views/schema-config-box.blade.php ENDPATH**/ ?>