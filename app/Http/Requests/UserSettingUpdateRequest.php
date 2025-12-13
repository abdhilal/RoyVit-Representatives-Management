<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'layout' => 'sometimes|string|in:rtl,ltr,Box',
            'sidebar_type' => 'sometimes|string|in:Vertical,Horizontal',
            'icon' => 'sometimes|string|in:Stroke,Colorful',
            'mode' => 'sometimes|string|in:Dark,Light,Mix',
            'color' => 'sometimes|string|in:#308e87,#57375D,#0766AD,#025464,#884A39,#0C356A',
        ];
    }
}
