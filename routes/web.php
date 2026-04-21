<?php

use Illuminate\Support\Facades\Route;

Route::view('/welcome', 'welcome');

Route::get('/', function () {
    return view('welcome');
});