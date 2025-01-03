<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Models\TvSeries;
use App\Models\WebSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\RecomendedSearch;
use App\Http\Controllers\Controller;
use App\Actions\Api\PremiumContent\PremiumContentActionUnAuthorized;

class SearchController extends Controller
{
    protected $recomendedSearch;
    public function __construct(RecomendedSearch $recomendedSearch)
    {
        $this->recomendedSearch=$recomendedSearch;
    }
    public function search(Request $request){
        $movieSearch = Movie::whereRaw('LOWER(title) like ?', ['%' . strtolower($request->search) . '%'])
        ->select(['id','title','slug','rating','poster','summary','release_date','type'])
        ->get()->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        })
        ->toArray();
        $webSeriesSearch=WebSeries::whereRaw('LOWER(title) like ?', ['%' . strtolower($request->search) . '%'])
        ->select(['id','title','slug','rating','poster','summary','release_date','type'])
        ->get()->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        })
        ->toArray();
        $tvSeriesSearch=TvSeries::whereRaw('LOWER(title) like ?', ['%' . strtolower($request->search) . '%'])
        ->select(['id','title','slug','rating','poster','summary','release_date','type'])
        ->get()->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        })
        ->toArray();
        $finalSearchData=array_merge($movieSearch,$webSeriesSearch,$tvSeriesSearch);
        RecomendedSearch::create([
            'key'=>$request->search,
            'search_date'=>Carbon::now()->format('Y-m-d')
        ]);
        return $this->responseApiSuccess("Search List !!", $finalSearchData, 200);
    }

    public function recomendedSearch(){
        $this->recomendedSearch->whereNull('key')->delete();
        $recomendedSearch = RecomendedSearch::whereNotNull('key')->get()->pluck('key')->toArray();
        $searchData=[];
        foreach($recomendedSearch as $search){
            $movieSearch = Movie::where('title', 'like', '%' . $search . '%')->select(['id','title','slug','rating','poster','summary','release_date','type'])->get()->toArray();
            $webSeriesSearch=WebSeries::where('title', 'like', '%' . $search . '%')->select(['id','title','slug','rating','poster','summary','release_date','type'])->get()->toArray();
            $tvSeriesSearch=TvSeries::where('title', 'like', '%' . $search . '%')->select(['id','title','slug','rating','poster','summary','release_date','type'])->get()->toArray();
            if($movieSearch !=null){
                $searchData=array_merge($movieSearch,$searchData);
            }
            if($webSeriesSearch !=null){
                $searchData=array_merge($webSeriesSearch,$searchData);
            }
            if($tvSeriesSearch !=null){
                $searchData=array_merge($tvSeriesSearch,$searchData);
            }
        }
        $searchData=collect($searchData)->unique('title')->take(10)->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        })->values();
        return $this->responseApiSuccess("Search List !!", $searchData, 200);
    }
}
