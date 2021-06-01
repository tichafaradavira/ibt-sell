<?php

namespace Modules\Transactions\Repositories;


use Illuminate\Support\Arr;
use Modules\Customers\Services\CustomerService;
use Modules\Products\Models\Product;
use Modules\Transactions\Models\Transaction;

class TransactionRepository
{
    public static function browse($browse_inputs, $vendor)
    {
        $query = Transaction::query()
            ->where('user_id', $vendor->id)
            ->orderBy('created_at', 'desc')
            ->with(['customer']);

        $transactions = $query->paginate(15);

        return $transactions;
    }


    function add($data, $vendor)
    {

        $transaction = new Transaction();
        if ($items_data = Arr::get($data, 'items')) {
            $items = array_combine(Arr::pluck($items_data,'product'),Arr::pluck($items_data,'count'));
            $data['items'] = $items;
            $total_price = $this->getTotalPrice($items, $vendor);
            $data['total_price'] = $total_price;
            $data['discount'] = $this->getDiscount(Arr::get($data, 'paid_price'), $total_price);
        }

        if ($customer_input = Arr::get($data, 'customer')) {
            $customer_service = resolve(CustomerService::class);
            $customer = $customer_service->add($customer_input);
            $transaction->customer()->associate($customer);
        }

        $transaction->fill($data);
        $transaction->vendor()->associate($vendor);

        if ($transaction->save()) {
            return $transaction;
        } else {
            return false;
        }


    }

    function edit($data, $transaction, $vendor)
    {
        if ($items = Arr::get($data, 'items')) {
            $total_price = $this->getTotalPrice($items, $vendor);
            $data['total_price'] = $total_price;
            $data['discount'] = $this->getDiscount(Arr::get($data, 'paid_price'), $total_price);
        }
        $transaction->fill($data);
        if ($transaction->save()) {
            return $transaction;
        } else {
            return false;
        }
    }

    function read($id, $vendor)
    {
        $transaction = Transaction::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->first();

        if ($transaction) {
            return $transaction;
        } else {
            return false;
        }
    }

    function delete($id, $vendor)
    {
        $result = Transaction::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->delete();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function restore($id, $vendor)
    {
        $result = Transaction::withTrashed()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->restore();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }


    public function getTotalPrice($items, $vendor)
    {
        $price = 0.0;
        $products = Product::query()->whereIn('id', array_keys($items))
            ->where('user_id', $vendor->id)->get();
        foreach ($products as $product) {
            $price = $price + $items[$product->id] * $product->selling_price;
        }

        return $price;
    }


    public function getDiscount($paid_price, $total_price)
    {
        if ($total_price > $paid_price) {
            return number_format(((float)((($total_price - $paid_price) / $total_price) * 100)), 2, '.', '');
        }
        return 0.0;
    }
}
