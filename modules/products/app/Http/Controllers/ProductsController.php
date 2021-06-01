<?php

namespace Modules\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Products\Http\Requests\Product\AddProductRequest;
use Modules\Products\Http\Requests\Product\DeleteProductRequest;
use Modules\Products\Http\Requests\Product\EditProductRequest;
use Modules\Products\Http\Requests\Product\ReadProductRequest;
use Modules\Products\Http\Requests\Product\ReplenishProductsRequest;
use Modules\Products\Http\Resources\Product;
use Modules\Products\Http\Resources\ProductCollection;
use Modules\Products\Services\ProductService;

class ProductsController extends Controller
{


    function browse(Request $request, ProductService $service)
    {

        $inputs = $request->all();

        $products = $service->browse($inputs);
        return response(new ProductCollection($products), 200);

    }

    function add(AddProductRequest $request, ProductService $service)
    {
        $inputs = $request->all();

        $product = $service->add($inputs);
        if ($product) {
            return response(new Product($product), 200);
        } else {
            return response('Product not added', 422);
        }
    }

    function edit(EditProductRequest $request, ProductService $service, $entity)
    {
        $inputs = $request->all();

        $product = $service->edit($inputs, $entity);
        if ($product) {
            return response(new Product($product), 200);
        } else {
            return response('Product not edit', 422);
        }
    }


    function read(ReadProductRequest $request, ProductService $service, $entity)
    {
        $product = $service->read($entity);
        if ($product) {
            return response(new Product($product), 200);
        } else {
            return response('Cannot read Product', 422);
        }
    }

    function delete(DeleteProductRequest $request, ProductService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Product', 422);
        }
    }

    function restore(DeleteProductRequest $request, ProductService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Product', 422);
        }
    }

    function replenish(ReplenishProductsRequest $request, ProductService $service, $entity)
    {
        $inputs = $request->all();

        $result = $service->replenish($inputs, $entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Product', 422);
        }
    }



}
