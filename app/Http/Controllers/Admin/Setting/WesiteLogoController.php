<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\WebsiteLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\WebsiteLogoStoreRequest;

class WesiteLogoController extends Controller
{
    protected $websiteLogo;
    public function __construct(WebsiteLogo $websiteLogo)
    {
        $this->websiteLogo=$websiteLogo;    
    }
    public function index()
    {
        $websiteLogo = WebsiteLogo::first();
        if ($websiteLogo == null) {
            return redirect()->route('websitelogo-setting.create');
        }
        return redirect()->route('websitelogo-setting.edit', $websiteLogo);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['websiteLogo'] = WebsiteLogo::first();
        
        if ($data['websiteLogo'] == null) {
            return view('admin.setting.websitelogo.form',$data);
        }
        return redirect()->route('websitelogo-setting.edit', $data['websiteLogo']);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WebsiteLogoStoreRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $this->websiteLogo->fill($input);
            $this->websiteLogo->save();
            DB::commit();
            $request->session()->flash('success', 'Successfully Saved.');
            return redirect()->route('websitelogo-setting.edit',$this->websiteLogo->id);
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
        $websiteLogo=WebsiteLogo::first();
        $data['websiteLogo'] = $websiteLogo;
        if ($data['websiteLogo'] == null) {
            return redirect()->route('websitelogo-setting.index');
        }
        return view('admin.setting.websitelogo.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WebsiteLogoStoreRequest $request,$id)
    {
        
        $websiteLogo=WebsiteLogo::findOrFail($id);
        $input = $request->all();
        DB::beginTransaction();
        try {
            $websiteLogo->fill($input);
            $websiteLogo->save();
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
