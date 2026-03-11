<?php

namespace Botble\RezgoConnector\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\RezgoConnector\Http\Requests\UpdateRezgoSettingsRequest;
use Botble\RezgoConnector\Models\{RezgoSubmission, RezgoProductMapping, RezgoLog};
use Botble\RezgoConnector\Services\{RezgoSettingsService, RezgoApiService};
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RezgoConnectorController extends BaseController
{
    private RezgoSettingsService $settings;
    private RezgoApiService $api;

    public function __construct(RezgoSettingsService $settings, RezgoApiService $api)
    {
        $this->settings = $settings;
        $this->api = $api;
    }

    /**
     * Settings dashboard
     */
    public function index(): View
    {
        return view('rezgo::admin.settings', [
            'settings' => $this->settings->all(),
            'submissionsCount' => RezgoSubmission::count(),
            'successCount' => RezgoSubmission::where('status', 'success')->count(),
            'failedCount' => RezgoSubmission::where('status', 'failed')->count(),
            'mappingsCount' => RezgoProductMapping::where('is_active', true)->count(),
            'recentLogs' => RezgoLog::latest()->limit(10)->get(),
        ]);
    }

    /**
     * Update settings
     */
    public function updateSettings(UpdateRezgoSettingsRequest $request): RedirectResponse
    {
        $this->settings->setCid($request->input('rezgo_cid'));
        $this->settings->setApiKey($request->input('rezgo_api_key'));
        $this->settings->set('default_passenger_type', $request->input('default_passenger_type', 'adult'));
        $this->settings->set('booking_date_offset', (int)$request->input('booking_date_offset', 1));
        $this->settings->set('sync_enabled', (bool)$request->input('sync_enabled', false));

        return back()->with('success', __('Settings updated successfully'));
    }

    /**
     * View submissions
     */
    public function submissions(): View
    {
        $submissions = RezgoSubmission::with('order')
            ->latest()
            ->paginate(20);

        return view('rezgo::admin.submissions', [
            'submissions' => $submissions,
        ]);
    }

    /**
     * View submission detail
     */
    public function submissionDetail(int $id): View
    {
        $submission = RezgoSubmission::with('order')->findOrFail($id);

        return view('rezgo::admin.submission-detail', [
            'submission' => $submission,
        ]);
    }

    /**
     * View product mappings
     */
    public function productMappings(): View
    {
        $mappings = RezgoProductMapping::with('product')
            ->paginate(20);

        $inventoryResponse = $this->api->searchInventory();
        $rezgoTours = [];

        if ($inventoryResponse['success'] && isset($inventoryResponse['data']['item'])) {
            $items = $inventoryResponse['data']['item'];
            if (!is_array($items) || !isset($items[0])) {
                $items = [$items];
            }
            $rezgoTours = $items;
        }

        return view('rezgo::admin.product-mappings', [
            'mappings' => $mappings,
            'rezgoTours' => $rezgoTours,
        ]);
    }

    /**
     * Create or update product mapping
     */
    public function saveProductMapping(\Illuminate\Http\Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:ec_products,id',
            'rezgo_uid' => 'required|string',
            'rezgo_title' => 'nullable|string',
            'passenger_type' => 'required|in:adult,child,senior',
        ]);

        RezgoProductMapping::updateOrCreate(
            ['product_id' => $request->product_id],
            [
                'rezgo_uid' => $request->rezgo_uid,
                'rezgo_title' => $request->rezgo_title,
                'passenger_type' => $request->passenger_type,
                'is_active' => true,
            ]
        );

        return back()->with('success', __('Product mapping saved successfully'));
    }

    /**
     * Delete product mapping
     */
    public function deleteProductMapping(int $id): RedirectResponse
    {
        RezgoProductMapping::findOrFail($id)->delete();

        return back()->with('success', __('Product mapping deleted'));
    }

    /**
     * View logs
     */
    public function logs(): View
    {
        $logs = RezgoLog::latest()
            ->paginate(50);

        return view('rezgo::admin.logs', [
            'logs' => $logs,
        ]);
    }

    /**
     * Test API connection
     */
    public function testConnection(): RedirectResponse
    {
        if (!$this->settings->isConfigured()) {
            return back()->with('error', __('Rezgo API not configured'));
        }

        $response = $this->api->getCompanyInfo();

        if ($response['success']) {
            $companyName = $response['data']['company_name'] ?? 'Unknown';
            return back()->with('success', __("Connection successful! Company: {$companyName}"));
        }

        return back()->with('error', __('Connection failed: ' . $response['error']));
    }

    /**
     * Sync inventory from Rezgo
     */
    public function syncInventory(): RedirectResponse
    {
        if (!$this->settings->isConfigured()) {
            return back()->with('error', __('Rezgo API not configured'));
        }

        $response = $this->api->searchInventory();

        if (!$response['success']) {
            return back()->with('error', __('Failed to sync inventory: ' . $response['error']));
        }

        // Log the sync
        RezgoLog::sync('sync_inventory', null, 'Inventory sync completed', $response['data']);

        return back()->with('success', __('Inventory synced successfully'));
    }
}
