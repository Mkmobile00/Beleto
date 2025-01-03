<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'is_featured',
        'status',
        'is_file'
    ];
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genres', 'genre_id', 'movie_id')->select(['title', 'slug', 'poster','rating','type']);
    }

    public function tvSeries()
    {
        return $this->belongsToMany(TvSeries::class, 'series_genres', 'genre_id', 'series_id')->select(['title', 'slug', 'poster','rating','type']);
    }

    public function webSeries()
    {
        return $this->belongsToMany(WebSeries::class, 'web_series_genres', 'genre_id', 'series_id')->select(['title', 'slug', 'poster','rating','type']);
    }
}