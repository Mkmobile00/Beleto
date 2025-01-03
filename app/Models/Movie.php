<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'rating',
        'release_date',
        'run_time',
        'publication',
        'download',
        'freePaid',
        'trailer_url',
        'trailer_url1',
        'thumbnail',
        'is_file',
        'is_file1',
        'poster',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'movie_path',
        'insert',
        'summary',
        'unique_code',
        'transcode',
        'transcodeStatus',
        'position'
    ];


    public function movieHasCategories()
    {
        return $this->belongsToMany('App\Models\Category', 'movie_categories', 'movie_id', 'cat_id');
    }
    public function videoQuality()
    {
        return $this->belongsToMany('App\Models\VideoQuality', 'movie_video_qualities', 'movie_id', 'video_quality_id');
    }

    public function actor()
    {
        return $this->belongsToMany('App\Models\Star', 'movie_actors', 'movie_id', 'star_id');
    }

    public function director()
    {
        return $this->belongsToMany('App\Models\Star', 'movie_directors', 'movie_id', 'star_id');
    }

    public function writer()
    {
        return $this->belongsToMany('App\Models\Star', 'movie_writers', 'movie_id', 'star_id');
    }

    public function producer()
    {
        return $this->belongsToMany('App\Models\Star', 'movie_producers', 'movie_id', 'star_id');
    }
    public function cinematographer()
    {
        return $this->belongsToMany('App\Models\Star', 'movie_cinematographers', 'movie_id', 'star_id');
    }
    public function editor()
    {
        return $this->belongsToMany('App\Models\Star', 'movie_editors', 'movie_id', 'star_id');
    }
    public function music()
    {
        return $this->belongsToMany('App\Models\Star', 'movie_music', 'movie_id', 'star_id');
    }




    public function genre()
    {
        return $this->belongsToMany('App\Models\Genre', 'movie_genres', 'movie_id', 'genre_id');
    }

    public function country()
    {
        return $this->belongsToMany('App\Models\Country', 'movie_countries', 'movie_id', 'country_id');
    }

    public function language()
    {
        return $this->belongsToMany('App\Models\LanguageSelection', 'movie_languages', 'movie_id', 'language_id');
    }

    public function videoType()
    {
        return $this->belongsToMany('App\Models\VideoType', 'movie_video_types', 'movie_id', 'video_type_id');
    }


    public function movieCategory()
    {
        return $this->hasMany(MovieCategory::class, 'movie_id', 'id');
    }
    public function movieVideoQuality()
    {
        return $this->hasMany(MovieVideoQuality::class, 'movie_id', 'id');
    }

    public function movieActor()
    {
        return $this->hasMany(MovieActor::class, 'movie_id', 'id');
    }

    public function movieProducer()
    {
        return $this->hasMany(MovieProducer::class, 'movie_id', 'id');
    }
    public function movieCinema()
    {
        return $this->hasMany(MovieCinematographer::class, 'movie_id', 'id');
    }
    public function movieMusic()
    {
        return $this->hasMany(MovieMusic::class, 'movie_id', 'id');
    }
    public function movieEditor()
    {
        return $this->hasMany(MovieEditor::class, 'movie_id', 'id');
    }



    public function movieDirector()
    {
        return $this->hasMany(MovieDirector::class, 'movie_id', 'id');
    }

    public function movieWriter()
    {
        return $this->hasMany(MovieWriter::class, 'movie_id', 'id');
    }

    public function movieGenre()
    {
        return $this->hasMany(MovieGenre::class, 'movie_id', 'id');
    }

    public function movieCountry()
    {
        return $this->hasMany(MovieCountry::class, 'movie_id', 'id');
    }

    public function movieLanguage()
    {
        return $this->hasMany(MovieLanguage::class, 'movie_id', 'id');
    }

    public function movieVideoType()
    {
        return $this->hasMany(MovieVideoType::class, 'movie_id', 'id');
    }

    public function views()
    {
        return $this->hasOne(VideoView::class, 'video_unique_code', 'unique_code');
    }

    public function likeDislikes()
    {
        return $this->hasMany(VideoLike::class, 'video_unique_code', 'unique_code');
    }

    public function isPremium()
    {
        return $this->hasOne(PremiumContent::class, 'movie_id', 'id')->where('type', '1')->where('is_premium', '1');
    }
}