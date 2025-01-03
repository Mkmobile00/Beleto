<?php

namespace App\Http\Controllers;

use ReflectionClass;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enum\Period\PeriodTypeEnum;
use App\Http\Requests\PeriodStoreRequest;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $period;
    public function __construct(Period $period)
    {
        $this->period=$period;
    }
    public function index()
    {
        $data['periods']=$this->period->orderBy('type','ASC')->get();
        $enumType=new ReflectionClass(PeriodTypeEnum::class);
        $data['types']=array_values($enumType->getConstants());
        return view('admin.period.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeriodStoreRequest $request)
    {
        $existData=Period::where('value',$request->value)->where('type',$request->type)->first();
        if($existData){
            $request->session()->flash('error','Data Already Exist Plz Try With Another !!');
            return redirect()->back();
        }
        $data=$request->all();
        DB::beginTransaction();
        try{
            $this->period->fill($data);
            $this->period->save();
            DB::commit();
            $request->session()->flash('success','Period Added Successfully !!');
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
    public function show(Period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Period $period)
    {
        $data['period']=$period;
        $enumType=new ReflectionClass(PeriodTypeEnum::class);
        $data['types']=array_values($enumType->getConstants());
        return view('admin.period.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PeriodStoreRequest $request, Period $period)
    {
        $existData=Period::where('value',$request->value)->where('id','!=',$period->id)->where('type',$request->type)->first();
        if($existData){
            $request->session()->flash('error','Data Already Exist Plz Try With Another !!');
            return redirect()->back();
        }
        $data=$request->all();
        DB::beginTransaction();
        try{
            $period->fill($data);
            $period->save();
            DB::commit();
            $request->session()->flash('success','Period Updated Successfully !!');
            return redirect()->route('period.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Period $period)
    {
        //
    }
}
