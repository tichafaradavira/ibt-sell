<?php

namespace Modules\Customers\Models;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Database\Factories\CustomerFactory;
use Modules\Customers\Database\Factories\LeadFactory;
use Modules\Users\Models\User;

class Lead extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "leads";

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
        return LeadFactory::new();
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getProperties(){

        return [
            'full_name' => $this->full_name,
            'description'=> $this->description,
            'phone'=> $this->phone,
            'email'=> $this->email,
            'street_address'=> $this->street_address,
            'suburb'=> $this->suburb,
            'city'=> $this->city,
            'country'=> $this->country,
            'zip_code'=> $this->zip_code,
        ];
    }

}
