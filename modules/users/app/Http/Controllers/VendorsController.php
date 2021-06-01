<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Users\Http\Requests\Vendor\AddVendorRequest;
use Modules\Users\Http\Requests\Vendor\DeleteVendorRequest;
use Modules\Users\Http\Requests\Vendor\EditVendorRequest;
use Modules\Users\Http\Requests\Vendor\ReadVendorRequest;
use Modules\Users\Http\Requests\Vendor\SuspendVendorRequest;
use Modules\Users\Http\Resources\User;
use Modules\Users\Http\Resources\UserCollection;
use Modules\Users\Services\VendorService;

class VendorsController extends Controller
{
    protected $admin;

    function __construct()
    {
        $this->admin =auth()->guard('api')->user();
    }

    function browse(Request $request, VendorService $service)
    {

        $inputs = $request->all();

        $vendors = $service->browse($inputs);
        return response(new UserCollection($vendors), 200);

    }

    function add(AddVendorRequest $request, VendorService $service)
    {
        $inputs = $request->all();

        $vendor = $service->add($inputs);
        if ($vendor) {
            return response(new User($vendor), 200);
        } else {
            return response('Vendor not added', 422);
        }
    }

    function edit(EditVendorRequest $request, VendorService $service, $entity)
    {
        $inputs = $request->all();

        $result = $service->edit($inputs, $entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Vendor not edit', 422);
        }
    }


    function read(ReadVendorRequest $request, VendorService $service, $entity)
    {
        $vendor = $service->read($entity);
        if ($vendor) {
            return response(new User($vendor), 200);
        } else {
            return response('Cannot read Vendor', 422);
        }
    }

    function delete(DeleteVendorRequest $request, VendorService $service, $entity)
    {
        $vendor = $service->delete($entity);
        if ($vendor) {
            return response(new User($vendor), 200);
        } else {
            return response('Cannot delete Vendor', 422);
        }
    }

    function suspend(SuspendVendorRequest $request, VendorService $service, $entity)
    {
        $inputs = $request->all();

        $vendor = $service->suspend($inputs, $entity);
        if ($vendor) {
            return response(new User($vendor), 200);
        } else {
            return response('Cannot delete Vendor', 422);
        }
    }

    function activate(SuspendVendorRequest $request, VendorService $service, $entity)
    {
        $vendor = $service->activate($entity);
        if ($vendor) {
            return response(new User($vendor), 200);
        } else {
            return response('Cannot delete Vendor', 422);
        }
    }

}
