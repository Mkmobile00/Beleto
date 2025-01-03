<?php

namespace App\Http\Controllers;

use ReflectionClass;
use App\Models\Device;
use App\Models\Category;
use App\Models\PlanContent;
use App\Models\AudioQuality;
use App\Models\VideoQuality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enum\Plan\CategoryTypeEnum;
use App\Http\Requests\PlanContentStoreRequest;

class PlanContentController extends Controller
{
    protected $planContent;
    public function __construct(PlanContent $planContent)
    {
        $this->planContent=$planContent;
    }
    public function index(Request $request)
    {

        $planContent = PlanContent::first();
        if ($planContent == null) {
            $request->session()->flash('success','Plan Content Created Successfully !!');
            return redirect()->route('plan-content.create');
            
        }
        $request->session()->flash('success','Plan Content Updated Successfully !!');
        return redirect()->route('plan-content.edit', $planContent);
        
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryType=new ReflectionClass(CategoryTypeEnum::class);
        $categoryType=array_values($categoryType->getConstants());
        $planContent=PlanContent::first();
        $data=[
            'movieCat'=>Category::where('status','1')->get(),
            'movieCategory'=>$categoryType,
            'videoQualitys'=>VideoQuality::where('status','1')->get(),
            'devices'=>Device::where('status','1')->get(),
            'audios'=>AudioQuality::where('status','1')->get(),
            'planContent'=>PlanContent::first()
        ];
        
        if ($data['planContent'] == null) {
            return view('admin.plancontent.form',$data);
        }
        return redirect()->route('plan-content.edit', $data['planContent']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanContentStoreRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try{
            $data=$request->all();
            if($request->download && $request->download=='1'){
                $data['download']='1';
            }else{
                $data['download']='0';
            }
            $data['content']=json_encode($request->content);
            $data['device']=json_encode($request->device);
            $data['categoryitem']=json_encode($request->categoryitem);
            $data['video_quality']=json_encode($request->video_quality);
            $data['audio_quality']=json_encode($request->audio_quality);
            $this->planContent->fill($data);
            $this->planContent->save();
            DB::commit();
            $request->session()->flash('success','Plan Content Created Successfully !!');
            return redirect()->route('plan-content.index');
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
    public function show(PlanContent $planContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanContent $planContent)
    {
        $categoryType=new ReflectionClass(CategoryTypeEnum::class);
        $categoryType=array_values($categoryType->getConstants());
        $planContent=PlanContent::first();
        $data=[
            'movieCat'=>Category::where('status','1')->get(),
            'movieCategory'=>$categoryType,
            'videoQualitys'=>VideoQuality::where('status','1')->get(),
            'devices'=>Device::where('status','1')->get(),
            'audios'=>AudioQuality::where('status','1')->get(),
            'planContent'=>PlanContent::first()
        ];
        $data['planContent'] = $planContent;
        if ($data['planContent'] == null) {
            return redirect()->route('plan-content.index');
        }
        return view('admin.plancontent.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanContentStoreRequest $request, PlanContent $planContent)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            if($request->download && $request->download=='1'){
                $data['download']='1';
            }else{
                $data['download']='0';
            }
            $data['content']=json_encode($request->content);
            $data['device']=json_encode($request->device);
            $data['categoryitem']=json_encode($request->categoryitem);
            // dd($data);
            $planContent->fill($data);
            $planContent->save();
            DB::commit();
            $request->session()->flash('success','Plan Content Updated Successfully !!');
            return redirect()->route('plan-content.index');
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
    public function destroy(PlanContent $planContent)
    {
        //
    }
}
