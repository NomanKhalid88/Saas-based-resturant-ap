<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderVariation extends Model
{
    protected $fillable = [
        'uuid',
        'order_item_uuid',
        'name',
        'value'
    ];
}
