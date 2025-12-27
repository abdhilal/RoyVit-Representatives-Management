<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasPermissionTo('create-areas');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:255|unique:areas,name',
            'city_id' => 'required|exists:cities,id',
        ];
    }


    public function attributes(): array
    {
        return [
            'name' => __('area name'),
            'city_id' => __('city'),
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
            'name.required' => __('area name is required'),
            'name.unique' => __('area name already exists'),
            'city_id.required' => __('city is required'),
            'city_id.exists' => __('The selected city is invalid.'),
        ];
    }
}
