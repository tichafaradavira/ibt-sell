<?php

namespace Modules\Customers\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Customers\Emails\SendInvoiceEmail;
use Modules\Customers\Models\Customer;
use Modules\Customers\Models\Invoice;
use Modules\Customers\Services\CustomerService;
use Modules\Users\Emails\SendForgotPasswordEmail;


class InvoiceRepository
{
    public static function browse($browse_inputs, $vendor)
    {
        $query = Invoice::query()
            ->where('user_id', $vendor->id);

        if ($type = Arr::get($browse_inputs, 'type')) {
            if ($type == 'paid') {
                $query->whereNotNull('paid_at');
            }
            if ($type == 'overdue') {
                $query->where('due_at', '<', Carbon::now())
                    ->whereNull('paid_at');
            }
            if ($type == 'pending') {
                $query->where('due_at', '>', Carbon::now())
                    ->whereNull('paid_at');
            }
        }

        $invoices = $query->paginate(15);

        return $invoices;
    }


    function add($data, $vendor)
    {
        if ($due_at = Arr::get($data, 'due_at')) {
            $data['due_at'] = Carbon::parse($due_at);
        }


        $customer = null;
        if ($customer_id = Arr::get($data, 'customer')) {
            $customer = Customer::query()->where('id', $customer_id)
                ->where('user_id', $vendor->id)
                ->first();

            if ($customer) {
                $invoice = new Invoice();
                $data['total_amount'] = $this->getTotal(Arr::get($data, 'items'), Arr::get($data, 'discount', 0));
                $data['number'] = $this->getInvoiceNumber($vendor);
                $invoice->fill($data);

                $invoice->vendor()->associate($vendor);
                $invoice->customer()->associate($customer);
                if ($invoice->save()) {
                    Mail::to($customer->email)
                        ->send(new SendInvoiceEmail($vendor, $invoice));
                    return $invoice;
                } else {
                    return false;
                }
            }

        } else {
            return false;
        }


    }

    function edit($data, $invoice)
    {
        $invoice->fill($data);
        if ($invoice->save()) {
            return $invoice;
        } else {
            return false;
        }
    }


    function markPaid($invoice)
    {
        $invoice->paid_at = Carbon::now();
        if ($invoice->save()) {
            return true;
        } else {
            return false;
        }
    }

    function read($id, $vendor)
    {
        $invoice = Invoice::query()
            ->where('id', $id)
            ->where('user_id', $vendor->id)
            ->first();

        if ($invoice) {
            return $invoice;
        } else {
            return false;
        }
    }

    function delete($id, $vendor)
    {
        $result = Invoice::query()
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
        $result = Invoice::withTrashed()
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

    function getInvoiceNumber($vendor)
    {
        $count = Invoice::query()->where('user_id', $vendor->id)->count() + 1;

        return Str::upper($vendor->id . '-' . $count . '-' . Str::random(4));
    }


}
