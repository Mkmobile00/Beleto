<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageSelection extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'status'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_languages', 'language_id', 'movie_id')->select(['title', 'slug', 'poster','rating','type']);
    }
    public function tvSeries()
    {
        return $this->belongsToMany(TvSeries::class, 'series_languages', 'language_id', 'series_id')->select(['title', 'slug', 'poster','rating','type']);
    }

    public function webSeries()
    {
        return $this->belongsToMany(WebSeries::class, 'web_series_languages', 'language_id', 'series_id')->select(['title', 'slug', 'poster','rating','type']);
    }
}
