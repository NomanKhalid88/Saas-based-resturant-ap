<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAddOn extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'uuid',
        'product_uuid',
        'name',
        'price',
        'is_active'
    ];
}
