<?php

use Illuminate\Support\Facades\Route;
use Modules\Transactions\Http\Controllers\TransactionsController;
use Modules\Transactions\Http\Controllers\ExpensesController;


Route::middleware(['auth:api'])->group(function () {
    Route::get('/transactions/', [TransactionsController::class, 'browse'])->name('modules.transaction.browse');
    Route::post('/transactions/add', [TransactionsController::class, 'add'])->name('modules.transaction.add');
    Route::post('/transactions/{entity}/edit', [TransactionsController::class, 'edit'])->name('modules.transaction.edit');
    Route::post('/transactions/{entity}/delete', [TransactionsController::class, 'delete'])->name('modules.transaction.delete');
    Route::post('/transactions/{entity}/restore', [TransactionsController::class, 'restore'])->name('modules.transaction.restore');
    Route::post('/transactions/{entity}/replenish', [TransactionsController::class, 'replenish'])->name('modules.transaction.replenish');
    Route::get('/transactions/{entity}', [TransactionsController::class, 'read'])->name('modules.transaction.read');


    Route::get('/expenses/', [ExpensesController::class, 'browse'])->name('modules.expense.browse');
    Route::post('/expenses/add', [ExpensesController::class, 'add'])->name('modules.expense.add');
    Route::post('/expenses/{entity}/edit', [ExpensesController::class, 'edit'])->name('modules.expense.edit');
    Route::post('/expenses/{entity}/delete', [ExpensesController::class, 'delete'])->name('modules.expense.delete');
    Route::get('/expenses/{entity}', [ExpensesController::class, 'read'])->name('modules.expense.read');

});
