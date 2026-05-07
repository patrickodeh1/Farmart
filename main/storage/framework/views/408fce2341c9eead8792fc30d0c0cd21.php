<div
    class="js-cookie-consent cookie-consent cookie-consent-<?php echo e(theme_option('cookie_consent_style', 'full-width')); ?>"
    style="background-color: <?php echo e(theme_option('cookie_consent_background_color', '#000')); ?>; color: <?php echo e(theme_option('cookie_consent_text_color', '#fff')); ?>;"
>
    <div
        class="cookie-consent-body"
        style="max-width: <?php echo e(theme_option('cookie_consent_max_width', 1170)); ?>px;"
    >
        <span class="cookie-consent__message">
            <?php echo BaseHelper::clean(theme_option('cookie_consent_message', trans('plugins/cookie-consent::cookie-consent.message'))); ?>

            <?php if(($learnMoreUrl = theme_option('cookie_consent_learn_more_url')) && ($learnMoreText = theme_option('cookie_consent_learn_more_text'))): ?>
                <a
                    href="<?php echo e(Str::startsWith($learnMoreUrl, ['http://', 'https://']) ? $learnMoreUrl : BaseHelper::getHomepageUrl() . '/' . $learnMoreUrl); ?>"><?php echo e($learnMoreText); ?></a>
            <?php endif; ?>
        </span>

        <button
            class="js-cookie-consent-agree cookie-consent__agree"
            style="background-color: <?php echo e(theme_option('cookie_consent_background_color', '#000')); ?>; color: <?php echo e(theme_option('cookie_consent_text_color', '#fff')); ?>; border: 1px solid <?php echo e(theme_option('cookie_consent_text_color', '#fff')); ?>;"
        >
            <?php echo e(theme_option('cookie_consent_button_text', trans('plugins/cookie-consent::cookie-consent.button_text'))); ?>

        </button>
    </div>
</div>
<div data-site-cookie-name="<?php echo e($cookieConsentConfig['cookie_name'] ?? 'cookie_for_consent'); ?>"></div>
<div data-site-cookie-lifetime="<?php echo e($cookieConsentConfig['cookie_lifetime'] ?? 36000); ?>"></div>
<div data-site-cookie-domain="<?php echo e(config('session.domain') ?? request()->getHost()); ?>"></div>
<div data-site-session-secure="<?php echo e(config('session.secure') ? ';secure' : null); ?>"></div>

<script>
    window.addEventListener('load', function () {
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'default', {
                'ad_storage': 'denied'
            });

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('js-cookie-consent-agree')) {
                    gtag('consent', 'update', {
                        'ad_storage': 'granted'
                    });
                }
            });
        }
    });
</script>
<?php /**PATH /var/www/html/platform/plugins/cookie-consent/resources/views/index.blade.php ENDPATH**/ ?>