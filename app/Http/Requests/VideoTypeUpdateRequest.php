<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoTypeUpdateRequest extends FormRequest
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
            'title'=>'required|unique:video_types,title,'.$this->videoType->id,
            'description'=>'nullable|string',
            'status'=>'required|in:0,1',
            'primary_menu'=>'nullable|in:0,1',
            'footer_menu'=>'nullable|in:0,1'
        ];
    }
}
