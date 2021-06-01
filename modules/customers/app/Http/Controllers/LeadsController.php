<?php

namespace Modules\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Customers\Http\Requests\Lead\AddLeadRequest;
use Modules\Customers\Http\Requests\Lead\ConvertLeadRequest;
use Modules\Customers\Http\Requests\Lead\DeleteLeadRequest;
use Modules\Customers\Http\Requests\Lead\EditLeadRequest;
use Modules\Customers\Http\Requests\Lead\ReadLeadRequest;
use Modules\Customers\Http\Resources\Lead;
use Modules\Customers\Http\Resources\LeadCollection;
use Modules\Customers\Services\LeadService;

class LeadsController extends Controller
{


    function browse(Request $request, LeadService $service)
    {

        $inputs = $request->all();

        $leads = $service->browse($inputs);
        return response(new LeadCollection($leads), 200);

    }

    function add(AddLeadRequest $request, LeadService $service)
    {
        $inputs = $request->all();

        $lead = $service->add($inputs);
        if ($lead) {
            return response(new Lead($lead), 200);
        } else {
            return response('Lead not added', 422);
        }
    }

    function edit(EditLeadRequest $request, LeadService $service, $entity)
    {
        $inputs = $request->all();

        $lead = $service->edit($inputs, $entity);
        if ($lead) {
            return response(new Lead($lead), 200);
        } else {
            return response('Lead not edit', 422);
        }
    }

    function convertToCustomer(ConvertLeadRequest $request, LeadService $service, $entity)
    {

        $lead = $service->convertToCustomer($entity);
        if ($lead) {
            return response(true, 200);
        } else {
            return response('Lead not edit', 422);
        }
    }


    function read(ReadLeadRequest $request, LeadService $service, $entity)
    {
        $lead = $service->read($entity);
        if ($lead) {
            return response(new Lead($lead), 200);
        } else {
            return response('Cannot read Lead', 422);
        }
    }

    function delete(DeleteLeadRequest $request, LeadService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Lead', 422);
        }
    }

    function restore(DeleteLeadRequest $request, LeadService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Lead', 422);
        }
    }

    function testPdf(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('leads::invoice.invoice'));
        return $pdf->stream();
    }

}
