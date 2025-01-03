<?php
namespace App\Actions\Admin\Stremming;

use App\Models\Stremming;
use App\Models\StremmingActor;
use App\Models\StremmingCountry;
use App\Models\StremmingDirector;
use App\Models\StremmingGenre;
use App\Models\StremmingLanguage;
use App\Models\StremmingVideoQuality;
use App\Models\StremmingVideoType;
use App\Models\StremmingWriter;

class MovieRelationalUpdate{
    protected $tvseries;
    protected $request;
    public function __construct(Stremming $tvseries,$request)
    {
        $this->tvseries=$tvseries;
        $this->request=$request;
        $this->syncAttribute();
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

    public function syncAttribute(){
        $this->tvseries->movieVideoQuality()->delete();
        $this->tvseries->movieActor()->delete();
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
       StremmingActor::insert($temp);
    }
    public function syncDirector(){
        $temp=[];
        foreach($this->request['director'] as $value){
             $temp[]=$this->arrangeStarData($value,'star_id');
        }
        StremmingDirector::insert($temp);
    }
    public function syncWriter(){
        $temp=[];
        foreach($this->request['writer'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        StremmingWriter::insert($temp);
    }

    public function syncGenre(){
        $temp=[];
        foreach($this->request['genre'] as $value){
                $temp[]=$this->arrangeStarData($value,'genre_id');
        }
        StremmingGenre::insert($temp);
    }

    public function syncVideoQuality(){
        $temp=[];
        foreach($this->request['videoQuality'] as $value){
                $temp[]=$this->arrangeStarData($value,'video_quality_id');
        }
        StremmingVideoQuality::insert($temp);
    }
    public function syncVideoType(){
        $temp=[];
        foreach($this->request['videoType'] as $value){
                $temp[]=$this->arrangeStarData($value,'video_type_id');
        }
        StremmingVideoType::insert($temp);
    }
    public function syncCountry(){
        $temp=[];
        foreach($this->request['country'] as $value){
                $temp[]=$this->arrangeStarData($value,'country_id');
        }
        StremmingCountry::insert($temp);
    }

    public function syncLanguage(){
        $temp=[];
        foreach($this->request['language'] as $value){
                $temp[]=$this->arrangeStarData($value,'language_id');
        }
        StremmingLanguage::insert($temp);
    }

    public function arrangeStarData($id,$field){
        return [
            'series_id'=>$this->tvseries->id,
            $field=>(int)$id
        ];
    }
}