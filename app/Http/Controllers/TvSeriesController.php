<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Actions\Admin\TvSeries\MovieAction;
use Illuminate\Support\Facades\Validator;
use App\Actions\Admin\TvSeries\MovieStoreAction;
use App\Actions\Admin\TvSeries\MovieUpdateAction;
use App\Models\TvSeries;

class TvSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $tvseries;
    public function __construct(TvSeries $tvseries)
    {
        $this->tvseries=$tvseries;
    }
    public function index()
    {
        $data['tvseries']=$this->tvseries->orderBy('id','DESC')->get();
        return view('admin.tvseries.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=(new MovieAction())->arrangeData();
        return view('admin.tvseries.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TvSeries $tvseries)
    {
        $data=(new MovieAction())->arrangeData();
        $data['tvseries']=$tvseries;
        return view('admin.tvseries.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TvSeries $tvseries)
    {
        $validator = Validator::make($request->postData, [
            'title'=>'required|string|unique:movies,title,'.$tvseries->id,
            'description'=>'required|string',
            'youtubeTrailer'=>'required|string',
            'videoQuality*'=>'required|exists:video_qualities,id',
            'actor*'=>'required|exists:stars,id',
            'director*'=>'required|exists:stars,id',
            'writer*'=>'required|exists:stars,id',
            'genre*'=>'required|exists:genres,id',
            'rating'=>'required|string',
            'country*'=>'required|exists:countries,id',
            'language*'=>'required|exists:language_selections,id',
            'videoType*'=>'required|exists:video_types,id',
            'publication'=>'nullable|in:0,1',
            'download'=>'nullable|in:0,1',
            'freePaid'=>'required|in:free,paid',
            'thumbnail'=>'required|string',
            'poster'=>'required|string',
            'is_file'=>'nullable|in:0,1',
            'is_file1'=>'nullable|in:0,1',
            'meta_title'=>'nullable|string',
            'meta_keyword'=>'nullable|string',
            'meta_description'=>'nullable|string',
            'runTime'=>'nullable|string',
            'releaseDate'=>'required|date'
        ]);
        if ($validator->fails()) {
            $response = [
                'validate' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        if(!$tvseries){
            DB::rollBack();
            $response=[
                'error'=>true,
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }

        DB::beginTransaction();
        try{
            
            $data=(new MovieUpdateAction($request,$tvseries))->update();
            DB::commit();
            $response=[
                'error'=>false,
                'msg'=>'Tv Series Updated Successfully !!',
                'url'=>route('tvseries.index')
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,TvSeries $tvseries)
    {
        DB::beginTransaction();
        try{
            $tvseries->delete();
            DB::commit();
            $request->session('success','TvSeries Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session('error','Something Went Wrong !!!!');
            return redirect()->back();
        }
    }

    public function saveTvseries(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->postData, [
            'title'=>'required|string|unique:tv_series,title',
            'summary'=>'required|string',
            'description'=>'required|string',
            'youtubeTrailer'=>'required|string',
            'videoQuality*'=>'required|exists:video_qualities,id',
            'actor*'=>'required|exists:stars,id',
            'director*'=>'required|exists:stars,id',
            'writer*'=>'required|exists:stars,id',
            'genre*'=>'required|exists:genres,id',
            'rating'=>'required|string',
            'country*'=>'required|exists:countries,id',
            'language*'=>'required|exists:language_selections,id',
            'videoType*'=>'required|exists:video_types,id',
            'publication'=>'nullable|in:0,1',
            'download'=>'nullable|in:0,1',
            'freePaid'=>'required|in:free,paid',
            'thumbnail'=>'required|string',
            'poster'=>'required|string',
            'is_file'=>'nullable|in:0,1',
            'is_file1'=>'nullable|in:0,1',
            'meta_title'=>'nullable|string',
            'meta_keyword'=>'nullable|string',
            'meta_description'=>'nullable|string',
            'runTime'=>'nullable|string',
            'releaseDate'=>'required|date',
            'imagePath'=>'nullable|string'
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
            $data=(new MovieStoreAction($request))->store();
            DB::commit();
            
            $response=[
                'error'=>false,
                'msg'=>'Tv Servies Uploaded Successfully !!',
                'url'=>route('tvseries.index'),
                'tableId'=>$data->id
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

    public function updateImagePath(Request $request){
        $tvseries=TvSeries::where('id',$request->rowId)->first();
        $tvseries->tvseries_path=$request->imagePath;
        $tvseries->save();
        $response=[
            'error'=>false,
            'msg'=>'Video File Upload SuccessFully !!',
            'redirectPath'=>route('tvseries.index')
        ];
        return response($response,200);
    }
}
