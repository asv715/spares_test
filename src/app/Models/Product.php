<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected array $fillable = [
        'name',
        'sku',
        'price',
        'stock_quantity',
        'category'
    ];

    protected array $casts = [
        'price' => 'float',
        'stock_quantity' => 'integer'
    ];

    public function scopeOfId($query, array $productIds)
    {
        $query->whereIn('id', $productIds);
    }
}
