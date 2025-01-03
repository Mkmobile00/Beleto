<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Models\FooterContent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\FooterContentStoreRequest;

class FooterContentController extends Controller
{
    protected $footerContent;
    public function __construct(FooterContent $footerContent)
    {
        $this->footerContent=$footerContent;    
    }
    public function index()
    {
        $footerContent = FooterContent::first();
        if ($footerContent == null) {
            return redirect()->route('footer-setting.create');
        }
        return redirect()->route('footer-setting.edit', $footerContent);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['footerContent'] = FooterContent::first();
        if ($data['footerContent'] == null) {
            return view('admin.setting.footercontent.form',$data);
        }
        return redirect()->route('footer-setting.edit', $data['footerContent']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FooterContentStoreRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $this->footerContent->fill($input);
            $this->footerContent->save();
            DB::commit();
            $request->session()->flash('success', 'Successfully Saved.');
            return redirect()->route('footer-setting.edit',$this->footerContent->id);
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
        $footerContent=FooterContent::first();
        $data['footerContent'] = $footerContent;
        if ($data['footerContent'] == null) {
            return redirect()->route('footer-setting.index');
        }
        return view('admin.setting.footercontent.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FooterContentStoreRequest $request,$id)
    {
        
        $footerContent=FooterContent::findOrFail($id);
        $input = $request->all();
        DB::beginTransaction();
        try {
            $footerContent->fill($input);
            $footerContent->save();
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
