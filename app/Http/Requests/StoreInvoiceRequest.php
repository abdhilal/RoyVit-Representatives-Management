<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasPermissionTo('create-invoices');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'representative_id' => 'required|exists:users,id',
            'product_id' => 'required|array',
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'representative_id.required' => __('representative is required'),
            'representative_id.exists' => __('representative must exist'),
            'product_id.required' => __('product is required'),
            'product_id.array' => __('product is required'),
            'product_id.*.required' => __('product is required'),
            'product_id.*.exists' => __('product must exist'),
            'quantity.required' => __('quantity is required'),
            'quantity.array' => __('quantity is required'),
            'quantity.*.required' => __('quantity is required'),
            'quantity.*.integer' => __('quantity must be an integer'),
            'quantity.*.min' => __('quantity must be at least 1'),
        ];
    }

    public function attributes(): array
    {
        return [
            'representative_id' => __('representative'),
            'product_id' => __('product'),
            'quantity' => __('quantity'),
            'note' => __('note'),
        ];
    }
}
