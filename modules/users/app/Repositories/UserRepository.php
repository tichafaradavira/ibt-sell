<?php

namespace Modules\Users\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Users\Emails\SendEmailVerifyUserEmail;
use Modules\Users\Emails\SendForgotPasswordEmail;
use Modules\Users\Models\User;

class UserRepository
{


    function signup($data)
    {
        if ($password = Arr::get($data, 'password')) {
            $data['password'] = Hash::make($password);
        }

        $data['otp'] = $this->generateOtp();
        $data['otp_expires_at'] = Carbon::now()->addMinutes(60);
        $user = User::create($data);


        if ($user->save()) {
            Mail::to($user->email)
                ->send(new SendEmailVerifyUserEmail($user));

            return $user;
        } else {
            return false;
        }


    }

    function forgotPassword($user)
    {
        $user->otp = $this->generateOtp();
        $user->otp_expires_at = Carbon::now()->addMinutes(60);
        $user->save();

        Mail::to($user->email)
            ->send(new SendForgotPasswordEmail($user));

        return true;
    }


    function resetPassword($data, $user)
    {
        if ($user->otp_expires_at > Carbon::now()) {
            $user->email_verified_at = Carbon::now();
            $user->password = Hash::make(Arr::get($data, 'password'));
            $user->save();
            return true;
        } else {
            return false;

        }

    }


    function verifyEmail($data, $user)
    {
        if ($otp = Arr::get($data, 'otp')) {
            if ($otp == $user->otp && $user->otp_expires_at > Carbon::now()) {
                $user->email_verified_at = Carbon::now();
                $user->save();
                return $user;
            } else {
                return false;
            }
        }

        return false;


    }


    function updateProfile($data, $user)
    {
//        if($email = Arr::get($data, 'email'))
//        {
//            if($email !== $user->email){
//                Mail::to($email)
//                    ->send(new SendEmailVerifyUserEmail($user));
//            }
//        }

        $user = User::where('id', $user->id)
            ->first();

        $user->fill($data);
        $user->save();

        return $user;

    }

    public function generateOtp()
    {
        return rand(10000, 99999);
    }


}
