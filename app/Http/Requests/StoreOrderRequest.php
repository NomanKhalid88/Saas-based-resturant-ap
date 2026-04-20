<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',

            'items.*.product_uuid' => 'required|exists:products,uuid',
            'items.*.quantity' => 'required|integer|min:1',

            // variations selected
            'items.*.variations' => 'nullable|array',
            'items.*.variations.*.uuid' => 'required|exists:product_variations,uuid',

            // addons selected
            'items.*.addons' => 'nullable|array',
            'items.*.addons.*.uuid' => 'required|exists:product_add_ons,uuid',
        ];
    }
}