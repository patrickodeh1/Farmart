@extends('base::layouts.master')

@section('content')
<div class="container-xl">
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">{{ __('Product Mappings') }}</h2>
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

                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Product') }}</th>
                                            <th>{{ __('Rezgo Tour') }}</th>
                                            <th>{{ __('Passenger Type') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mappings as $mapping)
                                            <tr>
                                                <td>
                                                    <strong>{{ $mapping->product->name ?? 'N/A' }}</strong>
                                                </td>
                                                <td>
                                                    {{ $mapping->rezgo_title ?? '—' }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ ucfirst($mapping->passenger_type) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $mapping->is_active ? 'success' : 'secondary' }}">
                                                        {{ $mapping->is_active ? __('Active') : __('Inactive') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form action="{{ route('rezgo.product-mappings.delete', $mapping->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-ghost-danger" onclick="return confirm('{{ __('Are you sure?') }}')">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">
                                                    {{ __('No product mappings configured') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if ($mappings->hasPages())
                                <div class="card-footer d-flex align-items-center">
                                    {{ $mappings->links() }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Available Rezgo Tours -->
                    @if ($rezgoTours)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Available Rezgo Tours') }}</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Tour Name') }}</th>
                                                <th>{{ __('UID') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rezgoTours as $tour)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $tour['item'] ?? 'N/A' }}</strong>
                                                    </td>
                                                    <td>
                                                        <code>{{ $tour['uid'] ?? '—' }}</code>
                                                    </td>
                                                    <td>
                                                        {{ $tour['starting'] ?? '—' }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#mapModal" onclick="setTourData('{{ $tour['uid'] ?? '' }}', '{{ $tour['item'] ?? '' }}')">
                                                            {{ __('Map Product') }}
                                                        </button>
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

<!-- Map Modal -->
<div class="modal modal-blur fade" id="mapModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Map Product to Rezgo Tour') }}</h5>
            </div>
            <form action="{{ route('rezgo.product-mappings.save') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Product') }}</label>
                        <select class="form-control" name="product_id" required>
                            <option value="">{{ __('Select a product') }}</option>
                            @forelse ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @empty
                                <option disabled>{{ __('No products available') }}</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Rezgo Tour UID') }}</label>
                        <input type="text" class="form-control" name="rezgo_uid" id="rezgoUid" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Rezgo Tour Title') }}</label>
                        <input type="text" class="form-control" name="rezgo_title" id="rezgoTitle" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Passenger Type') }}</label>
                        <select class="form-control" name="passenger_type" required>
                            <option value="adult">{{ __('Adult') }}</option>
                            <option value="child">{{ __('Child') }}</option>
                            <option value="senior">{{ __('Senior') }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link" data-bs-dismiss="modal">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Save Mapping') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function setTourData(uid, title) {
    document.getElementById('rezgoUid').value = uid;
    document.getElementById('rezgoTitle').value = title;
}
</script>
@endsection
