<?php

namespace App\Models;

use App\Models\SeriesActor;
use App\Models\SeriesGenre;
use App\Models\SeriesWriter;
use App\Models\TvSeriesPart;
use App\Models\MovieCategory;
use App\Models\SeriesCountry;
use App\Models\SeriesDirector;
use App\Models\SeriesLanguage;
use App\Models\SeriesVideoType;
use App\Models\SeriesVideoQuality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TvSeries extends Model
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
        'insert'
    ];

  
    public function videoQuality(){
        return $this->belongsToMany('App\Models\VideoQuality','series_video_qualities','series_id','video_quality_id');
    }

    public function actor(){
        return $this->belongsToMany('App\Models\Star','series_actors','series_id','star_id');
    }

    public function director(){
        return $this->belongsToMany('App\Models\Star','series_directors','series_id','star_id');
    }

    public function writer(){
        return $this->belongsToMany('App\Models\Star','series_writers','series_id','star_id');
    }

    public function genre(){
        return $this->belongsToMany('App\Models\Genre','series_genres','series_id','genre_id');
    }

    public function country(){
        return $this->belongsToMany('App\Models\Country','series_countries','series_id','country_id');
    }

    public function language(){
        return $this->belongsToMany('App\Models\LanguageSelection','series_languages','series_id','language_id');
    }

    public function videoType(){
        return $this->belongsToMany('App\Models\VideoType','series_video_types','series_id','video_type_id');
    }


    public function movieCategory(){
        return $this->hasMany(MovieCategory::class,'series_id','id');
    }
    public function movieVideoQuality(){
        return $this->hasMany(SeriesVideoQuality::class,'series_id','id');
    }

    public function movieActor(){
        return $this->hasMany(SeriesActor::class,'series_id','id');
    }

    public function movieDirector(){
        return $this->hasMany(SeriesDirector::class,'series_id','id');
    }

    public function movieWriter(){
        return $this->hasMany(SeriesWriter::class,'series_id','id');
    }

    public function movieGenre(){
        return $this->hasMany(SeriesGenre::class,'series_id','id');
    }

    public function movieCountry(){
        return $this->hasMany(SeriesCountry::class,'series_id','id');
    }

    public function movieLanguage(){
        return $this->hasMany(SeriesLanguage::class,'series_id','id');
    }

    public function movieVideoType(){
        return $this->hasMany(SeriesVideoType::class,'series_id','id');
    }

    public function episodes(){
        return $this->hasMany(TvSeriesPart::class,'tvseries_id','id');
    }

    

    public function isPremium(){
        return $this->hasOne(PremiumContent::class,'movie_id','id')->where('type','2')->where('is_premium','1');
    }
}
