<?php
namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Passport\HasApiTokens;
use Modules\Users\Database\Factories\UserFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    use HasFactory;

    protected  $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_admin',
        'first_name' ,
        'last_name' ,
        'company_name' ,
        'email',
        'country',
        'language',
        'otp' ,
        'settings',
        'otp_expires_at' ,
        'phone_number',
        'password',
        'recovery_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'is_admin',
        'first_name' ,
        'last_name' ,
        'company_name' ,
        'email',
        'country',
        'otp' ,
        'settings',
        'otp_verified_at' ,
        'language',
        'phone_number',
        'recovery_token',
        'suspended_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'suspended_at' => 'datetime',
        'otp_verified_at' => 'datetime',
        'settings' => 'array',
    ];



    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
