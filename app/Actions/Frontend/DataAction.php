<?php
namespace App\Actions\Frontend;

use App\Models\Movie;
use App\Models\TvSeries;
use App\Models\WebSeries;
use App\Actions\Api\PremiumContent\PremiumContentActionUnAuthorized;

class DataAction{

    public function getHotAndNew(){
        $finalData = [];
        $movies = Movie::select(['id','title', 'slug', 'thumbnail', 'type','poster'])->orderBy('id', 'DESC')->limit(10)->get()->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        });

        $newRealeseMovies = collect($movies)->sortByDesc('created_at');

        $trendingMovies = Movie::select(['id','title', 'slug', 'thumbnail', 'type','poster'])->orderBy('rating', 'DESC')->limit(10)->get()->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        });

        $tvSeries = TvSeries::select(['id','title', 'slug', 'thumbnail', 'type','poster'])->orderBy('id', 'DESC')->limit(10)->get()->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        });

        $newRealesetvSeries = collect($tvSeries)->sortByDesc('created_at');

        $trendingtvSeries = TvSeries::select(['id','title', 'slug', 'thumbnail', 'type','poster'])->orderBy('rating', 'DESC')->limit(10)->get()->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        });

        $webSeries = WebSeries::select(['id','title', 'slug', 'thumbnail', 'type','poster'])->orderBy('id', 'DESC')->limit(10)->get()->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        });

        $newRealeseWebSeries = collect($webSeries)->sortByDesc('created_at');
        $trendingWebSeries = collect($webSeries)->sortByDesc('rating');


        $finalData[]=$newRealeseMovies->toArray();
        $finalData[]=$trendingMovies->toArray();
        $finalData[]=$newRealesetvSeries->toArray();
        $finalData[]=$trendingtvSeries->toArray();
        $finalData[]=$newRealeseWebSeries->toArray();
        $finalData[]=$trendingWebSeries->toArray();
        $allData=[];
        foreach($finalData as $data){
            foreach($data as $value){
                $allData[]=$value;
            }
        }
        
        return $allData;
    }
}