<?php
namespace App\Http\Traits;

use App\Models\Movie;
use App\Models\Slider;
use App\Models\Category;
use App\Models\TvSeries;
use App\Models\WebSeries;
use Illuminate\Support\Facades\Auth;
use App\Enum\FeaturedSection\FeaturedSectionTypeEnum;

trait SliderTrait{

    function frontSlider(){
        $customer=Auth::guard('customer')->user();
        $sliders = Slider::where('status', 'active')->where('transcodeStatus','true')->select(['id', 'title', 'slug', 'sub_title', 'type', 'path', 'item_type', 'movie_id','transcode'])->orderBy('position','ASC')->get()->map(function ($item) use ($customer){
            $wishListData=$customer ? $customer->wishList : null;
            $wishStatus=false;
            
            $item->makeHidden('slug');
            switch ($item->item_type) {
                case FeaturedSectionTypeEnum::TVSERIES:
                    $data = TvSeries::where('id', $item->movie_id)->first();
                    $item->setAttribute('movie_slug', $data->slug);
                    $item->setAttribute('item_type', 2);
                    // return  $item;
                    break;
                case FeaturedSectionTypeEnum::WEBSERIES:
                    $data = WebSeries::where('id', $item->movie_id)->first();
                    $item->setAttribute('movie_slug', $data->slug);
                    $item->setAttribute('item_type', 3);
                    // return  $item;
                    break;
                case FeaturedSectionTypeEnum::MOVIES:
                    $data = Movie::where('id', $item->movie_id)->first();
                    $item->setAttribute('movie_slug', $data->slug ?? 0);
                    $item->setAttribute('item_type', 1);
                    // return  $item;
                    break;
                default:
                    return $item;
            }
            if($wishListData){
                foreach($wishListData as $wishData){
                    if($wishData->movie_id==$item->movie_id){
                        if($wishData->video_type==$item->item_type->value){
                            $wishStatus=true;
                        }else{
                            $wishStatus=false;
                        }
                    }else{
                        $wishStatus=false;
                    }
                }
                $item->setAttribute('is_wish',$wishStatus);
            }
           
            return $item;
            
        });
        return $sliders;
    }

    function topMenus(){
        $category = [];
            $categories = Category::whereNull('parent_id')->get();
            foreach ($categories as $key => $cat) {
                $category[$key]['title'] = $cat->title;
                $category[$key]['slug'] = $cat->slug;
                $category[$key]['type'] = '1';
                if($cat->childCat && count($cat->childCat) >0)
                {
                    foreach ($cat->childCat as $value => $sub) {
                        $category[$key]['subcat'][$value]['title'] = $sub->title;
                        $category[$key]['subcat'][$value]['slug'] = $sub->slug;
                        $category[$key]['subcat'][$value]['parent_id'] = $sub->parent_id;
                        $category[$key]['subcat'][$value]['type'] = '1';
                    }
                }else{
                    $category[$key]['subcat']=null;
                }
                
            }
            // $category[$key + 1]['title'] = 'Tv Shows';
            // $category[$key + 1]['slug'] = 'tvshows';
            // $category[$key + 1]['type'] = '2';
            // $category[$key + 1]['subcat'] = null;
            $category[$key + 2]['title'] = 'Series';
            $category[$key + 2]['slug'] = 'webseries';
            $category[$key + 2]['type'] = '3';
            $category[$key + 2]['subcat'] = null;
           return $category;
        
    }
}