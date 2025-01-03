<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Menu;
use App\Models\Plan;
use App\Models\Star;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Slider;
use App\Models\Category;
use App\Models\TvSeries;
use App\Models\Stremming;
use App\Models\WebSeries;
use App\Models\MovieActor;
use App\Models\MovieGenre;
use App\Models\MovieWriter;
use App\Models\PlanContent;
use App\Models\CurrencyRate;
use App\Models\Subscription;
use App\Models\TvSeriesPart;
use Illuminate\Http\Request;
use App\Models\MovieCategory;
use App\Models\MovieDirector;
use App\Models\WebSeriesPart;
use Illuminate\Support\Carbon;
use App\Enum\Star\StarTypeEnum;
use App\Models\FeaturedSection;
use App\Models\RecomendedSearch;
use App\Models\Customer\Customer;
use App\Models\LanguageSelection;
use App\Utilities\PaginationHelper;
use App\Actions\Frontend\DataAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enum\Customer\LikeDislikeEnum;
use Illuminate\Support\Facades\Storage;
use App\Actions\Frontend\FrontEndAction;
use Illuminate\Support\Facades\Validator;
use App\Enum\FeaturedSection\FeaturedSectionTypeEnum;
use App\Actions\Api\PremiumContent\PremiumContentAction;
use App\Actions\Api\PremiumContent\PremiumContentActionUnAuthorized;

class FrontendController extends Controller
{
    public function home(){
        $data=(new FrontEndAction())->getHomePageData();
        // dd($data);
        return view('frontend.index',$data);
    }

