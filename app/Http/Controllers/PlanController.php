<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Device;
use App\Models\PlanContent;
use Illuminate\Support\Str;
use App\Models\AudioQuality;
use App\Models\VideoQuality;
use Illuminate\Http\Request;
use App\Http\Traits\ContentTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PlanStoreRequest;
use App\Http\Requests\PlanUpdateRequest;

class PlanController extends Controller
{
    use ContentTrait;
    /**
     * Display a listing of the resource.
    */
    
    protected $plan;
    public function __construct(Plan $plan)
    {
        $this->plan=$plan;
    }
    public function index()
    {
        $data['plans']=$this->plan->get();
        return view('admin.plan.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $planContent=PlanContent::first();
        if(!$planContent){
            $request->session()->flash('error','First Create Plan Content');
            return redirect()->route('plan-content.index');
        }
        $deviceData=Device::whereIn('id',json_decode($planContent->device))->get();
        $videoQuality=VideoQuality::whereIn('id',json_decode($planContent->video_quality))->get();
        $audioQuality=AudioQuality::whereIn('id',json_decode($planContent->audio_quality))->get();
        $data['maxScreenSize']=$planContent->size;
        $data['liveTvStatus']=$planContent->livetv=='1' ? true : false;
        $data['addFreeStatus']=$planContent->addfree=='1' ? true : false;
        $data['downloadStatus']=$planContent->download=='1' ? true : false;
        $data['devices']=$deviceData;
        $data['videoQualitys']=$videoQuality;
        $data['audios']=$audioQuality;
        return view('admin.plan.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanStoreRequest $request)
    {
        $data=$request->all();
        DB::beginTransaction();
        try{
            $data['device']=json_encode($request->device);
            $data['video_quality']=json_encode($request->video_quality);
            $data['audio_quality']=json_encode($request->audio_quality);
            $data['slug']=Str::slug($request->title);
            $this->plan->fill($data);
            $this->plan->save();
            DB::commit();
            $request->session()->flash('success','Plan Created Successfully !!');
            return redirect()->route('plan.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Plan $plan)
    {
        $planContent=PlanContent::first();
        if(!$planContent){
            $request->session()->flash('error','First Create Plan Content');
            return redirect()->route('plan-content.index');
        }
        $deviceData=Device::whereIn('id',json_decode($planContent->device))->get();
        $videoQuality=VideoQuality::whereIn('id',json_decode($planContent->video_quality))->get();
        $audioQuality=AudioQuality::whereIn('id',json_decode($planContent->audio_quality))->get();
        $data['maxScreenSize']=$planContent->size;
        $data['liveTvStatus']=$planContent->livetv=='1' ? true : false;
        $data['addFreeStatus']=$planContent->addfree=='1' ? true : false;
        $data['downloadStatus']=$planContent->download=='1' ? true : false;
        $data['devices']=$deviceData;
        $data['videoQualitys']=$videoQuality;
        $data['audios']=$audioQuality;
        $data['plan']=$plan;
        return view('admin.plan.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanUpdateRequest $request, Plan $plan)
    {
        $data=$request->all();
        DB::beginTransaction();
        try{
            $data['device']=json_encode($request->device);
            $data['video_quality']=json_encode($request->video_quality);
            $data['audio_quality']=json_encode($request->audio_quality);
            $plan->fill($data);
            $plan->save();
            DB::commit();
            $request->session()->flash('success','Plan Updated Successfully !!');
            return redirect()->route('plan.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Plan $plan)
    {
        DB::beginTransaction();
        try{
            $plan->delete();
            DB::commit();
            $request->session()->flash('success','Plan Deleted Successfully !!');
            return redirect()->route('plan.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
