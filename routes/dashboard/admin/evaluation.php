<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Admin\Evaluation\InitialEvaluationController;
use App\Http\Controllers\Dashboard\Admin\Evaluation\SelfEvaluationController;
use App\Http\Controllers\Dashboard\Admin\Evaluation\SelfEvaluationFileController;

//initial evaluations
Route::controller(InitialEvaluationController::class)
    ->prefix('initial_evaluations')->name('initial_evaluations.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::get('filter', 'filter')->name('filter');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
		Route::post('sortable', 'storeSortable')->name('sortable.store');

    });
Route::resource('initial_evaluations', InitialEvaluationController::class)->except('show');

//self evaluations
Route::controller(SelfEvaluationController::class)
    ->prefix('self_evaluations')->name('self_evaluations.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
		Route::post('sortable', 'storeSortable')->name('sortable.store');

    });
Route::resource('self_evaluations', SelfEvaluationController::class)->except('show');

//self evaluations file
Route::controller(SelfEvaluationFileController::class)
    ->prefix('self_evaluations.self_evaluation_files')->name('self_evaluations.self_evaluation_files.')
    ->group(function () {

        Route::get('{self_evaluation}/data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
		Route::post('sortable', 'storeSortable')->name('sortable.store');

    });
Route::resource('self_evaluations.self_evaluation_files', SelfEvaluationFileController::class)->except('show');