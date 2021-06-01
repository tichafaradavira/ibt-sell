<?php

namespace Modules\Transactions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Models\Customer;
use Modules\Products\Models\Product;
use Modules\Transactions\Database\Factories\TransactionFactory;
use Modules\Users\Models\User;

class Transaction extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "transactions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'items',
        'description',
        'total_price',
        'paid_price',
        'discount',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'items',
        'description',
        'total_price',
        'paid_price',
        'discount',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'items' => 'array',
    ];


    protected static function newFactory()
    {
        return TransactionFactory::new();
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getProductsAttribute()
    {
        $products = Product::query()->whereIn('id', array_keys($this->items))
            ->get();
        $items = [];

        foreach ($products as $product){
            $items[$product->id] = ['product' => $product, 'count' =>  $this->items[$product->id]];
        }
        return $items;
    }


}
