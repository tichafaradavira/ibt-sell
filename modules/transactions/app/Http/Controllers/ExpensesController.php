<?php

namespace Modules\Transactions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Transactions\Http\Requests\Expense\AddExpenseRequest;
use Modules\Transactions\Http\Requests\Expense\DeleteExpenseRequest;
use Modules\Transactions\Http\Requests\Expense\EditExpenseRequest;
use Modules\Transactions\Http\Requests\Expense\ReadExpenseRequest;
use Modules\Transactions\Http\Resources\Expense;
use Modules\Transactions\Http\Resources\ExpenseCollection;
use Modules\Transactions\Services\ExpenseService;

class ExpensesController extends Controller
{


    function browse(Request $request, ExpenseService $service)
    {

        $inputs = $request->all();

        $expenses = $service->browse($inputs);
        return response(new ExpenseCollection($expenses), 200);

    }

    function add(AddExpenseRequest $request, ExpenseService $service)
    {
        $inputs = $request->all();

        $expense = $service->add($inputs);
        if ($expense) {
            return response(new Expense($expense), 200);
        } else {
            return response('Expense not added', 422);
        }
    }

    function edit(EditExpenseRequest $request, ExpenseService $service, $entity)
    {
        $inputs = $request->all();

        $expense = $service->edit($inputs, $entity);
        if ($expense) {
            return response(new Expense($expense), 200);
        } else {
            return response('Expense not edit', 422);
        }
    }


    function read(ReadExpenseRequest $request, ExpenseService $service, $entity)
    {
        $expense = $service->read($entity);
        if ($expense) {
            return response(new Expense($expense), 200);
        } else {
            return response('Cannot read Expense', 422);
        }
    }

    function delete(DeleteExpenseRequest $request, ExpenseService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Expense', 422);
        }
    }

    function restore(DeleteExpenseRequest $request, ExpenseService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Expense', 422);
        }
    }





}
