@php
    $rezgoMapping = is_plugin_active('rezgo-plugin') 
        ? \Botble\RezgoConnector\Models\RezgoProductMapping::where('product_id', $product->id)->first()
        : null;
@endphp

@if ($rezgoMapping)
    <div id="rezgo-calendar-root" data-rezgo-uid="{{ $rezgoMapping->rezgo_uid }}">
        <rezgo-calendar 
            :uid="'{{ $rezgoMapping->rezgo_uid }}'"
            button-text="Select Date & Price"
            modal-title="Select your date of visit"
        ></rezgo-calendar>
    </div>

    <!-- Hidden fields for form submission -->
    <input type="hidden" id="rezgo-selected-date" name="rezgo_date" />
    <input type="hidden" id="rezgo-selected-price" name="rezgo_price" />
    <input type="hidden" id="rezgo-product-uid" name="rezgo_uid" value="{{ $rezgoMapping->rezgo_uid }}" />
@endif

