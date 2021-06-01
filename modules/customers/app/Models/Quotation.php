<?php

namespace Modules\Customers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Database\Factories\InvoiceFactory;
use Modules\Customers\Database\Factories\QuotationFactory;
use Modules\Users\Models\User;

class Quotation extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "quotations";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'discount',
        'items',
        'total_amount',
        'number',
        'summary',
        'expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'discount',
        'items',
        'total_amount',
        'number',
        'summary',
        'expires_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d',
        'expires_at' => 'datetime:Y-m-d',
        'items' => 'array',
    ];


    protected static function newFactory()
    {
        return QuotationFactory::new();
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id')->withTrashed();
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id')->withTrashed();
    }

}
