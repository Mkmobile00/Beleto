<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeviceStoreRequest;
use App\Http\Requests\DeviceUpdateRequest;

class DeviceController extends Controller
{
    protected $device;
    public function __construct(Device $device)
    {
        $this->device=$device;
    }
    public function index()
    {
        $data['devices']=$this->device->get();
        return view('admin.setting.device.index',$data);
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
    public function store(DeviceStoreRequest $request)
    {
        $data=$request->all();
        DB::beginTransaction();
        try{
            $this->device->fill($data);
            $this->device->save();
            DB::commit();
            $request->session()->flash('success','Device Added Successfully !!');
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
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        $data['device']=$device;
        return view('admin.setting.device.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeviceUpdateRequest $request, Device $device)
    {
        $data=$request->all();
        DB::beginTransaction();
        try{
            $device->fill($data);
            $device->save();
            DB::commit();
            $request->session()->flash('success','Device Updated Successfully !!');
            return redirect()->route('device.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Device $device)
    {
        DB::beginTransaction();
        try{
            $device->delete();
            DB::commit();
            $request->session()->flash('success','Device Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
