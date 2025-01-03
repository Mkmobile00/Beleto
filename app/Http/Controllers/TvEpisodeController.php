<?php

namespace App\Http\Controllers;

use App\Models\TvSeries;
use Illuminate\Support\Str;
use App\Models\TvSeriesPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\VideoUniqueCodeGenerator;

class TvEpisodeController extends Controller
{
    use VideoUniqueCodeGenerator;
    protected $tvseriespart;
    public function __construct(TvSeriesPart $tvseriespart)
    {
        $this->tvseriespart=$tvseriespart;
    }
    public function episodeList(Request $request,$id){
        $data['tvseries']=TvSeries::findOrFail($id);
        $data['episodes']=$data['tvseries']->episodes;
        return view('admin.tvseriesepisodes.index',$data);
    }

    public function episodeCreate(Request $request,$id){
        $data['tvseries']=TvSeries::findOrFail($id);
        return view('admin.tvseriesepisodes.form',$data);
    }

    public function episodeEdit(Request $request,$id){
        $data['tvseriespart']=TvSeriesPart::findOrFail($id);
        $data['tvseries']=TvSeries::findOrFail( $data['tvseriespart']->tvseries_id);
        return view('admin.tvseriesepisodes.edit',$data);
    }

    public function updateTvseriesEpisodes(Request $request){
        $tvseries=TvSeriesPart::where('id',$request->rowId)->first();
        $tvseries->video_path=$request->imagePath;
        $tvseries->save();
        $response=[
            'error'=>false,
            'msg'=>'Video File Upload SuccessFully !!',
            'redirectPath'=>route('tvseries.episodelist',$tvseries->tvseries_id)
        ];
        return response($response,200);
    }

    public function saveEpisodes(Request $request){
        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "poster" => "required|string",
            "description" => "nullable|string",
            "summary" => "nullable|string",
            "status" => "required|in:0,1",
            "tvseries_id" => "required|exists:tv_series,id",
            "imagePath" => "nullable|string",
            "rowId" => "nullable|string",
            "releasedate"=>"required|date"
        ]);
        if ($validator->fails()) {
            $response = [
                'validate' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        DB::beginTransaction();
        try{
            $data=[
                "title" => $request->title,
                "slug"=>Str::slug($request->title),
                "poster" =>  $request->poster,
                "description" =>  $request->description,
                "summary" =>  $request->summary,
                "status" =>  $request->status,
                "tvseries_id" =>  $request->tvseries_id,
                "video_path" =>  $request->imagePath ?? null,
                "releasedate"=>$request->releasedate,
                'unique_code'=>$this->generateCode()
            ];
            $this->tvseriespart->fill($data);
            $this->tvseriespart->save();
            DB::commit();       
            $reloadStatus=false;
            if($request->imagePath && $request->imagePath)
            {
                $reloadStatus=true;
            }
            $response=[
                'error'=>false,
                'msg'=>'Movie Uploaded Successfully !!',
                'url'=>route('tvseries.episodelist',$request->tvseries_id),
                'tableId'=> $this->tvseriespart->id,
                'reloadStatus'=>$reloadStatus
            ];
            return response()->json($response,200);
        }catch(\Throwable $th){
            DB::rollBack();
            $response=[
                'error'=>true,
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }
    }

    public function deleteEpisodes(Request $request,$id){
        $this->tvseriespart=$this->tvseriespart->findOrFail($id);
        DB::beginTransaction();
        try{
            $this->tvseriespart->delete();
            DB::commit();       
            $request->session()->flash('success','Episode Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollBack();
           $request->session()->flash('error','Something Went Wrong !!');
           return redirect()->back();
        }
    }

    public function updateEpisodes(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "poster" => "required|string",
            "description" => "nullable|string",
            "summary" => "nullable|string",
            "status" => "required|in:0,1",
            "tvseries_id" => "required|exists:tv_series,id",
            "imagePath" => "nullable|string",
            "rowId" => "nullable|string",
            "releasedate"=>"required|date"
        ]);
        if ($validator->fails()) {
            $response = [
                'validate' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $this->tvseriespart=$this->tvseriespart->where('id',$request->seriesPartId)->where('tvseries_id',$request->tvseries_id)->first();
        if(!$this->tvseriespart){
            $response=[
                'error'=>true,
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }
        DB::beginTransaction();
        try{
            $data=[
                "title" => $request->title,
                "poster" =>  $request->poster,
                "description" =>  $request->description,
                "summary" =>  $request->summary,
                "status" =>  $request->status,
                "tvseries_id" =>  $request->tvseries_id,
                "releasedate"=>$request->releasedate
            ];
            if($request->imagePath && $request->imagePath !=null){
                $data['video_path']=$request->imagePath;
            }
            $this->tvseriespart->fill($data);
            $this->tvseriespart->save();
            DB::commit();       
            
            $response=[
                'error'=>false,
                'msg'=>'Movie Uploaded Successfully !!',
                'url'=>route('tvseries.episodelist',$request->tvseries_id),
            ];
            return response()->json($response,200);
        }catch(\Throwable $th){
            DB::rollBack();
            $response=[
                'error'=>true,
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }
    }
}
