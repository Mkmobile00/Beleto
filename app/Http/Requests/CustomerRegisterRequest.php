<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            "email" => "required|email|unique:customers,email",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "password" => "required|min:6|confirmed",
            'g-recaptcha-response'=>'required'
        ];
    }
}
