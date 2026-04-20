<?php
namespace App\Traits;

use App\Scopes\MerchantScope;

trait BelongsToMerchant
{
    protected static function bootBelongsToMerchant()
    {
        static::addGlobalScope(new MerchantScope);

        static::creating(function ($model) {
            if (auth()->check()) {
                $model->merchant_uuid = auth()->user()->merchant_uuid;
            }
        });
    }
}