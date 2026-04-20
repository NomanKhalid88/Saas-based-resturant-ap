<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderVariation;
use App\Models\OrderAddon;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductAddon;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $total = 0;

            // 1. Create Order
            $order = Order::create([
                'uuid' => generateUuidKey(),
                'merchant_uuid' => auth()->user()->merchant_uuid,
                'user_uuid' => auth()->user()->uuid,
                'status' => 'pending',
                'order_number' => 'ORD-' . strtoupper(substr(generateUuidKey(), 0, 8)),
                'total_amount' => 0,
            ]);

            // 2. Loop Items
            foreach ($data['items'] as $item) {

                $product = Product::where('uuid', $item['product_uuid'])->first();

                $itemPrice = $product->base_price;
                $quantity = $item['quantity'];

                // Create Order Item
                $orderItem = OrderItem::create([
                    'uuid' => generateUuidKey(),
                    'order_uuid' => $order->uuid,
                    'product_uuid' => $product->uuid,
                    'quantity' => $quantity,
                    'price' => $product->base_price,
                ]);

                /*
                |--------------------------------------------------------------------------
                | VARIATIONS PRICE
                |--------------------------------------------------------------------------
                */
                if (!empty($item['variations'])) {
                    foreach ($item['variations'] as $variationData) {

                        $variation = ProductVariation::where('uuid', $variationData['uuid'])->first();

                        $itemPrice += $variation->price;

                        OrderVariation::create([
                            'uuid' => generateUuidKey(),
                            'order_item_uuid' => $orderItem->uuid,
                            'name' => $variation->name,
                            'value' => $variation->value,
                            'price' => $variation->price,
                        ]);
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | ADDONS PRICE
                |--------------------------------------------------------------------------
                */
                if (!empty($item['addons'])) {
                    foreach ($item['addons'] as $addonData) {

                        $addon = ProductAddon::where('uuid', $addonData['uuid'])->first();

                        $itemPrice += $addon->price;

                        OrderAddon::create([
                            'uuid' => generateUuidKey(),
                            'order_item_uuid' => $orderItem->uuid,
                            'name' => $addon->name,
                            'price' => $addon->price,
                        ]);
                    }
                }

                // Final item total
                $lineTotal = $itemPrice * $quantity;
                $total += $lineTotal;

                // Update item price
                $orderItem->update([
                    'price' => $itemPrice
                ]);
            }

            // 3. Update order total
            $order->update([
                'total_amount' => $total
            ]);

            return $order->load(['items', 'items.variations', 'items.addons']);
        });
    }
}