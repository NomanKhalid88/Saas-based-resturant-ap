<?php

namespace App\Models;

use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes,BelongsToMerchant;

    protected $fillable = [
        'uuid',
        'merchant_uuid',
        'category_uuid',
        'name',
        'description',
        'base_price',
        'is_active'
    ];
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_uuid', 'uuid');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_uuid', 'uuid');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_uuid', 'uuid');
    }

    public function addons()
    {
        return $this->hasMany(ProductAddOn::class, 'product_uuid', 'uuid');
    }
}
