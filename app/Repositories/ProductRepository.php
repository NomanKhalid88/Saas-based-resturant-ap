<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductRepository
{
    public function allWithRelations()
    {
        $merchantUuid = auth()->user()->merchant_uuid;

        return Cache::remember(
            "products_{$merchantUuid}",
            now()->addMinutes(10),
            function () use ($merchantUuid) {
                return Product::with(['variations', 'addons'])
                    ->where('merchant_uuid', $merchantUuid)
                    ->latest()
                    ->get();
            }
        );
    }

    public function create(array $data)
    {
        return Product::create($data);
    }
}
