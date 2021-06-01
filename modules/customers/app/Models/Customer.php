<?php

namespace Modules\Customers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Database\Factories\CustomerFactory;
use Modules\Users\Models\User;

class Customer extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "customers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'description',
        'phone',
        'email',
        'street_address',
        'suburb',
        'city',
        'country',
        'zip_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'full_name',
        'description',
        'phone',
        'email',
        'street_address',
        'suburb',
        'city',
        'country',
        'zip_code',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];


    protected static function newFactory()
    {
        return CustomerFactory::new();
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
