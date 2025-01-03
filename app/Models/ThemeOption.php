<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeOption extends Model
{
    use HasFactory;
    protected $fillable=[
        'website_preloader',
        'dark_theme_enable',
        'website_background_enable',
        'website_background_image',
        'landing_page_search',
        'landing_page_image',
        'frontend_theme_color',
        'header_template',
        'footer_template',
        'google_map_api',
        'google_map_lat',
        'google_map_lang',
    ];
}
