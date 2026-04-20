<?php

namespace App\Models;

use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{ 
    use BelongsToMerchant;
    
    protected $fillable = [
        'uuid',
        'merchant_uuid',
        'user_uuid',
        'order_number',
        'total_amount',
        'status'
    ];
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_uuid', 'uuid');
    }
}
