<?php

namespace Modules\Products\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Products\Emails\ActivateAccountEmail;
use Modules\Products\Models\Product;

class ProductRepository
{
    public static function browse($browse_inputs, $vendor)
    {
        $query = Product::query()
            ->where('user_id', $vendor->id);

        $products = $query->paginate(15);

        return $products;
    }


    function add($data, $vendor)
    {

        $product = new Product();
        $product->fill($data);
        $product->vendor()->associate($vendor);

        if ($product->save()) {
            return $product;
        } else {
            return false;
        }


    }

    function edit($data, $product)
    {
        $product->fill($data);
        if ($product->save()) {
            return $product;
        } else {
            return false;
        }
    }

    function read($id, $vendor)
    {
        $product = Product::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->first();

        if ($product) {
            return $product;
        } else {
            return false;
        }
    }

    function delete($id, $vendor)
    {
        $result = Product::query()
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
        $result = Product::withTrashed()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->restore();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function replenish($data, $id, $vendor)
    {
        $product = Product::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->first();


        if ($product) {
            if ($quantity = Arr::get($data, 'quantity')) {
                $product->quantity = $product->quantity + $quantity;
                $product->save();
            }
            return $product;
        } else {
            return false;
        }
    }


}
