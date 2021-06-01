<?php

namespace Modules\Users\Services;

use Modules\Users\Models\User;
use Modules\Users\Repositories\VendorRepository;
use Modules\Users\Repositories\UserRepository;

class VendorService
{
    protected $repository;

    function __construct(VendorRepository $repository)
    {
        $this->repository = $repository;
    }

    function browse($inputs)
    {
        $vendors = $this->repository->browse($inputs);

        return $vendors;
    }

    function add($inputs)
    {
        $vendor = $this->repository->add($inputs);

        if ($vendor) {
            return $vendor;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $vendor = User::find($id);

        if ($vendor) {
            $vendor = $this->repository->edit($inputs, $vendor);
            return true;
        } else {
            return false;
        }


    }

    function read($id)
    {
        if ($id) {
            $vendor = $this->repository->read($id);
            return $vendor;
        } else {
            return false;
        }


    }


    function delete($id)
    {
        if ($id) {
            $vendor = $this->repository->delete($id);
            return $vendor;
        } else {
            return false;
        }
    }

    function suspend($inputs, $id)
    {
        $vendor = User::query()->where('id', $id)
            ->where('is_admin', false)
            ->first();

        if ($vendor) {
            $vendor = $this->repository->suspend($inputs, $vendor);
            return $vendor;
        } else {
            return false;
        }
    }


    function activate($id)
    {
        $vendor = User::query()->where('id', $id)
            ->where('is_admin', false)
            ->first();

        if ($vendor) {
            $vendor = $this->repository->activate($vendor);
            return $vendor;
        } else {
            return false;
        }
    }

}
