<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
    'supplier_id',
    'date',
    'tax',
    'discount',
    'total_amount',
    'status',

    ];
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function items(){
        return $this->hasMany(PurchaseItem::class);
    }
}
