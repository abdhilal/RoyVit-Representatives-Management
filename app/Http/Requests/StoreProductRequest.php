<?php

namespace App\Http\Requests;

use App\Enums\ProductType;
use App\Enums\ProductsType;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasPermissionTo('create-products');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => ['required', new Enum(ProductsType::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('name is required'),
            'type.required' => __('products type is required'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('name'),
            'type' => __('products type'),
        ];
    }
}
