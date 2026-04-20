<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            // Product fields
            'category_uuid' => 'required|exists:product_categories,uuid',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',

            // Variations (nested array)
            'variations' => 'nullable|array',
            'variations.*.name' => 'required_with:variations|string|max:255',
            'variations.*.value' => 'required_with:variations|string|max:255',
            'variations.*.price' => 'nullable|numeric|min:0',

            // Addons (nested array)
            'addons' => 'nullable|array',
            'addons.*.name' => 'required_with:addons|string|max:255',
            'addons.*.price' => 'required_with:addons|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'category_uuid.required' => 'Category is required',
            'category_uuid.exists' => 'Invalid category',

            'name.required' => 'Product name is required',
            'base_price.required' => 'Base price is required',

            'variations.*.name.required_with' => 'Variation name is required',
            'variations.*.value.required_with' => 'Variation value is required',

            'addons.*.name.required_with' => 'Addon name is required',
            'addons.*.price.required_with' => 'Addon price is required',
        ];
    }
}
