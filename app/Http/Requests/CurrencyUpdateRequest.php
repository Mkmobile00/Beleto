<?php

namespace App\Http\Requests;

use App\Enum\Setting\VideoEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CurrencyUpdateRequest extends FormRequest
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
            'title'=>'required|string|unique:currencies,title,'.$this->currency->id,
            'status'=>['required',Rule::in(VideoEnum::ACTIVE,VideoEnum::INACTIVE)],
            'value'=>'required|numeric|min:1'
        ];
    }
}
