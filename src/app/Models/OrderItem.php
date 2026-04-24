<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false;

    protected array $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price'
    ];

    protected array $casts = [
        'quantity' => 'integer',
        'unit_price' => 'float',
        'total_price' => 'float'
    ];

    protected array $with = ['product'];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
