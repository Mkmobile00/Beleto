<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitorStoreRequest extends FormRequest
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
            "first_name" => "required|string",
            "middle_name" => "nullable|string",
            "last_name" => "required|string",
            "gender" => "required|in:1,2,3",
            "citizenship_num" => "required|string",
            "issue_district" => "required|exists:districts,id",
            "issue_date" => "required|date",
            "contact_number" => "nullable|string",
            "email" => "required|email",
            "dob1" => "required|date",
            "dob2" => "nullable|date",
            "age" => "nullable|string",
            "martial_status" => "required|in:1,2",
            "occupation" => "nullable|string",
            "permanent_country" => "nullable|string",
            "permanent_province" => "nullable|exists:provinces,id",
            "permanent_district" => "nullable|exists:districts,id",
            "permanent_muncipality" => "nullable|exists:locals,id",
            "permanent_ward_num" => "nullable|string",
            "permanent_town" => "nullable|string",
            "permanent_postal_code" => "nullable|string",
            "permanent_street_num" => "nullable|string",
            "permanent_house_num" => "nullable|string",
            "temporary_country" => "nullable|string",
            "temporary_province" => "nullable|exists:provinces,id",
            "temporary_district" => "nullable|exists:districts,id",
            "temporary_muncipality" => "nullable|exists:locals,id",
            "temporary_ward_num" => "nullable|string",
            "temporary_town" => "nullable|string",
            "temporary_postal_code" => "nullable|string",
            "temporary_street_num" => "nullable|string",
            "temporary_house_num" => "nullable|string",
            "father_name" => "nullable|string",
            "grandfather_name" => "nullable|string",
            "mother_name" => "nullable|string",
            "passtype"=>"required|exists:pass_types,id",
            'photo'=>"nullable|string",
            'citizenship_photo'=>"nullable|string",
            'nationalcard_photo'=>"nullable|string",
            'votercard_photo'=>"nullable|string",
            'otherdocument_photo'=>"nullable|string"
        ];
    }
}
