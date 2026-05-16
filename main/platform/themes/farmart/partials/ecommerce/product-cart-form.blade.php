<form
    class="cart-form"
    action="{{ route('public.cart.add-to-cart') }}"
    method="POST"
>
    @csrf
    @if (!empty($withVariations) && $product->variations()->count())
        <div class="pr_switch_wrap">
            {!! render_product_swatches($product, [
                'selected' => $selectedAttrs,
            ]) !!}
        </div>
    @endif

    @if (isset($withProductOptions) && $withProductOptions)
        {!! render_product_options($product) !!}
    @endif

    <input
        class="hidden-product-id"
        name="id"
        type="hidden"
        value="{{ $product->is_variation || !$product->defaultVariation->product_id ? $product->id : $product->defaultVariation->product_id }}"
    />

    @if (EcommerceHelper::isCartEnabled() || !empty($withButtons))
        {!! apply_filters(ECOMMERCE_PRODUCT_DETAIL_EXTRA_HTML, null, $product) !!}
        <div class="product-button">
            @if (EcommerceHelper::isCartEnabled())
                @php
                    $hasRezgoMapping = is_plugin_active('rezgo-plugin') && 
                        \Botble\RezgoConnector\Models\RezgoProductMapping::where('product_id', $product->id)->exists();
                @endphp
                <div class="d-flex gap-2 align-items-end mb-2">
                    {!! Theme::partial('ecommerce.product-quantity', compact('product')) !!}
                    @if ($hasRezgoMapping)
                        @php
                            $rezgoMapping = \Botble\RezgoConnector\Models\RezgoProductMapping::where('product_id', $product->id)->first();
                        @endphp
                        <button
                            type="button"
                            class="btn btn-outline-primary"
                            id="rezgo-select-date-btn-{{ $rezgoMapping->rezgo_uid }}"
                        >
                            <span class="svg-icon">
                                <svg>
                                    <use href="#svg-icon-calendar" xlink:href="#svg-icon-calendar"></use>
                                </svg>
                            </span>
                            <span class="ms-1">{{ __('Select Date & Price') }}</span>
                        </button>
                    @endif
                </div>
                @if ($hasRezgoMapping ?? false)
                    <!-- Hidden fields for Rezgo calendar selection -->
                    <input type="hidden" id="rezgo-selected-date-{{ $rezgoMapping->rezgo_uid }}" name="rezgo_date" />
                    <input type="hidden" id="rezgo-selected-price-{{ $rezgoMapping->rezgo_uid }}" name="rezgo_price" />
                    <input type="hidden" id="rezgo-product-uid-{{ $rezgoMapping->rezgo_uid }}" name="rezgo_uid" value="{{ $rezgoMapping->rezgo_uid ?? '' }}" />
                    
                    @include('theme.farmart::partials.ecommerce.components.calendar', ['uid' => $rezgoMapping->rezgo_uid, 'year' => date('Y'), 'month' => date('n')])
                @endif
                <button
                    class="btn btn-primary mb-2 add-to-cart-button @if ($product->isOutOfStock()) disabled @endif"
                    name="add_to_cart"
                    type="submit"
                    value="1"
                    title="{{ __('Add to cart') }}"
                    @if ($product->isOutOfStock()) disabled @endif
                >
                    <span class="svg-icon">
                        <svg>
                            <use
                                href="#svg-icon-cart"
                                xlink:href="#svg-icon-cart"
                            ></use>
                        </svg>
                    </span>
                    <span class="add-to-cart-text ms-2">{{ __('Add to cart') }}</span>
                </button>

                @if (EcommerceHelper::isQuickBuyButtonEnabled() && isset($withBuyNow) && $withBuyNow)
                    <button
                        class="btn btn-primary btn-black mb-2 add-to-cart-button @if ($product->isOutOfStock()) disabled @endif"
                        name="checkout"
                        type="submit"
                        value="1"
                        title="{{ __('Buy Now') }}"
                        @if ($product->isOutOfStock()) disabled @endif
                    >
                        <span class="add-to-cart-text ms-2">{{ __('Buy Now') }}</span>
                    </button>
                @endif
            @endif
            @if (!empty($withButtons))
                {!! Theme::partial('ecommerce.product-loop-buttons', compact('product', 'wishlistIds')) !!}
            @endif
        </div>
    @endif
</form>
