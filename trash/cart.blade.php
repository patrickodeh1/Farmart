@php
    Theme::layout('full-width');
    Theme::set('bodyClass', 'rezgo-cart-page');
@endphp

<div class="bg-light py-md-5 px-lg-3 px-2">
    <div class="container-xxxl">

        <h1 class="fs-4 fw-bold mb-4">{{ __('Your Cart') }}</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (empty($cart))
            <div class="alert alert-info">
                Your cart is empty.
                <a href="{{ route('rezgo.storefront.tours') }}" class="alert-link">Browse tours</a>
            </div>
        @else
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tour</th>
                                        <th>Date</th>
                                        <th>Tickets</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $index => $item)
                                        <tr>
                                            <td>
                                                @if ($item['image'])
                                                    <img src="{{ $item['image'] }}" class="rounded me-2"
                                                         style="width:50px;height:50px;object-fit:cover;" alt="">
                                                @endif
                                                <span class="fw-bold">{{ $item['title'] }}</span>
                                            </td>
                                            <td>{{ $item['date'] }}</td>
                                            <td>
                                                @if ($item['qty_adult'] > 0)
                                                    <div>{{ $item['qty_adult'] }}x Adult (${{ number_format($item['price_adult'], 2) }})</div>
                                                @endif
                                                @if ($item['qty_child'] > 0)
                                                    <div>{{ $item['qty_child'] }}x Child (${{ number_format($item['price_child'], 2) }})</div>
                                                @endif
                                            </td>
                                            <td class="fw-bold">${{ number_format($item['total'], 2) }}</td>
                                            <td>
                                                <form action="{{ route('rezgo.storefront.cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="index" value="{{ $index }}">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('rezgo.storefront.tours') }}" class="btn btn-outline-secondary">
                            &larr; Continue Browsing
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-sm p-4">
                        <h5 class="fw-bold mb-3">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ count($cart) }} item(s)</span>
                            <span>${{ number_format($cartTotal, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                            <span>Total</span>
                            <span class="text-primary">${{ number_format($cartTotal, 2) }}</span>
                        </div>
                        <a href="{{ route('rezgo.storefront.checkout') }}" class="btn btn-primary w-100 btn-lg">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
