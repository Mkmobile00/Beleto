<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Models\TvSeriesPart;
use Illuminate\Http\Request;
use App\Models\WebSeriesPart;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Enum\Customer\MovieTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enum\Customer\LikeDislikeEnum;
use App\Models\VideoLike;
use Exception;
use FFMpeg\Media\Video;
use Illuminate\Support\Facades\Validator;

class LikeDislikeController extends Controller
{
    protected $videoLike;
    public function __construct(VideoLike $videoLike)
    {
        $this->videoLike=$videoLike;
    }
    public function likeDislike(Request $request){
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }

        $validator = Validator::make($request->all(), [
            'videoCode'=>'required|string',
            'status'=>['required',Rule::in(LikeDislikeEnum::LIKE,LikeDislikeEnum::DISLIKE)],
            'type'=>['required',Rule::in(MovieTypeEnum::MOVIE,MovieTypeEnum::TVSERIES,MovieTypeEnum::WEBSERIES)]
        ]);
       
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        try{
            $getCode = base64_decode($request->videoCode);
            switch((int)$request->type){
                case 1:
                    $videoData=Movie::where('unique_code',$getCode)->first();
                    if(!$videoData){
                        throw new Exception('Something Went Wrong !!');
                    }
                    break;
                case 2:
                    $videoData=TvSeriesPart::where('unique_code',$getCode)->first();
                    if(!$videoData){
                        throw new Exception('Something Went Wrong !!');
                    }
                    break;
                case 3:
                    $videoData=WebSeriesPart::where('unique_code',$getCode)->first();
                    if(!$videoData){
                        throw new Exception('Something Went Wrong !!');
                    }
                    break;
                default:
                    throw new Exception('Invalid Type Value !!');
            }
            $videoCodeData=$videoData->unique_code;
            $existCustomerData=VideoLike::where('video_unique_code',$videoCodeData)->where('customer_id',$customer->id)->first();
            $data=$this->arrangeData($request,$customer,$videoCodeData);
            if($existCustomerData){
                $this->videoLike=$existCustomerData;
            }
            $this->videoLike->fill($data);
            $this->videoLike->save();
            $statusMsg='Video '.($this->videoLike->status->value =='1' ? 'Liked' :'Disliked');
            $videoLikeDislikeData=VideoLike::where('video_unique_code',$videoCodeData)->get();
            $totalLikeCount=count($videoLikeDislikeData->where('status',LikeDislikeEnum::LIKE));
            $totalDisLikeCount=count($videoLikeDislikeData->where('status',LikeDislikeEnum::DISLIKE));
            $response=[
                'like'=>$this->videoLike->status->value =='1' ? true :false,
                'dislike'=>$this->videoLike->status->value =='2' ? true :false,
                'total_like'=>$totalLikeCount ?? 0,
                'total_dislike'=>$totalDisLikeCount ?? 0

            ];
            return $this->responseApiSuccess($statusMsg,$response,200);

        }catch(\Throwable $th){
            return $this->responseApiError($th->getMessage(),null,200);
        }
    }

    public function arrangeData($request,$customer,$videoCodeData){
        return[
            'video_unique_code'=>$videoCodeData,
            'customer_id'=>$customer->id,
            'status'=>$request->status,
            'type'=>$request->type
        ];
    }
}
