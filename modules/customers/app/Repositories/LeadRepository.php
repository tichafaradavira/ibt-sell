<?php

namespace Modules\Customers\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Customers\Models\Customer;
use Modules\Customers\Models\Lead;

class LeadRepository
{
    public static function browse($browse_inputs, $vendor)
    {
        $query = Lead::query()
            ->where('user_id', $vendor->id);

        $leads = $query->paginate(15);

        return $leads;
    }


    function add($data, $vendor)
    {

        $lead = new Lead();
        $lead->fill($data);
        $lead->vendor()->associate($vendor);

        if ($lead->save()) {
            return $lead;
        } else {
            return false;
        }


    }

    function edit($data, $lead)
    {
        $lead->fill($data);
        if ($lead->save()) {
            return $lead;
        } else {
            return false;
        }
    }


    function convertToCustomer($lead)
    {
        $customer = new Customer();
        $customer->fill($lead->getProperties());
        $customer->vendor()->associate($lead->vendor);

        if ($customer->save()) {
            $lead->delete();
            return true;
        } else {
            return false;
        }
    }

    function read($id, $vendor)
    {
        $lead = Lead::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->first();

        if ($lead) {
            return $lead;
        } else {
            return false;
        }
    }

    function delete($id, $vendor)
    {
        $result = Lead::query()
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
        $result = Lead::withTrashed()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->restore();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }



}
