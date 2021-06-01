<?php

use Illuminate\Support\Facades\Route;
use Modules\Customers\Http\Controllers\CustomersController;
use Modules\Customers\Http\Controllers\InvoicesController;
use Modules\Customers\Http\Controllers\LeadsController;
use Modules\Customers\Http\Controllers\QuotationsController;


Route::middleware(['auth:api'])->group(function () {
    Route::get('/customers/', [CustomersController::class, 'browse'])->name('modules.customer.browse');
    Route::post('/customers/add', [CustomersController::class, 'add'])->name('modules.customer.add');
    Route::post('/customers/{entity}/edit', [CustomersController::class, 'edit'])->name('modules.customer.edit');
    Route::post('/customers/{entity}/delete', [CustomersController::class, 'delete'])->name('modules.customer.delete');
    Route::post('/customers/{entity}/restore', [CustomersController::class, 'restore'])->name('modules.customer.restore');
    Route::get('/customers/{entity}', [CustomersController::class, 'read'])->name('modules.customer.read');

    Route::get('/leads/', [LeadsController::class, 'browse'])->name('modules.lead.browse');
    Route::post('/leads/add', [LeadsController::class, 'add'])->name('modules.lead.add');
    Route::post('/leads/{entity}/edit', [LeadsController::class, 'edit'])->name('modules.lead.edit');
    Route::post('/leads/{entity}/convert', [LeadsController::class, 'convertToCustomer'])->name('modules.lead.convert');
    Route::post('/leads/{entity}/delete', [LeadsController::class, 'delete'])->name('modules.lead.delete');
    Route::post('/leads/{entity}/restore', [LeadsController::class, 'restore'])->name('modules.lead.restore');
    Route::get('/leads/{entity}', [LeadsController::class, 'read'])->name('modules.lead.read');


    Route::get('/invoices', [InvoicesController::class, 'browse'])->name('modules.invoice.browse');
    Route::post('/invoices/add', [InvoicesController::class, 'add'])->name('modules.invoice.add');
    Route::post('/invoices/{entity}/edit', [InvoicesController::class, 'edit'])->name('modules.invoice.edit');
    Route::post('/invoices/{entity}/paid', [InvoicesController::class, 'markPaid'])->name('modules.invoice.paid');
    Route::post('/invoices/{entity}/delete', [InvoicesController::class, 'delete'])->name('modules.invoice.delete');
    Route::post('/invoices/{entity}/restore', [InvoicesController::class, 'restore'])->name('modules.invoice.restore');
    Route::get('/invoices/{entity}', [InvoicesController::class, 'read'])->name('modules.invoice.read');

    Route::get('/quotations', [QuotationsController::class, 'browse'])->name('modules.invoice.browse');
    Route::post('/quotations/add', [QuotationsController::class, 'add'])->name('modules.invoice.add');
    Route::post('/quotations/{entity}/delete', [QuotationsController::class, 'delete'])->name('modules.invoice.delete');
    Route::get('/quotations/{entity}', [QuotationsController::class, 'read'])->name('modules.invoice.read');

});