    public function movieDetailsPage(Request $request,$slug,$type){
        $type=$type;
        $slug=$slug;
        $request['slug']=$slug;
        if(!$type || !$slug){
            return $this->webError($request);
        }
        $type = $request->type;
        if (!$type || $type == null) {
            return response()->json([
                'error' => true,
                'data' => null,
                'msg' => 'Type Field Required'
            ], 200);
        }
        $validator = null;
        $model = null;
        $customer=Auth::guard('customer')->user();
        if($customer){
            $request['user_id']=Auth::guard('customer')->user()->id;
        }else{
            $request['user_id']=null;
        }
       
        switch ((int)$type) {
            case 1:
                $validator = Validator::make($request->all(), ['slug' => 'required|exists:movies,slug', 'user_id' => 'nullable|exists:customers,id']);
                $model = Movie::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType', 'movieHasCategories'])->select(['id', 'title', 'slug', 'description', 'rating', 'release_date', 'trailer_url', 'thumbnail', 'poster', 'summary', 'type', 'unique_code','run_time']);
                break;
            case 2:
                $validator = Validator::make($request->all(), ['slug' => 'required|exists:tv_series,slug', 'user_id' => 'nullable|exists:customers,id']);
                $model = TvSeries::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
                break;
            case 3:
                $validator = Validator::make($request->all(), ['slug' => 'required|exists:web_series,slug', 'user_id' => 'nullable|exists:customers,id']);
                $model = WebSeries::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
                break;
            default:
               return $this->webError($request);
        }
        if ($validator->fails()) {
            return $this->webError($request);
        }
        $movie = $model->where('slug', $request->slug)->first();
        // $movie->youtube_trailer = $movie->trailer_url;
        $movie->youtube_trailer = extractYoutubeCode($movie->trailer_url);
        $movie->custome_trailer = $movie->trailer_url1;
        $movie->makeHidden('trailer_url1');
        $movie->makeHidden('unique_code');
        $movie->makeHidden('movie_path');
        $actor = $movie->actor->pluck('id')->toArray();
        $director = $movie->director->pluck('id')->toArray();
        $writer = $movie->writer->pluck('id')->toArray();
        $genre = $movie->genre->pluck('id')->toArray();
        $actorMovie = MovieActor::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $directorMovie = MovieDirector::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $writerMovie = MovieWriter::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $genreMovie = MovieGenre::whereIn('genre_id', $genre)->get()->pluck('movie_id')->toArray();
        $movie->is_fav = false;
        $movie->is_like=false;
        $movie->is_dislike=false;
        $movie->premium_payment=false;
        if ($request->user_id) {
            $customer = Customer::where('id', $request->user_id)->first();
            $movie->is_fav = checkFav($customer->id, $movie->id, $type);
            $movie->is_like = checkLike($customer->id, $movie->unique_code);
            $movie->is_dislike = checkDislike($customer->id, $movie->unique_code);
            $movie->premium_status=false;
            $movie->premium_status=(new PremiumContentAction($customer,$movie))->checkPremium()['status'] ?? false;
            $movie->premium_details = (new PremiumContentAction($customer,$movie))->checkPremium();
            if($movie->premium_status){
                $movie->premium_payment=checkCustomerPreimumContentStatus($customer,$movie->premium_details,$movie->id);
            }
            
        }else{
            $movie->premium_status=(new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
        }
        if ($type == '1') {
            $category = $movie->movieHasCategories->pluck('id');
            $categoryMovie = MovieCategory::whereIn('cat_id', $category)->get()->pluck('movie_id')->toArray();
        } else {
            $categoryMovie = [];
        }
        $mergedFilterId = collect(array_merge($actorMovie, $directorMovie, $writerMovie, $genreMovie, $categoryMovie))->unique()->toArray();

        if ((int)$type != 1) {
            $episodes = $movie->episodes;
            if(count($episodes) > 0){
                $movie->videocode = $episodes[0]->unique_code ? base64_encode($episodes[0]->unique_code) : null;
            }else{
                $movie->videocode = null;
            }
            
            $movie->total_views = $episodes[0]->views->view_count ?? null;
            if(count($episodes) > 0){
                $movie->total_likes = count($episodes[0]->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0;
            }else{
                $movie->total_likes = 0;
            }
            
            $movie->episodesData = $episodes->map(function ($item) {
                $item->videocode = base64_encode($item->unique_code);
                $item->makeHidden('unique_code');
                $item->makeHidden('video_path');
                $item->makeHidden('views',$item->views->view_count ?? 0);
                $item->setAttribute('total_views',$item->views->view_count ?? 0);
                $item->setAttribute('total_likes',count($item->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0);
                $item->makeHidden('likeDislikes');
            });
        } else {
            $movie->videocode = base64_encode($movie->unique_code);
            $movie->episodesData = null;
            $movie->total_views=$movie->views->view_count ?? 0;
            $movie->total_likes=count($movie->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0;
        }

        if($request->user_id){
            $movie->videocode = $movie->youtube_trailer;
        }else{
            $movie->videocode = extractYoutubeCode($movie->youtube_trailer);
        }
        $movie->related_movie = Movie::whereIn('id', $mergedFilterId)->where('id', '!=', $movie->id)->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'slug' => $item->slug,
                'poster' => $item->poster,
                'rating' => $item->rating,
                'type' => $item->type
            ];
        });

        if (!$movie) {
            return $this->returnHomePage($request,'Sorry No Data Found !!');
        }
        if($type !='1'){
            $tvSeriess=TvSeries::where('id','!=',$movie->id)->get();
            $webSeriess=WebSeries::where('id','!=',$movie->id)->get();
        }else{
            $tvSeriess=TvSeries::get();
            $webSeriess=WebSeries::get();
        }
        $customer=Auth::guard('customer')->user();
        $stremmingSoon=false;
        return view('frontend.detailpage',compact('movie','webSeriess','tvSeriess','customer','stremmingSoon'));
    }

    public function stremmingsoon(Request $request,$slug){
        $slug=$slug;
        $request['slug']=$slug;
        if(!$slug){
            return $this->webError($request);
        }

        $stremmingSoon=true;
        $movie=Stremming::where('slug',$slug)->firstOrFail();
        return view('frontend.detailpagestremming',compact('movie','stremmingSoon'));
    }
    
    public function movieDetails(Request $request,$slug,$type){
        $type=$type;
        $slug=$slug;
        $request['slug']=$slug;
        if(!$type || !$slug){
            return $this->webError($request);
        }
        $type = $request->type;
        if (!$type || $type == null) {
            return response()->json([
                'error' => true,
                'data' => null,
                'msg' => 'Type Field Required'
            ], 200);
        }
        $validator = null;
        $model = null;
        $customer=Auth::guard('customer')->user();
        if($customer){
            $request['user_id']=Auth::guard('customer')->user()->id;
        }else{
            $request['user_id']=null;
        }
       
        switch ((int)$type) {
            case 1:
                $validator = Validator::make($request->all(), ['slug' => 'required|exists:movies,slug', 'user_id' => 'nullable|exists:customers,id']);
                $model = Movie::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType', 'movieHasCategories'])->select(['id', 'title', 'transcode','slug', 'description', 'rating', 'release_date', 'trailer_url', 'thumbnail', 'poster', 'summary', 'type', 'unique_code','run_time','position','movie_path']);
                break;
            case 2:
                $validator = Validator::make($request->all(), ['slug' => 'required|exists:tv_series,slug', 'user_id' => 'nullable|exists:customers,id']);
                $model = TvSeries::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
                break;
            case 3:
                $validator = Validator::make($request->all(), ['slug' => 'required|exists:web_series,slug', 'user_id' => 'nullable|exists:customers,id']);
                $model = WebSeries::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
                break;
            default:
               return $this->webError($request);
        }
        if ($validator->fails()) {
            return $this->webError($request);
        }
        $movie = $model->where('slug', $request->slug)->first();
        // $movie->youtube_trailer = $movie->trailer_url;
        $movie->youtube_trailer = extractYoutubeCode($movie->trailer_url);
        $movie->custome_trailer = $movie->trailer_url1;
        $movie->makeHidden('trailer_url1');
        $movie->makeHidden('unique_code');
        $movie->makeHidden('movie_path');
        $actor = $movie->actor->pluck('id')->toArray();
        $director = $movie->director->pluck('id')->toArray();
        $writer = $movie->writer->pluck('id')->toArray();
        $genre = $movie->genre->pluck('id')->toArray();
        $actorMovie = MovieActor::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $directorMovie = MovieDirector::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $writerMovie = MovieWriter::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $genreMovie = MovieGenre::whereIn('genre_id', $genre)->get()->pluck('movie_id')->toArray();
        $movie->is_fav = false;
        $movie->is_like=false;
        $movie->is_dislike=false;
        $movie->premium_payment=false;
        if ($request->user_id) {
            $customer = Customer::where('id', $request->user_id)->first();
            $movie->is_fav = checkFav($customer->id, $movie->id, $type);
            $movie->is_like = checkLike($customer->id, $movie->unique_code);
            $movie->is_dislike = checkDislike($customer->id, $movie->unique_code);
            $movie->premium_status=false;
            $movie->premium_status=(new PremiumContentAction($customer,$movie))->checkPremium()['status'] ?? false;
            $movie->premium_details = (new PremiumContentAction($customer,$movie))->checkPremium();
            if($movie->premium_status){
                $movie->premium_payment=checkCustomerPreimumContentStatus($customer,$movie->premium_details,$movie->id);
            }
            
        }else{
            $movie->premium_status=(new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
        }
        if ($type == '1') {
            $category = $movie->movieHasCategories->pluck('id');
            $categoryMovie = MovieCategory::whereIn('cat_id', $category)->get()->pluck('movie_id')->toArray();
        } else {
            $categoryMovie = [];
        }
        $mergedFilterId = collect(array_merge($actorMovie, $directorMovie, $writerMovie, $genreMovie, $categoryMovie))->unique()->toArray();

        if ((int)$type != 1) {
            $episodes = $movie->episodes;
            if (count($episodes) > 0) {
                $movie->videocode = $episodes[0]->unique_code ? base64_encode($episodes[0]->unique_code) : null;
                $movie->total_views = $episodes[0]->views->view_count ?? null;
                $movie->total_likes = count($episodes[0]->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0;
                
            }else{
                $movie->videocode = null;
                $movie->total_views = null;
                $movie->total_likes = 0;
            }
           
            $movie->episodesData = $episodes->map(function ($item) {
                $item->videocode = base64_encode($item->unique_code);
                $item->makeHidden('unique_code');
                $item->makeHidden('video_path');
                $item->makeHidden('views',$item->views->view_count ?? 0);
                $item->setAttribute('total_views',$item->views->view_count ?? 0);
                $item->setAttribute('total_likes',count($item->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0);
                $item->makeHidden('likeDislikes');
            });
        } else {
            $movie->videocode = base64_encode($movie->unique_code);
            $movie->episodesData = null;
            $movie->total_views=$movie->views->view_count ?? 0;
            $movie->total_likes=count($movie->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0;
        }

        if($request->user_id){
            $movie->videocode = $movie->youtube_trailer;
        }else{
            $movie->videocode = extractYoutubeCode($movie->youtube_trailer);
        }
        $movie->related_movie = Movie::whereIn('id', $mergedFilterId)->where('id', '!=', $movie->id)->orderBy('position','ASC')->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'slug' => $item->slug,
                'poster' => $item->poster,
                'rating' => $item->rating,
                'type' => $item->type
            ];
        });

        if (!$movie) {
            return $this->returnHomePage($request,'Sorry No Data Found !!');
        }
        if($type !='1'){
            $tvSeriess=TvSeries::where('id','!=',$movie->id)->get();
            $webSeriess=WebSeries::where('id','!=',$movie->id)->orderBy('position','ASC')->get();
        }else{
            $tvSeriess=TvSeries::get();
            $webSeriess=WebSeries::orderBy('position','ASC')->get();
        }
        $customer=Auth::guard('customer')->user();
        return view('frontend.moviedetails',compact('movie','webSeriess','tvSeriess','customer'));
    }

    public function movieDetailsStremmingSoon(Request $request,$slug){
        $slug=$slug;
        $request['slug']=$slug;
        if(!$slug){
            return $this->webError($request);
        }
        $type = $request->type;
       
        $model = null;
        $customer=Auth::guard('customer')->user();
        if($customer){
            $request['user_id']=Auth::guard('customer')->user()->id;
        }else{
            $request['user_id']=null;
        }
       
        $validator = Validator::make($request->all(), ['slug' => 'required|exists:stremmings,slug', 'user_id' => 'nullable|exists:customers,id']);
        $model = Stremming::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
        if ($validator->fails()) {
            return $this->webError($request);
        }
        $movie = $model->where('slug', $request->slug)->first();
        // dd($movie);
        // $movie->youtube_trailer = $movie->trailer_url;
        $movie->youtube_trailer = extractYoutubeCode($movie->trailer_url);
        $movie->custome_trailer = $movie->trailer_url1;
        $movie->makeHidden('trailer_url1');
        $movie->makeHidden('unique_code');
        $movie->makeHidden('movie_path');
        $actor = $movie->actor->pluck('id')->toArray();
        $director = $movie->director->pluck('id')->toArray();
        $writer = $movie->writer->pluck('id')->toArray();
        $genre = $movie->genre->pluck('id')->toArray();
        $actorMovie = MovieActor::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $directorMovie = MovieDirector::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $writerMovie = MovieWriter::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $genreMovie = MovieGenre::whereIn('genre_id', $genre)->get()->pluck('movie_id')->toArray();
        $movie->is_fav = false;
        $movie->is_like=false;
        $movie->is_dislike=false;
        $movie->premium_payment=false;
        if ($request->user_id) {
            $customer = Customer::where('id', $request->user_id)->first();
            $movie->is_fav = checkFav($customer->id, $movie->id, $type);
            $movie->is_like = checkLike($customer->id, $movie->unique_code);
            $movie->is_dislike = checkDislike($customer->id, $movie->unique_code);
            $movie->premium_status=false;
            $movie->premium_status=(new PremiumContentAction($customer,$movie))->checkPremium()['status'] ?? false;
            $movie->premium_details = (new PremiumContentAction($customer,$movie))->checkPremium();
            if($movie->premium_status){
                $movie->premium_payment=checkCustomerPreimumContentStatus($customer,$movie->premium_details,$movie->id);
            }
            
        }else{
            $movie->premium_status=(new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
        }
        if ($type == '1') {
            $category = $movie->movieHasCategories->pluck('id');
            $categoryMovie = MovieCategory::whereIn('cat_id', $category)->get()->pluck('movie_id')->toArray();
        } else {
            $categoryMovie = [];
        }
        $mergedFilterId = collect(array_merge($actorMovie, $directorMovie, $writerMovie, $genreMovie, $categoryMovie))->unique()->toArray();

        
            $movie->videocode = base64_encode($movie->unique_code);
            $movie->episodesData = null;
            $movie->total_views=$movie->views->view_count ?? 0;
            $movie->total_likes=0;

        if($request->user_id){
            $movie->videocode = $movie->youtube_trailer;
        }else{
            $movie->videocode = extractYoutubeCode($movie->youtube_trailer);
        }
        $movie->related_movie = Movie::whereIn('id', $mergedFilterId)->where('id', '!=', $movie->id)->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'slug' => $item->slug,
                'poster' => $item->poster,
                'rating' => $item->rating,
                'type' => $item->type
            ];
        });

        if (!$movie) {
            return $this->returnHomePage($request,'Sorry No Data Found !!');
        }
        if($type !='1'){
            $tvSeriess=TvSeries::where('id','!=',$movie->id)->get();
            $webSeriess=WebSeries::where('id','!=',$movie->id)->get();
        }else{
            $tvSeriess=TvSeries::get();
            $webSeriess=WebSeries::get();
        }
        $customer=Auth::guard('customer')->user();
        return view('frontend.moviedetailsstremming',compact('movie','webSeriess','tvSeriess','customer'));
    }

