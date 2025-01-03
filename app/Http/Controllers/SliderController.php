<?php

namespace App\Http\Controllers;

use ReflectionClass;
use App\Models\Movie;
use App\Models\Slider;
use App\Models\Category;
use App\Models\TvSeries;
use App\Models\WebSeries;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Events\HlsVideoPlayerConvertEvent;
use App\Enum\FeaturedSection\FeaturedSectionTypeEnum;

class SliderController extends Controller
{
    protected $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index()
    {
        $data['sliders'] = $this->slider->orderBy('position', 'ASC')->get();
        return view('admin.slider.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $itemTypes = new ReflectionClass(FeaturedSectionTypeEnum::class);
        $data['itemTypes'] = array_values($itemTypes->getConstants());
        $data['itemTypes'] = collect($data['itemTypes'])->where('value', '!=', 1);
        return view('admin.slider.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "sub_title" => "nullable|string",
            "status" => "required|in:active,inactive",
            "type" => "required|in:file,video",
            "path" => "nullable",
            "item_type" => "nullable|in:1,2,3,4",
            "movie_id" => "nullable",
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
            $data = $request->all();
            $data['slug'] = Str::slug($request->title);
            $reloadStatus = false;

            if ($request->type == 'file') {
                $data['transcodeStatus']='true';
                $this->slider->fill($data);
                $this->slider->save();
                DB::commit();
                if ($request->path && $request->path != null) {
                    $reloadStatus = true;
                }
                if ($request->type == 'file') {
                    $reloadStatus = true;
                }
                $response = [
                    'error' => false,
                    'url' => route('slider.index'),
                    'msg' => 'Slider Added Successfully !!',
                    'reloadStatus' => $reloadStatus,
                    'tableId' => $this->slider->id,
                ];
            } else {
                $data['path'] = $request->imagePath ?? null;
                $data['is_video'] = 'yes';
                $this->slider->fill($data);
                $this->slider->save();
                DB::commit();
                if ($request->imagePath && $request->imagePath != null) {
                    $reloadStatus = true;
                } else {
                    $reloadStatus = false;
                }
                $response = [
                    'error' => false,
                    'url' => route('slider.index'),
                    'msg' => 'Slider Added Successfully !!',
                    'reloadStatus' => $reloadStatus,
                    'tableId' => $this->slider->id,
                ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollback();
            $response = [
                'error' => true,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        $itemTypes = new ReflectionClass(FeaturedSectionTypeEnum::class);
        $data['itemTypes'] = array_values($itemTypes->getConstants());
        $data['itemTypes'] = collect($data['itemTypes'])->where('value', '!=', 1);
        return view('admin.slider.edit', compact('slider'), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "sub_title" => "nullable|string",
            "status" => "required|in:active,inactive",
            "type" => "required|in:file,video",
            "path" => "nullable"
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
            if ($request->transcodeStatus && $request->transcodeStatus == 'false') {
                $request['transcodeStatus'] = 'false';
                $request['transcode'] = null;
            } else {
                $request['transcodeStatus'] = 'true';
                $request['transcode'] = $slider->transcode;
            }
            $data = $request->all();
            $data['slug'] = Str::slug($request->title);
            $reloadStatus = false;
            if ($request->type == 'file') {
                if ($request->path) {
                    $data['path'] = $request->path;
                }
                $data['transcodeStatus']='true';
                // if($request->checkVideoFile=='false'){
                //     $data['path']=$slider->path;
                // }
                $slider->fill($data);
                $slider->save();
                // dd($slider);
                DB::commit();
                if ($request->path && $request->path != null) {
                    $reloadStatus = true;
                }
                if ($request->type == 'file') {
                    $reloadStatus = true;
                }
                $response = [
                    'error' => false,
                    'url' => route('slider.index'),
                    'msg' => 'Slider Added Successfully !!',
                    'reloadStatus' => $reloadStatus,
                    'tableId' => $slider->id,
                ];
            } else {
                $data['path'] = $request->imagePath ?? null;
                if ($request->checkVideoFile == 'false') {
                    $data['path'] = $slider->path;
                }
                $data['is_video'] = 'yes';
                $slider->fill($data);
                $slider->save();
                DB::commit();
                if ($request->imagePath && $request->imagePath != null) {
                    $reloadStatus = true;
                } else {
                    $reloadStatus = false;
                }
                $response = [
                    'error' => false,
                    'url' => route('slider.index'),
                    'msg' => 'Slider Updated Successfully !!',
                    'reloadStatus' => $reloadStatus,
                    'tableId' => $slider->id,
                ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollback();
            $response = [
                'error' => true,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Slider $slider)
    {
        DB::beginTransaction();
        try {
            $slider->delete();
            DB::commit();
            $request->session()->flash('success', 'Slider Deleted Successfully !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function updateimagepathSlider(Request $request)
    {
        $tvseries = Slider::where('id', $request->rowId)->first();
        $tvseries->path = $request->imagePath;
        $tvseries->type = 'video';
        $tvseries->transcode = null;
        $tvseries->transcodeStatus = 'false';
        $tvseries->save();
        $response = [
            'error' => false,
            'msg' => 'Video File Upload SuccessFully !!',
            'redirectPath' => route('slider.index')
        ];
        return response($response, 200);
    }

    public function slideritemtype(Request $request)
    {
        switch ((int)$request->itemTypeId) {
            case 1:
                $data['items'] = Category::where('status', '1')->get();
                $data['name'] = 'Category';
                break;
            case 2:
                $data['items'] = TvSeries::where('publication', '1')->get();
                $data['name'] = 'Tv Series';
                break;
            case 3:
                $data['items'] = WebSeries::where('publication', '1')->get();
                $data['name'] = 'Web Series';
                break;
            case 4:
                $data['items'] = Movie::where('publication', '1')->get();
                $data['name'] = 'Movies';
                break;
            default:
                $response = [
                    'error' => true,
                    'msg' => 'Something Went Wrong !!'
                ];
                return response($response, 200);
                break;
        }
        $data['movieId'] = $request->movieId ?? null;
        return view('admin.slider.typeItem', $data);
    }

    public function transcodeSlider(Request $request,$id){
        // dd('ok');
        $slider=Slider::findOrFail($id);
        if($slider->type !='video'){
            $request->session()->flash('error','This Action Will Perfome Only For Video Type');
            return redirect()->back();
        }
        
        return view('admin.slider.slidertranscode',compact('slider'));
       
    }

    public function transcodeActionPerforme(Request $request){
        $id=$request->id;
        $slider=Slider::findOrFail($id);
        // dd($slider);
        if($slider->type !='video'){
            $response=[
                'error'=>true,
                'data'=>null,
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }
        DB::beginTransaction();
        try{
             $filePath=$slider->path;
             $fileName=explode(env('VIDEO_PATH'),$filePath)[1];
             $path=Str::random(20);
             $pathData=event(new HlsVideoPlayerConvertEvent($fileName,$path));
             $slider->transcode=$path;
             $slider->transcodeStatus='true';
             $slider->save();
             DB::commit();
             $response=[
                'error'=>false,
                'data'=>null,
                'msg'=>'Completed!!',
                'url'=>route('slider.index')
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
                    $trip = Slider::find($arr['id']);
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