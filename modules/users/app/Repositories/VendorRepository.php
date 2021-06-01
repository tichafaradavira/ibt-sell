<?php

namespace Modules\Users\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Users\Emails\ActivateAccountEmail;
use Modules\Users\Emails\AddVendorVerifyUserEmail;
use Modules\Users\Emails\SuspendAccountEmail;
use Modules\Users\Models\User;

class VendorRepository
{
    public static function browse($browse_inputs)
    {
        $query = User::query();

        $vendors = $query->paginate(15);

        return $vendors;
    }


    function add($data)
    {
        $temporary_password = Str::random(8);
        $data['password'] = Hash::make($temporary_password);
        $data['dob'] = Carbon::now();
        $data['user_type'] = 'vendor';


        $vendor = User::create($data);


        if ($vendor->save()) {
            Mail::to($vendor->email)
                ->send(new AddVendorVerifyUserEmail($vendor, $temporary_password));

            return $vendor;
        } else {
            return false;
        }


    }

    function edit($data, $vendor)
    {
        $data['dob'] = Carbon::parse($data['dob']);
        $saved = User::where('id', $vendor->id)
            ->update($data);
        if ($saved) {
            return $vendor;
        } else {
            return false;
        }
    }

    function read($id)
    {
        $vendor = User::query()
            ->where('id', $id)
            ->first();

        if ($vendor) {
            return $vendor;
        }
    }

    function suspend($data, $vendor)
    {
        $vendor->suspended_at = Carbon::now();

        if ($vendor->save()) {

            if ($message = Arr::get($data, 'message')) {
                Mail::to($vendor->email)
                    ->send(new SuspendAccountEmail($vendor, $message));
            }

            return $vendor;
        } else {
            return false;
        }
    }

    /**
     * @param $vendor
     * @return false
     */
    function activate($vendor)
    {
        $vendor->suspended_at = null;

        if ($vendor->save()) {
            Mail::to($vendor->email)
                ->send(new ActivateAccountEmail($vendor));


            return $vendor;
        } else {
            return false;
        }
    }


}
