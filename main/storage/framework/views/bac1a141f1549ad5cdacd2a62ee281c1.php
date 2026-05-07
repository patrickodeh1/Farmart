<?php $__env->startSection('content'); ?>
<div class="container-xl">
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title"><?php echo e(__('Price Sync')); ?></h2>
                    </div>
                    <div class="col-auto">
                        <div class="btn-group" role="group">
                            <a href="<?php echo e(route('rezgo.index')); ?>" class="btn btn-link"><?php echo e(__('Settings')); ?></a>
                            <a href="<?php echo e(route('rezgo.product-mappings.index')); ?>" class="btn btn-link"><?php echo e(__('Product Mappings')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <!-- Sync Control Card -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo e(__('Sync Prices from Rezgo')); ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Last Sync</label>
                                            <p class="form-control-plaintext" id="lastSyncTime">Never</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <button type="button" class="btn btn-primary" id="syncButton" onclick="syncPrices()">
                                            <span class="spinner-border spinner-border-sm me-2 d-none" id="syncSpinner"></span>
                                            <i class="ti ti-refresh"></i> <?php echo e(__('Sync Prices Now')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                            <script>
                                // Load persisted data on page load
                                document.addEventListener('DOMContentLoaded', function() {
                                    const lastSync = localStorage.getItem('rezgo_last_sync');
                                    const results = JSON.parse(localStorage.getItem('rezgo_sync_results') || '[]');
                                    const summary = JSON.parse(localStorage.getItem('rezgo_sync_summary') || '{}');
                                    
                                    if (lastSync) {
                                        document.getElementById('lastSyncTime').textContent = new Date(lastSync).toLocaleString();
                                    }
                                    
                                    if (results.length > 0) {
                                        populateResults(results, summary);
                                    }
                                });
                            </script>
                        </div>
                    </div>

                    <!-- Results Table -->
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo e(__('Sync Results')); ?></h3>
                                <div class="card-options">
                                    <span class="badge bg-success d-none me-2" id="updatedBadge">Updated: <span id="updatedCount">0</span></span>
                                    <span class="badge bg-secondary d-none me-2" id="unchangedBadge">Unchanged: <span id="unchangedCount">0</span></span>
                                    <span class="badge bg-danger d-none" id="failedBadge">Failed: <span id="failedCount">0</span></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table" id="resultsTable">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Rezgo UID</th>
                                            <th class="text-end">Old Price</th>
                                            <th class="text-end">New Price</th>
                                            <th class="text-center">Change</th>
                                        </tr>
                                    </thead>
                                    <tbody id="resultsBody">
                                        <tr><td colspan="5" class="text-center text-muted py-4">Click "Sync Prices Now" to fetch latest prices from Rezgo</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function syncPrices() {
    const button = document.getElementById('syncButton');
    const spinner = document.getElementById('syncSpinner');
    const resultsBody = document.getElementById('resultsBody');
    
    button.disabled = true;
    spinner.classList.remove('d-none');
    resultsBody.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-4"><i class="ti ti-loader spin"></i> Syncing prices...</td></tr>';
    
    fetch('<?php echo e(route("rezgo.sync-prices-ajax")); ?>', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        button.disabled = false;
        spinner.classList.add('d-none');
        
        if (!data.success) {
            resultsBody.innerHTML = `<tr><td colspan="5" class="text-center text-danger py-4"><strong>Error:</strong> ${escapeHtml(data.error || 'Sync failed')}</td></tr>`;
            return;
        }
        
        // Persist to localStorage
        const now = new Date().toISOString();
        localStorage.setItem('rezgo_last_sync', now);
        localStorage.setItem('rezgo_sync_results', JSON.stringify(data.results));
        localStorage.setItem('rezgo_sync_summary', JSON.stringify(data.summary));
        
        // Update summary badges
        document.getElementById('updatedCount').textContent = data.summary.updated;
        document.getElementById('unchangedCount').textContent = data.summary.unchanged;
        document.getElementById('failedCount').textContent = data.summary.failed;
        
        if (data.summary.updated > 0) document.getElementById('updatedBadge').classList.remove('d-none');
        if (data.summary.unchanged > 0) document.getElementById('unchangedBadge').classList.remove('d-none');
        if (data.summary.failed > 0) document.getElementById('failedBadge').classList.remove('d-none');
        
        // Update last sync time
        document.getElementById('lastSyncTime').textContent = new Date(now).toLocaleString();
        
        // Build results table
        if (data.results.length === 0) {
            resultsBody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">No price changes found</td></tr>';
            return;
        }
        
        populateResults(data.results);
    })
    .catch(error => {
        console.error('Error:', error);
        button.disabled = false;
        spinner.classList.add('d-none');
        resultsBody.innerHTML = `<tr><td colspan="5" class="text-center text-danger py-4"><strong>Error:</strong> ${escapeHtml(error.message)}</td></tr>`;
    });
}

function populateResults(results) {
    const resultsBody = document.getElementById('resultsBody');
    resultsBody.innerHTML = results.map(result => `
        <tr>
            <td><strong>${escapeHtml(result.product_name)}</strong></td>
            <td><code>${escapeHtml(result.rezgo_uid)}</code></td>
            <td class="text-end">$${parseFloat(result.old_price).toFixed(2)}</td>
            <td class="text-end"><strong>$${parseFloat(result.new_price).toFixed(2)}</strong></td>
            <td class="text-center">
                <span class="badge ${parseFloat(result.new_price) > parseFloat(result.old_price) ? 'bg-danger' : 'bg-success'}">
                    ${result.change_percent}%
                </span>
            </td>
        </tr>
    `).join('');
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>

<style>
.spinner-border.spin {
    animation: spin 0.6s linear infinite;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}
.badge {
    color: white !important;
    font-weight: 600 !important;
}
</style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('core/base::layouts/master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/admin/dynamic-pricing.blade.php ENDPATH**/ ?>