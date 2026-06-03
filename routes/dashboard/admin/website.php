<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Admin\Websites\HeroController;
use App\Http\Controllers\Dashboard\Admin\Websites\ContactController;
use App\Http\Controllers\Dashboard\Admin\Websites\AppointmentController;
use App\Http\Controllers\Dashboard\Admin\Websites\AboutController;
use App\Http\Controllers\Dashboard\Admin\Websites\WhyUsController;
use App\Http\Controllers\Dashboard\Admin\Websites\CtaController;
use App\Http\Controllers\Dashboard\Admin\Websites\ServiceController;
use App\Http\Controllers\Dashboard\Admin\Websites\AboutPageController;
use App\Http\Controllers\Dashboard\Admin\Websites\ServicesSettingController;
use App\Http\Controllers\Dashboard\Admin\Websites\MemberController;

//Websites hero
Route::controller(HeroController::class)
    ->prefix('hero')->name('hero.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('store', 'store')->name('store');

});

//Websites about (section settings)
Route::controller(AboutController::class)
    ->prefix('about')->name('about.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('store', 'store')->name('store');

});

// Members — custom routes BEFORE resource to avoid {member} wildcard conflict
Route::controller(MemberController::class)
    ->prefix('about/members')->name('about.members.')->group(function () {

    Route::get('data',           'data')->name('data');
    Route::post('status',        'status')->name('status');
    Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
    Route::post('sortable',      'storeSortable')->name('sortable.store');

});
Route::resource('about/members', MemberController::class)
    ->names([
        'index'   => 'about.members.index',
        'create'  => 'about.members.create',
        'store'   => 'about.members.store',
        'edit'    => 'about.members.edit',
        'update'  => 'about.members.update',
        'destroy' => 'about.members.destroy',
    ])
    ->except('show');

//Websites services
Route::controller(ServiceController::class)
    ->prefix('services')->name('services.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
        Route::post('store', 'storeSortable')->name('sortable.store');

    });
Route::resource('services', ServiceController::class)->except('show');

// Websites settings
Route::controller(ServicesSettingController::class)
    ->prefix('services/setting')->name('services.setting.')->group(function () {

    Route::get('/',      'index')->name('index');
    Route::post('store', 'store')->name('store');

});


//Websites why_us
Route::controller(WhyUsController::class)
    ->prefix('why_us')->name('why_us.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('store', 'store')->name('store');

});
//Websites cta
Route::controller(CtaController::class)
    ->prefix('cta')->name('cta.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('store', 'store')->name('store');

});

// Appointments MUST be before contacts resource to avoid {contact} wildcard catching "appointments"
Route::prefix('contacts/appointments')->name('contacts.appointments.')->group(function () {
    Route::controller(AppointmentController::class)->group(function () {
        Route::get('/',                 'index')->name('index');
        Route::get('data',              'data')->name('data');
        Route::post('status',           'status')->name('status');
        Route::delete('bulk_delete',    'bulkDelete')->name('bulk_delete');
        Route::get('/{appointment}',    'show')->name('show');
        Route::delete('/{appointment}', 'destroy')->name('destroy');
    });
});

// Contacts (form submissions)
Route::controller(ContactController::class)
    ->prefix('contacts')->name('contacts.')->group(function () {

    Route::get('data',          'data')->name('data');
    Route::post('status',       'status')->name('status');
    Route::delete('bulk_delete','bulkDelete')->name('bulk_delete');

});
Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);

// About Page settings
Route::controller(AboutPageController::class)
    ->prefix('about/setting')->name('about-page.')->group(function () {

    Route::get('/',      'index')->name('index');
    Route::post('store', 'store')->name('store');

});
