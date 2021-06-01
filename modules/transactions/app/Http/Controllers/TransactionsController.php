<?php

namespace Modules\Transactions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Transactions\Http\Requests\Transaction\AddTransactionRequest;
use Modules\Transactions\Http\Requests\Transaction\DeleteTransactionRequest;
use Modules\Transactions\Http\Requests\Transaction\EditTransactionRequest;
use Modules\Transactions\Http\Requests\Transaction\ReadTransactionRequest;
use Modules\Transactions\Http\Resources\Transaction;
use Modules\Transactions\Http\Resources\TransactionCollection;
use Modules\Transactions\Services\TransactionService;

class TransactionsController extends Controller
{


    function browse(Request $request, TransactionService $service)
    {

        $inputs = $request->all();

        $transactions = $service->browse($inputs);
        return response(new TransactionCollection($transactions), 200);

    }

    function add(AddTransactionRequest $request, TransactionService $service)
    {
        $inputs = $request->all();

        $transaction = $service->add($inputs);
        if ($transaction) {
            return response(new Transaction($transaction), 200);
        } else {
            return response('Transaction not added', 422);
        }
    }

    function edit(EditTransactionRequest $request, TransactionService $service, $entity)
    {
        $inputs = $request->all();

        $transaction = $service->edit($inputs, $entity);
        if ($transaction) {
            return response(new Transaction($transaction), 200);
        } else {
            return response('Transaction not edit', 422);
        }
    }


    function read(ReadTransactionRequest $request, TransactionService $service, $entity)
    {
        $transaction = $service->read($entity);
        if ($transaction) {
            return response(new Transaction($transaction), 200);
        } else {
            return response('Cannot read Transaction', 422);
        }
    }

    function delete(DeleteTransactionRequest $request, TransactionService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Transaction', 422);
        }
    }

    function restore(DeleteTransactionRequest $request, TransactionService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Transaction', 422);
        }
    }





}
