<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanStoreRequest extends FormRequest
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
            'title'=>'required|string|unique:plans,title',
            'premium_content'=>'required|in:0,1',
            'device*'=>'nullable|exists:devices,id',
            'screensize'=>'required|integer',
            'video_quality*'=>'required|exists:video_qualities,id',
            'audio_quality*'=>'required|exists:audio_qualities,id',
            'livetv'=>'nullable|in:0,1',
            'addfree'=>'nullable|in:0,1',
            'download'=>'nullable|in:0,1',
            'status'=>'required|in:active,inactive'
        ];
    }
}
