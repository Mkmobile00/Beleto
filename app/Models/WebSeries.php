<?php

namespace App\Models;

use App\Models\WebSeriesPart;
use App\Models\WebSeriesActor;
use App\Models\WebSeriesGenre;
use App\Models\WebSeriesWriter;
use App\Models\WebSeriesCountry;
use App\Models\WebSeriesDirector;
use App\Models\WebSeriesLanguage;
use App\Models\WebSeriesVideoType;
use App\Models\WebSeriesVideoQuality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebSeries extends Model
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
        return $this->belongsToMany('App\Models\VideoQuality','web_series_video_qualities','series_id','video_quality_id');
    }

    public function actor(){
        return $this->belongsToMany('App\Models\Star','web_series_actors','series_id','star_id');
    }

    public function producer(){
        return $this->belongsToMany('App\Models\Star','web_series_producers','series_id','star_id');
    }
    public function cinematographer(){
        return $this->belongsToMany('App\Models\Star','web_series_cinematographers','series_id','star_id');
    }
    public function editor(){
        return $this->belongsToMany('App\Models\Star','web_series_editors','series_id','star_id');
    }
    public function music(){
        return $this->belongsToMany('App\Models\Star','web_series_music','series_id','star_id');
    }

    public function director(){
        return $this->belongsToMany('App\Models\Star','web_series_directors','series_id','star_id');
    }

    public function writer(){
        return $this->belongsToMany('App\Models\Star','web_series_writers','series_id','star_id');
    }

    public function genre(){
        return $this->belongsToMany('App\Models\Genre','web_series_genres','series_id','genre_id');
    }

    public function country(){
        return $this->belongsToMany('App\Models\Country','web_series_countries','series_id','country_id');
    }

    public function language(){
        return $this->belongsToMany('App\Models\LanguageSelection','web_series_languages','series_id','language_id');
    }

    public function videoType(){
        return $this->belongsToMany('App\Models\VideoType','web_series_video_types','series_id','video_type_id');
    }


    public function movieCategory(){
        return $this->hasMany(MovieCategory::class,'series_id','id');
    }
    public function movieVideoQuality(){
        return $this->hasMany(WebSeriesVideoQuality::class,'series_id','id');
    }

    public function movieActor(){
        return $this->hasMany(WebSeriesActor::class,'series_id','id');
    }

    public function movieProducer(){
        return $this->hasMany(WebSeriesProducer::class,'series_id','id');
    }
    public function movieCinema(){
        return $this->hasMany(WebSeriesCinematographer::class,'series_id','id');
    }
    public function movieMusic(){
        return $this->hasMany(WebSeriesMusic::class,'series_id','id');
    }
    public function movieEditor(){
        return $this->hasMany(WebSeriesEditor::class,'series_id','id');
    }

    public function movieDirector(){
        return $this->hasMany(WebSeriesDirector::class,'series_id','id');
    }

    public function movieWriter(){
        return $this->hasMany(WebSeriesWriter::class,'series_id','id');
    }

    public function movieGenre(){
        return $this->hasMany(WebSeriesGenre::class,'series_id','id');
    }

    public function movieCountry(){
        return $this->hasMany(WebSeriesCountry::class,'series_id','id');
    }

    public function movieLanguage(){
        return $this->hasMany(WebSeriesLanguage::class,'series_id','id');
    }

    public function movieVideoType(){
        return $this->hasMany(WebSeriesVideoType::class,'series_id','id');
    }

    public function episodes(){
        return $this->hasMany(WebSeriesPart::class,'tvseries_id','id')->orderBy('position','ASC');
    }

    public function isPremium(){
        return $this->hasOne(PremiumContent::class,'movie_id','id')->where('type','3')->where('is_premium','1');
    }
}
