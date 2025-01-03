<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'sub_title',
        'status',
        'type',
        'is_video',
        'path',
        'item_type',
        'movie_id',
        'transcode',
        'transcodeStatus',
        'position'
    ];
    
    protected $casts=[
        'item_type'=>\App\Enum\FeaturedSection\FeaturedSectionTypeEnum::class
    ];
}
