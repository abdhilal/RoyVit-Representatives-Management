<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && $this->user()->hasPermissionTo('create-orders');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',

        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => __('Title is required'),
            'description.required' => __('Description is required'),
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => __('title'),
            'description' => __('description'),
        ];
    }

}
