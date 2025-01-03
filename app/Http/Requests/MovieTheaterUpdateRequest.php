<?php

namespace App\Http\Requests;

use App\Enum\CustomerEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovieTheaterUpdateRequest extends FormRequest
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
            "theater_unique_id" => "required|unique:movie_theaters,theater_unique_id,".$this->movietheater->id,
            "title" => "required|string",
            "screen_id" => "nullable|nullable",
            "seat_capacity" => "nullable|nullable",
            "summary" => "nullable|nullable",
            "description" => "nullable|nullable",
            "cinemas_id" => "required|exists:cinemas,id",
            "image" => "nullable|string",
            "cinemas_branch_id" => "required|exists:cinemas_branches,id",
            "status" => ["required",Rule::in(CustomerEnum::ACTIVE,CustomerEnum::INACTIVE)],
            "city_id" => "required|exists:cities,id"
        ];
    }
}
