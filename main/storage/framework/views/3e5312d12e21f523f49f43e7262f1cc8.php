<?php $__env->startSection('content'); ?>
    <!-- Toast Container -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11; margin-top: 60px;">
        <div id="toastContainer"></div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>External Database Sync Settings</h1>
                        <p class="text-muted">Configure your custom PHP app's database to receive real-time ticket mapping updates</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <form method="POST" action="<?php echo e(route('rezgo.external-sync.save')); ?>" id="externalSyncForm">
                    <?php echo csrf_field(); ?>

                    <!-- Database Connection Card -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Database Connection Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="host" class="form-label">Database Host <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="host" name="host" value="<?php echo e($host); ?>" placeholder="localhost or IP address">
                                <?php $__errorArgs = ['host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <small class="form-text text-muted">The hostname or IP address of your MySQL server</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="port" class="form-label">Port <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control <?php $__errorArgs = ['port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="port" name="port" value="<?php echo e($port); ?>" min="1" max="65535">
                                    <?php $__errorArgs = ['port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="form-text text-muted">Default: 3306</small>
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="database" class="form-label">Database Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['database'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="database" name="database" value="<?php echo e($database); ?>" placeholder="your_custom_db">
                                    <?php $__errorArgs = ['database'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="form-text text-muted">The database name in your custom app</small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="username" name="username" value="<?php echo e($username); ?>" placeholder="database_user">
                                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="password" class="form-label">Password <?php echo e(!$host ? '<span class="text-danger">*</span>' : ''); ?></label>
                                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="password" name="password" placeholder="<?php echo e(!$host ? 'Database password (required for first setup)' : 'Leave blank to keep existing password'); ?>" <?php echo e(!$host ? 'required' : ''); ?>>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="form-text text-muted"><?php echo e(!$host ? 'Required to establish initial connection' : 'Only enter a new password if you want to change it'); ?></small>
                                </div>
                            </div>

                            <!-- Connection Test Buttons -->
                            <div class="d-flex gap-2 mt-4">
                                <button type="button" class="btn btn-outline-info" id="testConnectionBtn">
                                    <i class="fas fa-plug"></i> Test Connection
                                </button>
                                <button type="button" class="btn btn-outline-info" id="testTablesBtn">
                                    <i class="fas fa-table"></i> Check Tables
                                </button>
                                <button type="button" class="btn btn-outline-warning" id="createTablesBtn">
                                    <i class="fas fa-database"></i> Create Tables
                                </button>
                            </div>

                            <!-- Status Messages -->
                            <div id="statusAlert" class="alert d-none mt-3" role="alert">
                                <i id="statusIcon" class="fas fa-info-circle"></i>
                                <span id="statusMessage"></span>
                            </div>

                            <!-- Table Status -->
                            <div id="tableStatusDiv" class="d-none mt-4">
                                <h6 class="mb-3">Table Status:</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Table Name</th>
                                                <th>Status</th>
                                                <th>Records</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableStatusBody">
                                            <!-- Populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enable Sync Card -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Enable Synchronization</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="enabled" name="enabled" 
                                       value="1" <?php echo e($enabled ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="enabled">
                                    Enable real-time sync to external database
                                </label>
                            </div>
                            <small class="form-text text-muted d-block mt-2">
                                When enabled, every product mapping change will automatically sync to your external database's ticket_mapping table
                            </small>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                    </div>
                </form>
            </div>

            <!-- Help Panel -->
            <div class="col-lg-4">
                <div class="card bg-light">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="fas fa-question-circle"></i> Setup Help</h5>
                    </div>
                    <div class="card-body small">
                        <h6 class="font-weight-bold">Step 1: Enter Credentials</h6>
                        <p>Enter the connection details for your custom PHP app's MySQL database.</p>

                        <h6 class="font-weight-bold">Step 2: Test Connection</h6>
                        <p>Click "Test Connection" to verify the database is accessible.</p>

                        <h6 class="font-weight-bold">Step 3: Create Tables</h6>
                        <p>Click "Create Tables" to automatically create the required tables in your database.</p>

                        <h6 class="font-weight-bold">Step 4: Enable Sync</h6>
                        <p>Check the "Enable real-time sync" checkbox and save.</p>

                        <hr>

                        <h6 class="font-weight-bold"><i class="fas fa-info-circle text-info"></i> What Gets Synced?</h6>
                        <ul class="small mb-0">
                            <li><strong>ticket_mapping:</strong> Product-to-inventory mappings</li>
                            <li><strong>Ticket names & prices</strong> from Rezgo</li>
                            <li><strong>Available dates</strong> detected by API</li>
                            <li><strong>Sync timestamps</strong> for auditing</li>
                        </ul>

                        <hr class="my-2">

                        <div class="alert alert-info small mb-0">
                            <strong>Same Server?</strong> Both databases can be on the same MySQL server with different names. No complex networking required.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .page-header {
            padding: 20px 0;
            margin-bottom: 30px;
            border-bottom: 1px solid #e9ecef;
        }
        .page-title h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .card-header {
            border-bottom: 1px solid #e9ecef;
        }
        .form-row {
            display: flex;
            gap: 0;
        }
        .gap-2 {
            gap: 0.5rem;
        }
        .d-none {
            display: none;
        }
    </style>

    <script>
        // Toast notification function
        function showToast(message, type = 'success') {
            const isSuccess = type === 'success';
            const isError = type === 'error';
            const isInfo = type === 'info';
            
            let bgClass = isSuccess ? 'bg-success' : (isError ? 'bg-danger' : 'bg-primary');
            let icon = isSuccess ? 'fa-check-circle' : (isError ? 'fa-exclamation-circle' : 'fa-info-circle');
            let title = isSuccess ? 'Success' : (isError ? 'Error' : 'Info');
            
            const toastHtml = `
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header ${bgClass} text-white">
                        <i class="fas ${icon} me-2"></i>
                        <strong class="me-auto">${title}</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            `;
            
            const container = document.getElementById('toastContainer');
            const toastEl = document.createElement('div');
            toastEl.innerHTML = toastHtml;
            container.appendChild(toastEl);
            
            const toast = new bootstrap.Toast(toastEl.querySelector('.toast'));
            toast.show();
            
            // Remove from DOM after toast is hidden
            toastEl.addEventListener('hidden.bs.toast', () => {
                toastEl.remove();
            });
        }

        // Show session messages as toasts
        document.addEventListener('DOMContentLoaded', function() {
            <?php if(session('success')): ?>
                showToast('<?php echo e(session('success')); ?>', 'success');
            <?php endif; ?>

            <?php if(session('error')): ?>
                showToast('<?php echo e(session('error')); ?>', 'error');
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    showToast('<?php echo e($error); ?>', 'error');
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            const testConnectionBtn = document.getElementById('testConnectionBtn');
            const testTablesBtn = document.getElementById('testTablesBtn');
            const createTablesBtn = document.getElementById('createTablesBtn');
            const statusAlert = document.getElementById('statusAlert');
            const statusIcon = document.getElementById('statusIcon');
            const statusMessage = document.getElementById('statusMessage');
            const tableStatusDiv = document.getElementById('tableStatusDiv');
            const tableStatusBody = document.getElementById('tableStatusBody');

            function getFormData() {
                return {
                    host: document.getElementById('host').value,
                    port: document.getElementById('port').value,
                    username: document.getElementById('username').value,
                    password: document.getElementById('password').value,
                    database: document.getElementById('database').value,
                    _token: document.querySelector('input[name="_token"]').value
                };
            }

            function showStatus(isSuccess, message) {
                showToast(message, isSuccess ? 'success' : 'error');
            }

            testConnectionBtn.addEventListener('click', function() {
                const data = getFormData();
                testConnectionBtn.disabled = true;
                testConnectionBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Testing...';

                fetch('<?php echo e(route("rezgo.external-sync.test-connection")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    showStatus(result.success, result.message);
                    testConnectionBtn.innerHTML = '<i class="fas fa-plug"></i> Test Connection';
                    testConnectionBtn.disabled = false;
                })
                .catch(error => {
                    showStatus(false, 'Error: ' + error.message);
                    testConnectionBtn.innerHTML = '<i class="fas fa-plug"></i> Test Connection';
                    testConnectionBtn.disabled = false;
                });
            });

            testTablesBtn.addEventListener('click', function() {
                const data = getFormData();
                testTablesBtn.disabled = true;
                testTablesBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';

                fetch('<?php echo e(route("rezgo.external-sync.table-status")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    testTablesBtn.innerHTML = '<i class="fas fa-table"></i> Check Tables';
                    testTablesBtn.disabled = false;

                    if (result.success && result.tables) {
                        tableStatusBody.innerHTML = '';
                        for (const [tableName, status] of Object.entries(result.tables)) {
                            const row = `
                                <tr>
                                    <td>${tableName}</td>
                                    <td>
                                        ${status.exists 
                                            ? '<span class="badge bg-success">✓ Exists</span>' 
                                            : '<span class="badge bg-danger">✗ Missing</span>'}
                                    </td>
                                    <td>${status.records || 0}</td>
                                </tr>
                            `;
                            tableStatusBody.innerHTML += row;
                        }
                        tableStatusDiv.classList.remove('d-none');
                        showStatus(true, 'Table status retrieved');
                    } else {
                        showStatus(false, result.message || 'Failed to retrieve table status');
                        tableStatusDiv.classList.add('d-none');
                    }
                })
                .catch(error => {
                    showStatus(false, 'Error: ' + error.message);
                    testTablesBtn.innerHTML = '<i class="fas fa-table"></i> Check Tables';
                    testTablesBtn.disabled = false;
                });
            });

            createTablesBtn.addEventListener('click', function() {
                if (!confirm('This will create the required tables in your external database. Continue?')) {
                    return;
                }

                const data = getFormData();
                createTablesBtn.disabled = true;
                createTablesBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';

                fetch('<?php echo e(route("rezgo.external-sync.create-tables")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    createTablesBtn.innerHTML = '<i class="fas fa-database"></i> Create Tables';
                    createTablesBtn.disabled = false;

                    showStatus(result.success, result.message);

                    if (result.success) {
                        // Refresh table status
                        setTimeout(() => {
                            testTablesBtn.click();
                        }, 500);
                    }
                })
                .catch(error => {
                    showStatus(false, 'Error: ' + error.message);
                    createTablesBtn.innerHTML = '<i class="fas fa-database"></i> Create Tables';
                    createTablesBtn.disabled = false;
                });
            });

            // Form submit handler
            const externalSyncForm = document.getElementById('externalSyncForm');
            externalSyncForm.addEventListener('submit', function() {
                showToast('Saving settings...', 'info');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(BaseHelper::getAdminMasterLayoutTemplate(), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/external-sync-settings.blade.php ENDPATH**/ ?>