    public function episodeDetails(Request $request,$series,$episode,$type){
        $series=$request->series;
        $episodeSlug=$request->episode;
        $type=$request->type;
        if(!$series || !$episodeSlug || !$type){
            return $this->webError($request);
        }
        switch ((int)$type) {
            case 2:
                $model = TvSeries::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
                $episodeModel=new TvSeriesPart();
                break;
            case 3:
                $model = WebSeries::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
                $episodeModel=new WebSeriesPart();
                break;
            default:
               return $this->webError($request);
        }
        $movie = $model->where('slug',$series)->firstOrFail();
        $movie->youtube_trailer = $movie->trailer_url;
        $movie->custome_trailer = $movie->trailer_url1;
        $movie->makeHidden('trailer_url1');
        $movie->makeHidden('unique_code');
        // $movie->makeHidden('movie_path');
        $actor = $movie->actor->pluck('id')->toArray();
        $director = $movie->director->pluck('id')->toArray();
        $writer = $movie->writer->pluck('id')->toArray();
        $genre = $movie->genre->pluck('id')->toArray();
        $actorMovie = MovieActor::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $directorMovie = MovieDirector::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $writerMovie = MovieWriter::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $genreMovie = MovieGenre::whereIn('genre_id', $genre)->get()->pluck('movie_id')->toArray();
        $movie->is_fav = false;
        $movie->is_like=false;
        $movie->is_dislike=false;
        $movie->premium_payment=false;
        if ($request->user_id) {
            $customer = Customer::where('id', $request->user_id)->first();
            $movie->is_fav = checkFav($customer->id, $movie->id, $type);
            $movie->is_like = checkLike($customer->id, $movie->unique_code);
            $movie->is_dislike = checkDislike($customer->id, $movie->unique_code);
            $movie->premium_status=false;
            $movie->premium_status=(new PremiumContentAction($customer,$movie))->checkPremium()['status'] ?? false;
            $movie->premium_details = (new PremiumContentAction($customer,$movie))->checkPremium();
            if($movie->premium_status){
                $movie->premium_payment=checkCustomerPreimumContentStatus($customer,$movie->premium_details,$movie->id);
            }
            
        }else{
            $movie->premium_status=(new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
        }
        if ($type == '1') {
            $category = $movie->movieHasCategories->pluck('id');
            $categoryMovie = MovieCategory::whereIn('cat_id', $category)->get()->pluck('movie_id')->toArray();
        } else {
            $categoryMovie = [];
        }
        $mergedFilterId = collect(array_merge($actorMovie, $directorMovie, $writerMovie, $genreMovie, $categoryMovie))->unique()->toArray();

        if ((int)$type != 1) {
            $episodes = $movie->episodes;
            $movie->videocode = $episodes[0]->unique_code ? base64_encode($episodes[0]->unique_code) : null;
            $movie->total_views = $episodes[0]->views->view_count ?? null;
            $movie->total_likes = count($episodes[0]->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0;
            $movie->episodesData = $episodes->map(function ($item) {
                $item->videocode = base64_encode($item->unique_code);
                $item->makeHidden('unique_code');
                $item->makeHidden('video_path');
                $item->makeHidden('views',$item->views->view_count ?? 0);
                $item->setAttribute('total_views',$item->views->view_count ?? 0);
                $item->setAttribute('total_likes',count($item->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0);
                $item->makeHidden('likeDislikes');
            });
        } else {
            $movie->videocode = base64_encode($movie->unique_code);
            $movie->episodesData = null;
            $movie->total_views=$movie->views->view_count ?? 0;
            $movie->total_likes=count($movie->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0;
        }

        $movie->related_movie = Movie::whereIn('id', $mergedFilterId)->where('id', '!=', $movie->id)->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'slug' => $item->slug,
                'poster' => $item->poster,
                'rating' => $item->rating,
                'type' => $item->type
            ];
        });

        if (!$movie) {
            return $this->returnHomePage($request,'Sorry No Data Found !!');
        }
        if($type !='1'){
            $tvSeries=TvSeries::where('id','!=',$movie->id)->get();
            $webSeries=WebSeries::where('id','!=',$movie->id)->get();
        }else{
            $tvSeries=TvSeries::get();
            $webSeries=WebSeries::get();
        }
        $episodeData=$episodeModel->where('slug',$episodeSlug)->firstOrFail();
        $movie->transcode=$episodeData->transcode;
        return view('frontend.moviedetails',compact('movie','webSeries','tvSeries','episodeData'));
    }

    public function categoryDetails(Request $request,$slug,$type){
        $type=$type;
        $slug=$slug;
        if(!$type || !$slug){
            return $this->webError($request);
        }
        switch ((int)$type) {
            case 1:
                $mainCategory=Category::where('slug',$slug)->firstOrFail();
                $mainCategory=$mainCategory->title;
                $childrens = Category::descendantsAndSelf(Category::where('slug', $request->slug)->first())->pluck('id');
                $movieId = MovieCategory::whereIn('cat_id', $childrens->toArray())->get()->pluck('movie_id')->unique();
                $movies = Movie::whereIn('id', $movieId->toArray())->select(['title', 'slug', 'poster', 'type', 'rating', 'release_date','position'])->where('publication','1')->orderBy('position','ASC')->get();
                break;
            case 2:
                $mainCategory='Tv Series';
                $movies = TvSeries::select(['title', 'slug', 'poster', 'type', 'rating', 'release_date'])->where('publication','1')->orderBy('id', 'DESC')->get();
                break;
            case 3:
                $mainCategory='Web Series';
                $movies = WebSeries::select(['title', 'slug', 'poster', 'type', 'rating', 'release_date','position'])->where('publication','1')->orderBy('position', 'ASC')->get();
                break;
            default:
            return $this->webError($request);
                break;
        }
        return view('frontend.category',compact('movies','mainCategory'));
    }

    public function hotNewDetails(){
        $data['movies']=collect((new DataAction())->getHotAndNew())->unique('id');
        $data['title']='Hot & New';
        return view('frontend.sectionalldata',$data);
    }

    public function collectionDetails(Request $request,$slug,$type){
        $slug=$request->slug;
        $filter_type=$request->type;
        if(!$filter_type || !$slug){
            return $this->webError($request);
        }
        
            switch ((int)$filter_type) {
                case 1:
                    $category = Category::where('slug', $request->slug)->first();
                    if (!$category) {
                        return $this->responseApiError('Something Went Wrong !!', null, 200);
                    }
                    $movies = collect($category->movies->makeHidden('pivot')->toArray())->sortByDesc('id');
                    break;
                case 2:
                    $category = FeaturedSection::where('slug', $request->slug)->first();
                    switch ($category->type) {
                        case FeaturedSectionTypeEnum::CATEGORY:
                            $dataItems = collect($category->items)->pluck('item_id');
                            $movies = Category::whereIn('id', $dataItems)->with('movies')->get()->flatMap(function ($catValue) use ($category) {
                                return $catValue->movies->makeHidden('pivot')->toArray();
                            });
                            $movies = collect($movies)->sortByDesc('id');
                            break;
                        case FeaturedSectionTypeEnum::TVSERIES:
                            $dataItems = collect($category->items)->pluck('item_id');
                            $movies = TvSeries::whereIn('id', $dataItems)->select(['title', 'slug', 'poster', 'type'])->where('publication','1')->orderBy('id', 'DESC')->get()->toArray();
                            break;
                        case FeaturedSectionTypeEnum::WEBSERIES:
                            $dataItems = collect($category->items)->pluck('item_id');
                            $movies = WebSeries::whereIn('id', $dataItems)->select(['title', 'slug', 'poster', 'type'])->where('publication','1')->orderBy('position', 'ASC')->get()->toArray();
                            break;
                        case FeaturedSectionTypeEnum::MOVIES:
                            $dataItems = collect($category->items)->pluck('item_id');
                            $movies = Movie::whereIn('id', $dataItems)->select(['title', 'slug', 'poster', 'type'])->where('publication','1')->orderBy('position', 'ASC')->get()->toArray();
                            break;
                        default:
                            return $this->responseApiError('Something Went Wrong !!', null, 200);
                            break;
                    }
                    break;
                default:
                return $this->webError($request);
                    break;
            }
            $movies = PaginationHelper::paginate(collect($movies), 10);
            $movies = array_values($movies->items());
            $data = [
                'title' => $category->title,
                'slug' => $category->slug,
                'layout' => $category->view_type->name,
                'movies' => $movies
            ];
            $finalData['movies']=$data['movies'];
            $finalData['title']=$data['title'];
        return view('frontend.sectionalldata',$finalData);
    }

    public function castDetails(Request $request,$slug){
        $slug=$slug;
        if(!$slug){
            return $this->webError($request);
        }
        

        $star = Star::where('name', $slug)->firstOrFail();
        if (!$star) {
            return $this->webError($request);
        }
        switch ($star->star_type) {
            case StarTypeEnum::ACTOR:
                $movies = $star->actorMovies->makeHidden('pivot');
                $movies = collect($movies)->map(function ($item) {
                    $country = $item->country->map(function ($item) {
                        return $item->title;
                    });
                    return [
                        'title' => $item->title,
                        'slug' => $item->slug,
                        'poster' => $item->poster,
                        'rating' => $item->rating,
                        'type' => $item->type,
                        'summary' => $item->summary,
                        'release_date' => $item->release_date,
                        'country' => $country ?? null
                    ];
                });
                break;
            case StarTypeEnum::DIRECTOR:
                $movies = $star->directorMovies->makeHidden('pivot');
                $movies = collect($movies)->map(function ($item) {
                    $country = $item->country->map(function ($item) {
                        return $item->title;
                    });
                    return [
                        'title' => $item->title,
                        'slug' => $item->slug,
                        'poster' => $item->poster,
                        'rating' => $item->rating,
                        'type' => $item->type,
                        'summary' => $item->summary,
                        'release_date' => $item->release_date,
                        'country' => $country ?? null
                    ];
                });
                break;
            case StarTypeEnum::WRITER:
                $movies = $star->writerMovies->makeHidden('pivot');
                $movies = collect($movies)->map(function ($item) {
                    $country = $item->country->map(function ($item) {
                        return $item->title;
                    });
                    return [
                        'title' => $item->title,
                        'slug' => $item->slug,
                        'poster' => $item->poster,
                        'rating' => $item->rating,
                        'type' => $item->type,
                        'summary' => $item->summary,
                        'release_date' => $item->release_date,
                        'country' => $country ?? null
                    ];
                });
                break;
            default:
                return $this->responseApiError('Something Went Wrong !!', null, 200);
                break;
        }
        $data = [
            'title' => $star->name,
            'bio' => $star->star_bio,
            'image' => $star->image,
            'movies' => $movies
        ];
        return view('frontend.sectionalldata',$data);
    }

    public function genreDetails(Request $request,$slug){
        $slug=$request->slug;
        if(!$slug){
            return $this->webError($request);
        }
        
        $genre = Genre::where('slug', $slug)->first();
        if (!$genre) {
            return $this->webError($request);
        }
        $movies=$genre->movies->toArray();
        $tvSeries=$genre->tvSeries->toArray();
        $webSeries=$genre->webSeries->toArray();
        $finalData=array_merge($movies,$tvSeries,$webSeries);
        $data = [
            'title' => $genre->title,
            'bio' => $genre->description,
            'image' => $genre->icon,
            'movies' => $finalData
        ];
        return view('frontend.sectionalldata',$data);
    }

    public function languageDetails(Request $request,$slug){
        $slug=$request->slug;
        if(!$slug){
            return $this->webError($request);
        }
        $language = LanguageSelection::where('title', $slug)->first();
        if (!$language) {
            return $this->webError($request);
        }
        $movies=$language->movies->toArray();
        $tvSeries=$language->tvSeries->toArray();
        $webSeries=$language->webSeries->toArray();
        $finalData=array_merge($movies,$tvSeries,$webSeries);
        $data = [
            'title' => $language->title,
            'bio' => $language->description,
            'image' => $language->icon,
            'movies' => $finalData
        ];
        return view('frontend.sectionalldata',$data);
    }

    public function subscription(){

        $customer=Auth::guard('customer')->user();
        if(!$customer){
            request()->session()->flash('error','Plz Login First !!');
            return redirect()->route('customer.login');
        }

        
        $planContent = PlanContent::first();
        $plans = Plan::where('status','active')->get();
        $plansDatas = [];
        $plansContents = [];
        $customerCurrencyType='NPR';
        $currencyRate=1;
        $convertPrice=1;
        $usdCurrencyPrice=CurrencyRate::where('code','USD')->first();
        if($usdCurrencyPrice){
            $usdCurrencyPrice=(float)$usdCurrencyPrice->rate/(float)$usdCurrencyPrice->unit;
        }
        if($customer->cutomerDefaultCurrency){
            $currencyRateData=$customer->cutomerDefaultCurrency->currency;
            $customerCurrencyType=$currencyRateData->code;
            $currencyRate=((float)$currencyRateData->rate/(float)$currencyRateData->unit);
        }else{
            $convertPrice=100;
        }

        // dd($convertPrice);
        
        $allSubscriptionData=[];
        foreach ($plans as $key => $planData) {
            $plansDatas[$key] = [
                'id' => $planData->id,
                "title" => $planData->title,
                "features" => [
                    $planData->premium_content ? true :false,
                    $planData->livetv ? true :false,
                    $planData->addfree ? true :false,
                    $planData->download ? true :false,
                    ($planData->device != 'null') ? $planData->device() : '',
                    $planData->screensize,
                    ($planData->video_quality != 'null') ? $planData->videoQuality() : '',
                    ($planData->audio_quality != 'null') ? $planData->audioQuality() : '',
                ],
                'subscription' => collect($planData->subscription)->map(function ($item) use($customerCurrencyType,$usdCurrencyPrice,$currencyRate) {
                    $item->period_id = $item->period->value . '(' . $item->period->type->name . ')';
                    $item->currency_type=$customerCurrencyType ?? "NPR";
                    $item->price=round(($item->price * $usdCurrencyPrice)/$currencyRate,4);
                    $item->makeHidden('period');
                    return $item;
                })
            ];
        }
        $allSubscriptionData=Subscription::where('status','active')->get()->map(function ($item) use($customerCurrencyType,$usdCurrencyPrice,$currencyRate,$convertPrice,$customer) {
            $item->period_id = $item->period->value . '(' . $item->period->type->name . ')';
            $item->currency_type=$customerCurrencyType ?? "NPR";
            
            if($customer->cutomerDefaultCurrency){
                $item->price=round(($item->price * $usdCurrencyPrice)/$currencyRate,4);
            }else{
                $item->price=round(($item->price * $convertPrice),4);
            }
           
            // $item->price=round(($item->price * $convertPrice),4);
            // dd($item);
            $item->makeHidden('period');
            return $item;
        });
        $finalData = [];
        $finalData = [
            'data' => [
                'premium_content' => [
                    'title' => 'Premium Content',
                    'item' => ($planContent->premium_content != 'null') ? $planContent->premiumContent() : ''
                ],
                'live_tv' => [
                    'title' => 'Live Tv',
                    'item' =>  $planContent->livetv
                ],
                'add_free' => [
                    'title' => 'Add free',
                    'item' => $planContent->addfree
                ],
                'download' => [
                    'title' => 'Download',
                    'item' => $planContent->download
                ],
                'device' => [
                    'title' => 'Device',
                    'item' => ($planContent->device != 'null') ? $planContent->device() : ''
                ],
                'no_of_screen' => [
                    'title' => 'No. of screens',
                    'item' => $planContent->size ?? ''
                ],
                'video_quality' => [
                    'title' => 'Max video quality',
                    'item' => ($planContent->video_quality != 'null') ? $planContent->videoQuality() : ''
                ],
                'audio_quality' => [
                    'title' => 'Max audio quality',
                    'item' => ($planContent->audio_quality != 'null') ? $planContent->audioQuality() : ''
                ]
            ],
            'plan' => $plansDatas

        ];
        $defaultSubscription=$allSubscriptionData->where('is_suggested','1')->pluck('id')[0] ?? null;
        return view('frontend.subscription',compact('finalData','allSubscriptionData','defaultSubscription'));
    }

    public function fetCurrencyPriceFront(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First !!', null, 200);
        }

        if ($request->currency_code === 'NPR') {
            $currendtUsdRate = CurrencyRate::where('code', 'USD')->first();
            if ($request->to == 'npr') {
                $amount = $request->amount;
                $type = "NPR";
            } else {
                $amount = round((float)$request->amount / ((float)$currendtUsdRate->rate / (float)$currendtUsdRate->unit), 4);
                $type = "USD";
            }

            return $this->responseApiSuccessCustome('Final Amount !!', $amount, 'type', strtoupper($type), 200);
        }
        $validator = Validator::make($request->all(), [
            'currency_code' => 'required|exists:currency_rates,code',
            'amount' => 'required|string',
            'to' => 'required|in:npr,usd'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $currencyRate = CurrencyRate::where('code', $request->currency_code)->first();
        $currencyRate = (float)$currencyRate->rate / (float)$currencyRate->unit;
        $currendtUsdRate = CurrencyRate::where('code', 'USD')->first();
        switch ($request->to) {
            case 'npr':
                $finalAmount = round($currencyRate * (float)$request->amount, 4);
                $finalAmount=round($finalAmount/($currendtUsdRate->rate/$currendtUsdRate->unit)*100);
                break;
            case 'usd':
                $currendtUsdRate = CurrencyRate::where('code', 'USD')->first();
                $currendtUsdRate = (float)$currendtUsdRate->rate / (float)$currendtUsdRate->unit;
                $finalAmount = round(($currencyRate * (float)$request->amount) / $currendtUsdRate, 4);
                break;
            default:
                return $this->responseApiError('Currency Type Invalid !!', null, 200);
                break;
        }
        return $this->responseApiSuccessCustome('Final Amount !!', $finalAmount, 'type', strtoupper($request->to), 200);
    }

    public function upload(Request $request)
    {
        $chunk = $request->getContent();
        $chunkNumber = $request->header('X-Upload-Chunk');
        $fileName = $request->header('X-Upload-Name');
        $chunkSize = $request->header('X-Upload-Chunk-Size');
        $totalSize = $request->header('X-Upload-Total-Size');

        $tempFilePath = storage_path('app/temp/' . $fileName . '-' . $chunkNumber);
        file_put_contents($tempFilePath, $chunk);

        if ($this->allChunksUploaded($fileName, $chunkSize, $totalSize)) {
            $this->mergeChunks($fileName);
            return response()->json(['url' => $this->storeFile($fileName)]);
        } else {
            return response()->json(['success' => true]);
        }
    }

    private function allChunksUploaded($fileName, $chunkSize, $totalSize)
    {
        $totalChunks = ceil($totalSize / $chunkSize);
        $chunkFiles = glob(storage_path('app/temp/' . $fileName . '-*'));
        return count($chunkFiles) == $totalChunks;
    }

    private function mergeChunks($fileName)
    {
        $chunkFiles = glob(storage_path('app/temp/' . $fileName . '-*'));
        $outputPath = storage_path('app/uploads/' . $fileName);

        $outputFile = fopen($outputPath, 'w');
        foreach ($chunkFiles as $chunkFile) {
            fwrite($outputFile, file_get_contents($chunkFile));
            unlink($chunkFile);
        }
        fclose($outputFile);
    }

    private function storeFile($fileName)
    {
        $filePath = 'videos/' . $fileName;
        Storage::disk('s3')->put($filePath, fopen(storage_path('app/uploads/' . $fileName), 'r'));
        return Storage::disk('s3')->url($filePath);
    }

    public function pageDetails(Request $request,$slug){
        $page=Menu::where('slug',$slug)->firstOrFail();
        return view('frontend.page',compact('page'));
    }

    public function searchItem(Request $request){
        $searchItem=$request->searchItem;
        $movieSearch = Movie::whereRaw('LOWER(title) like ?', ['%' . strtolower($request->search) . '%'])
        ->select(['id','title','slug','rating','poster','summary','release_date','type','position'])
        ->orderBy('position','ASC')
        ->get()->map(function($movie){
            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
            $movie['premium_status'] = $premiumStatus;
            return $movie;
        })
        ->toArray();
        $webSeriesSearch=WebSeries::whereRaw('LOWER(title) like ?', ['%' . strtolower($request->search) . '%'])
        ->select(['id','title','slug','rating','poster','summary','release_date','type','position'])
        ->orderBy('position','ASC')
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
        $finalData['movies']=array_merge($movieSearch,$webSeriesSearch,$tvSeriesSearch);
        $finalData['title']='Search Item For '.$request->searchItem;
        RecomendedSearch::create([
            'key'=>$request->search,
            'search_date'=>Carbon::now()->format('Y-m-d')
        ]);
        return view('frontend.sectionalldata',$finalData);
    }

}
