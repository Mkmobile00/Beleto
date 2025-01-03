<?php

namespace App\Http\Controllers\Admin;

use ReflectionClass;
use App\Models\Movie;
use App\Models\TvSeries;
use App\Models\WebSeries;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\PremiumContent;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPayment;
use App\Utilities\PaginationHelper;
use BaconQrCode\Renderer\Path\Move;
use App\Enum\Customer\MovieTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Actions\Admin\Dashboard\DashboardAction;
use App\Models\VideoHistory;

class AdminController extends Controller
{
    protected $premiumContent;
    public function __construct(PremiumContent $premiumContent)
    {
        $this->premiumContent=$premiumContent;
    }
    public function dashboard(Request $request)
    {
        $filters=[
            'days'=>$request->daysValue ?? null
        ];
        
        $data=(new DashboardAction($filters))->arrangeData();
        return view('admin.dashboard',$data);
    }

    public function setMoviePremium(Request $request){
        $rules = [
            "type" => ["required", Rule::in(MovieTypeEnum::MOVIE, MovieTypeEnum::TVSERIES, MovieTypeEnum::WEBSERIES)],
            "price"=>["required","numeric","min:1"],
            "from" => [
                "nullable",
                "date",
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(date('Y-m-d'))) {
                        $fail("The $attribute must not be less than today's date.");
                    }
                },
            ],
            "to" => [
                "nullable",
                "date",
                function ($attribute, $value, $fail) use ($request) {
                    $from = $request->input('from');
                    if ($from && strtotime($value) < strtotime($from)) {
                        $fail("The $attribute must not be less than the 'from' date.");
                    }
                },
            ],
        ];
        switch((int)$request->type){
            case 1:
                $rules["movie_id"] = "required|exists:movies,id";
                break;
            case 2:
                $rules["movie_id"] = "required|exists:tv_series,id";
                break;
            case 3:
                $rules["movie_id"] = "required|exists:web_series,id";
                break;
            default:
                return false;
        }
        $existData=$this->premiumContent->where('movie_id',$request->movie_id)->where('type',$request->type)->first();
        if ($existData) {
            $rules['is_premium']= "nullable";
        }else{
            $rules['is_premium']="required|in:1";
        }
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response = [
                'validate' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        DB::beginTransaction();
        // try{
            $data=$request->all();
           
            if($existData){
                $this->premiumContent=$existData;
            }
            if(!$request->is_premium){
                $data['is_premium']='0';
            }
            if(!$request->duration){
                $data['duration']=null;
            }
            $this->premiumContent->fill($data);
            $this->premiumContent->save();
            DB::commit();
            $response = [
                'error' => false,
                'data' => null,
                'class'=>$this->premiumContent->is_premium=='1' ? '<span class="badge badge-success" id="setActive'.$request->movie_id.'">Active</span>':'<span class="badge badge-danger" id="setActive'.$request->movie_id.'">Not Set</span>',
                'msg' => 'Premium Content Set Successfully !!'
            ];
            return response()->json($response, 200);
        // }catch(\Throwable $th){
        //     DB::rollBack();
        //     $response = [
        //         'error' => true,
        //         'data' => null,
        //         'msg' => 'Something Went Wrong !!'
        //     ];
        //     return response()->json($response, 200);
        // }
    }

    public function fetchPremiumContent(Request $request){
        $rules=[
            "type"=>["required",Rule::in(MovieTypeEnum::MOVIE,MovieTypeEnum::TVSERIES,MovieTypeEnum::WEBSERIES)]
        ];
        switch((int)$request->type){
            case 1:
                $rules["movieId"] = "required|exists:movies,id";
                break;
            case 2:
                $rules["movieId"] = "required|exists:tv_series,id";
                break;
            case 3:
                $rules["movieId"] = "required|exists:web_series,id";
                break;
            default:
                return false;
        }
        
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $response = [
                'validate' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $premiumContent=$this->premiumContent->where('movie_id',$request->movieId)->where('type',$request->type)->first();
        $movieId=$request->movieId;
        return view('admin.movie.premiumContent',compact('premiumContent','movieId'));
    }

    public function getCustomerSubscription(Request $request){
        // dd($request->all());
        $filters=[
            'days'=>$request->daysValue ?? null
        ];
        $today = Carbon::today();
        $future_date = Carbon::createFromFormat('Y-m-d', '2026-02-09');
        $days_left = $today->diffInDays($future_date);
        $subscriptionPayment=SubscriptionPayment::orderBy('id','DESC')->get();
        // dd($subscriptionPayment);
        $allSubscription = $subscriptionPayment->where('is_expired', '0')->map(function ($item) use ($today) {
            $future_date = Carbon::createFromFormat('Y-m-d', $item->to_date);
            $days_left = $today->diffInDays($future_date);
            return [
                'id'=>$item->id,
                'title' => $item->subscription->title,
                'customer'=>@$item->customer->customerDetail->first_name .' '.@$item->customer->customerDetail->last_name,
                'customer_id'=>@$item->customer->id,
                'subscription_id' => $item->subscription->title,
                'total_days' => (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date)),
                'left_days' => $days_left,
                'percentage' => round(($days_left / (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date))) * 100),
                'from' => Carbon::parse($item->from_date)->formatLocalized('%d %B, %Y'),
                'to' => Carbon::parse($item->to_date)->formatLocalized('%d %B, %Y')
            ];
        })->when(Arr::get($filters,'days'),function($item,$value){
                return $item->map(function($data) use ($value){
                    if($data['left_days'] <= $value){
                        return $data;
                    }
                });
        })->whereNotNull();
        $url=route('getCustomerSubscription');
        $data['allSubscription'] = PaginationHelper::paginate(collect($allSubscription), 10)->withPath($url);
        $data['days']=$filters['days'];
        return view('admin.dashboardcustomersubscriptiontable',$data);
    }

    public function getMovieType(Request $request){
        $type=$request->type;
        switch((int)$type){
            case 1:
                $model=new Movie();
                $type="Movies";
                $path='movie.edit';
                $url=route('getMovieType');
                break;
            case 2:
                $model=new TvSeries();
                $type="Tv Series";
                $path='tvseries.edit';
                $url=route('getMovieTypeTv');
                break;
            case 3:
                $model=new WebSeries();
                $type="Web Series";
                $path='webseries.edit';
                $url=route('getMovieTypeWeb');
                break;
            default:
            $model=new Movie();
            $type="Movies";
            $path='movie.edit';
            $url=route('getMovieType');
            break;
        }
       
        return $this->getVideoTypeData($model,$type,$path,$url,$type);
    }

    
    public function getMovieTypeTv(Request $request){
        $type=$request->type;
        $model=new TvSeries();
        $type="Tv Series";
        $path='tvseries.edit';
        $url=route('getMovieTypeTv');
        return $this->getVideoTypeData($model,$type,$path,$url,$type);
        
    }
    public function getMovieTypeWeb(Request $request){
        $type=$request->type;
        $model=new WebSeries();
        $type="Web Series";
        $path='webseries.edit';
        $url=route('getMovieTypeTv');
        return $this->getVideoTypeData($model,$type,$path,$url,$type);
        
    }

    public function getVideoTypeData($model,$type,$path,$url){
        $data['allMoviesData']=$model->orderBy('id','DESC')->get()->map(function($item) use($path,$type){
            return[
                'id'=>$item->id,
                'title'=>$item->title,
                'poster'=>$item->poster,
                'type'=>$type,
                'path'=>route($path,$item->id)
            ];
        });
        $videoType=new ReflectionClass(MovieTypeEnum::class);
        $data['videoType']=array_values($videoType->getConstants());
        $urlPath=$url;
        $data['allMoviesData']= PaginationHelper::paginate(collect( $data['allMoviesData']), 5)->withPath($urlPath);
        $data['type']=$type;
        return view('admin.getmoviedata',$data);
    }

    public function getVideoPerformance(Request $request,$id,$type){
        switch($type){
            case 'Movies':
                $movies=Movie::where('id',$request->id)->first();
                $videoHistories=VideoHistory::where('type','1')->where('videoCode',$movies->unique_code)->get();
                dd($movies,$videoHistories);
                break;
            case 'Tv Series':
                dd(2);
                break;
            case 'Web Series':
                dd(3);
                break;
            default:
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();

        }
        return view('admin.videodetailsdata');
    }
}
