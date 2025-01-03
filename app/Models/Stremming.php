<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stremming extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'summary',
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
        'position'
    ];

  
    public function videoQuality(){
        return $this->belongsToMany('App\Models\VideoQuality','stremming_video_qualities','series_id','video_quality_id');
    }

    public function actor(){
        return $this->belongsToMany('App\Models\Star','stremming_actors','series_id','star_id');
    }

    public function director(){
        return $this->belongsToMany('App\Models\Star','stremming_directors','series_id','star_id');
    }

    public function writer(){
        return $this->belongsToMany('App\Models\Star','stremming_writers','series_id','star_id');
    }

    public function genre(){
        return $this->belongsToMany('App\Models\Genre','stremming_genres','series_id','genre_id');
    }

    public function country(){
        return $this->belongsToMany('App\Models\Country','stremming_countries','series_id','country_id');
    }

    public function language(){
        return $this->belongsToMany('App\Models\LanguageSelection','stremming_languages','series_id','language_id');
    }

    public function videoType(){
        return $this->belongsToMany('App\Models\VideoType','stremming_video_types','series_id','video_type_id');
    }


    public function movieCategory(){
        return $this->hasMany(MovieCategory::class,'series_id','id');
    }
    public function movieVideoQuality(){
        return $this->hasMany(StremmingVideoQuality::class,'series_id','id');
    }

    public function movieActor(){
        return $this->hasMany(StremmingActor::class,'series_id','id');
    }

    public function movieDirector(){
        return $this->hasMany(StremmingDirector::class,'series_id','id');
    }

    public function movieWriter(){
        return $this->hasMany(StremmingWriter::class,'series_id','id');
    }

    public function movieGenre(){
        return $this->hasMany(StremmingGenre::class,'series_id','id');
    }

    public function movieCountry(){
        return $this->hasMany(StremmingCountry::class,'series_id','id');
    }

    public function movieLanguage(){
        return $this->hasMany(StremmingLanguage::class,'series_id','id');
    }

    public function movieVideoType(){
        return $this->hasMany(StremmingVideoType::class,'series_id','id');
    }

}
