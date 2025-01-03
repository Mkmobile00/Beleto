<?php

namespace App\Http\Controllers;

use App\Models\VideoType;
use Illuminate\Http\Request;
use App\Enum\Setting\VideoEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VideoTypeStoreRequest;
use App\Http\Requests\VideoTypeUpdateRequest;

class VideoTypeController extends Controller
{
    protected $videoType;
    public function __construct(VideoType $videoType)
    {
        $this->videoType=$videoType;
    }
    public function index()
    {
        $data['videoTypes']=$this->videoType->get();
        $reflection=new \ReflectionClass(VideoEnum::class);
        $data['videoEnum']=array_values($reflection->getConstants());
        return view('admin.videotype.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoTypeStoreRequest $request)
    {
        $data=$request->all();
        DB::beginTransaction();
        try{
            $this->videoType->fill($data);
            $this->videoType->save();
            DB::commit();
            $request->session()->flash('success','Video Type Added Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VideoType $videoType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoType $videoType)
    {
        $reflection=new \ReflectionClass(VideoEnum::class);
        $data['videoEnum']=array_values($reflection->getConstants());
        $data['videoType']=$videoType;
        return view('admin.videotype.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoTypeUpdateRequest $request, VideoType $videoType)
    {
        $data=$request->all();
        $data['primary_menu']='0';
        $data['footer_menu']='0';
        if($request->primary_menu)
        {
            $data['primary_menu']='1';
        }
        if($request->footer_menu)
        {
            $data['footer_menu']='1';
        }
        DB::beginTransaction();
        try{
            $videoType->fill($data);
            $videoType->save();
            DB::commit();
            $request->session()->flash('success','Video Type Updated Successfully !!');
            return redirect()->route('video-type.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,VideoType $videoType)
    {
        DB::beginTransaction();
        try{
            $videoType->delete();
            DB::commit();
            $request->session()->flash('success','Video Type Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
