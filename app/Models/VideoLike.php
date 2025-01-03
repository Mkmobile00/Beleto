<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLike extends Model
{
    use HasFactory;
    protected $fillable=[
        'video_unique_code',
        'customer_id',
        'status',
        'type'
    ];

    protected $casts=[
        'status'=>\App\Enum\Customer\LikeDislikeEnum::class,
        'type'=>\App\Enum\Customer\MovieTypeEnum::class
    ];
}
