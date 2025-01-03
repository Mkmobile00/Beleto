<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class EmailSettingStoreRequest extends FormRequest
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
            'contact_email'=>'nullable|email',
            'mail_type'=>'nullable|in:smtp,mail',
            'smtp_server_address'=>'nullable|string',
            'smtp_username'=>'nullable|string',
            'smtp_password'=>'nullable|string',
            'smtp_port'=>'nullable|string',
            'smtp_crypto'=>'nullable|in:ssl,tls'
        ];
    }
}
