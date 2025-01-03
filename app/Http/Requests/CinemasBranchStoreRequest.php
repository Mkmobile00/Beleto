<?php

namespace App\Http\Requests;

use App\Enum\CustomerEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CinemasBranchStoreRequest extends FormRequest
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
            "branch_id" => "required|unique:cinemas_branches,branch_id",
            "title" => "required|string",
            "summary" => "nullable|string",
            "description" =>"nullable|string",
            "cinemas_id" => "required|exists:cinemas,id",
            "image" => "nullable|string",
            "cities" => "required|exists:cities,id",
            "status" => ["required",Rule::in(CustomerEnum::ACTIVE,CustomerEnum::INACTIVE)],
        ];
    }
}
