<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSocial extends Model
{
    use HasFactory;
    protected $fillable=[
        'site_map',
        'author_name',
        'google_analytics_id',
        'social_share_ad',
        'fb_url',
        'twitter_url',
        'linkedin_url',
        'vimeo_url',
        'youtube_url',
        'home_page_seo_title',
        'home_page_seo_keyword',
        'home_page_seo_metadescription',
        'movie_page_seo_title',
        'movie_page_seo_keyword',
        'movie_page_seo_metadescription',
        'tv_series_page_seo_title',
        'tv_series_page_seo_keyword',
        'tv_series_page_seo_metadescription',
        'live_tv_page_seo_title',
        'live_tv_page_seo_keyword',
        'live_tv_page_seo_metadescription',
        'blog_page_seo_title',
        'blog_page_seo_keyword',
        'blog_page_seo_metadescription',
    ];
}
