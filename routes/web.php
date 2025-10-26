<?php

use Abedin\Maker\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::get('warning', function () {
    return view('joynala.maker::warning');
})->name('warning');

Route::controller(MarketController::class)->middleware('auth', config('installer.admin_role'))->group(function () {
    Route::get('/upgrade-notice', 'upgrade')->name('marketplace.upgrade');
    Route::get('/marketplace', 'index')->name('marketplace.index');
});