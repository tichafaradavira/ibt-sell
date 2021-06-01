<?php

namespace Modules\Transactions\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Modules\Transactions\Models\Expense;

class ExpenseRepository
{
    public static function browse($browse_inputs, $vendor)
    {
        $query = Expense::query()
            ->where('user_id', $vendor->id)
            ->orderBy('created_at', 'desc');

        $expenses = $query->paginate(15);

        return $expenses;
    }


    function add($data, $vendor)
    {

        if ($paid_at = Arr::get($data, 'paid_at')) {
            $data['paid_at'] = Carbon::parse($paid_at);
        }

        $expense = new Expense();
        $expense->fill($data);
        $expense->vendor()->associate($vendor);

        if ($expense->save()) {
            return $expense;
        } else {
            return false;
        }


    }

    function edit($data, $expense, $vendor)
    {

        if ($paid_at = Arr::get($data, 'paid_at')) {
            $data['paid_at'] = Carbon::parse($paid_at);
        }

        $expense->fill($data);
        if ($expense->save()) {
            return $expense;
        } else {
            return false;
        }
    }

    function read($id, $vendor)
    {
        $expense = Expense::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->first();

        if ($expense) {
            return $expense;
        } else {
            return false;
        }
    }

    function delete($id, $vendor)
    {
        $result = Expense::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->delete();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

}
