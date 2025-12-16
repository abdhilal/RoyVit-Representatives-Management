<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepresentativeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasPermissionTo('create-representative_stores');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'representative_id' => ['required', 'exists:users,id'],
            'product_id' => ['required', 'exists:products,id'],
            'warehouse_id' => ['required', 'exists:warehouses,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'representative_id.required' => __('representative is required'),
            'representative_id.exists' => __('representative must exist'),
            'product_id.required' => __('product is required'),
            'product_id.exists' => __('product must exist'),
            'warehouse_id.required' => __('warehouse is required'),
            'warehouse_id.exists' => __('warehouse must exist'),
            'quantity.required' => __('quantity is required'),
            'quantity.integer' => __('quantity must be an integer'),
            'quantity.min' => __('quantity must be at least 1'),
        ];
    }

    public function attributes(): array
    {
        return [
            'representative_id' => __('representative'),
            'product_id' => __('product'),
            'warehouse_id' => __('warehouse'),
            'quantity' => __('quantity'),
        ];
    }
}
