@extends('core/base::layouts/master)

@section('content')
<div class="container-xl">
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">{{ __('Rezgo Connector Settings') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="alert-title">{{ __('Error') }}</div>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <a class="btn-close" data-bs-dismiss="alert"></a>
                    </div>
                @endif

                <div class="row row-cards">
                    <!-- Statistics Cards -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-sm font-semibold">{{ __('Total Submissions') }}</div>
                                <div class="text-lg font-bold">{{ $submissionsCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-sm font-semibold">{{ __('Successful') }}</div>
                                <div class="text-lg font-bold text-success">{{ $successCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-sm font-semibold">{{ __('Failed') }}</div>
                                <div class="text-lg font-bold text-danger">{{ $failedCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-sm font-semibold">{{ __('Product Mappings') }}</div>
                                <div class="text-lg font-bold text-primary">{{ $mappingsCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Form -->
                <div class="row row-cards mt-4">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('API Configuration') }}</h3>
                            </div>
                            <form action="{{ route('rezgo.settings.update') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Rezgo CID') }}</label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('rezgo_cid') is-invalid @enderror"
                                            name="rezgo_cid"
                                            value="{{ old('rezgo_cid', $settings['rezgo_cid'] ?? '') }}"
                                            placeholder="Enter your Rezgo CID"
                                        >
                                        @error('rezgo_cid')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Rezgo API Key') }}</label>
                                        <input 
                                            type="password" 
                                            class="form-control @error('rezgo_api_key') is-invalid @enderror"
                                            name="rezgo_api_key"
                                            placeholder="Enter your Rezgo API Key"
                                        >
                                        @error('rezgo_api_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted">{{ __('Your API key is encrypted and stored securely') }}</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Default Passenger Type') }}</label>
                                        <select class="form-control @error('default_passenger_type') is-invalid @enderror" name="default_passenger_type">
                                            <option value="adult" {{ old('default_passenger_type', $settings['default_passenger_type'] ?? 'adult') === 'adult' ? 'selected' : '' }}>{{ __('Adult') }}</option>
                                            <option value="child" {{ old('default_passenger_type', $settings['default_passenger_type'] ?? 'adult') === 'child' ? 'selected' : '' }}>{{ __('Child') }}</option>
                                            <option value="senior" {{ old('default_passenger_type', $settings['default_passenger_type'] ?? 'adult') === 'senior' ? 'selected' : '' }}>{{ __('Senior') }}</option>
                                        </select>
                                        @error('default_passenger_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Booking Date Offset (Days)') }}</label>
                                        <input 
                                            type="number" 
                                            class="form-control @error('booking_date_offset') is-invalid @enderror"
                                            name="booking_date_offset"
                                            value="{{ old('booking_date_offset', $settings['booking_date_offset'] ?? 1) }}"
                                            min="0"
                                            max="365"
                                        >
                                        <small class="text-muted">{{ __('Days from today to book tours') }}</small>
                                        @error('booking_date_offset')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" name="sync_enabled" value="1" {{ old('sync_enabled', $settings['sync_enabled'] ?? false) ? 'checked' : '' }}>
                                            <span class="form-check-label">{{ __('Enable Order Synchronization') }}</span>
                                        </label>
                                        <small class="text-muted d-block">{{ __('Enable automatic order submission to Rezgo') }}</small>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <a href="{{ route('rezgo.test-connection') }}" class="btn btn-link">{{ __('Test Connection') }}</a>
                                    <button type="submit" class="btn btn-primary">{{ __('Save Settings') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Quick Navigation') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-transparent">
                                    <a href="{{ route('rezgo.product-mappings') }}" class="list-group-item list-group-item-action">
                                        {{ __('Product Mappings') }}
                                        <span class="badge bg-primary float-end">{{ $mappingsCount }}</span>
                                    </a>
                                    <a href="{{ route('rezgo.submissions') }}" class="list-group-item list-group-item-action">
                                        {{ __('Submissions') }}
                                        <span class="badge bg-info float-end">{{ $submissionsCount }}</span>
                                    </a>
                                    <a href="{{ route('rezgo.logs') }}" class="list-group-item list-group-item-action">
                                        {{ __('Activity Logs') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Logs -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Recent Activity') }}</h3>
                            </div>
                            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                @forelse ($recentLogs as $log)
                                    <div class="mb-2 pb-2 border-bottom">
                                        <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                                        <div class="small">
                                            <span class="badge bg-{{ $log->log_type === 'error' ? 'danger' : ($log->log_type === 'warning' ? 'warning' : 'success') }}">
                                                {{ strtoupper($log->log_type) }}
                                            </span>
                                            {{ $log->message }}
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted small">{{ __('No recent activity') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
