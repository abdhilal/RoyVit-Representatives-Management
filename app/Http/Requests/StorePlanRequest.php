<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanRequest extends FormRequest
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
            'specializations_id' => 'required|array',
            'specializations_id.*' => 'exists:specializations,id',
            'product_id' => 'nullable|array',
            'product_id.*' => 'nullable|array',
            'product_id.*.*' => 'exists:products,id',
            'name' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('The :attribute field is required.'),
            'specializations_id.required' => __('The specializations field is required.'),
            'specializations_id.*.exists' => __('The selected specialization is invalid.'),
            'product_id.*.*.exists' => __('The selected product is invalid.'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('name'),
            'specializations_id' => __('specializations'),
            'product_id' => __('products'),
        ];
    }
}
