<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemStoreRequest extends FormRequest
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
            'theme'=>'nullable|string',
            'logo'=>'nullable|string',
            'purchase_code'=>'nullable|string',
            'time_zone'=>'nullable|string',
            'site_name'=>'nullable|string',
            'site_url'=>'nullable|string',
            'system_email'=>'nullable|email',
            'bussiness_address'=>'nullable|string',
            'bussiness_phone'=>'nullable|int',
            'contact_email'=>'nullable|email',
            'registration_enable'=>'nullable|in:0,1',
            'frontend_login'=>'nullable|in:0,1',
            'blog_enable'=>'nullable|in:0,1',
            'show_country_to_main'=>'nullable|in:0,1',
            'show_genre_to_main'=>'nullable|in:0,1',
            'show_release_to_main'=>'nullable|in:0,1',
            'show_contact_to_main'=>'nullable|in:0,1',
            'show_contact_to_footer'=>'nullable|in:0,1',
            'show_actordirwr_image_to_main'=>'nullable|in:0,1',
            'show_azlist_to_main'=>'nullable|in:0,1',
            'show_azlist_to_footer'=>'nullable|in:0,1',
            'enable_movie_report'=>'nullable|in:0,1',
            'movie_report_send_to'=>'nullable|email',
            'movie_report_attention_text'=>'nullable|string',
            'enable_movie_request'=>'nullable|in:0,1',
            'movie_request_send_to'=>'nullable|email',
            'enable_google_captcha'=>'nullable|in:0,1',
            'google_captcha_sitekey'=>'nullable|string',
            'google_captcha_secretkey'=>'nullable|string',
            'fb_link'=>'nullable|url',
            'insta_link'=>'nullable|url',
            'twitter_link'=>'nullable|url',
            'youtube_link'=>'nullable|url',
            'android_link'=>'nullable|url',
            'apple_link'=>'nullable|url',
        ];
    }
}
