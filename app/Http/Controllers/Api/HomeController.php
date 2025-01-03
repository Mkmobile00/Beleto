<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Menu;
use App\Models\Star;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Slider;
use GuzzleHttp\Client;
use App\Models\Category;
use App\Models\Currency;
use App\Models\TvSeries;
use App\Models\Stremming;
use App\Models\WebSeries;
use App\Models\MovieActor;
use App\Models\MovieGenre;
use App\Models\StartUpAdd;
use App\Models\MovieWriter;
use Illuminate\Support\Str;
use App\Models\CurrencyRate;
use App\Models\TvSeriesPart;
use Illuminate\Http\Request;
use App\Models\MovieCategory;
use App\Models\MovieDirector;
use App\Models\WebSeriesPart;
use App\Models\PaymentHistory;
use Illuminate\Support\Carbon;
use App\Enum\Setting\VideoEnum;
use App\Enum\Star\StarTypeEnum;
use App\Models\FeaturedSection;
use Illuminate\Validation\Rule;
use App\Http\Traits\GenerateOtp;
use App\Models\Customer\Customer;
use App\Mail\ResetPasswordOtpMail;
use Illuminate\Support\Facades\DB;
use App\Data\Currency\CurrencyData;
use App\Utilities\PaginationHelper;
use BaconQrCode\Renderer\Path\Move;
use App\Enum\Customer\MovieTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Api\CustomerWishList;
use App\Models\CustomerMovieHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Enum\Customer\LikeDislikeEnum;
use App\Http\Traits\UniqueIdGenerator;
use App\Models\Api\CustomerDeviceList;
use App\Models\CustomerDefaultCurrency;
use Illuminate\Database\Eloquent\Model;
use App\Enum\Customer\CustomerStatusEnum;
use App\Models\CustomerStatusUpAddLookup;
use Illuminate\Support\Facades\Validator;
use App\Actions\VideoAction\VideoActionCheck;
use App\Enum\FeaturedSection\FeaturedSectionTypeEnum;
use App\Actions\Api\PremiumContent\PremiumContentAction;
use App\Actions\Api\PremiumContent\PremiumContentActionUnAuthorized;

class HomeController extends Controller
{
    use UniqueIdGenerator,GenerateOtp;
    protected $customerDefaultCurrency;
    protected $customerWishList;
    protected $customerMovieHistory;
    public function __construct(CustomerDefaultCurrency $customerDefaultCurrency, CustomerWishList $customerWishList, CustomerMovieHistory $customerMovieHistory)
    {
        $this->customerDefaultCurrency = $customerDefaultCurrency;
        $this->customerWishList = $customerWishList;
        $this->customerMovieHistory = $customerMovieHistory;
    }
    public function subscription()
    {
        // $customer=Auth::user();
    }

    public function generateRandomNum()
    {
        $randomNumber = $this->getUniqueId('SubscriptionPayment', 'TXN', 'id');
        $response = [
            'error' => false,
            'data' => $randomNumber,
            'msg' => 'Random Number'
        ];
        return response()->json($response, 200);
    }

    public function getCurrency()
    {
        $currencies = (new CurrencyData())->getSelectionData();
        return $this->responseApiSuccess("Currency Data", $currencies, 200);
    }

