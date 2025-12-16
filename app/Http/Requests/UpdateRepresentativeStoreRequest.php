<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepresentativeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasPermissionTo('update-representative_stores');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => 'required|integer|min:1',
        ];


    }

    public function messages(): array
    {
        return [
            'quantity.required' => __('quantity is required'),
            'quantity.integer' => __('quantity must be an integer'),
            'quantity.min' => __('quantity must be at least 1'),
        ];
    }

    public function attributes(): array
    {
        return [
            'quantity' => __('quantity'),
        ];
    }
}
