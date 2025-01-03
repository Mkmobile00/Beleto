<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanContentStoreRequest extends FormRequest
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
            'content*'=>'required|exists:categories,id',
            'device*'=>'required|exists:devices,id',
            'size'=>'required|integer',
            'video_quality'=>'required|exists:video_qualities,id',
            'audio_quality'=>'required|exists:audio_qualities,id',
            'livetv'=>'required|in:0,1',
            'addfree'=>'required|in:0,1',
            'download'=>'nullable|in:1'
        ];
    }
}
