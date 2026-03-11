@extends('core/base::layouts.master')

@section('content')
<div class="container-lg mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Rezgo API Submissions</h1>
            <p class="text-muted">View all API requests and responses sent to Rezgo</p>
        </div>
        <div class="col-md-4 text-end">
            <span class="badge bg-success">{{ $submissions->where('status', 'success')->count() }} Successful</span>
            <span class="badge bg-danger">{{ $submissions->where('status', 'failed')->count() }} Failed</span>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Rezgo Booking ID</th>
                        <th>Status</th>
                        <th>HTTP Status</th>
                        <th>Submitted At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submissions as $submission)
                        <tr>
                            <td>
                                <strong>
                                    @if($submission->order_id)
                                        <a href="{{ route('orders.edit', $submission->order_id) }}" target="_blank">
                                            #{{ $submission->order_id }}
                                        </a>
                                    @else
                                        Order N/A
                                    @endif
                                </strong>
                            </td>
                            <td>
                                @if($submission->rezgo_booking_id)
                                    <code>{{ $submission->rezgo_booking_id }}</code>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($submission->status === 'success')
                                    <span class="badge bg-success">✓ Success</span>
                                @else
                                    <span class="badge bg-danger">✗ Failed</span>
                                @endif
                            </td>
                            <td>
                                @if($submission->http_status)
                                    <code>{{ $submission->http_status }}</code>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $submission->created_at->format('M d, Y H:i:s') }}</small>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                    data-bs-target="#detailModal{{ $submission->id }}">
                                    View Details
                                </button>
                            </td>
                        </tr>

                        <!-- Detail Modal -->
                        <div class="modal fade" id="detailModal{{ $submission->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Rezgo Submission #{{ $submission->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                                        <div class="mb-3">
                                            <h6 class="text-muted">Order & Status</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Order ID:</strong> {{ $submission->order_id }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Rezgo Booking ID:</strong> 
                                                        @if($submission->rezgo_booking_id)
                                                            <code>{{ $submission->rezgo_booking_id }}</code>
                                                        @else
                                                            <span class="text-muted">Not received</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Status:</strong> 
                                                        @if($submission->status === 'success')
                                                            <span class="badge bg-success">✓ Success</span>
                                                        @else
                                                            <span class="badge bg-danger">✗ Failed</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>HTTP Status Code:</strong> <code>{{ $submission->http_status }}</code></p>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="mb-3">
                                            <h6 class="text-muted">Request Sent to Rezgo</h6>
                                            <pre class="bg-light p-3 rounded" style="font-size: 12px; max-height: 250px; overflow: auto;"><code>{{ json_encode(json_decode($submission->request_payload), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</code></pre>
                                        </div>

                                        <hr>

                                        <div class="mb-3">
                                            <h6 class="text-muted">Response from Rezgo API</h6>
                                            <pre class="bg-light p-3 rounded" style="font-size: 12px; max-height: 250px; overflow: auto;"><code>{{ $submission->response_payload }}</code></pre>
                                        </div>

                                        @if($submission->error_message)
                                            <hr>
                                            <div class="alert alert-danger">
                                                <h6 class="alert-heading">Error Details</h6>
                                                <pre style="margin: 0;"><code>{{ $submission->error_message }}</code></pre>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No Rezgo API submissions yet. Place an order to see API interactions.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($submissions->count() > 0)
        <div class="mt-3">
            <small class="text-muted">
                Showing {{ $submissions->count() }} submission(s) • 
                Last updated: {{ now()->format('M d, Y H:i:s') }}
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
    }
    pre {
        font-family: 'Courier New', monospace;
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>
@endsection
