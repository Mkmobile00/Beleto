<?php
namespace App\Actions\Admin\Dashboard;

use ReflectionClass;
use App\Models\Movie;
use App\Models\TvSeries;
use App\Models\VideoView;
use App\Models\WebSeries;
use Illuminate\Support\Arr;
use App\Models\TvSeriesPart;
use App\Enum\PaymentTypeEnum;
use App\Models\WebSeriesPart;
use App\Models\PaymentHistory;
use Illuminate\Support\Carbon;
use App\Models\Customer\Customer;
use App\Utilities\PaginationHelper;
use App\Enum\Customer\MovieTypeEnum;

class DashboardAction{

    protected $filters;
    public function __construct($filters)
    {
        $this->filters=$filters;
        $this->getData();
    }

    public function arrangeData(){
        return $this->getData();
    }

    public function getData(){
        $totalMovies=Movie::get();
        $totalTvSeries=TvSeries::get();
        $totalWebSeries=WebSeries::get();
        $totalCustomers=Customer::get();
        $paymentOption=array_values((new ReflectionClass(PaymentTypeEnum::class))->getConstants());
        $paymentOptions=[];
        $paymentHistory=[];
        $videoType=new ReflectionClass(MovieTypeEnum::class);
        $videoType=array_values($videoType->getConstants());
        foreach($paymentOption as $key=>$history){
            $paymentOptions[]=$history->name;
            $paymentHistory[]=PaymentHistory::where('payment_type',$history->value)->get()->count();
        }
        $colors=getColorCode();
        $topFiveVideos=VideoView::orderBy('view_count','DESC')->limit(5)->get()->map(function($item){
            switch((int)$item->type){
                case 1:
                    $model=new Movie();
                    $fetch='movie_path';
                    $path='movie.edit';
                    $typeValue="Movie";
                    break;
                case 2:
                    $model=new TvSeriesPart();
                    $fetch='video_path';
                    $path='tvseries.episodeedit';
                    $typeValue="Tv Series";
                    break;
                case 3:
                    $model=new WebSeriesPart();
                    $fetch='video_path';
                    $path='webseries.episodeedit';
                    $typeValue="Web Series";
                    break;
                default:
                    return null;
            }
            $videoData=$model->where('unique_code',$item->video_unique_code)->first();
            $moviePath=$videoData->$fetch ?? null;
            $finalPath=route($path,$videoData->id);
            return[
                'title'=>$videoData->title,
                'poster'=>$videoData->poster,
                'views'=>$item->view_count,
                'video'=>$moviePath,
                'path'=>$finalPath,
                'type'=>$typeValue
            ];
        });
        $loginDevice=[];
        $loginDeviceData=[];
        $customerDevice=Customer::get()->groupBy('platform')->map(function($item){
            return count($item);
        });
        foreach($customerDevice as $key=>$device){
            $loginDevice[]=$key;
            $loginDeviceData[]=$device;
        }
        $url=route('alltransaction.view');
        $allMoviesData= PaginationHelper::paginate(collect($totalMovies), 5)->withPath($url);
        return[
            'totalMovies'=>$totalMovies,
            'totalTvSeries'=>$totalTvSeries,
            'totalWebSeries'=>$totalWebSeries,
            'totalCustomers'=>$totalCustomers,
            'paymentOptions'=>collect($paymentOption)->pluck('name'),
            'paymentHistory'=>$paymentHistory,
            'colors'=>$colors,
            'topFiveVideos'=>$topFiveVideos,
            'loginDevice'=>$loginDevice,
            'loginDeviceData'=>$loginDeviceData,
            'allMoviesData'=>$allMoviesData,
            'videoType'=>$videoType
        ];
    }

}