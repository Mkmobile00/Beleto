<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
            'title'=>'required|string',
            'description'=>'nullable|string',
            'link'=>'nullable|url',
            // 'location'=>'required|string',
            'status'=>'required|in:1,0',
            'event_date_nep' => 'required|date|after_or_equal:today',
            'event_date_eng' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'lng'=>'required|string',
            'lat'=>'required|string'
        ];
    }
}
