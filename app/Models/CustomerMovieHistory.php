<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMovieHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'movie_id',
        'video_type'
    ];

    protected $casts = [
        'video_type' => \App\Enum\Customer\MovieTypeEnum::class
    ];
}