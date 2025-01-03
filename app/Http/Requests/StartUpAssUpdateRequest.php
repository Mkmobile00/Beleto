<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enum\Customer\CustomerStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class StartUpAssUpdateRequest extends FormRequest
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
            "title" => "required|string",
            "description" => "required|string",
            "image" => "required|string",
            "from_date" => "required|date",
            "to_date" => "required|date",
            "status" => ['required',Rule::in(CustomerStatusEnum::ACTIVE,CustomerStatusEnum::INACTIVE,CustomerStatusEnum::BLOCKED)]
        ];
    }
}
