<?php

namespace Modules\Transactions\Services;

use Modules\Transactions\Models\Expense;
use Modules\Transactions\Repositories\ExpenseRepository;

class ExpenseService
{
    protected $repository;
    protected $vendor;

    function __construct(ExpenseRepository $repository)
    {
        $this->repository = $repository;
        $this->vendor = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $expenses = $this->repository->browse($inputs, $this->vendor);

        return $expenses;
    }

    function add($inputs)
    {
        $expense = $this->repository->add($inputs, $this->vendor);

        if ($expense) {
            return $expense;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $expense = Expense::query()
        ->where('user_id', $this->vendor->id)
        ->where('id',$id)
        ->first();

        if ($expense) {
            $expense = $this->repository->edit($inputs, $expense, $this->vendor);
            return $expense;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $expense = $this->repository->read($id, $this->vendor);
            return $expense;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $expense = $this->repository->delete($id, $this->vendor);
            return $expense;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $expense = $this->repository->restore($id, $this->vendor);
            return $expense;
        } else {
            return false;
        }
    }



}
