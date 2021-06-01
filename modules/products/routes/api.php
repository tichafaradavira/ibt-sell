<?php

use Illuminate\Support\Facades\Route;
use Modules\Products\Http\Controllers\ProductsController;


Route::middleware(['auth:api'])->group(function () {
    Route::get('/products', [ProductsController::class, 'browse'])->name('modules.product.browse');
    Route::post('/products/add', [ProductsController::class, 'add'])->name('modules.product.add');
    Route::post('/products/{entity}/edit', [ProductsController::class, 'edit'])->name('modules.product.edit');
    Route::post('/products/{entity}/delete', [ProductsController::class, 'delete'])->name('modules.product.delete');
    Route::post('/products/{entity}/restore', [ProductsController::class, 'restore'])->name('modules.product.restore');
    Route::post('/products/{entity}/replenish', [ProductsController::class, 'replenish'])->name('modules.product.replenish');
    Route::get('/products/{entity}', [ProductsController::class, 'read'])->name('modules.product.read');

});
