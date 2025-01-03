<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AndroidSetting extends Model
{
    use HasFactory;
    protected $fillable=[
        'android_nav_menu',
        'android_mendatory_login',
        'android_genre_display',
        'android_genre_country',
        'app_version',
        'app_version_code',
        'app_file_url',
        'whats_on_apk',
        'update_skipable',
    ];
}
