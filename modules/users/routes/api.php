<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;
use Modules\Users\Http\Controllers\VendorsController;

/**
 * Vendor signup
 */
Route::post('/users/signup', [UserController::class, 'signup'])->name('modules.users.signup');
Route::post('/users/signin', [UserController::class, 'signIn'])->name('modules.users.signin');
Route::post('/users/verify/email', [UserController::class, 'verifyEmail'])->name('modules.users.verify-email');
Route::post('/users/forgotpassword', [UserController::class, 'forgotPassword'])->name('modules.users.forgot.paswword');
Route::post('/users/password/reset', [UserController::class, 'resetPassword'])->name('modules.users.password.reset');
Route::post('/users/logout', [UserController::class, 'logout'])->name('modules.users.logout')->middleware('auth:api');
Route::get('/users/vendor/profile', [UserController::class, 'profile'])->name('modules.users.vendor.profile')->middleware('auth:api');
Route::post('/users/vendor/edit/profile', [UserController::class, 'editProfile'])->name('modules.users.vendor.edit.profile')->middleware('auth:api');

/**
 * Admin Managing vendorsUrl
 */

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users/vendors', [VendorsController::class, 'browse'])->name('modules.users.vendor.browse');
    Route::post('/users/vendor/add', [VendorsController::class, 'add'])->name('modules.users.vendor.add');
    Route::post('/users/vendor/{entity}/edit', [VendorsController::class, 'edit'])->name('modules.users.vendor.edit');
    Route::post('/users/vendor/{entity}/delete', [VendorsController::class, 'delete'])->name('modules.users.vendor.delete');
    Route::post('/users/vendor/{entity}/suspend', [VendorsController::class, 'suspend'])->name('modules.users.vendor.suspend');
    Route::post('/users/vendor/{entity}/activate', [VendorsController::class, 'activate'])->name('modules.users.vendor.activate');
    Route::get('/users/vendor/{entity}', [VendorsController::class, 'read'])->name('modules.users.vendor.read');

});
