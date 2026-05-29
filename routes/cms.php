<?php

use App\Http\Controllers\cms\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('cms')->name('cms.')->middleware(['auth'])->group(function () {
    Route::get('dashboard',         [DashboardController::class,'dashboard'])->name('dashboard');
});
