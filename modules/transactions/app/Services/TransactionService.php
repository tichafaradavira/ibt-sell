<?php

namespace Modules\Transactions\Services;

use Modules\Transactions\Models\Transaction;
use Modules\Transactions\Repositories\TransactionRepository;

class TransactionService
{
    protected $repository;
    protected $vendor;

    function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
        $this->vendor = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $transactions = $this->repository->browse($inputs, $this->vendor);

        return $transactions;
    }

    function add($inputs)
    {
        $transaction = $this->repository->add($inputs, $this->vendor);

        if ($transaction) {
            return $transaction;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $transaction = Transaction::query()
        ->where('user_id', $this->vendor->id)
        ->where('id',$id)
        ->first();

        if ($transaction) {
            $transaction = $this->repository->edit($inputs, $transaction, $this->vendor);
            return $transaction;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $transaction = $this->repository->read($id, $this->vendor);
            return $transaction;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $transaction = $this->repository->delete($id, $this->vendor);
            return $transaction;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $transaction = $this->repository->restore($id, $this->vendor);
            return $transaction;
        } else {
            return false;
        }
    }



}
