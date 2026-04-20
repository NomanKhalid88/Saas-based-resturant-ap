<?php

namespace App\Models;

use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes, BelongsToMerchant;

    protected $fillable = [
        'uuid',
        'merchant_uuid',
        'name'
    ];
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_uuid', 'uuid');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_uuid', 'uuid');
    }
}
