@extends('core/base::layouts.master')

@section('content')
<div class="container-lg mt-4">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1>🔗 Rezgo API Integration Dashboard</h1>
            <p class="text-muted">Real-time tracking of all booking submissions to Rezgo API</p>
        </div>
        <div class="col-md-4 text-end">
            <span class="badge bg-success fs-6">✓ {{ $submissions->where('status', 'success')->count() }} OK</span>
            <span class="badge bg-danger fs-6">✗ {{ $submissions->where('status', 'failed')->count() }} Failed</span>
            <span class="badge bg-info fs-6">📊 {{ $submissions->count() }} Total</span>
        </div>
    </div>

    <!-- Integration Status Alert -->
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <span style="font-size: 20px; margin-right: 10px;">ℹ️</span>
        <div>
            <strong>Integration Active:</strong> Orders are automatically submitted to Rezgo when placed through checkout. All API interactions are logged below for verification.
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">📊 Total Submissions</h6>
                    <h2 class="text-primary fw-bold">{{ $submissions->count() }}</h2>
                    <small class="text-muted">All orders tracked</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">✅ Success Rate</h6>
                    <h2 class="text-success fw-bold">
                        @if($submissions->count() > 0)
                            {{ round(($submissions->where('status', 'success')->count() / $submissions->count()) * 100) }}%
                        @else
                            0%
                        @endif
                    </h2>
                    <small class="text-muted">{{ $submissions->where('status', 'success')->count() }} successful</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">⏱️ Latest Submission</h6>
                    @if($submissions->first())
                        <p class="fw-bold mb-0">{{ $submissions->first()->created_at->format('H:i:s') }}</p>
                        <small class="text-muted">{{ $submissions->first()->created_at->diffForHumans() }}</small>
                    @else
                        <p class="text-muted mb-0">No data yet</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">🔌 API Endpoint</h6>
                    <small class="text-monospace d-block fw-bold">api.rezgo.com</small>
                    <small class="text-muted">CID: 32036</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Submissions Table -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📋 Submission History</h5>
            <button class="btn btn-sm btn-light" onclick="location.reload()">🔄 Refresh</button>
        </div>
        
        @if($submissions->isEmpty())
            <div class="card-body">
                <div class="alert alert-info mb-0" role="alert">
                    <h5 class="alert-heading">📬 No Submissions Yet</h5>
                    <p class="mb-0">
                        Place an order on the storefront to see API interactions appear here automatically. 
                        Orders are submitted to Rezgo in real-time when checkout completes.
                    </p>
                    <small class="text-muted d-block mt-2">
                        🛒 Test the integration: Visit the store, add a product to cart, and complete checkout.
                    </small>
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th class="ps-4" style="width: 12%;">Order ID</th>
                            <th style="width: 12%;">Status</th>
                            <th style="width: 18%;">Booking ID</th>
                            <th style="width: 8%;">HTTP</th>
                            <th style="width: 30%;">Message/Error</th>
                            <th style="width: 12%;">Submitted</th>
                            <th class="text-center pe-4" style="width: 8%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                            <tr class="@if($submission->status === 'failed') table-danger @endif align-middle">
                                <td class="ps-4">
                                    <strong class="text-primary">#{{ $submission->order_id }}</strong>
                                </td>
                                <td>
                                    @if($submission->status === 'success')
                                        <span class="badge bg-success">✅ Success</span>
                                    @else
                                        <span class="badge bg-danger">❌ Failed</span>
                                    @endif
                                </td>
                                <td>
                                    @if($submission->rezgo_booking_id)
                                        <code class="text-success bg-light p-1 rounded">{{ $submission->rezgo_booking_id }}</code>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge @if($submission->http_status >= 200 && $submission->http_status < 300) bg-success @elseif($submission->http_status >= 400) bg-danger @else bg-warning @endif">
                                        {{ $submission->http_status }}
                                    </span>
                                </td>
                                <td>
                                    @if($submission->error_message)
                                        <span class="text-danger" title="{{ $submission->error_message }}">⚠️ {{ substr($submission->error_message, 0, 40) }}...</span>
                                    @else
                                        <span class="text-success">✓ OK</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted d-block">{{ $submission->created_at->format('M d, H:i') }}</small>
                                    <small class="text-muted">{{ $submission->created_at->diffForHumans(null, null, true) }} ago</small>
                                </td>
                                <td class="text-center pe-4">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $submission->id }}">
                                        Details
                                    </button>
                                </td>
                            </tr>

                            <!-- Enhanced Detail Modal -->
                            <div class="modal fade" id="detailModal{{ $submission->id }}" tabindex="-1">
                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header border-bottom bg-light">
                                            <div class="flex-grow-1">
                                                <h5 class="modal-title fw-bold">📦 Order #{{ $submission->order_id }}</h5>
                                                <small class="text-muted d-block">Record ID: {{ $submission->id }} | Submitted: {{ $submission->created_at->format('Y-m-d H:i:s T') }}</small>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <!-- Status Section -->
                                            <div class="row mb-4">
                                                <div class="col-md-4">
                                                    <div class="card bg-light border-0">
                                                        <div class="card-body text-center">
                                                            <h6 class="text-muted mb-2">Submission Status</h6>
                                                            @if($submission->status === 'success')
                                                                <span class="badge bg-success p-2 fs-6">✅ SUCCESS</span>
                                                            @else
                                                                <span class="badge bg-danger p-2 fs-6">❌ FAILED</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card bg-light border-0">
                                                        <div class="card-body text-center">
                                                            <h6 class="text-muted mb-2">HTTP Response</h6>
                                                            <span class="badge @if($submission->http_status >= 200 && $submission->http_status < 300) bg-success @elseif($submission->http_status >= 400) bg-danger @else bg-warning @endif p-2 fs-6">
                                                                {{ $submission->http_status }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card bg-light border-0">
                                                        <div class="card-body text-center">
                                                            <h6 class="text-muted mb-2">Rezgo Booking ID</h6>
                                                            @if($submission->rezgo_booking_id)
                                                                <code class="text-success fw-bold d-block">{{ $submission->rezgo_booking_id }}</code>
                                                            @else
                                                                <span class="text-muted">Not assigned</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Error Section -->
                                            @if($submission->error_message)
                                                <div class="alert alert-danger">
                                                    <h6 class="alert-heading">⚠️ Error Details</h6>
                                                    <code class="text-break d-block">{{ $submission->error_message }}</code>
                                                </div>
                                            @endif

                                            <!-- Request/Response Tabs -->
                                            <ul class="nav nav-tabs mb-3" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="reqTab{{ $submission->id }}-tab" data-bs-toggle="tab" data-bs-target="#reqTab{{ $submission->id }}" type="button" role="tab">
                                                        📤 Request Payload
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="respTab{{ $submission->id }}-tab" data-bs-toggle="tab" data-bs-target="#respTab{{ $submission->id }}" type="button" role="tab">
                                                        📥 Response Payload
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="metaTab{{ $submission->id }}-tab" data-bs-toggle="tab" data-bs-target="#metaTab{{ $submission->id }}" type="button" role="tab">
                                                        ℹ️ Metadata
                                                    </button>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <!-- Request Tab -->
                                                <div id="reqTab{{ $submission->id }}" class="tab-pane fade show active" role="tabpanel">
                                                    <div class="bg-dark rounded p-3" style="font-size: 12px; overflow: auto; max-height: 450px;">
                                                        <pre class="text-light mb-0 font-monospace">{{ json_encode(json_decode($submission->request_payload), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                                    </div>
                                                </div>

                                                <!-- Response Tab -->
                                                <div id="respTab{{ $submission->id }}" class="tab-pane fade" role="tabpanel">
                                                    <div class="bg-dark rounded p-3" style="font-size: 12px; overflow: auto; max-height: 450px;">
                                                        <pre class="text-light mb-0 font-monospace">{{ json_encode(json_decode($submission->response_payload ?? '{}'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                                    </div>
                                                </div>

                                                <!-- Metadata Tab -->
                                                <div id="metaTab{{ $submission->id }}" class="tab-pane fade" role="tabpanel">
                                                    <table class="table table-sm table-borderless">
                                                        <tr>
                                                            <th>Record ID:</th>
                                                            <td><code>{{ $submission->id }}</code></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Order ID:</th>
                                                            <td><code>{{ $submission->order_id }}</code></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status:</th>
                                                            <td>
                                                                @if($submission->status === 'success')
                                                                    <span class="badge bg-success">{{ $submission->status }}</span>
                                                                @else
                                                                    <span class="badge bg-danger">{{ $submission->status }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Rezgo Booking ID:</th>
                                                            <td><code>{{ $submission->rezgo_booking_id ?? 'N/A' }}</code></td>
                                                        </tr>
                                                        <tr>
                                                            <th>HTTP Status Code:</th>
                                                            <td><code>{{ $submission->http_status ?? 'N/A' }}</code></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Submitted At:</th>
                                                            <td>{{ $submission->created_at->format('Y-m-d H:i:s') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Updated At:</th>
                                                            <td>{{ $submission->updated_at->format('Y-m-d H:i:s') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="modal-footer border-top bg-light">
                                            <small class="text-muted flex-grow-1">
                                                <strong>API:</strong> https://api.rezgo.com/v1/bookings
                                            </small>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

    <!-- Information Footer -->
    <div class="mt-4 p-4 bg-light rounded border">
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold mb-3">🔐 Integration Configuration</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <strong>Rezgo CID:</strong> 
                        <code class="bg-white p-1 rounded">32036</code>
                    </li>
                    <li class="mb-2">
                        <strong>API Endpoint:</strong> 
                        <code class="bg-white p-1 rounded">https://api.rezgo.com/v1/bookings</code>
                    </li>
                    <li class="mb-2">
                        <strong>Authentication:</strong> 
                        <span class="badge bg-info">API Key Header</span>
                    </li>
                    <li class="mb-2">
                        <strong>Integration Type:</strong> 
                        <span class="badge bg-success">Event-driven (Real-time)</span>
                    </li>
                    <li>
                        <strong>Submission Method:</strong> 
                        <span class="badge bg-primary">HTTP POST</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold mb-3">📊 Live Statistics</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <strong>Total Orders Tracked:</strong> 
                        <span class="badge bg-secondary">{{ $submissions->count() }}</span>
                    </li>
                    <li class="mb-2">
                        <strong>Successful Submissions:</strong> 
                        <span class="badge bg-success">{{ $submissions->where('status', 'success')->count() }}</span>
                    </li>
                    <li class="mb-2">
                        <strong>Failed Submissions:</strong> 
                        <span class="badge bg-danger">{{ $submissions->where('status', 'failed')->count() }}</span>
                    </li>
                    <li class="mb-2">
                        <strong>Success Rate:</strong> 
                        <span class="badge bg-info">
                            @if($submissions->count() > 0)
                                {{ round(($submissions->where('status', 'success')->count() / $submissions->count()) * 100) }}%
                            @else
                                0%
                            @endif
                        </span>
                    </li>
                    <li>
                        <strong>Last Activity:</strong> 
                        <span class="badge bg-warning">
                            {{ $submissions->first()?->created_at->diffForHumans() ?? 'None yet' }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Debug/Support Section -->
    <div class="mt-4 p-3 bg-warning bg-opacity-10 rounded border border-warning">
        <h6 class="text-dark fw-bold">🔧 Troubleshooting & Support</h6>
        <small class="text-muted">
            If submissions are failing, verify:
            <ul class="mb-0 mt-2">
                <li>✓ Rezgo API Key is valid and has sufficient permissions</li>
                <li>✓ Network connectivity to api.rezgo.com is available</li>
                <li>✓ Request payload contains all required Rezgo fields</li>
                <li>✓ Order items have valid pricing and details</li>
                <li>✓ Check error message in Details modal for specific API errors</li>
            </ul>
        </small>
    </div>

    <!-- Last Updated -->
    @if($submissions->count() > 0)
        <div class="mt-3 text-center">
            <small class="text-muted">
                📈 Showing {{ $submissions->count() }} submission(s) • 
                ⏱️ Last updated: {{ now()->format('M d, Y H:i:s T') }} • 
                🔄 Auto-refresh page for latest data
            </small>
        </div>
    @endif
</div>

<style>
    code {
        background-color: #f5f5f5;
        padding: 2px 6px;
        border-radius: 3px;
        font-family: 'Courier New', monospace;
        font-size: 0.95em;
    }
    pre {
        font-family: 'Courier New', monospace;
        margin: 0;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa !important;
    }
    .badge {
        font-weight: 500;
    }
    .modal-xl {
        max-width: 85% !important;
    }
    .font-monospace {
        font-family: 'Courier New', monospace;
    }
</style>
@endsection
