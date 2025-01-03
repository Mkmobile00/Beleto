<?php
namespace App\Actions\Admin\Movie;

use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\MovieCategory;
use App\Models\MovieCountry;
use App\Models\MovieDirector;
use App\Models\MovieGenre;
use App\Models\MovieLanguage;
use App\Models\MovieVideoQuality;
use App\Models\MovieVideoType;
use App\Models\MovieWriter;

class MovieRelational{
    protected $movie;
    protected $request;
    public function __construct(Movie $movie,$request)
    {
        $this->movie=$movie;
        $this->request=$request;
        // dd($this->request);
        $this->syncCategory();
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
            $field=>$id
        ];
    }
}