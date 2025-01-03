<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
        'logo',
        'logo2',
        'site_name',
        'quatation',
        'fb_link',
        'twitter_link',
        'linkedin_link',
        'insta_link',
        'youtube_link',
        'pinterest_link',
        'google_plus',
        'address',
        'location_url',
        'email',
        'phone',
        'contact',
        'contact_second',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'copyright'
    ];
}
