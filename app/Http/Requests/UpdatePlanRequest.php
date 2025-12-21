<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() ? auth()->user()->can('update-plans') : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'specializations_id' => 'nullable|array',
            'specializations_id.*' => 'exists:specializations,id',
            'product_id' => 'nullable|array',
            'product_id.*' => 'exists:products,id',
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
            'specializations_id.*.exists' => __('The selected specialization is invalid.'),
            'product_id.*.exists' => __('The selected product is invalid.'),
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
