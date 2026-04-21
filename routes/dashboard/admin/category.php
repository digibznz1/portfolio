<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Admin\Category\StandardController;
use App\Http\Controllers\Dashboard\Admin\Category\FieldController;

//Standard
Route::prefix('standards')->name('standards.')->group(function () {

    Route::controller(StandardController::class)->group(function () {
        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
        Route::post('sortable', 'storeSortable')->name('sortable.store');
    });

	});
Route::resource('standards', StandardController::class)->parameters(['standards' => 'standard'])->except('show');

//Field
Route::prefix('fields')->name('fields.')->group(function () {

    Route::controller(FieldController::class)->group(function () {
        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
        Route::post('sortable', 'storeSortable')->name('sortable.store');
    });

	});
Route::resource('fields', FieldController::class)->parameters(['fields' => 'field'])->except('show');