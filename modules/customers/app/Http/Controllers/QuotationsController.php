<?php

namespace Modules\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Customers\Http\Requests\Quotation\AddQuotationRequest;
use Modules\Customers\Http\Requests\Quotation\DeleteQuotationRequest;
use Modules\Customers\Http\Requests\Quotation\EditQuotationRequest;
use Modules\Customers\Http\Requests\Quotation\ReadQuotationRequest;
use Modules\Customers\Http\Resources\Quotation;
use Modules\Customers\Http\Resources\QuotationCollection;
use Modules\Customers\Services\QuotationService;

class QuotationsController extends Controller
{


    function browse(Request $request, QuotationService $service)
    {

        $inputs = $request->all();

        $quotations = $service->browse($inputs);
        return response(new QuotationCollection($quotations), 200);

    }

    function add(AddQuotationRequest $request, QuotationService $service)
    {
        $inputs = $request->all();

        $quotation = $service->add($inputs);
        if ($quotation) {
            return response(new Quotation($quotation), 200);
        } else {
            return response('Quotation not added', 422);
        }
    }

    //this endpoint should never be used, users should opt for voiding/deleting an quotation instead of editing it
    function edit(EditQuotationRequest $request, QuotationService $service, $entity)
    {
        $inputs = $request->all();

        $quotation = $service->edit($inputs, $entity);
        if ($quotation) {
            return response(new Quotation($quotation), 200);
        } else {
            return response('Quotation not edit', 422);
        }
    }


    function read(ReadQuotationRequest $request, QuotationService $service, $entity)
    {
        $quotation = $service->read($entity);
        if ($quotation) {
            return response(new Quotation($quotation), 200);
        } else {
            return response('Cannot read Quotation', 422);
        }
    }

    function delete(DeleteQuotationRequest $request, QuotationService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Quotation', 422);
        }
    }

    function restore(DeleteQuotationRequest $request, QuotationService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Quotation', 422);
        }
    }

}
