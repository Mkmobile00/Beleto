<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    use HasFactory;
    protected $fillable = [
        'star_type',
        'name',
        'star_bio',
        'image'
    ];

    protected $casts = [
        'star_type' => \App\Enum\Star\StarTypeEnum::class
    ];

    public function actorMovies()
    {
        return $this->belongsToMany(Movie::class, 'movie_actors', 'star_id', 'movie_id');
    }

    public function directorMovies()
    {
        return $this->belongsToMany(Movie::class, 'movie_directors', 'star_id', 'movie_id');
    }

    public function writerMovies()
    {
        return $this->belongsToMany(Movie::class, 'movie_writers', 'star_id', 'movie_id');
    }
}