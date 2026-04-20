<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\ProductVariation;
use App\Models\ProductAddon;
use Illuminate\Support\Facades\DB;
use App\Events\ProductCreated;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepo
    ) {}

    public function list()
    {
        return $this->productRepo->allWithRelations();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $product = $this->productRepo->create([
                'uuid' => generateUuidKey(),
                'merchant_uuid' => auth()->user()->merchant_uuid,
                'category_uuid' => $data['category_uuid'],
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'base_price' => $data['base_price'],
            ]);

            // Variations
            foreach ($data['variations'] ?? [] as $variation) {
                ProductVariation::create([
                    'uuid' => generateUuidKey(),
                    'merchant_uuid' => auth()->user()->merchant_uuid,
                    'product_uuid' => $product->uuid,
                    'name' => $variation['name'],
                    'value' => $variation['value'],
                    'price' => $variation['price'] ?? 0,
                ]);
            }

            // Addons
            foreach ($data['addons'] ?? [] as $addon) {
                ProductAddon::create([
                    'uuid' => generateUuidKey(),
                    'merchant_uuid' => auth()->user()->merchant_uuid,
                    'product_uuid' => $product->uuid,
                    'name' => $addon['name'],
                    'price' => $addon['price'],
                ]);
            }
            Cache::forget("products_" . auth()->user()->merchant_uuid);
            // Fire Ev  ent
            event(new ProductCreated($product));

            return $product->load(['variations', 'addons']);
        });
    }
}