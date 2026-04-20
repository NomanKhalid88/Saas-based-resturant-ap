<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone',
        'address',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'merchant_uuid', 'uuid');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'merchant_uuid', 'uuid');
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'merchant_uuid', 'uuid');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'merchant_uuid', 'uuid');
    }
}
