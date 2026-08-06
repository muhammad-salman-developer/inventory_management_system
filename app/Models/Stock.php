<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'product_id', 'type', 'direction', 'quantity',
        'stock_before', 'stock_after',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
