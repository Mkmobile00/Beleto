<?php
namespace App\Actions\Admin\Stremming;

use App\Models\Star;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Category;
use App\Models\VideoType;
use App\Models\VideoQuality;
use App\Enum\Star\StarTypeEnum;
use App\Models\LanguageSelection;
use App\Actions\Admin\TvSeries\StartUpAction;

class MovieAction{

    protected $data;
    protected $rowId;
    public function __construct()
    {
        // $this->setStartUP();
        $this->arrangeData();
        return $this->data;
    }

    // public function setStartUP(){
    //     $this->rowId=(new StartUpAction(new Movie()))->latestRow();
    // }

    public function arrangeData(){

        $videoQuality=VideoQuality::where('status','1')->get();
        $videoType=VideoType::where('status','1')->get();
        $starData=Star::get();
        $actor=$starData->where('star_type',StarTypeEnum::ACTOR);
        $director=$starData->where('star_type',StarTypeEnum::DIRECTOR);
        $writer=$starData->where('star_type',StarTypeEnum::WRITER);
        $countries=Country::where('status','1')->get();
        $genres=Genre::where('status','1')->get();
        $languages=LanguageSelection::where('status','1')->get();
        $categories=Category::whereNull('parent_id')->get();

        return[
            'videoQuality'=>$videoQuality,
            'videoTypes'=>$videoType,
            'actors'=>$actor,
            'directors'=>$director,
            'writers'=>$writer,
            'countries'=>$countries,
            'genres'=>$genres,
            'languages'=>$languages,
            'categories'=>$categories,
        ];
        
    }
}