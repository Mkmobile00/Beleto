<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'content'=>'required|string',
            'thumbnail'=>'required|string',
            'is_file'=>'required|string',
            'status'=>'required|in:1,2',
            'meta_title'=>'nullable|string',
            'meta_keyword'=>'nullable|string',
            'meta_description'=>'nullable|string',
            'post_cat*'=>'required|exists:post_categories,id'
        ];
    }
}
