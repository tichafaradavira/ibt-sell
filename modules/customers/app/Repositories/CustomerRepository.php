<?php

namespace Modules\Customers\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Customers\Models\Customer;

class CustomerRepository
{
    public static function browse($browse_inputs, $vendor)
    {
        $query = Customer::query()
            ->where('user_id', $vendor->id);

        $customers = $query->paginate(15);

        return $customers;
    }


    function add($data, $vendor)
    {

        $customer = new Customer();
        $customer->fill($data);
        $customer->vendor()->associate($vendor);

        if ($customer->save()) {
            return $customer;
        } else {
            return false;
        }


    }

    function edit($data, $customer)
    {
        $customer->fill($data);
        if ($customer->save()) {
            return $customer;
        } else {
            return false;
        }
    }

    function read($id, $vendor)
    {
        $customer = Customer::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->first();

        if ($customer) {
            return $customer;
        } else {
            return false;
        }
    }

    function delete($id, $vendor)
    {
        $result = Customer::query()
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
        $result = Customer::withTrashed()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->restore();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }



}
