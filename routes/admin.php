<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('sites', SiteController::class);

        // /sites/{site}/invoices
        Route::get('invoices', [InvoiceController::class, 'index'])
            ->name('invoices.index');

        // /sites/{site}/imports
        Route::post('imports', [ImportController::class, 'store'])
            ->name('imports.store');

        // /sites/{site}/imports/create
        Route::get('imports/create', [ImportController::class, 'create'])
            ->name('imports.create');

        // /sites/{site}/imports
        Route::get('imports', [ImportController::class, 'index'])
            ->name('imports.index');

        Route::get('imports/{import}', [ImportController::class, 'show'])
            ->name('imports.show');
    });
