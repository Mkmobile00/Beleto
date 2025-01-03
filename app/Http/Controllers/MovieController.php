<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PremiumContent;
use Illuminate\Support\Facades\DB;
use App\Actions\Admin\Movie\MovieAction;
use Illuminate\Support\Facades\Validator;
use App\Events\HlsVideoPlayerConvertEvent;
use App\Actions\Admin\Movie\MovieStoreAction;
use App\Actions\Admin\Movie\MovieUpdateAction;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $movie;
    protected $premiumContent;
    public function __construct(Movie $movie, PremiumContent $premiumContent)
    {
        $this->movie = $movie;
        $this->premiumContent = $premiumContent;
    }
    public function index()
    {
        $data['movies'] = $this->movie->orderBy('position','ASC')->get();
        return view('admin.movie.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = (new MovieAction())->arrangeData();
        return view('admin.movie.form', $data);
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
    public function edit(Movie $movie)
    {
        $data = (new MovieAction())->arrangeData();
        $data['movie'] = $movie;
        // dd($data['movie']);
        return view('admin.movie.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {

        $validator = Validator::make($request->postData, [
            'title' => 'required|string|unique:movies,title,' . $movie->id,
            'summary' => 'required|string',
            'description' => 'required|string',
            'youtubeTrailer' => 'required|string',
            'videoQuality*' => 'required|exists:video_qualities,id',
            'category' => 'required|exists:categories,id',
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
            'thumbnail' => 'required|string',
            'poster' => 'required|string',
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

        if (!$movie) {
            DB::rollBack();
            $response = [
                'error' => true,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }


        DB::beginTransaction();
        try {

            $data = (new MovieUpdateAction($request, $movie))->update();
            DB::commit();
            $response = [
                'error' => false,
                'msg' => 'Movie Updated Successfully !!',
                'url' => route('movie.index')
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
    public function destroy(Request $request, Movie $movie)
    {

        DB::beginTransaction();
        try {
            $movie->delete();
            DB::commit();
            $request->session('success', 'Movie Deleted Successfully !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session('error', 'Something Went Wrong !!!!');
            return redirect()->back();
        }
    }

    public function saveMovie(Request $request)
    {

        $validator = Validator::make($request->postData, [
            'title' => 'required|string|unique:movies,title',
            'summary' => 'required|string',
            'description' => 'required|string',
            'youtubeTrailer' => 'required|string',
            'videoQuality*' => 'required|exists:video_qualities,id',
            'category' => 'required|exists:categories,id',
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
            'thumbnail' => 'required|string',
            'poster' => 'required|string',
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
            $reloadStatus = false;
            if ($request->postData['imagePath'] && $request->postData['imagePath']) {
                $reloadStatus = true;
            }
            $response = [
                'error' => false,
                'msg' => 'Movie Uploaded Successfully !!',
                'url' => route('movie.index'),
                'tableId' => $data->id,
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

    public function updateImagePath(Request $request)
    {
        $movie = Movie::where('id', $request->rowId)->first();
        $movie->movie_path = $request->imagePath;
        $movie->save();
        $response = [
            'error' => false,
            'msg' => 'Video File Upload SuccessFully !!',
            'redirectPath' => route('movie.index')
        ];
        return response($response, 200);
    }

    public function updateimagepathMovie(Request $request)
    {
        $tvseries = Movie::where('id', $request->rowId)->first();
        $tvseries->movie_path = $request->imagePath;
        $tvseries->transcode = null;
        $tvseries->transcodeStatus = 'false';
        $tvseries->save();
        $response = [
            'error' => false,
            'msg' => 'Video File Upload SuccessFully !!',
            'redirectPath' => route('movie.index')
        ];
        return response($response, 200);
    }

    public function transcodeMovie(Request $request,$id){
        $movie=Movie::findOrFail($id);
        return view('admin.movie.movietranscode', compact('movie'));
       
    }

    public function transcodeActionPerforme(Request $request){
        $id=$request->id;
        $movie=Movie::findOrFail($id);
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
             $filePath=$movie->movie_path;
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
                'url'=>route('movie.index')
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
                    $trip = Movie::find($arr['id']);
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