<?php

namespace Modules\Customers\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Customers\Emails\SendQuotationEmail;
use Modules\Customers\Models\Customer;
use Modules\Customers\Models\Lead;
use Modules\Customers\Models\Quotation;
use Modules\Customers\Services\CustomerService;
use Modules\Users\Emails\SendForgotPasswordEmail;


class QuotationRepository
{
    public static function browse($browse_inputs, $vendor)
    {
        $query = Quotation::query()
            ->where('user_id', $vendor->id)
            ->with(['lead','customer']);

        $quotations = $query->paginate(15);

        return $quotations;
    }


    function add($data, $vendor)
    {
        if ($expires_at = Arr::get($data, 'expires_at')) {
            $data['expires_at'] = Carbon::parse($expires_at);
        }
        $quotation = new Quotation();
        $data['total_amount'] = $this->getTotal(Arr::get($data, 'items'), Arr::get($data, 'discount', 0));
        $data['number'] = $this->getQuotationNumber($vendor);
        $quotation->fill($data);


        $customer = null;
        if ($customer_id = Arr::get($data, 'customer')) {
            $customer = Customer::query()->where('id', $customer_id)
                ->where('user_id', $vendor->id)
                ->first();
            if ($customer) {
                $quotation->vendor()->associate($vendor);
                $quotation->customer()->associate($customer);
                if ($quotation->save()) {
                    Mail::to($customer->email)
                        ->send(new SendQuotationEmail($vendor, $quotation));
                    return $quotation;
                } else {
                    return false;
                }
            }

        }

        if ($lead_id = Arr::get($data, 'lead')) {
            $lead = Lead::query()->where('id', $lead_id)
                ->where('user_id', $vendor->id)
                ->first();
            if ($lead) {
                $quotation->vendor()->associate($vendor);
                $quotation->lead()->associate($lead);
                if ($quotation->save()) {
                    Mail::to($lead->email)
                        ->send(new SendQuotationEmail($vendor, $quotation));
                    return $quotation;
                } else {
                    return false;
                }
            }

        }

        return false;
    }

    function edit($data, $quotation)
    {
        $quotation->fill($data);
        if ($quotation->save()) {
            return $quotation;
        } else {
            return false;
        }
    }

    function read($id, $vendor)
    {
        $quotation = Quotation::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->with(['lead','customer'])
            ->first();

        if ($quotation) {
            return $quotation;
        } else {
            return false;
        }
    }

    function delete($id, $vendor)
    {
        $result = Quotation::query()
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
        $result = Quotation::withTrashed()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->restore();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function getTotal($items, $discount = 0)
    {
        $total = 0.0;

        foreach ($items as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        if ($discount) {
            $discount = ($discount / 100) * $total;
        }
        return ($total - $discount);
    }

    function getQuotationNumber($vendor)
    {
        $count = Quotation::query()->where('user_id', $vendor->id)->count() + 1;

        return Str::upper($vendor->id . '-' . $count . '-' . Str::random(4));
    }
}
