<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Actions\Admin\WebSeries\MovieAction;
use Illuminate\Support\Facades\Validator;
use App\Actions\Admin\WebSeries\MovieStoreAction;
use App\Actions\Admin\WebSeries\MovieUpdateAction;
use App\Models\WebSeries;

class WebSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $webseries;
    public function __construct(WebSeries $webseries)
    {
        $this->webseries = $webseries;
    }
    public function index()
    {
        $data['tvseries'] = $this->webseries->orderBy('position','ASC')->get();
        return view('admin.webseries.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = (new MovieAction())->arrangeData();
        return view('admin.webseries.form', $data);
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
    public function edit(WebSeries $webseries)
    {
        $data = (new MovieAction())->arrangeData();
        $data['tvseries'] = $webseries;
        return view('admin.webseries.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebSeries $webseries)
    {
        $validator = Validator::make($request->postData, [
            'title' => 'required|string|unique:movies,title,' . $webseries->id,
            'summary' => 'required|string',
            'description' => 'required|string',
            'youtubeTrailer' => 'required|string',
            'videoQuality*' => 'required|exists:video_qualities,id',
            'actor*' => 'required|exists:stars,id',
            'director*' => 'required|exists:stars,id',
            'writer*' => 'required|exists:stars,id',
            'genre*' => 'required|exists:genres,id',
            'rating' => 'required|string',
            'country*' => 'required|exists:countries,id',
            'language*' => 'required|exists:language_selections,id',
            'videoType*' => 'required|exists:video_types,id',
            'publication' => 'nullable|in:0,1',
            'download' => 'nullable|in:0,1',
            'freePaid' => 'required|in:free,paid',
            'thumbnail' => 'nullable|string',
            'poster' => 'nullable|string',
            'is_file' => 'nullable|in:0,1',
            'is_file1' => 'nullable|in:0,1',
            'meta_title' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'runTime' => 'nullable|string',
            'releaseDate' => 'required|date'
        ]);
        if ($validator->fails()) {
            $response = [
                'validate' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        if (!$webseries) {
            DB::rollBack();
            $response = [
                'error' => true,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }

        DB::beginTransaction();
        try {

            $data = (new MovieUpdateAction($request, $webseries))->update();
            DB::commit();
            $response = [
                'error' => false,
                'msg' => 'WebSeries Updated Successfully !!',
                'url' => route('webseries.index')
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, WebSeries $webseries)
    {
        DB::beginTransaction();
        try {
            $webseries->delete();
            DB::commit();
            $request->session('success', 'WebSeries Deleted Successfully !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session('error', 'Something Went Wrong !!!!');
            return redirect()->back();
        }
    }

    public function saveTvseries(Request $request)
    {

        $validator = Validator::make($request->postData, [
            'title' => 'required|string|unique:tv_series,title',
            'summary' => 'required|string',
            'description' => 'required|string',
            'youtubeTrailer' => 'required|string',
            'videoQuality*' => 'required|exists:video_qualities,id',
            'actor*' => 'required|exists:stars,id',
            'director*' => 'required|exists:stars,id',
            'writer*' => 'required|exists:stars,id',
            'genre*' => 'required|exists:genres,id',
            'rating' => 'required|string',
            'country*' => 'required|exists:countries,id',
            'language*' => 'required|exists:language_selections,id',
            'videoType*' => 'required|exists:video_types,id',
            'publication' => 'nullable|in:0,1',
            'download' => 'nullable|in:0,1',
            'freePaid' => 'required|in:free,paid',
            'thumbnail' => 'nullable|string',
            'poster' => 'nullable|string',
            'is_file' => 'nullable|in:0,1',
            'is_file1' => 'nullable|in:0,1',
            'meta_title' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'runTime' => 'nullable|string',
            'releaseDate' => 'required|date',
            'imagePath' => 'nullable|string'
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
            $data = (new MovieStoreAction($request))->store();
            DB::commit();
            $response = [
                'error' => false,
                'msg' => 'Web Servies Uploaded Successfully !!',
                'url' => route('webseries.index'),
                'tableId' => $data->id
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

    public function updateImagePath(Request $request)
    {
        $tvseries = WebSeries::where('id', $request->rowId)->first();
        $tvseries->tvseries_path = $request->imagePath;
        $tvseries->save();
        $response = [
            'error' => false,
            'msg' => 'Video File Upload SuccessFully !!',
            'redirectPath' => route('webseries.index')
        ];
        return response($response, 200);
    }

    public function updatePosition(Request $request)
    {
        DB::beginTransaction();
        try{
                $array = $request->order;
                foreach($array as $arr){
                    $trip = WebSeries::find($arr['id']);
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