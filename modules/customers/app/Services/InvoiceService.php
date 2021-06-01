<?php

namespace Modules\Customers\Services;

use Illuminate\Support\Facades\App;
use Modules\Customers\Models\Invoice;
use Modules\Customers\Repositories\InvoiceRepository;

class InvoiceService
{
    protected $repository;
    protected $vendor;

    function __construct(InvoiceRepository $repository)
    {
        $this->repository = $repository;
        $this->vendor = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $invoices = $this->repository->browse($inputs, $this->vendor);

        return $invoices;
    }

    function add($inputs)
    {
        $invoice = $this->repository->add($inputs, $this->vendor);

        if ($invoice) {
            return $invoice;
        } else {
            return false;
        }
    }


    function edit($inputs, $id)
    {
        $invoice = Invoice::query()
        ->where('user_id', $this->vendor->id)
        ->where('id',$id)
        ->first();

        if ($invoice) {
            $invoice = $this->repository->edit($inputs, $invoice);
            return $invoice;
        } else {
            return false;
        }

    }

    function markPaid($id)
    {
        $invoice = Invoice::query()
        ->where('user_id', $this->vendor->id)
        ->where('id',$id)
        ->first();

        if ($invoice) {
            $invoice = $this->repository->markPaid( $invoice);
            return $invoice;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $invoice = $this->repository->read($id, $this->vendor);
            return $invoice;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $invoice = $this->repository->delete($id, $this->vendor);
            return $invoice;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $invoice = $this->repository->restore($id, $this->vendor);
            return $invoice;
        } else {
            return false;
        }
    }


    function generatePdfInvoice(Invoice $invoice){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('customers::invoice.invoice',['invoice' => $invoice, 'vendor' => $this->vendor]));
        return $pdf;
    }

}
