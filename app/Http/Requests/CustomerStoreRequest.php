<?php

namespace App\Http\Requests;

use App\Enum\GenderEnum;
use Illuminate\Validation\Rule;
use App\Enum\Customer\CustomerStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            "email" => "required|email|unique:customers,email",
            "password" => "required|min:6|confirmed",
            "password_confirmation" => "required|min:6",
            "first_name" => "nullable|string",
            "last_name" => "nullable|string",
            "status" => ["required",Rule::in(CustomerStatusEnum::ACTIVE,CustomerStatusEnum::INACTIVE,CustomerStatusEnum::BLOCKED)],
            "gender" => ["required",Rule::in(GenderEnum::MALE,GenderEnum::FEMALE,GenderEnum::OTHER)],
            "date_of_birth" => "nullable|string",
            "photo" => "nullable|string",
            "phone" => "nullable|unique:customers,phone"
        ];
    }
}
