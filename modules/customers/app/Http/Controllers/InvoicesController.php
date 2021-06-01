<?php

namespace Modules\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Customers\Http\Requests\Invoice\AddInvoiceRequest;
use Modules\Customers\Http\Requests\Invoice\DeleteInvoiceRequest;
use Modules\Customers\Http\Requests\Invoice\EditInvoiceRequest;
use Modules\Customers\Http\Requests\Invoice\PaidRequest;
use Modules\Customers\Http\Requests\Invoice\ReadInvoiceRequest;
use Modules\Customers\Http\Resources\Invoice;
use Modules\Customers\Http\Resources\InvoiceCollection;
use Modules\Customers\Services\InvoiceService;

class InvoicesController extends Controller
{


    function browse(Request $request, InvoiceService $service)
    {

        $inputs = $request->all();

        $invoices = $service->browse($inputs);
        return response(new InvoiceCollection($invoices), 200);

    }

    function add(AddInvoiceRequest $request, InvoiceService $service)
    {
        $inputs = $request->all();

        $invoice = $service->add($inputs);
        if ($invoice) {
            return response(new Invoice($invoice), 200);
        } else {
            return response('Invoice not added', 422);
        }
    }

    //this endpoint should never be used, users should opt for voiding/deleting an invoice instead of editing it
    function edit(EditInvoiceRequest $request, InvoiceService $service, $entity)
    {
        $inputs = $request->all();

        $invoice = $service->edit($inputs, $entity);
        if ($invoice) {
            return response(new Invoice($invoice), 200);
        } else {
            return response('Invoice not edit', 422);
        }
    }

    function markPaid(PaidRequest $request, InvoiceService $service, $entity)
    {

        $invoice = $service->markPaid($entity);
        if ($invoice) {
            return response(true, 200);
        } else {
            return response('Invoice not marked', 422);
        }
    }


    function read(ReadInvoiceRequest $request, InvoiceService $service, $entity)
    {
        $invoice = $service->read($entity);
        if ($invoice) {
            return response(new Invoice($invoice), 200);
        } else {
            return response('Cannot read Invoice', 422);
        }
    }

    function delete(DeleteInvoiceRequest $request, InvoiceService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Invoice', 422);
        }
    }

    function restore(DeleteInvoiceRequest $request, InvoiceService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Invoice', 422);
        }
    }

}
