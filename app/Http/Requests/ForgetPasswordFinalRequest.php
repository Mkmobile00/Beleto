<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class ForgetPasswordFinalRequest extends FormRequest
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
    public function rules()
    {
        return [
            'otp'=>'required|string',
            'password'=>'required|confirmed|min:8',
        ];
    }

    public function failedValidation(Validator $validate)
    {
        throw new HttpResponseException(response()->json([
            'validation'=>true,
            'data'=>'Validation Error',
            'msg'=>$validate->errors()
        ]));
    }
}