    public function setDefaultCurrency(Request $request)
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First !!', null, 200);
        }
        $validator = Validator::make($request->all(), [
            'currency_id' => 'nullable|exists:currency_rates,id',
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $customerDefaultCurrency = $customer->cutomerDefaultCurrency->currency ?? null;
        if ($customerDefaultCurrency) {
            $customer->cutomerDefaultCurrency->delete();
        }
        $data = [
            'customer_id' => $customer->id,
            'currency_id' => (int)$request->currency_id
        ];
        if ($request->currency_id) {
            $this->customerDefaultCurrency->create($data);
        }

        return $this->responseApiSuccess('Default Currency Set Successfully !!', null, 200);
    }

    public function fetCurrencyPrice(Request $request)
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First !!', null, 200);
        }
        $convertPrice=100;
        if ($request->currency_code === 'NPR') {
            $currendtUsdRate = CurrencyRate::where('code', 'USD')->first();
            if ($request->to == 'npr') {
                $amount = $request->amount;
                $type = "NPR";
            } else {
                // $amount = round((float)$request->amount / ((float)$currendtUsdRate->rate / (float)$currendtUsdRate->unit), 4);
                $amount=round(($request->amount /$convertPrice),4);
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
        $status=false;
        if($request->currency_code !='USD'){
            $status=true;
        }
        switch ($request->to) {
            case 'npr':
                // $finalAmount = round($currencyRate * (float)$request->amount, 4);
                // $finalAmount=round(($request->amount * $convertPrice),4);


                $currendtUsdRate = CurrencyRate::where('code', 'USD')->first();
                $currendtUsdRate = (float)$currendtUsdRate->rate / (float)$currendtUsdRate->unit;
                $finalAmount = round(($currencyRate * (float)$request->amount) / $currendtUsdRate, 4);
                // $finalAmount=round(($finalAmount * $convertPrice),4);
                $finalAmount=round(($finalAmount * $convertPrice),4);
                break;
            case 'usd':
                $currendtUsdRate = CurrencyRate::where('code', 'USD')->first();
                $currendtUsdRate = (float)$currendtUsdRate->rate / (float)$currendtUsdRate->unit;
                // $finalAmount = round(($currencyRate * (float)$request->amount) / $currendtUsdRate, 4);

                
                if($status){
                    $finalAmount = round(($currencyRate * (float)$request->amount) / $currendtUsdRate, 4);
                    
                }else{
                    $finalAmount = (float)$request->amount;
                }
                break;
            default:
                return $this->responseApiError('Currency Type Invalid !!', null, 200);
                break;
        }
        return $this->responseApiSuccessCustome('Final Amount !!', $finalAmount, 'type', strtoupper($request->to), 200);
    }

    public function customerPaymentHistory()
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $paymentHistories = $customer->paymentHistories->map(function ($item) {
            return [
                'title' => 'Online Payment',
                'amount' => ($item->amount_type == 'npr' ? 'NPR ' : '$ ') . $item->amount,
                'operator' => $item->payment_type->name,
                'type' => 'Online',
                'invoice_num' => $item->transaction_id,
                'for_payment' => $item->purpose,
                'date' => Carbon::parse($item->created_at)->formatLocalized('%d %B, %Y')
            ];
        });
        return $this->responseApiSuccess("Payment Histories", $paymentHistories, 200);
    }

    public function customerAllSubscription()
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $today = Carbon::today();
        $future_date = Carbon::createFromFormat('Y-m-d', '2026-02-09');
        $days_left = $today->diffInDays($future_date);
        $allSubscription = $customer->subscription->where('is_expired', '0')->map(function ($item) use ($today) {
            $future_date = Carbon::createFromFormat('Y-m-d', $item->to_date);
            $days_left = $today->diffInDays($future_date);
            return [
                'title' => $item->subscription->title,
                'days' => $item->subscription_id,
                'total_days' => (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date)),
                'left_days' => $days_left,
                'percentage' => round(($days_left / (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date))) * 100),
                'from' => Carbon::parse($item->from_date)->formatLocalized('%d %B, %Y'),
                'to' => Carbon::parse($item->to_date)->formatLocalized('%d %B, %Y')
            ];
        });
        return $this->responseApiSuccess("Subscription List", $allSubscription, 200);
    }

    public function addWishList(Request $request)
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }

        $validator = Validator::make($request->all(), [
            'movie_id' => 'required',
            'video_type' => ['required', Rule::in(MovieTypeEnum::MOVIE, MovieTypeEnum::TVSERIES, MovieTypeEnum::WEBSERIES)]
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        DB::beginTransaction();
        try {

            $alereadyExists = CustomerWishList::where('customer_id', $customer->id)->where('movie_id', $request->movie_id)->where('video_type', $request->video_type)->first();
            if ($alereadyExists) {
                $alereadyExists->delete();
                DB::commit();
                return $this->responseApiSuccess("Remove From Wish List !!", null, 200);
            }
            $data = $request->all();
            $data['customer_id'] = $customer->id;
            $this->customerWishList->fill($data);
            $this->customerWishList->save();
            DB::commit();
            return $this->responseApiSuccess("Added To Wish List !!", null, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }

    public function customerWishList()
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $customerWishList = $customer->wishList->groupBy('video_type');
        $moviesList = [];
        foreach ($customerWishList as $index => $list) {
            switch ($index) {
                case 1: //movie
                    $moviesList = array_merge($this->wishListMovie($list)->toArray(), $moviesList);
                    break;
                case 2: //tvshow
                    $moviesList = array_merge($this->wishListTvSeries($list)->toArray(), $moviesList);
                    break;
                case 3: // webseries
                    $moviesList =  array_merge($this->wishListWebSeries($list)->toArray(), $moviesList);
                    break;
                default:
                    return $this->responseApiError('Something Went Wrong !!', null, 200);
                    break;
            }
        }

        return $this->responseApiSuccess("Wish List Data !!", $moviesList, 200);
    }

    public function wishListMovie($data)
    {

        return $movies = collect($data)->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->movie->title,
                'slug' => $item->movie->slug,
                'image' => $item->movie->poster,
                'summary' => $item->movie->summary,
                'rating' => $item->movie->rating,
                'movie_id' => $item->movie->id,
                'type' => $item->video_type,
                'release_date' => $item->movie->release_date ?? null,
                'country' => $item->movie->country->map(function ($item) {
                    return $item->title;
                })
            ];
        });
    }

    public function wishListTvSeries($data)
    {

        return $movies = collect($data)->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->tvSeries->title,
                'slug' => $item->tvSeries->slug,
                'image' => $item->tvSeries->poster,
                'summary' => $item->tvSeries->summary,
                'rating' => $item->tvSeries->rating,
                'movie_id' => $item->tvSeries->id,
                'type' => $item->video_type,
                'release_date' => $item->tvSeries->release_date ?? null,
                'country' => $item->tvSeries->country->map(function ($item) {
                    return $item->title;
                })
            ];
        });
    }

    public function wishListWebSeries($data)
    {

        return $movies = collect($data)->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->webSeries->title,
                'slug' => $item->webSeries->slug,
                'image' => $item->webSeries->poster,
                'summary' => $item->webSeries->summary,
                'rating' => $item->webSeries->rating,
                'movie_id' => $item->webSeries->id,
                'type' => $item->video_type,
                'release_date' => $item->webSeries->release_date ?? null,
                'country' => $item->webSeries->country->map(function ($item) {
                    return $item->title;
                })
            ];
        });
    }

    public function home()
    {
        $finalData = [];
        $categories = Category::where('status', '1')->with('movies')->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'slug' => $item->slug,
                'layout' => $item->view_type->name,
                'filter_type' => '1',
                'movies' => collect($item->movies->makeHidden('pivot')->toArray())->map(function($movie){
                            $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                            $movie['premium_status'] = $premiumStatus;
                            return $movie;
                            })->take(10)->values()->all()
            ];
        });

        $featuredSection = FeaturedSection::where('status', VideoEnum::ACTIVE)->get()->map(function ($item) {
            switch ($item->type) {
                case FeaturedSectionTypeEnum::CATEGORY:
                    $dataItems = collect($item->items)->pluck('item_id');
                    $movies = Category::whereIn('id', $dataItems)->with('movies')->get()->flatMap(function ($catValue) use ($item) {
                        return $catValue->movies->makeHidden('pivot')->toArray();
                    });
                    $movies = collect($movies)->sortByDesc('id')->take(10);
                    break;
                case FeaturedSectionTypeEnum::TVSERIES:
                    $dataItems = collect($item->items)->pluck('item_id');
                    $movies = TvSeries::whereIn('id', $dataItems)->select(['id','title', 'slug', 'poster', 'type','thumbnail'])->orderBy('id', 'DESC')->take(10)->get()->toArray();
                    break;
                case FeaturedSectionTypeEnum::WEBSERIES:
                    $dataItems = collect($item->items)->pluck('item_id');
                    $movies = WebSeries::whereIn('id', $dataItems)->select(['id','title', 'slug', 'poster', 'type','thumbnail','position'])->where('publication','1')->orderBy('position', 'ASC')->take(10)->get()->toArray();
                    break;
                case FeaturedSectionTypeEnum::MOVIES:
                    $dataItems = collect($item->items)->pluck('item_id');
                    $movies = Movie::whereIn('id', $dataItems)->select(['id','title', 'slug', 'poster', 'type','thumbnail','position'])->where('publication','1')->orderBy('position', 'ASC')->take(10)->get()->toArray();
                    break;
                default:
                    return $this->responseApiError('Something Went Wrong !!', null, 200);
                    break;
            }
            $movies = collect($movies)->map(function($movie) {
                $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                $movie['premium_status'] = $premiumStatus;
                return $movie;
            })->values()->all();
            // dd($movies);
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
        $finalData = array_merge($categoriesArray, $featuredSectionArray, $finalData);
        $finalData = PaginationHelper::paginate(collect($finalData), 5);
        $next_page = $finalData->nextPageUrl();
        $finalData = array_values($finalData->items());
        return response()->json([
            'error' => false,
            'data' => $finalData,
            'next_url' => $next_page,
            'msg' => "HomePage Data !!"
        ], 200);
    }

    public function movieDetails(Request $request)
    {
        // $customer = Auth::user();
        // if (!$customer) {
        //     return $this->responseApiError('Plz Login First', null, 200);
        // }
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
        switch ((int)$type) {
            case 1:
                $validator = Validator::make($request->all(), ['slug' => 'required|exists:movies,slug', 'user_id' => 'nullable|exists:customers,id']);
                $model = Movie::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType', 'movieHasCategories'])->select(['id', 'title', 'slug', 'description', 'rating', 'release_date', 'trailer_url', 'thumbnail', 'poster', 'summary', 'type', 'unique_code','position']);
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
                return $this->responseApiError('Invalid Type Value !!', null, 200);
        }
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ], 200);
        }
        $movie = $model->where('slug', $request->slug)->first();
        $movie->youtube_trailer = $movie->trailer_url;
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
                // $movie->premium_payment=checkCustomerPreimumContentStatus($customer,$movie->premium_details,$movie->id);
                $movie->premium_payment=true;
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
            $movie->episodes = $episodes->map(function ($item) {
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
            $movie->episodes = null;
            $movie->total_views=$movie->views->view_count ?? 0;
            $movie->total_likes=count($movie->likeDislikes->where('status',LikeDislikeEnum::LIKE)) ?? 0;
        }

        $movie->related_movie = Movie::whereIn('id', $mergedFilterId)->where('id', '!=', $movie->id)->where('publication','1')->orderBy('position','ASC')->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'slug' => $item->slug,
                'poster' => $item->poster,
                'rating' => $item->rating,
                'type' => $item->type
            ];
        });

        if (!$movie) {
            return $this->responseApiError('Sorry No Data Found !!', null, 200);
        }
        return $this->responseApiSuccess("Movie Details Data !!", $movie, 200);
    }

  

    public function castsDetails(Request $request)
    {
        // $customer = Auth::user();
        // if (!$customer) {
        //     return $this->responseApiError('Plz Login First', null, 200);
        // }
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:stars,id',
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        $star = Star::where('id', $request->id)->first();
        if (!$star) {
            return $this->responseApiError('Sorry No Data Found !!', null, 200);
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
            'name' => $star->name,
            'bio' => $star->star_bio,
            'image' => $star->image,
            'movies' => $movies
        ];
        return $this->responseApiSuccess("Casts Details !!", $data, 200);
    }

    public function getGenre(Request $request)
    {
        // $customer = Auth::user();
        // if (!$customer) {
        //     return $this->responseApiError('Plz Login First', null, 200);
        // }
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:stars,id',
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $genre = Genre::where('id', $request->id)->first();
        if (!$genre) {
            return $this->responseApiError('Sorry No Data Found !!', null, 200);
        }

        $data = [
            'name' => $genre->title,
            'bio' => $genre->description,
            'image' => $genre->icon,
            'movies' => $genre->movies
        ];
        return $this->responseApiSuccess("Genre Details !!", $data, 200);
    }

    public function saveHistory(Request $request)
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }

        $validator = Validator::make($request->all(), [
            'id' => "required",
            'video_type' => ['required', Rule::in(MovieTypeEnum::MOVIE, MovieTypeEnum::TVSERIES, MovieTypeEnum::WEBSERIES)]
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['customer_id'] = $customer->id;
            $data['movie_id'] = $request->id;
            $this->customerMovieHistory->fill($data);
            $this->customerMovieHistory->save();
            DB::commit();
            return $this->responseApiSuccess("Added To History !!", null, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }
    public function getViewHistory()
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        // dd($customer->getViewHistory);
        // switch ($item->video_type) {
        //     case FeaturedSectionTypeEnum::CATEGORY:
        //         $dataItems = collect($item->items)->pluck('item_id');
        //         $movies = Category::whereIn('id', $dataItems)->with('movies')->get()->map(function ($catValue) use ($item) {
        //             return $catValue->movies->makeHidden('pivot')->toArray();
        //         });
        //         break;
        //     case FeaturedSectionTypeEnum::TVSERIES:
        //         dd('2');
        //         break;
        //     case FeaturedSectionTypeEnum::WEBSERIES:
        //         dd('3');
        //         break;
        //     case FeaturedSectionTypeEnum::MOVIES:
        //         $dataItems = collect($item->items)->pluck('item_id');
        //         $movies = Movie::whereIn('id', $dataItems)->select(['title', 'slug', 'poster'])->get()->toArray();
        //         break;
        //     default:
        //         return $this->responseApiError('Something Went Wrong !!', null, 200);
        //         break;
        // }
    }

    public function notificationList()
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $notifications = $customer->notificationList->map(function ($item) {
            $fromModel = $item['from_model'];
            $fromId = $item['from_id'];
            $model = $fromModel::find($fromId);
            return [
                'title' => $model->title ?? '',
                'image' => $model->image ?? '',
                'summary' => $model->summary ?? '',
                'description' => $model->description ?? '',
                'date' => Carbon::parse($item->created_at)->formatLocalized('%d %B, %Y')
            ];
        });
        return $this->responseApiSuccess("Notification List !!", $notifications, 200);
    }

    public function categories()
    {
        $category = [];
        try {
            $categories = Category::whereNull('parent_id')->get();
            foreach ($categories as $key => $cat) {
                $category[$key]['title'] = $cat->title;
                $category[$key]['slug'] = $cat->slug;
                $category[$key]['type'] = '1';
                foreach ($cat->childCat as $value => $sub) {
                    $category[$key]['subcat'][$value]['title'] = $sub->title;
                    $category[$key]['subcat'][$value]['slug'] = $sub->slug;
                    $category[$key]['subcat'][$value]['parent_id'] = $sub->parent_id;
                    $category[$key]['subcat'][$value]['type'] = '1';
                }
            }
            $category[$key + 1]['title'] = 'Tv Shows';
            $category[$key + 1]['slug'] = 'tvshows';
            $category[$key + 1]['type'] = '2';
            $category[$key + 2]['title'] = 'Web Series';
            $category[$key + 2]['slug'] = 'webseries';
            $category[$key + 2]['type'] = '3';
            return $this->responseApiSuccess("All Category List !!", $category, 200);
        } catch (\Exception $ex) {
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }

    public function categoriesMovies(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => "required",
            'type' => "required|in:1,2,3"
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        try {
            switch ((int)$request->type) {
                case 1:
                    $childrens = Category::descendantsAndSelf(Category::where('slug', $request->slug)->first())->pluck('id');
                    $movieId = MovieCategory::whereIn('cat_id', $childrens->toArray())->get()->pluck('movie_id')->unique();
                    $movies = Movie::whereIn('id', $movieId->toArray())->select(['title', 'slug', 'poster', 'type', 'rating', 'release_date','position'])->where('publication','1')->orderBy('position','ASC')->paginate(10);
                    break;
                case 2:
                    $movies = TvSeries::select(['title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('id', 'DESC')->paginate(10);
                    break;
                case 3:
                    $movies = WebSeries::select(['title', 'slug', 'poster', 'type', 'rating', 'release_date','position'])->where('publication','1')->orderBy('position','ASC')->paginate(10);
                    break;
                default:
                    return $this->responseApiError('Something Went Wrong !!', null, 200);
                    break;
            }
            return $this->responseApiSuccess("All Category List !!", array_values($movies->items()), 200);
        } catch (\Exception $ex) {
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }

    public function hotNew()
    {

        try {
            $finalData = [];
            $movies = Movie::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('id', 'DESC')->limit(10)->get()->map(function($movie){
                $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                $movie['premium_status'] = $premiumStatus;
                return $movie;
            });

            $newRealeseMovies = collect($movies)->sortByDesc('created_at');

            $trendingMovies = Movie::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('rating', 'DESC')->limit(10)->get()->map(function($movie){
                $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                $movie['premium_status'] = $premiumStatus;
                return $movie;
            });

            $tvSeries = TvSeries::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('id', 'DESC')->limit(10)->get()->map(function($movie){
                $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                $movie['premium_status'] = $premiumStatus;
                return $movie;
            });

            $newRealesetvSeries = collect($tvSeries)->sortByDesc('created_at');

            $trendingtvSeries = TvSeries::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('rating', 'DESC')->limit(10)->get()->map(function($movie){
                $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                $movie['premium_status'] = $premiumStatus;
                return $movie;
            });

            $webSeries = WebSeries::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('id', 'DESC')->limit(10)->get()->map(function($movie){
                $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                $movie['premium_status'] = $premiumStatus;
                return $movie;
            });

            $newRealeseWebSeries = collect($webSeries)->sortByDesc('created_at');

            $trendingWebSeries = collect($webSeries)->sortByDesc('rating');

            $finalData[0]['title'] = 'New Realease Movie';
            $finalData[0]['slug'] = 'New Realease Movie';
            $finalData[0]['type'] = '1';
            $finalData[0]['movies'] = $newRealeseMovies;

            $finalData[1]['title'] = 'Trending Movies';
            $finalData[1]['slug'] = 'Trending Movies';
            $finalData[1]['type'] = '2';
            $finalData[1]['movies'] = $trendingMovies;

            $finalData[2]['title'] = 'New Realease Tv Series';
            $finalData[2]['slug'] = 'New Realease Tv Series';
            $finalData[2]['type'] = '3';
            $finalData[2]['movies'] = $newRealesetvSeries;

            $finalData[3]['title'] = 'Trending Tv Series';
            $finalData[3]['slug'] = 'Trending Tv Series';
            $finalData[3]['type'] = '4';
            $finalData[3]['movies'] = $trendingtvSeries;

            $finalData[4]['title'] = 'New Realease Web Series';
            $finalData[4]['slug'] = 'New Realease Web Series';
            $finalData[4]['type'] = '5';
            $finalData[4]['movies'] = $newRealeseWebSeries;

            $finalData[5]['title'] = 'Trending WebSeries';
            $finalData[5]['slug'] = 'Trending WebSeries';
            $finalData[5]['type'] = '6';
            $finalData[5]['movies'] = $trendingWebSeries;
            return $this->responseApiSuccess("Hot N New !!", $finalData, 200);
        } catch (\Exception $ex) {
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }

    public function sliders(Request $request)
    {
        if ($request->user_id) {
            $customer = Customer::where('id', $request->user_id)->first();
        }else{
            $customer=null;
        }
        $sliders = Slider::where('status', 'active')->select(['id', 'title', 'slug', 'sub_title', 'type', 'path', 'item_type', 'movie_id','position'])->orderBy('position','ASC')->get()->map(function ($item) use ($customer) {
            $is_fav=false;
            $item->makeHidden('slug');
            switch ($item->item_type) {
                case FeaturedSectionTypeEnum::TVSERIES:
                    $data = TvSeries::where('id', $item->movie_id)->first();
                    $item->setAttribute('movie_slug', $data->slug);
                    $item->setAttribute('item_type', 2);
                    if($customer){
                        $item->setAttribute('is_fav',checkFav($customer->id, $item->movie_id, $item->item_type));
                    }else{
                        $item->setAttribute('is_fav',$is_fav);
                    }
                    return  $item;
                    break;
                case FeaturedSectionTypeEnum::WEBSERIES:
                    $data = WebSeries::where('id', $item->movie_id)->first();
                    $item->setAttribute('movie_slug', $data->slug);
                    $item->setAttribute('item_type', 3);
                    if($customer){
                        $item->setAttribute('is_fav',checkFav($customer->id, $item->movie_id, $item->item_type));
                    }else{
                        $item->setAttribute('is_fav',$is_fav);
                    }
                    return  $item;
                    break;
                case FeaturedSectionTypeEnum::MOVIES:
                    $data = Movie::where('id', $item->movie_id)->first();
                    $item->setAttribute('movie_slug', $data->slug ?? null);
                    $item->setAttribute('item_type', 1);
                    if($customer){
                        $item->setAttribute('is_fav',checkFav($customer->id, $item->movie_id, $item->item_type));
                    }else{
                        $item->setAttribute('is_fav',$is_fav);
                    }
                    return  $item;
                    break;
                default:
                    return $item;
            }
        });

        return $this->responseApiSuccess("Sliders List !!", $sliders, 200);
    }


    public function featuredDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => "required",
            'filter_type' => "required|in:1,2"
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        try {
            switch ((int)$request->filter_type) {
                case 1:
                    $category = Category::where('slug', $request->slug)->first();
                    if (!$category) {
                        return $this->responseApiError('Something Went Wrong !!', null, 200);
                    }
                    $movies = collect($category->movies->makeHidden('pivot')->toArray());
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
                            $movies = TvSeries::whereIn('id', $dataItems)->select(['title', 'slug', 'poster', 'type'])->orderBy('id', 'DESC')->get()->toArray();
                            break;
                        case FeaturedSectionTypeEnum::WEBSERIES:
                            $dataItems = collect($category->items)->pluck('item_id');
                            $movies = WebSeries::whereIn('id', $dataItems)->select(['title', 'slug', 'poster', 'type','position'])->where('publication','1')->orderBy('position','ASC')->get()->toArray();
                            break;
                        case FeaturedSectionTypeEnum::MOVIES:
                            $dataItems = collect($category->items)->pluck('item_id');
                            $movies = Movie::whereIn('id', $dataItems)->select(['title', 'slug', 'poster', 'type','position'])->where('publication','1')->orderBy('position','ASC')->get()->toArray();
                            break;
                        default:
                            return $this->responseApiError('Something Went Wrong !!', null, 200);
                            break;
                    }
                    break;
                default:
                    return $this->responseApiError('Something Went Wrong !!', null, 200);
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
            return $this->responseApiSuccess("Featured Details With Movies !!", $data, 200);
        } catch (\Exception $ex) {
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }

    public function hotnewDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => "required|in:1,2,3,4,5,6"
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        switch ((int)$request->type) {
            case 1: //New Realease Movie
                $movies = Movie::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('id', 'DESC')->paginate(10)->map(function($movie){
                    $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                    $movie['premium_status'] = $premiumStatus;
                    return $movie;
                })->values()->all();
                // dd($movies);
                break;
            case 2: //Trending Movies
                $movies = Movie::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('rating', 'DESC')->paginate(10)->map(function($movie){
                    $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                    $movie['premium_status'] = $premiumStatus;
                    return $movie;
                })->values()->all();
                break;
            case 3: //New Realease Tv Series
                $movies = TvSeries::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('id', 'DESC')->paginate(10)->map(function($movie){
                    $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                    $movie['premium_status'] = $premiumStatus;
                    return $movie;
                })->values()->all();
                break;
            case 4: //Trending Tv Series
                $movies = TvSeries::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('rating', 'DESC')->paginate(10)->map(function($movie){
                    $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                    $movie['premium_status'] = $premiumStatus;
                    return $movie;
                })->values()->all();
                break;
            case 5: //New Realease Web Series
                $movies = WebSeries::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('id', 'DESC')->paginate(10)->map(function($movie){
                    $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                    $movie['premium_status'] = $premiumStatus;
                    return $movie;
                })->values()->all();
                break;
            case 6: //Trending WebSeries
                $movies = WebSeries::select(['id','title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('rating', 'DESC')->paginate(10)->map(function($movie){
                    $premiumStatus = (new PremiumContentActionUnAuthorized($movie))->checkPremium()['status'] ?? false;
                    $movie['premium_status'] = $premiumStatus;
                    return $movie;
                })->values()->all();
                break;
            default:
                return $this->responseApiError('Something Went Wrong !!', null, 200);
                break;
        }
        // dd($movies->items());
        return $this->responseApiSuccess("Movies List !!", $movies, 200);
    }

    public function customerDeviceList()
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $deviceList = $customer->deviceList->map(function ($item) {
            return [
                'id' => $item->id,
                'device_type' => $item->device_type->name,
                'device_name' => $item->device_name,
                'device_serial_num' => $item->device_serial_num,
                'added_date' => $item->added_date
            ];
        });
        return $this->responseApiSuccess("Device List !!", $deviceList, 200);
    }

    public function customerDeleteDeviceList(Request $request)
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $validator = Validator::make($request->all(), [
            'id' => "required|exists:customer_device_lists,id"
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        $customerDevice = CustomerDeviceList::whereId($request->id)->where('customer_id', $customer->id)->first();
        if (!$customerDevice) {
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
        DB::beginTransaction();
        try {
            $customerDevice->delete();
            DB::commit();
            return $this->responseApiSuccess("Device Removed Successfully !!", null, 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }

    public function allPages()
    {
        $pages = Menu::where('publish_status', true)->where('category_slug', 'page')->select(['name', 'slug','image'])->get();
        return $this->responseApiSuccess("All Page List !!", $pages, 200);
    }

    public function getPage(Request $request, $slug)
    {
        if (!$slug) {
            return $this->responseApiError('Slug Field Required !!', null, 200);
        }
        $page = Menu::where('publish_status', true)->where('category_slug', 'page')->where('slug', $slug)->first();
        DB::beginTransaction();
        try {

            DB::commit();
            return $this->responseApiSuccess("Page Details !!", $page, 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }

    public function slidersDetails(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => "required|exists:sliders,id"
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $slider = Slider::where('id', $request->id)->first();
        if ($slider->item_type == null || $slider->movie_id == null) {
            return $this->responseApiError('Invalid Type Value !!', null, 200);
        }
        $type = $slider->item_type->value;
        if (!$type || $type == null) {
            return response()->json([
                'error' => true,
                'data' => null,
                'msg' => 'Type Field Required'
            ], 200);
        }
        $validator = null;
        $model = null;
        switch ((int)$type) {
            case 1:
                $childrens = Category::descendantsAndSelf(Category::where('id', $slider->movie_id)->first())->pluck('id');
                $movieId = MovieCategory::whereIn('cat_id', $childrens->toArray())->get()->pluck('movie_id')->unique();
                $movie = Movie::whereIn('id', $movieId->toArray())->select(['title', 'slug', 'poster', 'type', 'rating', 'release_date'])->orderBy('id', 'DESC')->paginate(10);
                return $this->responseApiSuccess("Movie Details Data !!", $movie, 200);
                break;
            case 2:
                $model = TvSeries::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
                break;
            case 3:
                $model = WebSeries::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
                break;
            case 4:
                $model = Movie::with(['videoQuality', 'actor', 'director', 'writer', 'genre', 'country', 'language', 'videoType']);
                break;
            default:
                return $this->responseApiError('Invalid Type Value !!', null, 200);
        }

        $movie = $model->where('id', $slider->movie_id)->first();
        $movie->youtube_trailer = $movie->trailer_url ?? '';
        $movie->custome_trailer = $movie->trailer_url1 ?? '';
        $movie->makeHidden('trailer_url1');
        $actor = $movie->actor->pluck('id')->toArray();
        $director = $movie->director->pluck('id')->toArray();
        $writer = $movie->writer->pluck('id')->toArray();
        $genre = $movie->genre->pluck('id')->toArray();
        $actorMovie = MovieActor::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $directorMovie = MovieDirector::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $writerMovie = MovieWriter::whereIn('star_id', $actor)->get()->pluck('movie_id')->toArray();
        $genreMovie = MovieGenre::whereIn('genre_id', $genre)->get()->pluck('movie_id')->toArray();
        if ($type == '1') {
            $category = $movie->movieHasCategories->pluck('id');
            $categoryMovie = MovieCategory::whereIn('cat_id', $category)->get()->pluck('movie_id')->toArray();
        } else {
            $categoryMovie = [];
        }
        $mergedFilterId = collect(array_merge($actorMovie, $directorMovie, $writerMovie, $genreMovie, $categoryMovie))->unique()->toArray();
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
            return $this->responseApiError('Sorry No Data Found !!', null, 200);
        }
        return $this->responseApiSuccess("Movie Details Data !!", $movie, 200);
    }

    public function fetchVideo(Request $request)
    {
        if (!$request->api_key) {
            return $this->responseApiError('Sorry Something Went Wrong !!', null, 200);
        }
        if ($request->api_key != 'S2FudGlwdXIgQ2luZW1hcyBjcmVhdGVkIGJ5IG5lY3RhciBkaWdpdC4g') {
            return $this->responseApiError('Sorry Something Went Wrong !!', null, 200);
        }
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $validator = Validator::make($request->all(), [
            'videoCode' => "required",
            'device_serial_num' => 'required',
            'premium_payment'=>'required|in:true,false',
            'premium_status'=>'required|in:true,false'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        if($request->premium_payment=="true" && $request->premium_status=="true"){
            $accessStatus = (new VideoActionCheck($request, $customer))->checkPremiumDevice();
            if (!$accessStatus['status']) {
                return $this->responseApiError($accessStatus['msg'], null, 200);
            }
            $getCode = base64_decode($request->videoCode);
            $videoCode = $getCode;
            $movies = Movie::where('unique_code', $videoCode)->first();
            if (!$movies) {
                $movies = TvSeriesPart::where('unique_code', $videoCode)->first();
                if (!$movies) {
                    $movies = WebSeriesPart::where('unique_code', $videoCode)->first();
                    if (!$movies) {
                        return $this->responseApiError('InValid Code', null, 200);
                    }
                }
            }
        }else{
            $accessStatus = (new VideoActionCheck($request, $customer))->check();
            if (!$accessStatus['status']) {
                return $this->responseApiError($accessStatus['msg'], null, 200);
            }
            $getCode = base64_decode($request->videoCode);
            $videoCode = $getCode;
            $movies = Movie::where('unique_code', $videoCode)->first();
            if (!$movies) {
                $movies = TvSeriesPart::where('unique_code', $videoCode)->first();
                if (!$movies) {
                    $movies = WebSeriesPart::where('unique_code', $videoCode)->first();
                    if (!$movies) {
                        return $this->responseApiError('InValid Code', null, 200);
                    }
                }
            }
            $status = (new VideoActionCheck($request, $customer))->checkContent($movies);
            if (!$status['status']) {
                return $this->responseApiError($status['msg'], null, 200);
            }
        }
        $path = $movies->movie_path ?? $movies->video_path;
        return $this->responseApiSuccess("", base64_encode(explode(env('VIDEO_PATH'), $path)[1]), 200);
    }

    public function fetchVideoPath(Request $request)
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $response = [
            'error' => false,
            'data' => base64_encode(env('VIDEO_PATH')) ?? null,
            'msg' => 'Video Path !!'
        ];
        return $this->responseApiSuccess("", $response, 200);
    }

    public function imepayResponse(Request $request){
        $data=[
            "ResponseCode"=> "0",
            "ReferenceId"=> $request->ReferenceId,
            "ResponseDescription"=> "Payment Request Recorded"
           ];
           return response()->json($data,200);
    }
    public function detailpage() {
        return view('frontend.detailpage');
    }
    public function seeterms() {
        return view('frontend.seeterms');
    }
    public function aboutus() {
        return view('frontend.aboutus');
    }
    public function privacy_policy() {
        return view('frontend.privacy_policy');
    }
    public function help_center() {
        return view('frontend.help_center');
    }
    public function order_detail() {
        return view('frontend.order_detail');
    }

    public function hamroPayCheckout(Request $request){
        $data = [
            "merchant_id"=> $request->hamroPayMerchantId,
            "session_id"=> $request->sessionId,
            "token"=> $request->signatureField,
            "merchant_transaction_id"=>$request->invoiceNum,
            "remarks"=>$request->remarks
        ];
        return view('hamro',compact('data'));
    }

    public function requestResetPasswordCheck(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers,email',
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        DB::beginTransaction();
        try{
            $customer=Customer::where('email',$request->email)->first();
            if (!$customer) {
                $response = [
                    'error' => true,
                    'data' => null,
                    'msg' => 'User Not Found...'
                ];
                return response()->json($response, 200);
            }
            $reset_otp=$this->generateOtp();
            Mail::to($customer->email)->send(new ResetPasswordOtpMail($customer,$reset_otp));
            $customer->reset_otp=$reset_otp;
            $customer->save();
            DB::commit();
            $response = [
                'error' => false,
                'email' => $request->email,
                'msg' => 'Password Reset Otp Send Successfully !!'
            ];
            return response()->json($response, 200);
        }catch(\Throwable $th){
            DB::rollback();
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers,email',
            'password'=>'required|min:6|confirmed',
            'reset_otp'=>'required'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        DB::beginTransaction();
        try{
            $customer=Customer::where('email',$request->email)->where('reset_otp',$request->reset_otp)->first();
            if (!$customer) {
                $response = [
                    'error' => true,
                    'data' => null,
                    'msg' => 'Invalid Otp Or Email...'
                ];
                return response()->json($response, 200);
            }
           
            $customer->password=bcrypt($request->password);
            $customer->from_old='0';
            $customer->save();
            DB::commit();
            $response = [
                'error' => false,
                'email' => $request->email,
                'msg' => 'Password Updated Successfully !!'
            ];
            return response()->json($response, 200);
        }catch(\Throwable $th){
            DB::rollback();
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }

    public function streammingNow(){
        $streamingNow=Stremming::where('publication','1')->with(['actor','director','writer','genre'])->orderBy('position','ASC')->get();
        $response = [
            'error' => false,
            'data' => $streamingNow,
            'msg' => 'Streamming Now Data !!'
        ];
        return response()->json($response, 200);
    }

    public function getStartUpData(Request $request){
        $validator = Validator::make($request->all(), [
            'device_serial_num' => 'required'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $currentDate=Carbon::now();
        $startupData=StartUpAdd::where('status',CustomerStatusEnum::ACTIVE)->where('to_date','>=',$currentDate)->orderBy('id','DESC')->first();
        if($startupData){
            $customerStartupData=CustomerStatusUpAddLookup::where('startupadd_id',$startupData->id)->where('device_serial_num',$request->device_serial_num)->first();
            if($customerStartupData){
                $startupData=null;
            }
        }
        $response=[
            'error'=>false,
            'data'=>$startupData,
            'msg'=>'Start Up Data List !!'
        ];
        return response()->json($response,200);
    }

    public function deleteCustomerStartupAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'device_serial_num' => 'required',
            'startupadd_id'=>'required|exists:start_up_adds,id'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        DB::beginTransaction();
        try{
            $startupAdd=StartUpAdd::where('id',$request->startupadd_id)->first();
            if (!$startupAdd) {
                $response = [
                    'error' => true,
                    'data' => null,
                    'msg' => 'Something Went Wrong !!'
                ];
                return response()->json($response, 200);
            }

            CustomerStatusUpAddLookup::create([
                'startupadd_id'=>$request->startupadd_id,
                'device_serial_num' =>$request->device_serial_num
            ]);

            DB::commit();
            $response = [
                'error' => false,
                'email' => $request->email,
                'msg' => 'Removed Successfully !!'
            ];
            return response()->json($response, 200);
        }catch(\Throwable $th){
            DB::rollback();
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }

    public function fetchVideoIos(Request $request)
    {
        if (!$request->api_key) {
            return $this->responseApiError('Sorry Something Went Wrong !!', null, 200);
        }
        if ($request->api_key != 'S2FudGlwdXIgQ2luZW1hcyBjcmVhdGVkIGJ5IG5lY3RhciBkaWdpdC4g') {
            return $this->responseApiError('Sorry Something Went Wrong !!', null, 200);
        }
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $validator = Validator::make($request->all(), [
            'videoCode' => "required",
            'device_serial_num' => 'required',
            'premium_payment'=>'required|in:true,false',
            'premium_status'=>'required|in:true,false'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        if($request->premium_payment=="true" && $request->premium_status=="true"){
            $accessStatus = (new VideoActionCheck($request, $customer))->checkPremiumDevice();
            if (!$accessStatus['status']) {
                return $this->responseApiError($accessStatus['msg'], null, 200);
            }
            $getCode = base64_decode($request->videoCode);
            $videoCode = $getCode;
            $movies = Movie::where('unique_code', $videoCode)->first();
            if (!$movies) {
                $movies = TvSeriesPart::where('unique_code', $videoCode)->first();
                if (!$movies) {
                    $movies = WebSeriesPart::where('unique_code', $videoCode)->first();
                    if (!$movies) {
                        return $this->responseApiError('InValid Code', null, 200);
                    }
                }
            }
        }else{
            $accessStatus = (new VideoActionCheck($request, $customer))->check();
            if (!$accessStatus['status']) {
                return $this->responseApiError($accessStatus['msg'], null, 200);
            }
            $getCode = base64_decode($request->videoCode);
            $videoCode = $getCode;
            $movies = Movie::where('unique_code', $videoCode)->first();
            if (!$movies) {
                $movies = TvSeriesPart::where('unique_code', $videoCode)->first();
                if (!$movies) {
                    $movies = WebSeriesPart::where('unique_code', $videoCode)->first();
                    if (!$movies) {
                        return $this->responseApiError('InValid Code', null, 200);
                    }
                }
            }
            $status = (new VideoActionCheck($request, $customer))->checkContent($movies);
            if (!$status['status']) {
                return $this->responseApiError($status['msg'], null, 200);
            }
        }
        $path = $movies->movie_path ?? $movies->video_path;
        return $this->responseApiSuccess("", base64_encode(explode(env('VIDEO_PATH'), $path)[1]), 200);
    }

    
}
