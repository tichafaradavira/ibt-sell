<?php

namespace Modules\Transactions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Models\Customer;
use Modules\Products\Models\Product;
use Modules\Transactions\Database\Factories\ExpenseFactory;
use Modules\Users\Models\User;

class Expense extends Model
{
    use HasFactory;

    protected $table = "expenses";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'cost',
        'paid_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'description',
        'cost',
        'paid_at'

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'paid_at' => 'datetime',
    ];


    protected static function newFactory()
    {
        return ExpenseFactory::new();
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
