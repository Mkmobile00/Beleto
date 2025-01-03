<?php

namespace App\Http\Requests;

use App\Enum\Setting\VideoEnum;
use Illuminate\Validation\Rule;
use App\Enum\Layout\LayoutDesignEnum;
use Illuminate\Foundation\Http\FormRequest;
use App\Enum\FeaturedSection\FeaturedSectionTypeEnum;

class FeaturedSetionStoreRequest extends FormRequest
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
            "title" => "required|string",
            "image" => "nullable|string",
            "type" => ["required",Rule::in(FeaturedSectionTypeEnum::CATEGORY,FeaturedSectionTypeEnum::TVSERIES,FeaturedSectionTypeEnum::WEBSERIES,FeaturedSectionTypeEnum::MOVIES)],
            "status" => ["required",Rule::in(VideoEnum::ACTIVE,VideoEnum::INACTIVE)],
            "meta_title" => "nullable|string",
            "meta_keyword" => "nullable|string",
            "meta_description" => "nullable|string",
            // 'view_type'=>['nullable',Rule::in(LayoutDesignEnum::GRID,LayoutDesignEnum::SLIDER,LayoutDesignEnum::LISTHORIGENTAL,LayoutDesignEnum::LISTVERTICAL)]
            'view_type'=>['nullable',Rule::in(LayoutDesignEnum::SLIDER,LayoutDesignEnum::LISTHORIGENTAL)]
        ];
    }
}
