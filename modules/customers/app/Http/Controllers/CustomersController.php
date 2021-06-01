<?php

namespace Modules\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Customers\Http\Requests\Customer\AddCustomerRequest;
use Modules\Customers\Http\Requests\Customer\DeleteCustomerRequest;
use Modules\Customers\Http\Requests\Customer\EditCustomerRequest;
use Modules\Customers\Http\Requests\Customer\ReadCustomerRequest;
use Modules\Customers\Http\Resources\Customer;
use Modules\Customers\Http\Resources\CustomerCollection;
use Modules\Customers\Services\CustomerService;

class CustomersController extends Controller
{


    function browse(Request $request, CustomerService $service)
    {

        $inputs = $request->all();

        $customers = $service->browse($inputs);
        return response(new CustomerCollection($customers), 200);

    }

    function add(AddCustomerRequest $request, CustomerService $service)
    {
        $inputs = $request->all();

        $customer = $service->add($inputs);
        if ($customer) {
            return response(new Customer($customer), 200);
        } else {
            return response('Customer not added', 422);
        }
    }

    function edit(EditCustomerRequest $request, CustomerService $service, $entity)
    {
        $inputs = $request->all();

        $customer = $service->edit($inputs, $entity);
        if ($customer) {
            return response(new Customer($customer), 200);
        } else {
            return response('Customer not edit', 422);
        }
    }


    function read(ReadCustomerRequest $request, CustomerService $service, $entity)
    {
        $customer = $service->read($entity);
        if ($customer) {
            return response(new Customer($customer), 200);
        } else {
            return response('Cannot read Customer', 422);
        }
    }

    function delete(DeleteCustomerRequest $request, CustomerService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Customer', 422);
        }
    }

    function restore(DeleteCustomerRequest $request, CustomerService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Customer', 422);
        }
    }

    function testPdf(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('customers::invoice.invoice'));
        return $pdf->stream();
    }

}
