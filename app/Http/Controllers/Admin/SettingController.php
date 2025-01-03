<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Actions\SettingAction\SettingEditAction;
use App\Actions\SettingAction\SettingStoreAction;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        if ($setting == null) {
            return redirect()->route('setting.create');
        }
        return redirect()->route('setting.edit', $setting);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::first();
        $sessionData=session()->get('lang') ?? 'en';
        if ($setting == null) {
            return view('admin.setting.form',compact('sessionData'));
        }
        return redirect()->route('setting.edit', $setting);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $settingData=(new SettingStoreAction($request))->arrangeStoreData();
            if($settingData !='success')
            {
                throw new Exception();
            }
            DB::commit();
            $request->session()->flash('success', 'Successfully Saved.');
            return redirect()->back();
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
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Setting $setting)
    {
        $data = [
            'setting' => $setting,
            'sessionData'=>session()->get('lang') ?? 'en'
        ];
        return view('admin.setting.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $input = $request->all();
        $sessionValue=session()->get('lang') ?? 'en';
        DB::beginTransaction();
        try {
            $finalData=(new SettingEditAction($request,$sessionValue,$setting))->arrangeUpdateData();
            if($finalData !=='success')
            {
                throw new Exception();
            }
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
        dd('index');
    }



    public function test()
    {
        $token = uniqid();

    // Save the token in the session for later retrieval
        session(['scanned_token' => $token]);

     // Generate the QR code with the token as a parameter in the URL
        $qrCode = QrCode::size(100)->generate(route('process.scanned.data', ['token' => $token]));
        dd($qrCode);

    // Return the view with the QR code image data
    return view('admin.setting.qr', compact('qrCode'));
    }
}
