<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieVideoQuality extends Model
{
    use HasFactory;
    protected $fillable=[
        'movie_id',
        'video_quality_id'
    ];
}
