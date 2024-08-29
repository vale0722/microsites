<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('sites', SiteController::class);

        Route::post('imports', [ImportController::class, 'store'])
            ->name('imports.store');

        Route::get('imports/create', [ImportController::class, 'create'])
            ->name('imports.create');

        Route::get('imports', [ImportController::class, 'index'])
            ->name('imports.index');

        Route::get('imports/{import}', [ImportController::class, 'show'])
            ->name('imports.show');
    });
