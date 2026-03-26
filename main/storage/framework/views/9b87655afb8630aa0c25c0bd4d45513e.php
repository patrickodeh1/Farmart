<div class="customer-address-payment-form">
    <input type="hidden" name="update-tax-url" id="update-checkout-tax-url" value="<?php echo e(route('public.ajax.checkout.update-tax')); ?>">
    <div class="mb-3 form-group">
        <?php if(auth('customer')->check()): ?>
            <p><?php echo e(__('Account')); ?>: <strong><?php echo e(auth('customer')->user()->name); ?></strong> - <?php echo Html::email(auth('customer')->user()->email); ?> (<a href="<?php echo e(route('customer.logout')); ?>"><?php echo e(__('Logout')); ?>)</a></p>
        <?php else: ?>
            <p><?php echo e(__('Already have an account?')); ?> <a href="<?php echo e(route('customer.login')); ?>"><?php echo e(__('Login')); ?></a></p>
        <?php endif; ?>
    </div>

    <?php echo apply_filters('ecommerce_checkout_address_form_before'); ?>


    <?php if(auth()->guard('customer')->check()): ?>
        <div class="mb-3 form-group">
            <?php if($isAvailableAddress): ?>
                <label
                    class="mb-2 form-label"
                    for="address_id"
                ><?php echo e(__('Select available addresses')); ?>:</label>
            <?php endif; ?>
            <?php
                $oldSessionAddressId = old('address.address_id', $sessionAddressId);
            ?>
            <div class="list-customer-address <?php if(!$isAvailableAddress): ?> d-none <?php endif; ?>">
                <div class="select--arrow">
                    <select
                        class="form-control"
                        id="address_id"
                        name="address[address_id]"
                        <?php if($isAvailableAddress): echo 'required'; endif; ?>
                    >
                        <option
                            value="new"
                            <?php if($oldSessionAddressId == 'new'): echo 'selected'; endif; ?>
                        ><?php echo e(__('Add new address...')); ?></option>
                        <?php if($isAvailableAddress): ?>
                            <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($address->id); ?>"
                                    <?php if($oldSessionAddressId == $address->id): echo 'selected'; endif; ?>
                                ><?php echo e($address->full_address); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-chevron-down'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                </div>
                <br>
                <div class="address-item-selected <?php if(!$sessionAddressId): ?> d-none <?php endif; ?>">
                    <?php if($isAvailableAddress && $oldSessionAddressId != 'new'): ?>
                        <?php if($oldSessionAddressId && $addresses->contains('id', $oldSessionAddressId)): ?>
                            <?php echo $__env->make('plugins/ecommerce::orders.partials.address-item', [
                                'address' => $addresses->firstWhere('id', $oldSessionAddressId),
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php elseif($defaultAddress = get_default_customer_address()): ?>
                            <?php echo $__env->make('plugins/ecommerce::orders.partials.address-item', [
                                'address' => $defaultAddress,
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make('plugins/ecommerce::orders.partials.address-item', [
                                'address' => Arr::first($addresses),
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="list-available-address d-none">
                    <?php if($isAvailableAddress): ?>
                        <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div
                                class="address-item-wrapper"
                                data-id="<?php echo e($address->id); ?>"
                            >
                                <?php echo $__env->make(
                                    'plugins/ecommerce::orders.partials.address-item',
                                    compact('address'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="address-form-wrapper <?php if(auth('customer')->check() && $oldSessionAddressId !== 'new' && $isAvailableAddress): ?> d-none <?php endif; ?>">
        <div class="form-group mb-3 <?php $__errorArgs = ['address.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <div class="form-input-wrapper">
                <input
                    class="form-control"
                    id="address_name"
                    name="address[name]"
                    autocomplete="family-name"
                    type="text"
                    value="<?php echo e(old('address.name', Arr::get($sessionCheckoutData, 'name')) ?: (auth('customer')->check() ? auth('customer')->user()->name : null)); ?>"
                    required
                >
                <label for="address_name"><?php echo e(__('Full Name')); ?></label>
            </div>
            <?php echo Form::error('address.name', $errors); ?>

        </div>

        <div class="row">
            <?php if(!in_array('email', EcommerceHelper::getHiddenFieldsAtCheckout())): ?>
                <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'col-12',
                    'col-lg-8' => !in_array(
                        'phone',
                        EcommerceHelper::getHiddenFieldsAtCheckout()),
                ]); ?>">
                    <div class="form-group mb-3 <?php $__errorArgs = ['address.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <div class="form-input-wrapper">
                            <input
                                class="form-control"
                                id="address_email"
                                name="address[email]"
                                autocomplete="email"
                                type="email"
                                value="<?php echo e(old('address.email', Arr::get($sessionCheckoutData, 'email')) ?: (auth('customer')->check() ? auth('customer')->user()->email : null)); ?>"
                                required
                            >
                            <label for="address_email"><?php echo e(__('Email')); ?></label>
                        </div>
                        <?php echo Form::error('address.email', $errors); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(!in_array('phone', EcommerceHelper::getHiddenFieldsAtCheckout())): ?>
                <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'col-12',
                    'col-lg-4' => !in_array(
                        'email',
                        EcommerceHelper::getHiddenFieldsAtCheckout()),
                ]); ?>">
                    <div class="form-group mb-3 <?php $__errorArgs = ['address.phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <div class="form-input-wrapper">
                            <input
                                class="form-control"
                                id="address_phone"
                                name="address[phone]"
                                autocomplete="phone"
                                type="tel"
                                value="<?php echo e(old('address.phone', Arr::get($sessionCheckoutData, 'phone')) ?: (auth('customer')->check() ? auth('customer')->user()->phone : null)); ?>"
                            >
                            <label for="address_phone"><?php echo e(__('Phone')); ?></label>
                        </div>
                        <?php echo Form::error('address.phone', $errors); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php echo apply_filters('ecommerce_checkout_address_form_inside', null); ?>


        <?php if(EcommerceHelper::isUsingInMultipleCountries() && !in_array('country', EcommerceHelper::getHiddenFieldsAtCheckout())): ?>
            <div class="form-group mb-3 <?php $__errorArgs = ['address.country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <div class="select--arrow form-input-wrapper">
                    <select
                        class="form-control"
                        id="address_country"
                        name="address[country]"
                        autocomplete="country"
                        data-form-parent=".customer-address-payment-form"
                        data-type="country"
                        required
                    >
                        <?php $__currentLoopData = EcommerceHelper::getAvailableCountries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countryCode => $countryName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($countryCode); ?>"
                                <?php if(old('address.country', Arr::get($sessionCheckoutData, 'country', EcommerceHelper::getDefaultCountryId())) == $countryCode): echo 'selected'; endif; ?>
                            >
                                <?php echo e($countryName); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-chevron-down'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                    <label for="address_country"><?php echo e(__('Country')); ?></label>
                </div>
                <?php echo Form::error('address.country', $errors); ?>

            </div>
        <?php else: ?>
            <input
                id="address_country"
                name="address[country]"
                type="hidden"
                value="<?php echo e(EcommerceHelper::getFirstCountryId()); ?>"
            >
        <?php endif; ?>

        <div class="row">
            <?php if(!in_array('state', EcommerceHelper::getHiddenFieldsAtCheckout())): ?>
                <div class="col-sm-6 col-12">
                    <div class="form-group mb-3 <?php $__errorArgs = ['address.state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php if(EcommerceHelper::loadCountriesStatesCitiesFromPluginLocation()): ?>
                            <div class="select--arrow form-input-wrapper">
                                <select
                                    class="form-control"
                                    id="address_state"
                                    name="address[state]"
                                    autocomplete="state"
                                    data-form-parent=".customer-address-payment-form"
                                    data-type="state"
                                    data-url="<?php echo e(route('ajax.states-by-country')); ?>"
                                    required
                                >
                                    <option value=""><?php echo e(__('Select state...')); ?></option>
                                    <?php if(old('address.country', Arr::get($sessionCheckoutData, 'country') ?: EcommerceHelper::getDefaultCountryId()) || !EcommerceHelper::isUsingInMultipleCountries()): ?>
                                        <?php $__currentLoopData = EcommerceHelper::getAvailableStatesByCountry(old('address.country', Arr::get($sessionCheckoutData, 'country') ?: EcommerceHelper::getDefaultCountryId())); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stateId => $stateName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($stateId); ?>"
                                                <?php if(old('address.state', Arr::get($sessionCheckoutData, 'state')) == $stateId): ?> selected <?php endif; ?>
                                            ><?php echo e($stateName); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-chevron-down'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                                <label for="address_state"><?php echo e(__('State')); ?></label>
                            </div>
                        <?php else: ?>
                            <div class="form-input-wrapper">
                                <input
                                    class="form-control"
                                    id="address_state"
                                    name="address[state]"
                                    autocomplete="state"
                                    type="text"
                                    value="<?php echo e(old('address.state', Arr::get($sessionCheckoutData, 'state'))); ?>"
                                    required
                                >
                                <label for="address_state"><?php echo e(__('State')); ?></label>
                            </div>
                        <?php endif; ?>
                        <?php echo Form::error('address.state', $errors); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if(!in_array('city', EcommerceHelper::getHiddenFieldsAtCheckout())): ?>
                <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['col-sm-6 col-12' => ! in_array('state', EcommerceHelper::getHiddenFieldsAtCheckout()), 'col-12' => in_array('state', EcommerceHelper::getHiddenFieldsAtCheckout())]); ?>">
                    <div class="form-group mb-3 <?php $__errorArgs = ['address.city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php if(EcommerceHelper::useCityFieldAsTextField()): ?>
                            <div class="form-input-wrapper">
                                <input
                                    class="form-control"
                                    id="address_city"
                                    name="address[city]"
                                    autocomplete="city"
                                    type="text"
                                    value="<?php echo e(old('address.city', Arr::get($sessionCheckoutData, 'city'))); ?>"
                                    required
                                >
                                <label for="address_city"><?php echo e(__('City')); ?></label>
                            </div>
                        <?php else: ?>
                            <div class="select--arrow form-input-wrapper">
                                <select
                                    class="form-control"
                                    id="address_city"
                                    name="address[city]"
                                    autocomplete="city"
                                    data-type="city"
                                    data-using-select2="false"
                                    data-url="<?php echo e(route('ajax.cities-by-state')); ?>"
                                    required
                                >
                                    <option value=""><?php echo e(__('Select city...')); ?></option>
                                    <?php if(old('address.state', Arr::get($sessionCheckoutData, 'state')) || in_array('state', EcommerceHelper::getHiddenFieldsAtCheckout())): ?>
                                        <?php $__currentLoopData = EcommerceHelper::getAvailableCitiesByState(old('address.state', Arr::get($sessionCheckoutData, 'state')), old('address.country', Arr::get($sessionCheckoutData, 'country'))); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cityId => $cityName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($cityId); ?>"
                                                <?php if(old('address.city', Arr::get($sessionCheckoutData, 'city')) == $cityId): ?> selected <?php endif; ?>
                                            ><?php echo e($cityName); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-chevron-down'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                                <label for="address_city"><?php echo e(__('City')); ?></label>
                            </div>
                        <?php endif; ?>
                        <?php echo Form::error('address.city', $errors); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php echo apply_filters('ecommerce_checkout_address_form_after_city_field', null, $sessionCheckoutData); ?>


        <?php if(!in_array('address', EcommerceHelper::getHiddenFieldsAtCheckout())): ?>
            <div class="form-group mb-3 <?php $__errorArgs = ['address.address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <div class="form-input-wrapper">
                    <input
                        class="form-control"
                        id="address_address"
                        name="address[address]"
                        autocomplete="address"
                        type="text"
                        value="<?php echo e(old('address.address', Arr::get($sessionCheckoutData, 'address'))); ?>"
                        required
                    >
                    <label for="address_address"><?php echo e(__('Address')); ?></label>
                </div>
                <?php echo Form::error('address.address', $errors); ?>

            </div>
        <?php endif; ?>

        <?php if(EcommerceHelper::isZipCodeEnabled()): ?>
            <div class="form-group mb-3 <?php $__errorArgs = ['address.zip_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <div class="form-input-wrapper">
                    <input
                        class="form-control"
                        id="address_zip_code"
                        name="address[zip_code]"
                        autocomplete="postal-code"
                        type="text"
                        value="<?php echo e(old('address.zip_code', Arr::get($sessionCheckoutData, 'zip_code'))); ?>"
                        required
                    >
                    <label for="address_zip_code"><?php echo e(__('Zip code')); ?></label>
                </div>
                <?php echo Form::error('address.zip_code', $errors); ?>

            </div>
        <?php endif; ?>
    </div>

    <?php if(!auth('customer')->check()): ?>
        <div id="register-an-account-wrapper">
            <div class="mb-3">
                <label class="form-check">
                    <input
                        id="create_account"
                        name="create_account"
                        type="checkbox"
                        value="1"
                        class="form-check-input"
                        <?php if(old('create_account') == 1): ?> checked <?php endif; ?>
                    >
                    <span
                        class="form-check-label"
                    ><?php echo e(__('Register an account with above information?')); ?></span>
                </label>
            </div>

            <div class="password-group <?php if(!$errors->has('password') && !$errors->has('password_confirmation')): ?> d-none <?php endif; ?>">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <div class="form-input-wrapper">
                                <input
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="new-password"
                                >
                                <label for="password"><?php echo e(__('Password')); ?></label>
                            </div>
                            <?php echo Form::error('password', $errors); ?>

                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <div class="form-input-wrapper">
                                <input
                                    class="form-control"
                                    id="password-confirm"
                                    name="password_confirmation"
                                    type="password"
                                    autocomplete="password-confirmation"
                                >
                                <label for="password-confirm"><?php echo e(__('Password confirmation')); ?></label>
                            </div>
                            <?php echo Form::error('password_confirmation', $errors); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php echo apply_filters('ecommerce_checkout_address_form_after', null, $sessionCheckoutData); ?>

</div>
<?php /**PATH /var/www/html/platform/plugins/ecommerce/resources/views/orders/partials/address-form.blade.php ENDPATH**/ ?>