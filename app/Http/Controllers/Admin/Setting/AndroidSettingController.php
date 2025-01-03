<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Models\AndroidSetting;
use App\Http\Traits\ArrayTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\AndroidSettingStoreRequest;

class AndroidSettingController extends Controller
{
    use ArrayTrait;
    protected $androidSetting;
    public function __construct(AndroidSetting $androidSetting)
    {
        $this->androidSetting=$androidSetting;    
    }
    public function index()
    {
        
        $androidSetting = AndroidSetting::first();
        if ($androidSetting == null) {
            return redirect()->route('android-setting.create');
        }
        return redirect()->route('android-setting.edit', $androidSetting);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $data['androidSetting'] = AndroidSetting::first();
        $data['preLoaders']=$this->preLoaders();
        $data['confirmations']=$this->confirmations();
        
        if ($data['androidSetting'] == null) {
            return view('admin.setting.androidSetting.form',$data);
        }
        return redirect()->route('android-setting.edit', $data['androidSetting']);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AndroidSettingStoreRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $this->androidSetting->fill($input);
            $this->androidSetting->save();
            DB::commit();
            $request->session()->flash('success', 'Successfully Saved.');
            return redirect()->route('android-setting.edit',$this->androidSetting->id);
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
        $androidSetting=AndroidSetting::first();
        $data['androidSetting'] = $androidSetting;
        $data['preLoaders']=$this->preLoaders();
        $data['confirmations']=$this->confirmations();
      
        if ($data['androidSetting'] == null) {
            return redirect()->route('android-setting.index');
        }
        return view('admin.setting.androidSetting.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AndroidSettingStoreRequest $request,AndroidSetting $androidSetting)
    {
        
        $input = $request->all();
        DB::beginTransaction();
        try {
            $androidSetting->fill($input);
            $androidSetting->save();
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
