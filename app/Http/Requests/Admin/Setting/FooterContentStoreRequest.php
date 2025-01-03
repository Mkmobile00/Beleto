<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class FooterContentStoreRequest extends FormRequest
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
            'footer_title1'=>'nullable|string',
            'footer_content1'=>'nullable|string',
            'footer_title2'=>'nullable|string',
            'footer_content2'=>'nullable|string',
            'footer_title3'=>'nullable|string',
            'footer_content3'=>'nullable|string',
            'copyright'=>'nullable|string'
        ];
    }
}
