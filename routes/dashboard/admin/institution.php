<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\Institutions\OrganizationController;
use App\Http\Controllers\Dashboard\Admin\Institutions\OrganizationTypeController;

//organizations
Route::controller(OrganizationController::class)
    ->prefix('organizations')->name('organizations.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

    });
Route::resource('organizations', OrganizationController::class)->except('show');

//organizations
Route::controller(OrganizationTypeController::class)
    ->prefix('organization_types')->name('organization_types.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

    });
Route::resource('organization_types', OrganizationTypeController::class)->except('show');
