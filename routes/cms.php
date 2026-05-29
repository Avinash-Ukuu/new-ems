<?php

use App\Http\Controllers\cms\DashboardController;
use App\Http\Controllers\cms\ModuleController;
use App\Http\Controllers\cms\PermissionController;
use App\Http\Controllers\cms\RoleController;
use App\Http\Controllers\cms\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('cms')->name('cms.')->middleware(['auth'])->group(function () {
    Route::get('dashboard',         [DashboardController::class,'dashboard'])->name('dashboard');

    // User Management
    Route::resource('user',                     UserController::class);
    Route::resource("role",                     RoleController::class);
    Route::resource("module",                   ModuleController::class);
    Route::resource("permission",               PermissionController::class);
    Route::get("assign/user/roles/{id}",        [UserController::class,'assignRoleForm'])->name('assignRoles');
    Route::post("submit/user/roles",            [UserController::class,'assignRole'])->name('submitRole');
    Route::get("assign/role/permissions/{id}",  [RoleController::class,'assignPermissionForm'])->name('assignPermissions');
    Route::post("submit/role/permissions",      [RoleController::class,'assignPermission'])->name('submitPermission');
    Route::get("/change/password",              [UserController::class,'changePassword'])->name("changePassword");
    Route::post("/update/password",             [UserController::class,'updatePassword'])->name("updatePassword");
    Route::get("switch/user/form",              [UserController::class,'switchUserForm'])->name('switchUserForm');
    Route::post("switch/user",                  [UserController::class,'switchUser'])->name('switchUser');
    Route::get("logout/switch/user",            [UserController::class,'logoutSwitchUser'])->name('logoutSwitchUser');

});
