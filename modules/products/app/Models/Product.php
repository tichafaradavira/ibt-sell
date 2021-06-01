<?php

namespace Modules\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Products\Database\Factories\ProductFactory;
use Modules\Users\Models\User;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "products";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'buying_price',
        'selling_price',
        'quantity',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'name',
        'description',
        'buying_price',
        'selling_price',
        'quantity',
        'vendor'

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
        return ProductFactory::new();
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
