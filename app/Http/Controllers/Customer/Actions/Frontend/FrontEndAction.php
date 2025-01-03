<?php
namespace App\Actions\Frontend;

use App\Models\Movie;
use App\Models\Category;
use App\Models\TvSeries;
use App\Models\WebSeries;
use App\Enum\Setting\VideoEnum;
use App\Models\FeaturedSection;
use App\Http\Traits\SliderTrait;
use App\Utilities\PaginationHelper;
use App\Enum\FeaturedSection\FeaturedSectionTypeEnum;
use App\Actions\Api\PremiumContent\PremiumContentActionUnAuthorized;

class FrontEndAction{
    
    use SliderTrait;

    public function getHomePageDatasss(){
        $sliders=$this->frontSlider();
        $data['sliders']=$sliders;
        $finalData = [];
        $categories = Category::where('status', '1')->with('movies')->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'slug' => $item->slug,
                'layout' => $item->view_type->name,
                'filter_type' => '1',
                'movies' => collect($item->moviesFront->makeHidden('pivot')->toArray())->sortByDesc('id')->map(function($movie){
                            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                            $movie['premium_status'] = $premiumStatus;
                            if(isset($movie['genre']) && is_array($movie['genre']) && count($movie['genre']) > 0) {
                                $movie['genre'] = collect($movie['genre'])->map(function($genre){
                                    return [
                                        'title' => $genre['title'],
                                        'slug' => $genre['slug']
                                    ];
                                })->toArray();
                            } else {
                                $movie['genre'] = null;
                            }
                            return $movie;
                            })->take(10)->values()->all()
            ];
        });
        $featuredSection = FeaturedSection::where('status', VideoEnum::ACTIVE)->get()->map(function ($item) {
            switch ($item->type) {
                case FeaturedSectionTypeEnum::CATEGORY:
                    $dataItems = collect($item->items)->pluck('item_id');
                    $movies = Category::whereIn('id', $dataItems)->with('movies')->get()->flatMap(function ($catValue) use ($item) {
                        return $catValue->moviesFront->makeHidden('pivot')->toArray();
                    });
                    $movies = collect($movies)->sortByDesc('id')->take(10);
                    break;
                case FeaturedSectionTypeEnum::TVSERIES:
                    $dataItems = collect($item->items)->pluck('item_id');
                    $movies = TvSeries::whereIn('id', $dataItems)->with('genre')->select(['id','title', 'slug', 'poster', 'type','thumbnail','run_time'])->orderBy('id', 'DESC')->take(10)->get()->toArray();
                    break;
                case FeaturedSectionTypeEnum::WEBSERIES:
                    $dataItems = collect($item->items)->pluck('item_id');
                    $movies = WebSeries::whereIn('id', $dataItems)->with('genre')->select(['id','title', 'slug', 'poster', 'type','thumbnail','run_time'])->orderBy('id', 'DESC')->take(10)->get()->toArray();
                    break;
                case FeaturedSectionTypeEnum::MOVIES:
                    $dataItems = collect($item->items)->pluck('item_id');
                    $movies = Movie::whereIn('id', $dataItems)->with('genre')->select(['id','title', 'slug', 'poster', 'type','thumbnail','run_time'])->orderBy('id', 'DESC')->take(10)->get()->toArray();
                    break;
                default:
                   return null;
                    break;
            }
            $movies = collect($movies)->map(function($movie) {
                if(isset($movie['genre']) && is_array($movie['genre']) && count($movie['genre']) > 0) {
                    $movie['genre'] = collect($movie['genre'])->map(function($genre){
                        return [
                            'title' => $genre['title'],
                            'slug' => $genre['slug']
                        ];
                    })->toArray();
                } else {
                    $movie['genre'] = null;
                }
                $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                $movie['premium_status'] = $premiumStatus;
                return $movie;
            })->values()->all();
            return [
                'title' => $item->title,
                'slug' => $item->slug,
                'layout' => $item->view_type->name,
                'filter_type' => '2',
                'movies' => $movies
            ];
        });
        $categoriesArray = $categories->toArray();
        $featuredSectionArray = $featuredSection->toArray();
        $data['finalData'] = array_merge($categoriesArray, $featuredSectionArray, $finalData);
        $data['hotAndNew']=(new DataAction())->getHotAndNew();
        return $data;
    }
}