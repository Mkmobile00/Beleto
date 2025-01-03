<?php

namespace App\Http\Controllers\Admin\Setting;

use Svg\Tag\Rect;
use App\Models\VideoQuality;
use Illuminate\Http\Request;
use App\Enum\Setting\VideoEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\VideoStoreRequest;
use App\Http\Requests\Admin\Setting\VideoUpdateRequest;

class VideoQualityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $videoQuality;
    public function __construct(VideoQuality $videoQuality)
    {
        $this->videoQuality=$videoQuality;
    }
    public function index()
    {
        $data['videoQualitys']=$this->videoQuality->get();
        $reflection=new \ReflectionClass(VideoEnum::class);
        $data['videoEnum']=array_values($reflection->getConstants());
        return view('admin.setting.videoquality.index',$data);
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
    public function store(VideoStoreRequest $request)
    {
        $data=$request->all();
        $existData=$this->videoQuality->get();
        if(!$existData || $existData==null || count($existData) <=0)
        {
            $data['default']='1';
        }
        DB::beginTransaction();
        try{
            $this->videoQuality->fill($data);
            $this->videoQuality->save();
            DB::commit();
            $request->session()->flash('success','Video Quality Added Successfully !!');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoQuality $videoQuality)
    {
        $reflection=new \ReflectionClass(VideoEnum::class);
        $data['videoEnum']=array_values($reflection->getConstants());
        $data['videoQuality']=$videoQuality;
        return view('admin.setting.videoquality.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoUpdateRequest $request,VideoQuality $videoQuality)
    {
        $data=$request->all();
        
        DB::beginTransaction();
        try{
            $videoQuality->fill($data);
            $videoQuality->save();
            DB::commit();
            $request->session()->flash('success','Video Quality Updated Successfully !!');
            return redirect()->route('video-quality.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,VideoQuality $videoQuality)
    {
        DB::beginTransaction();
        try{
            $videoQuality->delete();
            DB::commit();
            $request->session()->flash('success','Video Quality Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function setDefault(Request $request)
    {
        $videoQuality=VideoQuality::findOrFail($request->status_default);
        DB::beginTransaction();
        try{
            $videoQualitys=$this->videoQuality->get();
            foreach($videoQualitys as $data)
            {
                $data->default='0';
                $data->save();
            }
            $videoQuality->default='1';
            $videoQuality->save();
            DB::commit();
            $request->session()->flash('success','Default Quality Set Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
        
        
    }
}
