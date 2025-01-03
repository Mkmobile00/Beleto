<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use Illuminate\Support\Carbon;
use App\Http\Traits\TimeZoneTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SystemStoreRequest;
use PHPUnit\Event\Telemetry\System;

class SystemSettingController extends Controller
{
    use TimeZoneTrait;
    /**
     * Display a listing of the resource.
     */
    protected $systemSetting;
    public function __construct(SystemSetting $systemSetting)
    {
        $this->systemSetting=$systemSetting;    
    }
    public function index()
    {
        $systemSetting = SystemSetting::first();
        if ($systemSetting == null) {
            return redirect()->route('system-setting.create');
        }
        return redirect()->route('system-setting.edit', $systemSetting);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['systemSetting'] = SystemSetting::first();
        $data['sessionData']=session()->get('lang') ?? 'en';
        $data['serverTime'] = Carbon::now()->format('Y-m-d H:i:s');
        $data['timeZone']=$this->getTimezoneList();
        if ($data['systemSetting'] == null) {
            return view('admin.setting.systemsetting.form',$data);
        }
        return redirect()->route('system-setting.edit', $data['systemSetting']);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SystemStoreRequest $request)
    {
        
        $input = $request->all();
      
        DB::beginTransaction();
        try {
            $this->systemSetting->fill($input);
            $this->systemSetting->save();
            DB::commit();
            $request->session()->flash('success', 'Successfully Saved.');
            return redirect()->route('system-setting.edit',$this->systemSetting->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session()->flash('error', 'Something Went Wrong !!.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        
        $systemSetting=SystemSetting::first();
        $data['systemSetting'] = $systemSetting;
        $data['sessionData']=session()->get('lang') ?? 'en';
        $data['serverTime'] = Carbon::now()->format('Y-m-d H:i:s');
        $data['timeZone']=$this->getTimezoneList();
        if ($data['systemSetting'] == null) {
            return redirect()->route('system-setting.index');
        }
        return view('admin.setting.systemsetting.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SystemStoreRequest $request,SystemSetting $systemSetting)
    {
        
        $input = $request->all();
       
        DB::beginTransaction();
        try {
            $systemSetting->fill($input);
            $systemSetting->save();
            DB::commit();
            $request->session()->flash('success', 'Successfully Updated.');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session()->flash('error', 'Something Went Wrong !!.');
            return redirect()->back();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->back();
    }
}
