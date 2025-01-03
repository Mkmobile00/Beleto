<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\ThemeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Traits\ArrayTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ThemeOptionStoreRequest;

class ThemeOptionController extends Controller
{
    use ArrayTrait;
    protected $themeOption;
    public function __construct(ThemeOption $themeOption)
    {
        $this->themeOption=$themeOption;    
    }
    public function index()
    {
        $themeOption = ThemeOption::first();
        if ($themeOption == null) {
            return redirect()->route('theme-option.create');
        }
        return redirect()->route('theme-option.edit', $themeOption);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['themeOption'] = ThemeOption::first();
        $data['themeColors']=$this->colorThemes();
        $data['headerTemplate']=$this->headerTemplates();
        $data['footerTemplates']=$this->footerTemplates();
        if ($data['themeOption'] == null) {
            return view('admin.setting.themeoption.form',$data);
        }
        return redirect()->route('theme-option.edit', $data['themeOption']);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThemeOptionStoreRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $this->themeOption->fill($input);
            $this->themeOption->save();
            DB::commit();
            $request->session()->flash('success', 'Successfully Saved.');
            return redirect()->route('theme-option.edit',$this->themeOption->id);
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
        
        $themeOption=ThemeOption::first();
        $data['themeOption'] = $themeOption;
        $data['themeColors']=$this->colorThemes();
        $data['headerTemplate']=$this->headerTemplates();
        $data['footerTemplates']=$this->footerTemplates();
      
        if ($data['themeOption'] == null) {
            return redirect()->route('theme-option.index');
        }
        return view('admin.setting.themeOption.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ThemeOptionStoreRequest $request,ThemeOption $themeOption)
    {
       
        $input = $request->all();
        DB::beginTransaction();
        try {
            $themeOption->fill($input);
            $themeOption->save();
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
