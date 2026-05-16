@php
    Theme::layout('full-width');
    Theme::set('bodyClass', 'rezgo-confirmation-page');
@endphp

<div class="bg-light py-md-5 px-lg-3 px-2">
    <div class="container-xxxl">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-5 text-center">
                    @if ($order->status === 'confirmed')
                        <div class="text-success mb-3">
                            <i class="ti ti-circle-check" style="font-size:64px;"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Booking Confirmed!</h2>
                        <p class="text-muted mb-4">
                            Your booking reference is <strong>#{{ $order->rezgo_booking_id }}</strong>.
                            A confirmation has been sent to <strong>{{ $order->email }}</strong>.
                        </p>
                    @else
                        <div class="text-warning mb-3">
                            <i class="ti ti-clock" style="font-size:64px;"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Booking Received</h2>
                        <p class="text-muted mb-4">
                            Your booking is being processed. We will contact you at
                            <strong>{{ $order->email }}</strong> to confirm.
                        </p>
                    @endif

                    <div class="card bg-light border-0 p-4 text-start mb-4">
                        <h6 class="fw-bold mb-3">Booking Details</h6>
                        <div class="row small">
                            <div class="col-6 text-muted">Tour</div>
                            <div class="col-6 fw-bold">{{ $order->rezgo_title }}</div>
                            <div class="col-6 text-muted mt-2">Date</div>
                            <div class="col-6 mt-2">{{ $order->tour_date }}</div>
                            @if ($order->qty_adult > 0)
                                <div class="col-6 text-muted mt-2">Adults</div>
                                <div class="col-6 mt-2">{{ $order->qty_adult }} x ${{ number_format($order->price_adult, 2) }}</div>
                            @endif
                            @if ($order->qty_child > 0)
                                <div class="col-6 text-muted mt-2">Children</div>
                                <div class="col-6 mt-2">{{ $order->qty_child }} x ${{ number_format($order->price_child, 2) }}</div>
                            @endif
                            <div class="col-6 text-muted mt-2">Total</div>
                            <div class="col-6 mt-2 fw-bold text-primary">${{ number_format($order->total, 2) }}</div>
                            <div class="col-6 text-muted mt-2">Name</div>
                            <div class="col-6 mt-2">{{ $order->first_name }} {{ $order->last_name }}</div>
                        </div>
                    </div>

                    <a href="{{ route('rezgo.storefront.tours') }}" class="btn btn-outline-primary">
                        Browse More Tours
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
