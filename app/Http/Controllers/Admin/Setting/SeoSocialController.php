<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\SeoSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SeoSocialStoreRequest;

class SeoSocialController extends Controller
{
    protected $seoSocial;
    public function __construct(SeoSocial $seoSocial)
    {
        $this->seoSocial=$seoSocial;    
    }
    public function index()
    {
        $seoSocial = SeoSocial::first();
        if ($seoSocial == null) {
            return redirect()->route('seosocial-setting.create');
        }
        return redirect()->route('seosocial-setting.edit', $seoSocial);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['seoSocial'] = SeoSocial::first();
        if ($data['seoSocial'] == null) {
            return view('admin.setting.seosocial.form',$data);
        }
        return redirect()->route('seosocial-setting.edit', $data['seoSocial']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeoSocialStoreRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $this->seoSocial->fill($input);
            $this->seoSocial->save();
            DB::commit();
            $request->session()->flash('success', 'Successfully Saved.');
            return redirect()->route('seosocial-setting.edit',$this->seoSocial->id);
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
        $seoSocial=SeoSocial::first();
        $data['seoSocial'] = $seoSocial;
        if ($data['seoSocial'] == null) {
            return redirect()->route('seosocial-setting.index');
        }
        return view('admin.setting.seosocial.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeoSocialStoreRequest $request,$id)
    {
        
        $seoSocial=SeoSocial::findOrFail($id);
        $input = $request->all();
        DB::beginTransaction();
        try {
            $seoSocial->fill($input);
            $seoSocial->save();
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
