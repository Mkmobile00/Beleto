<?php

namespace App\Http\Controllers;

use App\Models\TvSeries;
use App\Models\WebSeries;
use Illuminate\Support\Str;
use App\Models\TvSeriesPart;
use Illuminate\Http\Request;
use App\Models\WebSeriesPart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Events\HlsVideoPlayerConvertEvent;
use App\Http\Traits\VideoUniqueCodeGenerator;

class WebSeriesEpisodeController extends Controller
{
    use VideoUniqueCodeGenerator;
    protected $tvseriespart;
    public function __construct(WebSeriesPart $tvseriespart)
    {
        $this->tvseriespart = $tvseriespart;
    }
    public function episodeList(Request $request, $id)
    {
        $data['tvseries'] = WebSeries::findOrFail($id);
        $data['episodes'] = $data['tvseries']->episodes;
        return view('admin.webseriesepisodes.index', $data);
    }

    public function episodeCreate(Request $request, $id)
    {
        $data['tvseries'] = WebSeries::findOrFail($id);
        return view('admin.webseriesepisodes.form', $data);
    }

    public function episodeEdit(Request $request, $id)
    {
        $data['tvseriespart'] = WebSeriesPart::findOrFail($id);
        $data['tvseries'] = WebSeries::findOrFail($data['tvseriespart']->tvseries_id);
        return view('admin.webseriesepisodes.edit', $data);
    }

    public function updateTvseriesEpisodes(Request $request)
    {
        $tvseries = WebSeriesPart::where('id', $request->rowId)->first();
        $tvseries->video_path = $request->imagePath;
        $tvseries->transcode = null;
        $tvseries->transcodeStatus = 'false';
        $tvseries->save();
        $response = [
            'error' => false,
            'msg' => 'Video File Upload SuccessFully !!',
            'redirectPath' => route('webseries.episodelist', $tvseries->tvseries_id)
        ];
        return response($response, 200);
    }

    public function saveEpisodes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "poster" => "required|string",
            "description" => "nullable|string",
            "summary" => "nullable|string",
            "status" => "required|in:0,1",
            "tvseries_id" => "required|exists:web_series,id",
            "imagePath" => "nullable|string",
            "rowId" => "nullable|string",
            "releasedate" => "required|date"
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
        try {
            $data = [
                "title" => $request->title,
                "slug" => Str::slug($request->title),
                "poster" =>  $request->poster,
                "description" =>  $request->description,
                "summary" =>  $request->summary,
                "status" =>  $request->status,
                "tvseries_id" =>  $request->tvseries_id,
                "video_path" =>  $request->imagePath ?? null,
                "releasedate" => $request->releasedate,
                'unique_code' => $this->generateCode()
            ];
            $this->tvseriespart->fill($data);
            $this->tvseriespart->save();
            DB::commit();
            $reloadStatus = false;
            if ($request->imagePath && $request->imagePath) {
                $reloadStatus = true;
            }
            $response = [
                'error' => false,
                'msg' => 'Movie Uploaded Successfully !!',
                'url' => route('webseries.episodelist', $request->tvseries_id),
                'tableId' => $this->tvseriespart->id,
                'reloadStatus' => $reloadStatus
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'error' => true,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }

    public function deleteEpisodes(Request $request, $id)
    {
        $this->tvseriespart = $this->tvseriespart->findOrFail($id);
        DB::beginTransaction();
        try {
            $this->tvseriespart->delete();
            DB::commit();
            $request->session()->flash('success', 'Episode Deleted Successfully !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function updateEpisodes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "poster" => "required|string",
            "description" => "nullable|string",
            "summary" => "nullable|string",
            "status" => "required|in:0,1",
            "tvseries_id" => "required|exists:web_series,id",
            "imagePath" => "nullable|string",
            "rowId" => "nullable|string",
            "releasedate" => "required|date"
        ]);
        if ($validator->fails()) {
            $response = [
                'validate' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $this->tvseriespart = $this->tvseriespart->where('id', $request->seriesPartId)->where('tvseries_id', $request->tvseries_id)->first();
        if (!$this->tvseriespart) {
            $response = [
                'error' => true,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
        DB::beginTransaction();
        try {
            if ($request['transcodeStatus'] && $request['transcodeStatus'] == 'false') {
                $request['transcodeStatus'] = 'false';
                $request['transcode'] = null;
            } else {
                $request['transcodeStatus'] = 'true';
                $request['transcode'] = $this->tvseriespart->transcode;
            }
            $data = [
                "title" => $request->title,
                "poster" =>  $request->poster,
                "description" =>  $request->description,
                "summary" =>  $request->summary,
                "status" =>  $request->status,
                "tvseries_id" =>  $request->tvseries_id,
                "releasedate" => $request->releasedate,
                "transcodeStatus" => $request->transcodeStatus,
                "transcode" => $request->transcode
            ];
            if ($request->imagePath && $request->imagePath != null) {
                $data['video_path'] = $request->imagePath;
            }
            $this->tvseriespart->fill($data);
            $this->tvseriespart->save();
            DB::commit();

            $response = [
                'error' => false,
                'msg' => 'Movie Uploaded Successfully !!',
                'url' => route('webseries.episodelist', $request->tvseries_id),
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'error' => true,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }

    public function transcodeMovie(Request $request,$id){
        $webSeriesPart=WebSeriesPart::findOrFail($id);
        return view('admin.webseriesepisodes.webseriesparttranscode', compact('webSeriesPart'));
       
    }

    public function transcodeActionPerforme(Request $request){
        $id=$request->id;
        $movie=WebSeriesPart::findOrFail($id);
        if(!$movie){
            $response=[
                'error'=>true,
                'data'=>null,
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }
        DB::beginTransaction();
        try{
            // dd('ok');
             $filePath=$movie->video_path;
             $fileName=explode(env('VIDEO_PATH'),$filePath)[1];
             $path=Str::random(20);
             $pathData=event(new HlsVideoPlayerConvertEvent($fileName,$path));
             $movie->transcode=$path;
             $movie->transcodeStatus='true';
             $movie->save();
             DB::commit();
             $response=[
                'error'=>false,
                'data'=>null,
                'msg'=>'Completed!!',
                'url'=>route('webseries.episodelist',$movie->tvseries_id)
            ];
            return response()->json($response,200);
        }catch(\Throwable $th){
             DB::commit();
             $response=[
                'error'=>true,
                'data'=>null,
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }
    }

    public function updatePosition(Request $request)
    {
        DB::beginTransaction();
        try{
                $array = $request->order;
                foreach($array as $arr){
                    $trip = WebSeriesPart::find($arr['id']);
                    $trip->position = $arr['position'];
                    $trip->save();
                }
                DB::commit();
                $response=[
                    'error'=>false,
                    'msg'=>'Position Updated !!'
                ];
                return response($response, 200);
        }catch(\Throwable $th){
                DB::rollBack();
                $response=[
                    'error'=>true,
                    'msg'=>'Something Went Wrong !!'
                ];
                return response($response, 200);
        }
       
    }
}