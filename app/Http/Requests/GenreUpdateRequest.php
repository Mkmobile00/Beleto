<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreUpdateRequest extends FormRequest
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
            'title'=>'required|unique:genres,title,'.$this->genre->id,
            'status'=>'required|in:0,1',
            'image'=>'nullable|string',
            'is_featured'=>'required|in:0,1',
            'description'=>'nullable|string'
        ];
    }
}
