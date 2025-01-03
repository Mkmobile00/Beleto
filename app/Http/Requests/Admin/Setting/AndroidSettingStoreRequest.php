<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class AndroidSettingStoreRequest extends FormRequest
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
            'android_nav_menu'=>'nullable|in:0,1',
            'android_mendatory_login'=>'nullable|in:0,1',
            'android_genre_display'=>'nullable|in:0,1',
            'android_genre_country'=>'nullable|in:0,1',
            'app_version'=>'nullable|string',
            'app_version_code'=>'nullable|string',
            'app_file_url'=>'nullable|url',
            'whats_on_apk'=>'nullable|string',
            'update_skipable'=>'nullable|in:0,1',
        ];
    }
}
