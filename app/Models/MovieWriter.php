<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieWriter extends Model
{
    use HasFactory;
    protected $fillable=[
        'movie_id',
        'star_id'
    ];
}
