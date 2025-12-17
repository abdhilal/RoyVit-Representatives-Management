<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorVisitRequest extends FormRequest
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
            'doctor_id' => 'required|exists:doctors,id',
            'product_id' => 'required|array',
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'visit_date' => 'required|date',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'note' => 'nullable|string',
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
            'doctor_id.required' => __('The doctor field is required.'),
            'product_id.required' => __('The product field is required.'),
            'quantity.required' => __('The quantity field is required.'),
            'visit_date.required' => __('The visit date field is required.'),
        ];
    }


    public function attributes(): array
    {
        return [
            'doctor_id' => __('Doctor'),
            'product_id' => __('Product'),
            'quantity' => __('Quantity'),
            'visit_date' => __('Visit Date'),
            'attachment' => __('Attachment'),
            'note' => __('Note'),
        ];
    }
}
