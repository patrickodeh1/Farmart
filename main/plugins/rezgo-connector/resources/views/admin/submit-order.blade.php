@extends('base::layouts.master')

@section('content')
<div class="container-xl">
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">{{ __('Submit Order to Rezgo') }}</h2>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('rezgo.index') }}" class="btn btn-link">{{ __('Back to Settings') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                @endif

                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Select an Order to Submit') }}</h3>
                            </div>
                            <form action="{{ route('rezgo.submit-order') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Order ID') }}</label>
                                        <select class="form-control" name="order_id" required id="orderSelect" onchange="updateOrderDetails()">
                                            <option value="">{{ __('Select an order...') }}</option>
                                            @foreach ($orders as $order)
                                                <option value="{{ $order->id }}" data-total="{{ $order->final_price ?? $order->total ?? 0 }}">
                                                    Order #{{ $order->id }} - {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }} - ${{ number_format($order->final_price ?? $order->total ?? 0, 2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3" id="orderDetails" style="display: none;">
                                        <div class="alert alert-info">
                                            <p><strong>Order Total:</strong> <span id="orderTotal">-</span></p>
                                            <p><strong>Order Date:</strong> <span id="orderDate">-</span></p>
                                        </div>
                                    </div>

                                    <div class="form-footer">
                                        <a href="{{ route('rezgo.index') }}" class="btn btn-link">{{ __('Cancel') }}</a>
                                        <button type="submit" class="btn btn-primary">{{ __('Submit Order to Rezgo') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Recent Submissions -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('How it Works') }}</h3>
                            </div>
                            <div class="card-body">
                                <ol>
                                    <li>{{ __('Select an order from the dropdown above') }}</li>
                                    <li>{{ __('Ensure the order has at least one product with a Rezgo mapping') }}</li>
                                    <li>{{ __('Click "Submit Order to Rezgo"') }}</li>
                                    <li>{{ __('The order will be submitted with customer information and tour details') }}</li>
                                    <li>{{ __('Check the Submissions page to see the status') }}</li>
                                </ol>

                                <div class="alert alert-warning mt-3">
                                    <strong>{{ __('Note:') }}</strong> {{ __('All product mappings must be configured before submitting orders. Products without mappings will cause submission to fail.') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Available Orders Summary -->
                    @if ($orders->count() > 0)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Available Orders') }}</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-vcenter table-sm">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Order ID') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Total') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->take(20) as $order)
                                        <tr>
                                            <td>
                                                <strong>#{{ $order->id }}</strong>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y H:i') }}
                                            </td>
                                            <td>
                                                ${{ number_format($order->final_price ?? $order->total ?? 0, 2) }}
                                            </td>
                                            <td>
                                                <form action="{{ route('rezgo.submit-order') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <button type="submit" class="btn btn-sm btn-primary">{{ __('Submit') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateOrderDetails() {
    const select = document.getElementById('orderSelect');
    const option = select.options[select.selectedIndex];
    const detailsDiv = document.getElementById('orderDetails');

    if (select.value) {
        document.getElementById('orderTotal').textContent = '$' + parseFloat(option.dataset.total).toFixed(2);
        detailsDiv.style.display = 'block';
    } else {
        detailsDiv.style.display = 'none';
    }
}
</script>
@endsection
