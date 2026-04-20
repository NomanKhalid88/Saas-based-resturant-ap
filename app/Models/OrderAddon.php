<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddon extends Model
{
    protected $fillable = [
        'uuid',
        'order_item_uuid',
        'name',
        'price'
    ];
}
