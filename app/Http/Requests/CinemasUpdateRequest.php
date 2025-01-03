<?php

namespace App\Http\Requests;

use App\Enum\CustomerEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CinemasUpdateRequest extends FormRequest
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
            "cinemas_unique_code" => "required|unique:cinemas,cinemas_unique_code,".$this->cinema->id,
            "title" => "required|string",
            "summary" => "nullable|string",
            "description" => "nullable|string",
            "image" => "nullable|string",
            "status" => ["required",Rule::in(CustomerEnum::ACTIVE,CustomerEnum::INACTIVE)],
            "cities*"=>"required|exists:cities,id"
        ];
    }
}
