<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Enum\Customer\MovieTypeEnum;
use App\Models\VideoHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VideoHistoryController extends Controller
{
    protected $videoHistory;
    public function __construct(VideoHistory $videoHistory)
    {
        $this->videoHistory=$videoHistory;
    }
    public function videoHistory(Request $request){
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }

        $validator = Validator::make($request->all(), [
            'videoCode'=>'required|string',
            'duration'=>'required|string',
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
            $data=$request->all();
            $data['customer_id']=$customer->id;
            $this->videoHistory->fill($data);
            $this->videoHistory->save();
            DB::commit();
            return $this->responseApiSuccess('Data Saved Successfully !!',$this->videoHistory,200);

        }catch(\Throwable $th){
            DB::rollBack();
            return $this->responseApiError($th->getMessage(),null,200);
        }
    }
}
