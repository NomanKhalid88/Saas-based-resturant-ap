<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'uuid',
        'order_uuid',
        'product_uuid',
        'quantity',
        'price'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_uuid', 'uuid');
    }
    public function variations()
    {
        return $this->belongsTo(ProductVariation::class, 'variation_uuid', 'uuid');
    }
     public function addons()
    {
        return $this->belongsTo(ProductAddOn::class, 'addon_uuid', 'uuid');
    }
}
