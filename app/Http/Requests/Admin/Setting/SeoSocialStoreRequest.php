<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SeoSocialStoreRequest extends FormRequest
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
            'site_map'=>'nullable|string',
            'author_name'=>'nullable|string',
            'google_analytics_id'=>'nullable|string',
            'social_share_ad'=>'nullable|in:0,1',
            'fb_url'=>'nullable|string',
            'twitter_url'=>'nullable|string',
            'linkedin_url'=>'nullable|string',
            'vimeo_url'=>'nullable|string',
            'youtube_url'=>'nullable|string',
            'home_page_seo_title'=>'nullable|string',
            'home_page_seo_keyword'=>'nullable|string',
            'home_page_seo_metadescription'=>'nullable|string',
            'movie_page_seo_title'=>'nullable|string',
            'movie_page_seo_keyword'=>'nullable|string',
            'movie_page_seo_metadescription'=>'nullable|string',
            'tv_series_page_seo_title'=>'nullable|string',
            'tv_series_page_seo_keyword'=>'nullable|string',
            'tv_series_page_seo_metadescription'=>'nullable|string',
            'live_tv_page_seo_title'=>'nullable|string',
            'live_tv_page_seo_keyword'=>'nullable|string',
            'live_tv_page_seo_metadescription'=>'nullable|string',
            'blog_page_seo_title'=>'nullable|string',
            'blog_page_seo_keyword'=>'nullable|string',
            'blog_page_seo_metadescription'=>'nullable|string',
        ];
    }
}
