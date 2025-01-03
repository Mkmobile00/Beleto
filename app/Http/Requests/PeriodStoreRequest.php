<?php

namespace App\Http\Requests;

use App\Enum\Period\PeriodTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeriodStoreRequest extends FormRequest
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
            'value' => 'required|integer|min:1',
            'type'  => ['required', Rule::in(PeriodTypeEnum::MONTH, PeriodTypeEnum::YEAR)],
        ];
    }
}
