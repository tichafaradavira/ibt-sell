<?php

namespace Modules\Products\Services;

use Modules\Products\Models\Product;
use Modules\Products\Repositories\ProductRepository;

class ProductService
{
    protected $repository;
    protected $vendor;

    function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
        $this->vendor = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $products = $this->repository->browse($inputs, $this->vendor);

        return $products;
    }

    function add($inputs)
    {
        $product = $this->repository->add($inputs, $this->vendor);

        if ($product) {
            return $product;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $product = Product::query()
        ->where('user_id', $this->vendor->id)
        ->where('id',$id)
        ->first();

        if ($product) {
            $product = $this->repository->edit($inputs, $product);
            return $product;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $product = $this->repository->read($id, $this->vendor);
            return $product;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $product = $this->repository->delete($id, $this->vendor);
            return $product;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $product = $this->repository->restore($id, $this->vendor);
            return $product;
        } else {
            return false;
        }
    }


    function replenish($inputs, $id)
    {
        if ($id) {
            $product = $this->repository->replenish($inputs, $id, $this->vendor);
            return $product;
        } else {
            return false;
        }
    }
}
