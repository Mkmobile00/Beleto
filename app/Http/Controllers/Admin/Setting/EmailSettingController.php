<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\EmailSetting;
use Illuminate\Http\Request;
use App\Http\Traits\ArrayTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\EmailSettingStoreRequest;

class emailSettingController extends Controller
{
    use ArrayTrait;
    protected $emailSetting;
    public function __construct(EmailSetting $emailSetting)
    {
        $this->emailSetting=$emailSetting;    
    }
    public function index()
    {
        
        $emailSetting = EmailSetting::first();
        if ($emailSetting == null) {
            return redirect()->route('email-setting.create');
        }
        return redirect()->route('email-setting.edit', $emailSetting);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['emailSetting'] = EmailSetting::first();
        $data['mailType']=$this->mailType();
        $data['smtpCrypto']=$this->smtpCrypto();
        
        if ($data['emailSetting'] == null) {
            return view('admin.setting.emailsetting.form',$data);
        }
        return redirect()->route('email-setting.edit', $data['emailSetting']);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailSettingStoreRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $this->emailSetting->fill($input);
            $this->emailSetting->save();
            DB::commit();
            $request->session()->flash('success', 'Successfully Saved.');
            return redirect()->route('email-setting.edit',$this->emailSetting->id);
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
        $emailSetting=EmailSetting::first();
        $data['emailSetting'] = $emailSetting;
        $data['mailType']=$this->mailType();
        $data['smtpCrypto']=$this->smtpCrypto();
        if ($data['emailSetting'] == null) {
            return redirect()->route('email-setting.index');
        }
        return view('admin.setting.emailsetting.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailSettingStoreRequest $request,EmailSetting $emailSetting)
    {
        
        $input = $request->all();
        DB::beginTransaction();
        try {
            $emailSetting->fill($input);
            $emailSetting->save();
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
