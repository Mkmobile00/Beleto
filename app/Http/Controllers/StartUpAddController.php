<?php

namespace App\Http\Controllers;

use App\Models\StartUpAdd;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enum\Customer\CustomerStatusEnum;
use App\Http\Requests\StartUpAssStoreRequest;
use App\Http\Requests\StartUpAssUpdateRequest;

class StartUpAddController extends Controller
{
    protected $startupadd;
    public function __construct(StartUpAdd $startupadd)
    {
        $this->startupadd=$startupadd;
    }
    public function index()
    {
        $data['startupData']=$this->startupadd->get();
        return view('admin.startupadd.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['statuses']=array_values((new \ReflectionClass(CustomerStatusEnum::class))->getConstants());
        return view('admin.startupadd.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StartUpAssStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['slug']=Str::slug($request->title);
            $this->startupadd->fill($data);
            $this->startupadd->save();
            DB::commit();
            $request->session()->flash('success','Startup Add Created Successfully !!');
            return redirect()->route('startupadd.index');
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
    public function show(StartUpAdd $startupadd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StartUpAdd $startupadd)
    {
        $data['startupadd']=$startupadd;
        $data['statuses']=array_values((new \ReflectionClass(CustomerStatusEnum::class))->getConstants());
        return view('admin.startupadd.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StartUpAssUpdateRequest $request, StartUpAdd $startupadd)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $startupadd->fill($data);
            $startupadd->save();
            DB::commit();
            $request->session()->flash('success','Startup Add Updated Successfully !!');
            return redirect()->route('startupadd.index');
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
    public function destroy(Request $request,StartUpAdd $startupadd)
    {
        
        DB::beginTransaction();
        try{
            $startupadd->delete();
            DB::commit();
            $request->session()->flash('success','Startup Add Deleted Successfully !!');
            return redirect()->route('startupadd.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
