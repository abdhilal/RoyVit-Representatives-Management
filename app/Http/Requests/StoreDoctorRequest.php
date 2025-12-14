<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasPermissionTo('create-doctors');
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
            'phone' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'area_id' => 'required|exists:areas,id',
            'classification_id' => 'required|exists:classifications,id',
            'specialization_id' => 'required|exists:specializations,id',
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => __('Name is required'),
            'phone.required' => __('Phone is required'),
            'address.required' => __('Address is required'),
            'gender.required' => __('Gender is required'),
            'gender.in' => __('Gender must be male or female'),
            'area_id.required' => __('Area is required'),
            'classification_id.required' => __('Classification is required'),
            'specialization_id.required' => __('Specialization is required'),
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => __('Name'),
            'phone' => __('Phone'),
            'address' => __('Address'),
            'gender' => __('Gender'),
            'area_id' => __('Area'),
            'classification_id' => __('Classification'),
            'specialization_id' => __('Specialization'),
        ];
    }
}
