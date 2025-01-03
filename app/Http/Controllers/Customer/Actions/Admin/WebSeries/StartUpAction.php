<?php
namespace App\Actions\Admin\WebSeries;

use App\Models\Movie;

class StartUpAction{

    protected $movie;
    public function __construct(Movie $movie)
    {
        $data=[];
        $this->movie=$movie;
        $this->movie->fill($data);
        $this->movie->save();
        
    }

    public function latestRow(){
        return $this->movie->id;
    }
}