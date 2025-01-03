<?php
namespace App\Actions\Admin\WebSeries;
use App\Models\WebSeries;
use App\Models\WebSeriesActor;
use App\Models\WebSeriesCinematographer;
use App\Models\WebSeriesCountry;
use App\Models\WebSeriesDirector;
use App\Models\WebSeriesEditor;
use App\Models\WebSeriesGenre;
use App\Models\WebSeriesLanguage;
use App\Models\WebSeriesMusic;
use App\Models\WebSeriesProducer;
use App\Models\WebSeriesVideoQuality;
use App\Models\WebSeriesVideoType;
use App\Models\WebSeriesWriter;

class MovieRelationalUpdate{
    protected $tvseries;
    protected $request;
    public function __construct(WebSeries $tvseries,$request)
    {
        $this->tvseries=$tvseries;
        $this->request=$request;
        $this->syncAttribute();
        $this->syncActor();
        $this->syncProducer();
        $this->syncCinema();
        $this->syncMusic();
        $this->syncEditor();
        $this->syncDirector();
        $this->syncWriter();
        $this->syncGenre();
        $this->syncVideoQuality();
        $this->syncVideoType();
        $this->syncCountry();
        $this->syncLanguage();
        // dd('sucess');
    }

    public function syncAttribute(){
        $this->tvseries->movieVideoQuality()->delete();
        $this->tvseries->movieActor()->delete();
        $this->tvseries->movieProducer()->delete();
        $this->tvseries->movieCinema()->delete();
        $this->tvseries->movieMusic()->delete();
        $this->tvseries->movieEditor()->delete();
        $this->tvseries->movieDirector()->delete();
        $this->tvseries->movieWriter()->delete();
        $this->tvseries->movieGenre()->delete();
        $this->tvseries->movieCountry()->delete();
        $this->tvseries->movieLanguage()->delete();
        $this->tvseries->movieVideoType()->delete();
    }

   

    public function syncActor(){
       $temp=[];
       foreach($this->request['actor'] as $value){
            $temp[]=$this->arrangeStarData($value,'star_id');
       }
       WebSeriesActor::insert($temp);
    }

    public function syncProducer(){
        $temp=[];
        foreach($this->request['producer'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        WebSeriesProducer::insert($temp);
    }

    public function syncCinema(){
        $temp=[];
        foreach($this->request['cinematographer'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        WebSeriesCinematographer::insert($temp);
    }

    public function syncMusic(){
        $temp=[];
        foreach($this->request['music'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        WebSeriesMusic::insert($temp);
    }

    public function syncEditor(){
        $temp=[];
        foreach($this->request['editor'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        WebSeriesEditor::insert($temp);
    }


    public function syncDirector(){
        $temp=[];
        foreach($this->request['director'] as $value){
             $temp[]=$this->arrangeStarData($value,'star_id');
        }
        WebSeriesDirector::insert($temp);
    }
    public function syncWriter(){
        $temp=[];
        foreach($this->request['writer'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        WebSeriesWriter::insert($temp);
    }

    public function syncGenre(){
        $temp=[];
        foreach($this->request['genre'] as $value){
                $temp[]=$this->arrangeStarData($value,'genre_id');
        }
        WebSeriesGenre::insert($temp);
    }

    public function syncVideoQuality(){
        $temp=[];
        foreach($this->request['videoQuality'] as $value){
                $temp[]=$this->arrangeStarData($value,'video_quality_id');
        }
        WebSeriesVideoQuality::insert($temp);
    }
    public function syncVideoType(){
        $temp=[];
        foreach($this->request['videoType'] as $value){
                $temp[]=$this->arrangeStarData($value,'video_type_id');
        }
        WebSeriesVideoType::insert($temp);
    }
    public function syncCountry(){
        $temp=[];
        foreach($this->request['country'] as $value){
                $temp[]=$this->arrangeStarData($value,'country_id');
        }
        WebSeriesCountry::insert($temp);
    }

    public function syncLanguage(){
        $temp=[];
        foreach($this->request['language'] as $value){
                $temp[]=$this->arrangeStarData($value,'language_id');
        }
        WebSeriesLanguage::insert($temp);
    }

    public function arrangeStarData($id,$field){
        return [
            'series_id'=>$this->tvseries->id,
            $field=>(int)$id
        ];
    }
}