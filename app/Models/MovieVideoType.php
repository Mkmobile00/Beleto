<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieVideoType extends Model
{
    use HasFactory;
    protected $fillable=[
        'movie_id',
        'video_type_id'
    ];
}
