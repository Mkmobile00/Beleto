<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ThemeOptionStoreRequest extends FormRequest
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
            'website_preloader'=>'nullable|in:0,1',
            'dark_theme_enable'=>'nullable|in:0,1',
            'website_background_enable'=>'nullable|in:0,1',
            'website_background_image'=>'nullable|string',
            'landing_page_search'=>'nullable|in:0,1',
            'landing_page_image'=>'nullable|string',
            'frontend_theme_color'=>'nullable|string',
            'header_template'=>'nullable|string',
            'footer_template'=>'nullable|string',
            'google_map_api'=>'nullable|string',
            'google_map_lat'=>'nullable|string',
            'google_map_lang'=>'nullable|string',
        ];
    }
}
