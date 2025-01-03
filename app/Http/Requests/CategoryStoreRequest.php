<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enum\Layout\LayoutDesignEnum;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'title'=>'required|unique:categories,title',
            'parent_id'=>'nullable|exists:categories,id',
            'status'=>'required|in:0,1',
            'image'=>'nullable|string',
            'is_featured'=>'required|in:0,1',
            'meta_title'=>'nullable|string',
            'meta_keyword'=>'nullable|string',
            'meta_description'=>'nullable|string',
            // 'view_type'=>['nullable',Rule::in(LayoutDesignEnum::GRID,LayoutDesignEnum::SLIDER,LayoutDesignEnum::LISTHORIGENTAL,LayoutDesignEnum::LISTVERTICAL)]
            'view_type'=>['nullable',Rule::in(LayoutDesignEnum::SLIDER,LayoutDesignEnum::LISTHORIGENTAL)]
        ];
    }
}
