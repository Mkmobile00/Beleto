<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;
    protected $fillable=[
        'theme',
        'logo',
        'purchase_code',
        'time_zone',
        'site_name',
        'site_url',
        'system_email',
        'bussiness_address',
        'bussiness_phone',
        'contact_email',
        'registration_enable',
        'frontend_login',
        'blog_enable',
        'show_country_to_main',
        'show_genre_to_main',
        'show_release_to_main',
        'show_contact_to_main',
        'show_contact_to_footer',
        'show_actordirwr_image_to_main',
        'show_azlist_to_main',
        'show_azlist_to_footer',
        'enable_movie_report',
        'movie_report_send_to',
        'movie_report_attention_text',
        'enable_movie_request',
        'movie_request_send_to',
        'enable_google_captcha',
        'google_captcha_sitekey',
        'google_captcha_secretkey',
        'fb_link',
        'insta_link',
        'twitter_link',
        'youtube_link',
        'android_link',
        'apple_link'
    ];
}

