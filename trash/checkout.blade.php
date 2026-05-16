@php
    Theme::layout('full-width');
    Theme::set('bodyClass', 'rezgo-checkout-page');
@endphp

<div class="bg-light py-md-5 px-lg-3 px-2">
    <div class="container-xxxl">

        <h1 class="fs-4 fw-bold mb-4">{{ __('Checkout') }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-3">Contact Details</h5>
                    <form action="{{ route('rezgo.storefront.checkout.process') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name *</label>
                                <input type="text" name="first_name" class="form-control"
                                       value="{{ old('first_name', $customer->first_name ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name *</label>
                                <input type="text" name="last_name" class="form-control"
                                       value="{{ old('last_name', $customer->last_name ?? '') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $customer->email ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone', $customer->phone ?? '') }}">
                        </div>

                        @guest('customer')
                            <div class="alert alert-info small">
                                <a href="{{ route('customer.login') }}">Login</a> or
                                <a href="{{ route('customer.register') }}">Register</a>
                                to save your booking history. Or continue as guest.
                            </div>
                        @endguest

                        <button type="submit" class="btn btn-primary w-100 btn-lg mt-2">
                            <i class="ti ti-check me-1"></i> Confirm Booking
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-3">Order Summary</h5>
                    @foreach ($cart as $item)
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="fw-bold small">{{ $item['title'] }}</div>
                            <div class="text-muted small">{{ $item['date'] }}</div>
                            @if ($item['qty_adult'] > 0)
                                <div class="small">{{ $item['qty_adult'] }}x Adult — ${{ number_format($item['price_adult'], 2) }}</div>
                            @endif
                            @if ($item['qty_child'] > 0)
                                <div class="small">{{ $item['qty_child'] }}x Child — ${{ number_format($item['price_child'], 2) }}</div>
                            @endif
                            <div class="fw-bold mt-1">${{ number_format($item['total'], 2) }}</div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span class="text-primary">${{ number_format($cartTotal, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
