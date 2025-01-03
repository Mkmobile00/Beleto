<?php
namespace App\Http\Traits;

use App\Models\Movie;
use App\Models\TvSeries;
use App\Models\WebSeries;
use Illuminate\Support\Str;

trait VideoUniqueCodeGenerator{

    function generateCode(){
        $code=Str::random(10);
        $movies=Movie::where('unique_code',$code)->first();
        $tvseries=TvSeries::where('unique_code',$code)->first();
        $webseries=WebSeries::where('unique_code',$code)->first();
        if($movies){
            $this->generateCode();
        }
        if($tvseries){
            $this->generateCode();
        }
        if($webseries){
            $this->generateCode();
        }

        return $code;
    }
}