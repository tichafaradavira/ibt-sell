<?php

namespace Modules\Customers\Services;

use Modules\Customers\Models\Lead;
use Modules\Customers\Repositories\LeadRepository;

class LeadService
{
    protected $repository;
    protected $vendor;

    function __construct(LeadRepository $repository)
    {
        $this->repository = $repository;
        $this->vendor = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $leads = $this->repository->browse($inputs, $this->vendor);

        return $leads;
    }

    function add($inputs)
    {
        $lead = $this->repository->add($inputs, $this->vendor);

        if ($lead) {
            return $lead;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $lead = Lead::query()
        ->where('user_id', $this->vendor->id)
        ->where('id',$id)
        ->first();

        if ($lead) {
            $lead = $this->repository->edit($inputs, $lead);
            return $lead;
        } else {
            return false;
        }

    }



    function convertToCustomer($id)
    {
        $lead = Lead::query()
            ->where('user_id', $this->vendor->id)
            ->where('id',$id)
            ->first();

        if ($lead) {
            $lead = $this->repository->convertToCustomer($lead);
            return $lead;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $lead = $this->repository->read($id, $this->vendor);
            return $lead;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $lead = $this->repository->delete($id, $this->vendor);
            return $lead;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $lead = $this->repository->restore($id, $this->vendor);
            return $lead;
        } else {
            return false;
        }
    }


}
