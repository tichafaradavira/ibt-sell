<?php

namespace Modules\Customers\Services;

use Modules\Customers\Models\Customer;
use Modules\Customers\Repositories\CustomerRepository;

class CustomerService
{
    protected $repository;
    protected $vendor;

    function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
        $this->vendor = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $customers = $this->repository->browse($inputs, $this->vendor);

        return $customers;
    }

    function add($inputs)
    {
        $customer = $this->repository->add($inputs, $this->vendor);

        if ($customer) {
            return $customer;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $customer = Customer::query()
        ->where('user_id', $this->vendor->id)
        ->where('id',$id)
        ->first();

        if ($customer) {
            $customer = $this->repository->edit($inputs, $customer);
            return $customer;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $customer = $this->repository->read($id, $this->vendor);
            return $customer;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $customer = $this->repository->delete($id, $this->vendor);
            return $customer;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $customer = $this->repository->restore($id, $this->vendor);
            return $customer;
        } else {
            return false;
        }
    }


}
