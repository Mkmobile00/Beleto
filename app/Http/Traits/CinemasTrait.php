<?php
namespace App\Http\Traits;

use App\Models\Cinemas;
use App\Models\CinemasBranch;
use App\Models\MovieTheater;
use Illuminate\Support\Str;

trait CinemasTrait{

    public function generateCinemasUniqueCode(){
        $randomCode=str::upper('NC-'.rand(111,555).Str::random(3));
        $exist=Cinemas::where('cinemas_unique_code',$randomCode)->first();
        if($exist){
            $this->generateCinemasUniqueCode();
        }
        return $randomCode;
    }

    public function generateCinemasBranchUniqueCode(){
        $randomCode=str::upper('NCB-'.rand(111,555).Str::random(3));
        $exist=CinemasBranch::where('branch_id',$randomCode)->first();
        if($exist){
            $this->generateCinemasUniqueCode();
        }
        return $randomCode;
    }

    public function generateMovieTheaterUniqueCode(){
        $randomCode=str::upper('NCMT-'.rand(111,555).Str::random(3));
        $exist=MovieTheater::where('theater_unique_id',$randomCode)->first();
        if($exist){
            $this->generateCinemasUniqueCode();
        }
        return $randomCode;
    }
}
