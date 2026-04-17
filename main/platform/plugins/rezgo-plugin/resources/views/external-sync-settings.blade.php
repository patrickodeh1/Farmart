@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
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
                <!-- Configuration Status -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Current Configuration</h5>
                    </div>
                    <div class="card-body">
                        @if(!empty($host))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> <strong>Status:</strong> External sync is configured
                            </div>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td><strong>Host:</strong></td>
                                    <td><code>{{ $host }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Port:</strong></td>
                                    <td><code>{{ $port }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Database:</strong></td>
                                    <td><code>{{ $database }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Username:</strong></td>
                                    <td><code>{{ $username }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Sync Enabled:</strong></td>
                                    <td>
                                        @if($enabled)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> <strong>Status:</strong> External sync not configured
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Instructions -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">How to Configure External Database Sync</h5>
                    </div>
                    <div class="card-body">
                        <p>To configure external database syncing, edit your <code>.env</code> file with the following variables:</p>

                        <div class="bg-light p-3 rounded mb-3" style="font-family: monospace; font-size: 0.9em; overflow-x: auto;">
                            <div># Enable external sync (true/false)</div>
                            <div>REZGO_EXTERNAL_SYNC_ENABLED=true</div>
                            <div><br></div>
                            <div># Database connection details (using existing DZM_COATAA_DB_* variables)</div>
                            <div>DZM_COATAA_DB_HOST=localhost</div>
                            <div>DZM_COATAA_DB_PORT=3306</div>
                            <div>DZM_COATAA_DB_DATABASE=your_custom_db</div>
                            <div>DZM_COATAA_DB_USERNAME=db_user</div>
                            <div>DZM_COATAA_DB_PASSWORD=db_password</div>
                        </div>

                        <h6 class="mt-4 mb-3"><i class="fas fa-tasks"></i> Setup Steps:</h6>
                        <ol>
                            <li>Open your <code>.env</code> file in the Farmart root directory</li>
                            <li>Find the <code>DZM_COATAA_DB_*</code> section</li>
                            <li>Ensure your external database credentials are filled in</li>
                            <li>Add or enable: <code>REZGO_EXTERNAL_SYNC_ENABLED=true</code></li>
                            <li>Save the file</li>
                            <li>Clear Laravel cache by running: <code>php artisan config:cache</code></li>
                            <li>Use the tools below to verify the connection works</li>
                        </ol>

                        <div class="alert alert-info mt-4">
                            <i class="fas fa-lightbulb"></i> <strong>Tip:</strong> Both databases can be on the same MySQL server with different names. No complex networking required.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Panel -->
            <div class="col-lg-4">
                <div class="card bg-light">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="fas fa-question-circle"></i> What Gets Synced?</h5>
                    </div>
                    <div class="card-body small">
                        <p>When external sync is enabled, the following data is synchronized to your external database:</p>

                        <h6 class="font-weight-bold mt-3">Tables Created:</h6>
                        <ul class="small">
                            <li><strong>ticket_mapping</strong><br>
                                <small>Rezgo UID, ticket name, price</small></li>
                            <li><strong>ticket_pricing</strong><br>
                                <small>Pricing information by ticket type</small></li>
                            <li><strong>dates_availability</strong><br>
                                <small>Available dates for each ticket</small></li>
                        </ul>

                        <hr>

                        <h6 class="font-weight-bold">Real-Time Updates:</h6>
                        <ul class="small mb-0">
                            <li>✓ When product mappings are created</li>
                            <li>✓ When product mappings are updated</li>
                            <li>✓ When product mappings are deleted</li>
                            <li>✓ Automatic sync timestamp on each change</li>
                        </ul>

                        <div class="alert alert-warning small mt-3 mb-0">
                            <strong>Note:</strong> Make sure your .env file has <code>REZGO_EXTERNAL_SYNC_ENABLED=true</code> for syncing to work.
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
    </style>
@endsection
