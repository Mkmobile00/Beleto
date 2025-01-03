<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\TvSeries;
use App\Models\WebSeries;
use App\Models\TvSeriesPart;
use App\Models\WebSeriesPart;
use Illuminate\Database\Seeder;
use App\Events\TestTranscodeEvent;
use App\Http\Traits\VideoUniqueCodeGenerator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SetVideoCodeSeeder extends Seeder
{
    use VideoUniqueCodeGenerator;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        event(new TestTranscodeEvent());
        // $movies=Movie::whereNull('unique_code')->get();
        // foreach($movies as $movie){
        //     $movie->unique_code=$this->generateCode();
        //     $movie->save();
        // }
        // $tvseries=TvSeries::whereNull('unique_code')->get();
        // foreach($tvseries as $series){
        //     $series->unique_code=$this->generateCode();
        //     $series->save();
        // }
        // $webSeries=WebSeries::whereNull('unique_code')->get();
        // foreach($webSeries as $data){
        //     $data->unique_code=$this->generateCode();
        //     $data->save();
        // }
        // $tvseriespart=TvSeriesPart::whereNull('unique_code')->get();
        // foreach($tvseriespart as $data){
        //     $data->unique_code=$this->generateCode();
        //     $data->save();
        // }
        // $webseriespart=WebSeriesPart::whereNull('unique_code')->get();
        // foreach($webseriespart as $data){
        //     $data->unique_code=$this->generateCode();
        //     $data->save();
        // }
        dd('success');
    }
}
