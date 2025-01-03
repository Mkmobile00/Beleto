<?php
namespace App\Actions\Admin\TvSeries;

use App\Models\SeriesActor;
use App\Models\SeriesGenre;
use App\Models\SeriesWriter;
use App\Models\SeriesCountry;
use App\Models\SeriesDirector;
use App\Models\SeriesLanguage;
use App\Models\SeriesVideoType;
use App\Models\SeriesVideoQuality;
use App\Models\TvSeries;

class MovieRelational{
    protected $movie;
    protected $request;
    public function __construct(TvSeries $movie,$request)
    {
        $this->movie=$movie;
        $this->request=$request;
        $this->syncActor();
        $this->syncDirector();
        $this->syncWriter();
        $this->syncGenre();
        $this->syncVideoQuality();
        $this->syncVideoType();
        $this->syncCountry();
        $this->syncLanguage();
        // dd('sucess');
    }

  

    public function syncActor(){
       $temp=[];
       foreach($this->request['actor'] as $value){
            $temp[]=$this->arrangeStarData($value,'star_id');
       }
       SeriesActor::insert($temp);
    }
    public function syncDirector(){
        $temp=[];
        foreach($this->request['director'] as $value){
             $temp[]=$this->arrangeStarData($value,'star_id');
        }
        SeriesDirector::insert($temp);
    }
    public function syncWriter(){
        $temp=[];
        foreach($this->request['writer'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        SeriesWriter::insert($temp);
    }

    public function syncGenre(){
        $temp=[];
        foreach($this->request['genre'] as $value){
                $temp[]=$this->arrangeStarData($value,'genre_id');
        }
        SeriesGenre::insert($temp);
    }

    public function syncVideoQuality(){
        $temp=[];
        foreach($this->request['videoQuality'] as $value){
                $temp[]=$this->arrangeStarData($value,'video_quality_id');
        }
        SeriesVideoQuality::insert($temp);
    }
    public function syncVideoType(){
        $temp=[];
        foreach($this->request['videoType'] as $value){
                $temp[]=$this->arrangeStarData($value,'video_type_id');
        }
        SeriesVideoType::insert($temp);
    }
    public function syncCountry(){
        $temp=[];
        foreach($this->request['country'] as $value){
                $temp[]=$this->arrangeStarData($value,'country_id');
        }
        SeriesCountry::insert($temp);
    }

    public function syncLanguage(){
        $temp=[];
        foreach($this->request['language'] as $value){
                $temp[]=$this->arrangeStarData($value,'language_id');
        }
        SeriesLanguage::insert($temp);
    }

    public function arrangeStarData($id,$field){
        return [
            'series_id'=>$this->movie->id,
            $field=>$id
        ];
    }
}