<?php

namespace App\Http\Controllers;

use App\Models\AudioQuality;
use Illuminate\Http\Request;
use App\Enum\Setting\VideoEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AudioStoreRequest;
use App\Http\Requests\AudioUpdateRequest;

class AudioQualityController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    protected $audioQuality;
    public function __construct(AudioQuality $audioQuality)
    {
        $this->audioQuality=$audioQuality;
    }
    public function index()
    {
        $data['audioQualitys']=$this->audioQuality->get();
        $reflection=new \ReflectionClass(VideoEnum::class);
        $data['videoEnum']=array_values($reflection->getConstants());
        return view('admin.setting.audioquality.index',$data);
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
    public function store(AudioStoreRequest $request)
    {
        $data=$request->all();
        $existData=$this->audioQuality->get();
        if(!$existData || $existData==null || count($existData) <=0)
        {
            $data['default']='1';
        }
        DB::beginTransaction();
        try{
            $this->audioQuality->fill($data);
            $this->audioQuality->save();
            DB::commit();
            $request->session()->flash('success','Audio Added Successfully !!');
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
    public function edit(audioQuality $audioQuality)
    {
        $reflection=new \ReflectionClass(VideoEnum::class);
        $data['videoEnum']=array_values($reflection->getConstants());
        $data['audioQuality']=$audioQuality;
        return view('admin.setting.audioquality.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AudioUpdateRequest $request,audioQuality $audioQuality)
    {
        $data=$request->all();
        DB::beginTransaction();
        try{
            $audioQuality->fill($data);
            $audioQuality->save();
            DB::commit();
            $request->session()->flash('success','Audio Updated Successfully !!');
            return redirect()->route('audio-quality.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,AudioQuality $audioQuality)
    {
        DB::beginTransaction();
        try{
            $audioQuality->delete();
            DB::commit();
            $request->session()->flash('success','Audio Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function setDefault(Request $request)
    {
        $audioQuality=audioQuality::findOrFail($request->status_default);
        DB::beginTransaction();
        try{
            $audioQualitys=$this->audioQuality->get();
            foreach($audioQualitys as $data)
            {
                $data->default='0';
                $data->save();
            }
            $audioQuality->default='1';
            $audioQuality->save();
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
