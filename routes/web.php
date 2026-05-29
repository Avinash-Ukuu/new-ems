<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('cms.dashboard'));
});

require __DIR__.'/auth.php';
