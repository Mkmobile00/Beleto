<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\WebSeriesPart;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Enum\Customer\MovieTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\TvSeriesPart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    protected $comment;
    public function __construct(Comment $comment)
    {
        $this->comment=$comment;
    }
    public function addComment(Request $request){
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }

        $validator = Validator::make($request->all(), [
            'videoCode'=>'required|string',
            'parent_id'=>'nullable|exists:comments,id',
            'comments'=>'required|string',
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

        DB::beginTransaction();
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

            $data=$this->arrangeCommentsData($request,$customer,$getCode);
            $this->comment->fill($data);
            $this->comment->save();
            DB::commit();
            return $this->responseApiSuccess('Comment Added Successfully !!',$this->comment,200);

        }catch(\Throwable $th){
            DB::rollBack();
            return $this->responseApiError($th->getMessage(),null,200);
        }
    }

    public function arrangeCommentsData($requestData,$customer,$getCode){
        return[
            'customer_id'=>$customer->id,
            'video_unique_code'=>$getCode,
            'parent_id'=>$requestData->parent_id ?? null,
            'comments'=>$requestData->comments,
            'status'=>'0',
            'type'=>$requestData->type
        ];
    }

    public function comments(Request $request){
        $validator = Validator::make($request->all(), [
            'videoCode'=>'required|string',
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
            $comments=Comment::where('video_unique_code',$videoData->unique_code)
            ->whereNull('parent_id')->with('commentReplies')
            ->select(['id','comments','type','comments','created_at','customer_id'])
            ->get()
            ->map(function($item){
                return[
                    "id" => $item->id,
                    "comments" =>  $item->comments,
                    'photo'=>$item->customer->customerDetail->photo ?? null,
                    "type" =>  $item->type->value,
                    "created_at" =>  $item->created_at->diffForHumans(),
                    'replies_count'=>count($item->commentReplies),
                    'replies'=>$item->commentReplies->map(function($reply){
                       return[
                        "comments" =>  $reply->comments,
                        'photo'=>$reply->customer->customerDetail->photo ?? null,
                        "created_at" =>  $reply->created_at->diffForHumans(),
                       ];
                    })
                ];
            });
            return $this->responseApiSuccess('Comments List !!',$comments,200);

        }catch(\Throwable $th){
            return $this->responseApiError($th->getMessage(),null,200);
        }
    }
}
