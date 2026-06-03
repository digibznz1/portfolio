<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ContactController;

Route::view('/welcome', 'welcome');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about',    [HomeController::class, 'about'])->name('about');
Route::get('services', [HomeController::class, 'services'])->name('services');
Route::get('language/{language:code}', [HomeController::class, 'changeLanguage'])->name('changeLanguage');

// Contact page + AJAX endpoints
Route::controller(ContactController::class)
    ->prefix('contact')->name('contact.')->group(function () {

    Route::get('/',            'index')->name('index');
    Route::post('rfq',         'storeContact')->name('store');
    Route::post('appointment', 'storeAppointment')->name('appointment.store');
    Route::get('slots',        'availableSlots')->name('slots');

});