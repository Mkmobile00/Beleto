<?php

namespace App\Http\Controllers;

use App\Models\Stremming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Actions\Admin\Stremming\MovieAction;
use App\Actions\Admin\Stremming\MovieStoreAction;
use App\Actions\Admin\Stremming\MovieUpdateAction;

class StremmingController extends Controller
{
    protected $stremming;
    public function __construct(Stremming $stremming)
    {
        $this->stremming=$stremming;
    }
    public function index()
    {
        $data['tvseries']=$this->stremming->orderBy('position','ASC')->get();
        return view('admin.stremming.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=(new MovieAction())->arrangeData();
        return view('admin.stremming.form',$data);
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
    public function show(Stremming $stremming)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stremming $stremming)
    {
        $data=(new MovieAction())->arrangeData();
        $data['tvseries']=$stremming;
        return view('admin.stremming.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stremming $stremming)
    {
        $validator = Validator::make($request->postData, [
            'title'=>'required|string|unique:stremmings,title,'.$stremming->id,
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
            'thumbnail'=>'nullable|string',
            'poster'=>'nullable|string',
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
        if(!$stremming){
            DB::rollBack();
            $response=[
                'error'=>true,
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }

        DB::beginTransaction();
        // try{
            
            $data=(new MovieUpdateAction($request,$stremming))->update();
            DB::commit();
            $response=[
                'error'=>false,
                'msg'=>'Stremming Updated Successfully !!',
                'url'=>route('stremming.index')
            ];
            return response()->json($response,200);
        // }catch(\Throwable $th){
        //     DB::rollBack();
        //     $response=[
        //         'error'=>true,
        //         'msg'=>'Something Went Wrong !!'
        //     ];
        //     return response()->json($response,200);
        // }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Stremming $stremming)
    {
        DB::beginTransaction();
        try{
            $stremming->delete();
            DB::commit();
            $request->session('success','Stremming Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session('error','Something Went Wrong !!!!');
            return redirect()->back();
        }
    }

    public function saveTvseries(Request $request){
       
        $validator = Validator::make($request->postData, [
            'title'=>'required|string|unique:stremmings,title',
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
            'thumbnail'=>'nullable|string',
            'poster'=>'nullable|string',
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
        // try{
            $data=(new MovieStoreAction($request))->store();
            DB::commit();
            $response=[
                'error'=>false,
                'msg'=>'Stremming Servies Uploaded Successfully !!',
                'url'=>route('stremming.index'),
                'tableId'=>$data->id
            ];
            return response()->json($response,200);
        // }catch(\Throwable $th){
        //     DB::rollBack();
        //     $response=[
        //         'error'=>true,
        //         'msg'=>'Something Went Wrong !!'
        //     ];
        //     return response()->json($response,200);
        // }
    }

    public function updateImagePath(Request $request){
        $tvseries=Stremming::where('id',$request->rowId)->first();
        $tvseries->tvseries_path=$request->imagePath;
        $tvseries->save();
        $response=[
            'error'=>false,
            'msg'=>'Video File Upload SuccessFully !!',
            'redirectPath'=>route('stremming.index')
        ];
        return response($response,200);
    }

    public function updatePosition(Request $request)
    {
        DB::beginTransaction();
        try{
                $array = $request->order;
                foreach($array as $arr){
                    $trip = Stremming::find($arr['id']);
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
