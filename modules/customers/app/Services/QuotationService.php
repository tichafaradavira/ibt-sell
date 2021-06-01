<?php

namespace Modules\Customers\Services;

use Illuminate\Support\Facades\App;
use Modules\Customers\Models\Quotation;
use Modules\Customers\Repositories\QuotationRepository;

class QuotationService
{
    protected $repository;
    protected $vendor;

    function __construct(QuotationRepository $repository)
    {
        $this->repository = $repository;
        $this->vendor = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $quotations = $this->repository->browse($inputs, $this->vendor);

        return $quotations;
    }

    function add($inputs)
    {
        $quotation = $this->repository->add($inputs, $this->vendor);

        if ($quotation) {
            return $quotation;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $quotation = Quotation::query()
        ->where('user_id', $this->vendor->id)
        ->where('id',$id)
        ->first();

        if ($quotation) {
            $quotation = $this->repository->edit($inputs, $quotation);
            return $quotation;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $quotation = $this->repository->read($id, $this->vendor);
            return $quotation;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $quotation = $this->repository->delete($id, $this->vendor);
            return $quotation;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $quotation = $this->repository->restore($id, $this->vendor);
            return $quotation;
        } else {
            return false;
        }
    }


    function generatePdfQuotation(Quotation $quotation){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('customers::invoice.quotation',['quotation' => $quotation, 'vendor' => $this->vendor]));
        return $pdf;
    }

}
