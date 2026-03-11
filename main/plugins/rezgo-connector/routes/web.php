<?php

use Botble\RezgoConnector\Http\Controllers\RezgoConnectorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'admin'])
    ->prefix('admin/rezgo-connector')
    ->name('rezgo.')
    ->group(function () {
        Route::get('/', [RezgoConnectorController::class, 'index'])->name('index');
        Route::post('/settings', [RezgoConnectorController::class, 'updateSettings'])->name('settings.update');
        Route::get('/test-connection', [RezgoConnectorController::class, 'testConnection'])->name('test-connection');
        Route::get('/sync-inventory', [RezgoConnectorController::class, 'syncInventory'])->name('sync-inventory');

        Route::prefix('submissions')
            ->group(function () {
                Route::get('/', [RezgoConnectorController::class, 'submissions'])->name('submissions');
                Route::get('{id}', [RezgoConnectorController::class, 'submissionDetail'])->name('submission-detail');
            });

        Route::prefix('product-mappings')
            ->group(function () {
                Route::get('/', [RezgoConnectorController::class, 'productMappings'])->name('product-mappings');
                Route::post('/', [RezgoConnectorController::class, 'saveProductMapping'])->name('product-mappings.save');
                Route::delete('{id}', [RezgoConnectorController::class, 'deleteProductMapping'])->name('product-mappings.delete');
            });

        Route::prefix('logs')
            ->group(function () {
                Route::get('/', [RezgoConnectorController::class, 'logs'])->name('logs');
            });
    });
