<?php
use Illuminate\Support\Facades\Route;

Route::get('/pdf', [\Modules\Customers\Http\Controllers\CustomersController::class, 'testPdf'])->name('modules.customer.read');

