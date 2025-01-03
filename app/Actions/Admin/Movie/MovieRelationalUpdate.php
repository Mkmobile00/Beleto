<?php
namespace App\Actions\Admin\Movie;

use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\MovieCategory;
use App\Models\MovieCinematographer;
use App\Models\MovieCountry;
use App\Models\MovieDirector;
use App\Models\MovieEditor;
use App\Models\MovieGenre;
use App\Models\MovieLanguage;
use App\Models\MovieMusic;
use App\Models\MovieProducer;
use App\Models\MovieVideoQuality;
use App\Models\MovieVideoType;
use App\Models\MovieWriter;

class MovieRelationalUpdate{
    protected $movie;
    protected $request;
    public function __construct(Movie $movie,$request)
    {
        $this->movie=$movie;
        $this->request=$request;
        $this->syncAttribute();
        $this->syncCategory();
        $this->syncActor();
        $this->syncDirector();
        $this->syncWriter();

        $this->syncProducer();
        $this->syncCinema();
        $this->syncMusic();
        $this->syncEditor();



        $this->syncGenre();
        $this->syncVideoQuality();
        $this->syncVideoType();
        $this->syncCountry();
        $this->syncLanguage();
        // dd('sucess');
    }

    public function syncAttribute(){
        $this->movie->movieCategory()->delete();
        $this->movie->movieVideoQuality()->delete();
        $this->movie->movieActor()->delete();

        $this->movie->movieProducer()->delete();
        $this->movie->movieCinema()->delete();
        $this->movie->movieMusic()->delete();
        $this->movie->movieEditor()->delete();


        $this->movie->movieDirector()->delete();
        $this->movie->movieWriter()->delete();
        $this->movie->movieGenre()->delete();
        $this->movie->movieCountry()->delete();
        $this->movie->movieLanguage()->delete();
        $this->movie->movieVideoType()->delete();
    }

    public function syncCategory(){
        $temp=[];
        foreach($this->request['category'] as $value){
             $temp[]=$this->arrangeStarData($value,'cat_id');
        }
        MovieCategory::insert($temp);
     }

    public function syncActor(){
       $temp=[];
       foreach($this->request['actor'] as $value){
            $temp[]=$this->arrangeStarData($value,'star_id');
       }
       MovieActor::insert($temp);
    }
    public function syncDirector(){
        $temp=[];
        foreach($this->request['director'] as $value){
             $temp[]=$this->arrangeStarData($value,'star_id');
        }
        MovieDirector::insert($temp);
    }
    public function syncWriter(){
        $temp=[];
        foreach($this->request['writer'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        MovieWriter::insert($temp);
    }

    public function syncProducer(){
        $temp=[];
        foreach($this->request['producer'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        MovieProducer::insert($temp);
    }

    public function syncCinema(){
        $temp=[];
        foreach($this->request['cinematographer'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        MovieCinematographer::insert($temp);
    }

    public function syncMusic(){
        $temp=[];
        foreach($this->request['music'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        MovieMusic::insert($temp);
    }

    public function syncEditor(){
        $temp=[];
        foreach($this->request['editor'] as $value){
                $temp[]=$this->arrangeStarData($value,'star_id');
        }
        MovieEditor::insert($temp);
    }

    public function syncGenre(){
        $temp=[];
        foreach($this->request['genre'] as $value){
                $temp[]=$this->arrangeStarData($value,'genre_id');
        }
        MovieGenre::insert($temp);
    }

    public function syncVideoQuality(){
        $temp=[];
        foreach($this->request['videoQuality'] as $value){
                $temp[]=$this->arrangeStarData($value,'video_quality_id');
        }
        MovieVideoQuality::insert($temp);
    }
    public function syncVideoType(){
        $temp=[];
        foreach($this->request['videoType'] as $value){
                $temp[]=$this->arrangeStarData($value,'video_type_id');
        }
        MovieVideoType::insert($temp);
    }
    public function syncCountry(){
        $temp=[];
        foreach($this->request['country'] as $value){
                $temp[]=$this->arrangeStarData($value,'country_id');
        }
        MovieCountry::insert($temp);
    }

    public function syncLanguage(){
        $temp=[];
        foreach($this->request['language'] as $value){
                $temp[]=$this->arrangeStarData($value,'language_id');
        }
        MovieLanguage::insert($temp);
    }

    public function arrangeStarData($id,$field){
        return [
            'movie_id'=>$this->movie->id,
            $field=>(int)$id
        ];
    }
}