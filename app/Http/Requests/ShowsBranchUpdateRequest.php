<?php

namespace App\Http\Requests;

use App\Enum\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowsBranchUpdateRequest extends FormRequest
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
            "movies_id" => "required|exists:movies,id",
            "theater_id" => "required|exists:movie_theaters,id",
            "image" => "nullable|string",
            "summary" => "nullable|string",
            "description" => "nullable|string",
            "status" => ["required",Rule::in(UserStatusEnum::ACTIVE,UserStatusEnum::INACTIVE)]
        ];
    }
}
