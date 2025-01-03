<?php

namespace App\Http\Controllers;

use App\Models\Star;
use Illuminate\Http\Request;
use App\Enum\Star\StarTypeEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StarStoreRequest;
use App\Http\Requests\StarUpdateRequest;

class StarController extends Controller
{
    protected $star;
    public function __construct(Star $star)
    {
        $this->star=$star;
    }
    public function index()
    {
        $data['stars']=$this->star->get();
        return view('admin.star.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeData=new \ReflectionClass(StarTypeEnum::class);
        $data['starTypes']=array_values($typeData->getConstants());
        return view('admin.star.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StarStoreRequest $request)
    {
        
        DB::beginTransaction();
        try{
            $data=$request->all();
            $this->star->fill($data);
            $this->star->save();
            DB::commit();
            $request->session()->flash('success','Genre Star Successfully !!');
            return redirect()->route('star.index');
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
    public function show(Star $star)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Star $star)
    {
        $typeData=new \ReflectionClass(StarTypeEnum::class);
        $data['starTypes']=array_values($typeData->getConstants());
        $data['star']=$star;
        return view('admin.star.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StarUpdateRequest $request, Star $star)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $star->fill($data);
            $star->save();
            DB::commit();
            $request->session()->flash('success','Star Updated Successfully !!');
            return redirect()->route('star.index');
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
    public function destroy(Request $request,Star $star)
    {
        DB::beginTransaction();
        try{
            $star->delete();
            DB::commit();
            $request->session()->flash('success','Star Deleted Successfully !!');
            return redirect()->route('star.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
