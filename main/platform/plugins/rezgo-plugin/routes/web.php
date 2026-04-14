<?php

use Botble\RezgoConnector\Http\Controllers\RezgoConnectorController;
use Botble\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function (): void {
    Route::group(['prefix' => 'rezgo-connector', 'as' => 'rezgo.'], function (): void {
        Route::get('/', [RezgoConnectorController::class, 'index'])->name('index');
        Route::post('/settings', [RezgoConnectorController::class, 'updateSettings'])->name('settings.update');
        Route::get('/test-connection', [RezgoConnectorController::class, 'testConnection'])->name('test-connection');
        Route::get('/sync-inventory', [RezgoConnectorController::class, 'syncInventory'])->name('sync-inventory');
        Route::get('/submit-order', [RezgoConnectorController::class, 'showSubmitOrderForm'])->name('submit-order.form');
        Route::post('/submit-order', [RezgoConnectorController::class, 'submitOrder'])->name('submit-order');

        Route::prefix('submissions')
            ->as('submissions.')
            ->group(function () {
                Route::get('/', [RezgoConnectorController::class, 'submissions'])->name('index');
                Route::get('{id}', [RezgoConnectorController::class, 'submissionDetail'])->name('detail');
            });

        Route::prefix('product-mappings')
            ->as('product-mappings.')
            ->group(function () {
                Route::get('/', [RezgoConnectorController::class, 'productMappings'])->name('index');
                Route::post('/', [RezgoConnectorController::class, 'saveProductMapping'])->name('save');
                Route::delete('{id}', [RezgoConnectorController::class, 'deleteProductMapping'])->name('delete');
            });

        Route::get('/import-as-draft', [RezgoConnectorController::class, 'importAsDraft'])->name('import-as-draft');

        Route::prefix('external-sync')
            ->as('external-sync.')
            ->group(function () {
                Route::get('/', [RezgoConnectorController::class, 'showExternalSyncSettings'])->name('settings');
                Route::post('/save', [RezgoConnectorController::class, 'saveExternalSyncSettings'])->name('save');
                Route::post('/test-connection', [RezgoConnectorController::class, 'testExternalConnection'])->name('test-connection');
                Route::post('/create-tables', [RezgoConnectorController::class, 'createExternalTables'])->name('create-tables');
                Route::post('/table-status', [RezgoConnectorController::class, 'getExternalTableStatus'])->name('table-status');
            });

        Route::prefix('logs')
            ->as('logs.')
            ->group(function () {
                Route::get('/', [RezgoConnectorController::class, 'logs'])->name('index');
            });
    });
});
